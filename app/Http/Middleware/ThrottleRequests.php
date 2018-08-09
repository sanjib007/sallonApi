<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\JsonResponse;

class ThrottleRequests
{
    /**
     * The rate limiter instance.
     *
     * @var \Illuminate\Cache\RateLimiter
     */
    protected $limiter;

    /**
     * Create a new request throttler.
     *
     * @param  \Illuminate\Cache\RateLimiter $limiter
     *
     * @return void
     */
    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  int                      $maxAttempts
     * @param  int                      $decayMinutes
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1)
    {
        $key = $this->resolveRequestSignature($request);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts, $decayMinutes)) {
           // if ($request->expectsJson()) {
                return $this->buildJsonResponse($key, $maxAttempts);
         //   } else {
          //      return $this->buildResponse($key, $maxAttempts);
         //   }
        }

        $this->limiter->hit($key, $decayMinutes);

        $response = $next($request);

        return $this->addHeaders(
            $response,
            $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts)
        );
    }

    /**
     * Resolve request signature.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function resolveRequestSignature($request)
    {
        return sha1(
            $request->method() .
            '|' . $request->getHost() .
            '|' . $request->ip()
        );
    }

   
    /**
     * Add the limit header information to the given response.
     *
     * @param  \Illuminate\Http\Response $response
     * @param  int                       $maxAttempts
     * @param  int                       $remainingAttempts
     * @param  int|null                  $retryAfter
     *
     * @return \Illuminate\Http\Response
     */
    protected function addHeaders(Response $response, $maxAttempts, $remainingAttempts, $retryAfter = null)
    {
        $headers = [
            'X-RateLimit-Limit'     => $maxAttempts,
            'X-RateLimit-Remaining' => $remainingAttempts,
        ];

        if (!is_null($retryAfter)) {
            $headers['Retry-After'] = $retryAfter;
        }

        $response->headers->add($headers);

        return $response;
    }

    /**
     * Calculate the number of remaining attempts.
     *
     * @param  string $key
     * @param  int    $maxAttempts
     *
     * @return int
     */
    protected function calculateRemainingAttempts($key, $maxAttempts)
    {
        return $maxAttempts - $this->limiter->attempts($key) + 1;
    }


    protected function buildJsonResponse($key, $maxAttempts)
    {
        
    
       

        $retryAfter = $this->limiter->availableIn($key);
        $headers = [
            'X-RateLimit-Limit'     => $maxAttempts,
            'X-RateLimit-Remaining' => $this->calculateRemainingAttempts($key, $maxAttempts),
        ];

        if (!is_null($retryAfter)) {
            $headers['Retry-After'] = $retryAfter;
        }

        return  response()->json(['error' => 'Too many Attempt'],429,$headers);

        // return $this->addHeaders(
        //     $response,
        //     $maxAttempts,
        //     $this->calculateRemainingAttempts($key, $maxAttempts),
        //     $this->limiter->availableIn($key)
        // );
        
    }



     /**
     * Create a 'too many attempts' response.
     *
     * @param  string $key
     * @param  int    $maxAttempts
     *
     * @return \Illuminate\Http\Response
     */
    protected function buildResponse($key, $maxAttempts)
    {
        $response = new Response('Too Many Attempts.', 429);

        return $this->addHeaders(
            $response,
            $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts),
            $this->limiter->availableIn($key)
        );
    }

}