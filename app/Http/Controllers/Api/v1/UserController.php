<?php

namespace App\Http\Controllers\Api\v1;

use App\Mail\UserCreated;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('CheckUserOwnRequest', ['only' => ['update', 'destroy']]);

    }

    public function index()
    {
        $user = User::all();
        return $this->showAll($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->showOne($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $id)
//    {
//        $rules = [
//            'email' => 'sometimes|email|unique:users',
//            'password' => 'sometimes|min:6|confirmed',
//            'cover_image' => 'sometimes|required|image',
//            'phone_no' => 'sometimes|min:10|numeric|unique:users,phone_no',
//        ];
//        $this->validate($request, $rules);
//
//        if ($request->has('name')) {
//            $user->name = $request->name;
//        }
//        if ($request->has('phone_no')) {
//            $user->phone_no = $request->phone_no;
//        }
//        if ($request->has('email') && $user->email != $request->email) {
//            $user->verified = User::UNVERIFIED_USER;
//            $user->verification_token = User::generateVerificationCode();
//            $user->email = $request->email;
//        }
//        if ($request->has('password')) {
//            $user->password = bcrypt($request->password);
//        }
//
//
//        if ($request->has('cover_image')) {
//            $file = $request->file('cover_image');
//            $image = Image::make($file);
//            $image->encode('jpg', 50);
//            $fileName = uniqid('img_') . ".jpg";
//            $image->resize(300, 200, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//            $image->save(public_path('img/'.$fileName));
//            $user->image_thumb = $fileName;
//        }
//
//
//
//
//        if (!$user->isDirty()) {
//            return $this->errorResponse('you need to specify a diffenrt value to update code', 422);
//        }
//        $user->save();
//        return $this->showOne($user);
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user->delete();
        return $this->showOne($user);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();
        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;
        $user->save();
        return $this->showMessage('The account has been verified successfully');
    }

    public function resend($id)
    {
        $user = User::find($id);

        if ($user->isVerified()) {
            return $this->errorResponse("this user is already verified", 409);
        }
        $user->verification_token = User::generateVerificationCode();
        $user->save();
        Mail::to($user)->send(new UserCreated($user));
        return $this->showMessage("The verification email send successfully");
    }




    public function getRefreshToken(Request $request)
    {
        $rules = [
            'token' => 'required',
        ];
        $this->validate($request, $rules);
        $client = new \GuzzleHttp\Client();
        $response = "";
        // try{
        $response = $client->post(route('oauth.token'), [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->token,
                'client_id' => env('client_id', 2),
                'client_secret' => env('client_secret', 'EoI5mImtDRySqc89HiUJIorBhcIZct9V6Z6IwzCx'),
            ],
            'http_errors' => false //add this to return errors in json
        ]);
        return $response;
//        }catch (\Exception $e){
//
//            return \GuzzleHttp\json_decode(json_encode($e->getMessage()));
//            return $e->getMessage();
//            return json_encode(json_decode($e->getMessage()));
//        }
    }

    public function logout(Request $request)
    {
        $accessToken = Auth::user()->token();
        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);
        $accessToken->revoke();
        return $this->showMessage("you are logout successfully", 200);
    }


    public function registerUserData()
    {

        return $this->showOne(request()->user(), 200);
    }


    public function update_cover(Request $request, User $user){
        $rules = [
            'cover_image' => 'sometimes|required|image',
        ];
        $this->validate($request, $rules);

        //dd($request->all());hasFile


        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $image = Image::make($file);
            $image->encode('jpg', 50);
            $fileName = uniqid('img_') . ".jpg";
            $image->resize(300, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path('img/'.$fileName));
            $user->image_thumb = $fileName;
        }




        if (!$user->isDirty()) {
            return $this->errorResponse('you need to specify a diffenrt value to update code', 422);
        }
        $user->save();
        return $this->showOne($user);
    }
}
