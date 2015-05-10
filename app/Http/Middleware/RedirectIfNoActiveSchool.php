<?php namespace App\Http\Middleware;

use App\Services\Shortcut;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RedirectIfNoActiveSchool
{

    protected $shortcut;

    public function __construct(Shortcut $shortcut)
    {
        $this->shortcut = $shortcut;
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
        if ($this->shortcut->getActiveSchool() == null) {
            // Check if the user has created any semester yet and make it the active semester once he has created one
            $firstSchool = Auth::user()->schools()->first();
            if ($firstSchool != null) {
                \Setting::set('activeSchoolId', $firstSchool->id);
                \Setting::save();

                return $next($request);
            }
            // Redirect to semester creation page and tell the user that he must create a semester
            return redirect('semester/create')->with('message', 'Um Noten erfassen zu können, musst du zuerst ein Semester erstellen. Du kannst auch mehrere Semester erstellen sowie deine Semester im nachhinein verwarten (editieren, löschen).');
        }
        return $next($request);


        // Check if the user has an active school

    }

}
