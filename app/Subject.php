<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        return $query->where('user_id', '=', Auth::id());
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
            return -1;
        }

        $gradeStack = 0;
        foreach ($grades as $grade) {
            $gradeStack += $grade->grade;
        }

        return round($gradeStack / count($grades), 2);
    }
}