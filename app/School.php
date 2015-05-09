<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Semester;

class School extends Model {

    use SoftDeletes;

    // Needed for SoftDelete
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id'];

    // See query scopes: http://laravel.com/docs/5.0/eloquent#query-scopes
    public function scopeOfCurrentUser($query)
    {
        return $query->where('user_id', '=', Auth::id());
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function semesters()
    {
        return $this->hasMany('App\Semester');
    }

    public function addSemester($user = null)
    {
        if ($user == null)
        {
            $user = Auth::user();
        }
        //$lastSemester = Semester::ofCurrentUser()->orderBy('semester_number', 'DESC')->first();
        $lastSemester = Semester::where('user_id', '=', $user->id)->where('school_id', '=', $this->id)->orderBy('semester_number', 'DESC')->first();
        $newSemesterNumber = 1;
        if ($lastSemester != null) {
            $newSemesterNumber = ($lastSemester->semester_number + 1);
        }
        return Semester::create(['semester_number' => $newSemesterNumber, 'school_id' => $this->id, 'user_id' => $user->id]);
    }
}
