<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

    // Needed for SoftDelete
    protected $dates = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function semesters()
    {
        return $this->hasMany('App\Semester');
    }

    public function schools()
    {
        return $this->hasMany('App\School');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    public function activeSemester()
    {
        return $this->hasOne('App\Semester', 'id', 'active_semester');
    }

    public function activeSchool()
    {
        return $this->hasOne('App\School', 'id', 'active_school');
    }
}
