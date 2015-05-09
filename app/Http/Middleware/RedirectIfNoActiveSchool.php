<?php namespace App\Http\Middleware;

use App\Services\Shortcut;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RedirectIfNoActiveSchool
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
        // Check if the user has an active school
        if ($this->env->getActiveSchool() == null) {
            // Check if the user has created any school yet and make it the active school once he has created one
            $user = Auth::user();
            $firstSchool = $user->schools()->first();
            if ($firstSchool != null) {
                $user->active_school = $firstSchool->id;
                $user->save();
                return $next($request);
            }
            // Redirect to school creation page and tell the user that he must create a school
            return redirect('school/create')->with('message', 'Um Noten erfassen zu können, musst du zuerst die Schule an welche du gehst erstellen. Du kannst auch mehrere Schulen erstellen sowie deine Schulen im nachhinein verwarten (editieren, löschen)');
        }
        return $next($request);
    }

}
