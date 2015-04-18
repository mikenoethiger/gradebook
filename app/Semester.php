<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Semester extends Model {

	use SoftDeletes;

    // Needed for SoftDelete
    protected $dates = ['deleted_at'];

    // See query scopes: http://laravel.com/docs/5.0/eloquent#query-scopes
    public function scopeOfCurrentUser($query)
    {
        return $query->where('user_id', '=', Auth::id());
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }
}
