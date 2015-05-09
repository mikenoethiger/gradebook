<?php namespace App\Http\Middleware;

use App\Services\Shortcut;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNoActiveSemester
{

    protected $env;

    public function __construct(Shortcut $env)
    {
        $this->env = $env;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user has an active semester
        if ($this->env->getActiveSemester() == null) {
            // Check if the user has created any semester yet and make it the active semester once he has created one
            $user = Auth::user();
            $firstSemester = $this->env->getActiveSchool()->semesters()->first();
            if ($firstSemester != null) {
                $user->active_semester = $firstSemester->id;
                $user->save();
                return $next($request);
            }
            // Redirect to semester creation page and tell the user that he must create a semester
            return redirect('semester/create')->with('message', 'Um Noten erfassen zu können, musst du zuerst ein Semester erstellen. Du kannst auch mehrere Semester erstellen sowie deine Semester im nachhinein verwarten (editieren, löschen).');
        }
        return $next($request);
    }

}
