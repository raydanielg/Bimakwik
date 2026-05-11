<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $moduleCode, $permission = 'view')
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $user = auth()->user();

        if (!$user->hasModulePermission($moduleCode, $permission)) {
            abort(403, 'Unauthorized. You do not have permission to access this resource.');
        }

        $restrictions = $user->getModuleRestrictions($moduleCode);
        if ($restrictions) {
            $request->merge(['_restrictions' => $restrictions]);
        }

        return $next($request);
    }
}
