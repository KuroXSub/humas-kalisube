<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CleanOutputMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Clear all output buffers for download responses
        if ($response->headers->get('content-disposition') && 
            str_contains($response->headers->get('content-disposition'), 'attachment')) {
            if (ob_get_length()) ob_clean();
        }
        
        return $response;
    }
}
