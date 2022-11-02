<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
       // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'age' => 'required|date',
            'gender' => 'required',
            'password' => 'required|string|confirmed|min:6',
        ]);





        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }


        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'age'=>$request->age,
            'gender'=>$request->gender,
            'linkedin'=> $request->linkedin,
            'emp_id'=> $request->emp_id,
            'skype'=> $request->skype,
            'password'=> bcrypt($request->password),
        ];


        if ($request->file('profile')) {
            $profile_photo_filename = time().$request->file('profile')->getClientOriginalName();
            $profile_photo_filename = preg_replace('/[^A-Za-z0-9\-]/', '', $profile_photo_filename);
            $profile_photo = $request->file('profile')->storeAs('public/img/profile', $profile_photo_filename);
            $data['profile']= $profile_photo_filename;
            //$user->profile_photo = $profile_photo_filename;
        }
        // print_r( $data);
        // die;


        $user = User::create($data);
        return response()->json([
            'message' => 'User successfully registered',
            'data' => $user
        ], 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
