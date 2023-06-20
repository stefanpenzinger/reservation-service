<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateUser
{
    /**
     * Handles the incoming request and checks if the user is authenticated for this request
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     * @throws GuzzleException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiToken = $request->header('Authorization');

        // Send a request to the user-management-service to validate the token
        $client = new Client();
        $response = $client->post('user-management-app/api/v1/verify-token', [
            'headers' => ['Authorization' => $apiToken]
        ]);


        // Check the response status code to determine if the token is valid
        if ($response->getStatusCode() !== 200) {
            return response('Unauthorized', 401);
        }

        // Token is valid, continue with the request
        return $next($request);
    }
}
