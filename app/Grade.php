<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Grade extends Model {

	use SoftDeletes;

    // Needed for SoftDelete
    protected $dates = ['deleted_at'];

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
}