<?php

namespace App\Http\Controllers\Api\v1;

use App\Mail\UserCreated;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{

    /**
     * AuthenticationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth',['only'=>[
            'logout'
        ]]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registration(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone_no' => 'required|min:10|numeric|unique:users',
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;
        if ($request->hasFile('image_thumb')) {
            $data['image_thumb'] = $request->image_thumb->store('');
        } else {
            $data['image_thumb'] = null;
        }
        $user = User::create($data);
        Mail::to($user)->send(new UserCreated($user));
        return $this->showOne($user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ];
        $this->validate($request, $rules);

        $user = User::where('email', $request->username)->first();


        if (!$user) {
            return $this->errorResponse("User not found", 401);
        }
        if (!matchPassword($user->password, $request->password)) {
            return $this->errorResponse("UserName & Password does not match", 401);
        }
        if ($user->verified == User::UNVERIFIED_USER) {
            return $this->errorResponse("you are not verified resend mail and again verified", 401);
        }
        try {
            $client = new Client([
                'base_uri' => env('APP_URL')
            ]);
            $headers = array();
            // $headers['Accept'] = "application/json";
            $response = $client->request('POST', '/v1/oauth/token',['form_params' => [
                'grant_type' => 'password',
                'client_id' => $request->client_id,
                'client_secret' => $request->client_secret,
                'username' => $request->username,
                'password' => $request->password,
            ]]);
            return json_decode((string)$response->getBody(), true);
        } catch (ClientException $e) {

            return $this->errorResponse("unauthorize",401);
        }


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $accessToken = $request->user()->token();

        $refreshToken = app('db')
            ->table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return $this->showMessage("logout successfully",200);


    }
}
