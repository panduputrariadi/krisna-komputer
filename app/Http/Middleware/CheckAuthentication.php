<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthentication
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            Alert::info('Info', 'Tolong login terlebih dahulu ataupun register untuk dapat akses selebihnya')->persistent(true, false);
            return redirect('/login');
        }

        return $next($request);
    }
}
