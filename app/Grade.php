<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Grade extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['grade', 'user_id', 'subject_id'];

    // Needed for SoftDelete
    protected $dates = ['deleted_at'];

    private $appData;

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // See query scopes: http://laravel.com/docs/5.0/eloquent#query-scopes
    public function scopeOfCurrentUser($query)
    {
        return $query->where('user_id', '=', Auth::id());
    }

    public function scopeOfSemester($query, $semesterId)
    {
        return $query->join('subjects', 'grades.subject_id', '=', 'subjects.id')->where('subjects.semester_id', $semesterId);
    }
}