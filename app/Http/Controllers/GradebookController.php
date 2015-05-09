<?php namespace App\Http\Controllers;

use App\Services\Shortcut;
use App\Http\Controllers\Controller;
use App\School;
use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GradebookController extends Controller
{
    protected $activeSchool;
    protected $activeSemester;
    protected $allSchools;
    protected $allSchoolSemesters;

    protected $generalGradebookData;

    // Type hint request so it will get dependency injected by laravel
    // The Request can be used to access route parameters, see: http://laravel.com/docs/5.0/routing#route-parameters
    public function __construct(Shortcut $appData)
    {
        $this->activeSchool = $appData->getActiveSchool();
        $this->activeSemester = $appData->getActiveSemester();
        $this->allSchools = $appData->getAllSchools();
        $this->allSchoolSemesters = $appData->getAllSchoolSemesters();

        $this->generalGradebookData = [
            'activeSchool' => $this->activeSchool,
            'activeSemester' => $this->activeSemester,
            'allSchools' => $this->allSchools,
            'allSchoolSemesters' => $this->allSchoolSemesters
        ];
    }
}