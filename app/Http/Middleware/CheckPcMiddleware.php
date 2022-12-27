<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckPcMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $computerId = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'];
            if (is_null(auth()->user()->pc_id)) {
                User::query()->where('id', auth()->id())->update(['pc_id' => $computerId]);
            } else {
                if ($computerId != auth()->user()->pc_id) {
                    auth()->logout();
                    return redirect(url('/'));
                }
            }
        }
        return $next($request);
    }
}
