<?php namespace App\Services;

use App\Grade;
use App\School;
use App\Semester;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 20.04.15
 * Time: 17:07
 *
 * This service provides general route data such as the school and the semester
 * which is almost on every request (within authenticated zone / app zone).
 *
 * It is provided through the App\Providers\AppServiceProvider.
 * For more information about ServiceProviders look at http://laravel.com/docs/5.0/providers
 */
class Shortcut
{
    public function getActiveSchool()
    {
        $schoolId = \Setting::get('activeSchoolId');
        return School::find($schoolId);
    }

    public function getActiveSemester()
    {
        $semesterId = \Setting::get('activeSemesterId');
        return Semester::find($semesterId);
    }

    public function getAllSchools()
    {
        return School::ofCurrentUser()->get();
    }

    public function getAllSchoolSemesters()
    {
        return $this->getActiveSchool() == null ? null : $this->getActiveSchool()->semesters;
    }

    // The base path represents everything before the main path
    // the main path could be for example /grade/create
    public function getBasePath()
    {
        return '';
    }

    // Returns all subjects of the current semester
    public function getSubjects()
    {
        return $this->getActiveSemester()->subjects;
    }

    // Returns all grades of the current semester
    public function getGrades()
    {
        return $this->getActiveSemester()->grades;
    }
}