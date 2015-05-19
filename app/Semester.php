<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Semester extends Model {

	use SoftDeletes;

    // Needed for SoftDelete
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['semester_number', 'user_id', 'school_id'];

    // See query scopes: http://laravel.com/docs/5.0/eloquent#query-scopes
    public function scopeOfCurrentUser($query)
    {
        return scopeOfUser($query, Auth::id());
    }

    public function scopeOfUser($query, $userId)
    {
        return $query->join('schools', 'schools.id', '=', 'semesters.school_id')->whereUserId($userId)->select('semesters.*');
    }

    public function user()
    {
        return $this->school->user();
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    // The hasManyThrough queries nested relations. Very useful!
    // See: http://laravel.com/docs/5.0/eloquent#has-many-through
    public function grades()
    {
        return $this->hasManyThrough('App\Grade', 'App\Subject');
    }
}