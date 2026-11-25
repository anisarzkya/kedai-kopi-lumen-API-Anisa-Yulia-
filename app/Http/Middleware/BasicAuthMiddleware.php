<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ApiResponse;

class BasicAuthMiddleware
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        $username = $request->getUser();
        $password = $request->getPassword();

        // Kredensial Basic Auth
        if ($username !== 'admin' || $password !== 'kopi123') {
            return $this->sendResponse($request, [
                'status'  => 'error',
                'message' => 'Unauthorized. Masukkan username & password Basic Auth yang benar.'
            ], 401);
        }

        return $next($request);
    }
}
