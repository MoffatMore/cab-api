<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Validator;

class AuthController extends Controller
{
    private $apiToken;

    public function __construct()
    {
        // Unique Token
        $this->apiToken = uniqid(base64_encode(str_random(60)));
    }
    /**
     * Client Login
     */
    public function postLogin(Request $request)
    {
        // Validations
        $rules = [
            'email'=>'required|email',
            'password'=>'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Validation failed
            return response()->json([
                'message' => $validator->messages(),
            ]);
        } else {
            // Fetch User
            $user = User::where('email',$request->email)->first();
            if($user) {
                // Verify the password
                if( password_verify($request->password, $user->password) ) {
                    // Update Token
                    $postArray = ['api_token' => $this->apiToken];
                    $login = User::where('email',$request->email)->update($postArray);

                    if($login) {
                        return response()->json([
                            'name'         => $user->name,
                            'email'        => $user->email,
                            'cell_no'        => $user->cell_no,
                            'model_type'        => $user->model_type,
                            'access_token' => $this->apiToken
                        ]);
                    }
                } else {
                    return response()->json([
                        'message' => 'Invalid Password',
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'User not found',
                ]);
            }
        }
    }
    /**
     * Register
     */
    public function postRegister(Request $request)
    {
        // Validations
        $rules = [
            'name'     => 'required|min:3',
            'email'    => 'required|unique:users,email',
            'password' => 'required|min:8'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Validation failed
            return response()->json([
                'message' => $validator->messages(),
            ]);
        } else {
            $postArray = [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'cell_no'   => $request->cell_no,
                'model_type'     => $request->model_type,
                'api_token' => $this->apiToken
            ];
            // $user = User::GetInsertId($postArray);
            $user = User::insert($postArray);

            if($user) {
                return response()->json([
                    'name'         => $request->name,
                    'email'        => $request->email,
                    'cell_no'      => $request->cell_no,
                    'model_type'   => $request->model_type,
                    'access_token' => $this->apiToken
                ]);
            } else {
                return response()->json([
                    'message' => 'Registration failed, please try again.',
                ]);
            }
        }
    }
    /**
     * Logout
     */
    public function postLogout(Request $request)
    {
        $token = $request->header('Authorization');
        $user = User::where('api_token',$token)->first();
        if($user) {
            $postArray = ['api_token' => null];
            $logout = User::where('id',$user->id)->update($postArray);
            if($logout) {
                return response()->json([
                    'message' => 'User Logged Out',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'User not found',
            ]);
        }
    }
}
