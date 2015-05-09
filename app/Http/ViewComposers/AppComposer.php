<?php namespace App\Http\ViewComposers;

/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 20.04.15
 * Time: 15:13
 */

use App\School;
use App\Semester;
use App\Services\Shortcut;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AppComposer
{
    private $gbRequest;

    // Type hint AppData so it will get dependency injected by laravel
    public function __construct(Shortcut $gbRequest)
    {
        $this->gbRequest = $gbRequest;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = [
            'basePath' => $this->gbRequest->getBasePath(),
            'activeSchool' => $this->gbRequest->getActiveSchool(),
            'activeSemester' => $this->gbRequest->getActiveSemester(),
            'allSchools' => $this->gbRequest->getAllSchools(),
            'allSchoolSemesters' => $this->gbRequest->getAllSchoolSemesters()
        ];
        $view->with($data);
    }
}