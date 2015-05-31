<?php namespace App;

use App\Exceptions\NoGradesException;
use App\Gradebook\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Subject extends Model
{

    use SoftDeletes;

    // Needed for SoftDelete
    protected $dates = ['deleted_at'];

    public static function boot() {
        parent::boot();

        // On Subject delete (see http://laravel.com/docs/5.0/eloquent#model-events), delete the referenced grades too
        Subject::deleting(function($subject)
        {
            foreach ($subject->grades as $grade) {
                $grade->delete();
            }
        });

        // On Subject restore (see http://laravel.com/docs/5.0/eloquent#model-events), restore the referenced grades too
        Subject::restored(function($subject)
        {
            $subject->grades()->restore();
        });
    }

    // See query scopes: http://laravel.com/docs/5.0/eloquent#query-scopes
    public function scopeOfCurrentUser($query)
    {
        return $this->scopeOfUser($query, Auth::id());
    }

    public function scopeOfUser($query, $userId)
    {
        return $query
            ->join('semesters', 'semesters.id', '=', 'subjects.semester_id')
            ->join('schools', 'schools.id', '=', 'semesters.school_id')
            ->whereUserId($userId)
            ->select('subjects.*');
    }

    // Get user who owns this subject
    public function user()
    {
        return $this->semester->school->user();
    }

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    // See "Defining The Inverse Of A Relation": http://laravel.com/docs/5.0/eloquent#relationships
    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    // Just a helper function to calculate the average from all grades of this subject
    public function average()
    {
        $grades = $this->grades;
        if (count($grades) == 0) {
            throw new NoGradesException("The subject '" . $this->name . "' has no grades.");
        }

        return Helper::avgOfArrayItems($this->grades()->lists('grade'));

        $gradeSum = 0;
        $weightSum = 0;
        foreach ($grades as $grade) {
            $weightSum += $grade->weighting;
            $gradeSum += $grade->grade * $grade->weighting;
        }

        $round = App::make('App\Services\Round');

        return $round->tenth($gradeSum / $weightSum);
    }
}