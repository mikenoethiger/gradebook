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
        // Check if the user has an active school
        if ($this->shortcut->getActiveSchool() == null) {
            // If the user has already added a school yet then make it the active one
            $firstSchool = Auth::user()->schools()->first();
            if ($firstSchool != null) {
                \Setting::set('activeSchoolId', $firstSchool->id);
                \Setting::save();

                return $next($request);
            }
            // Redirect to school creation page and tell the user that he must create a school
            return redirect('school/create')->with('well', '<b>Gleich kanns los gehen!</b> An welche Schule gehst du zurzeit? (kann später angepasst werden)');
        }
        return $next($request);
    }

}
