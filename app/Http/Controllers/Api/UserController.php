<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $data = DB::table('users')->select('password')->where('email', '=', $email)->get();
            $a = json_decode($data, true);
            if (password_verify($password, $a[0]['password'])) {
                $data1 = DB::table('users')->select('name', 'token')->where('email', '=', $email)->get();
                return response()->json(['data' => $data1], $this->successStatus);
            } else {
                return response()->json(['error' => 'Invalid account or password'], 401);
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function register(UserRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->expried_at = Carbon::now()->addHour(72);
            $user->token = bin2hex(random_bytes(16));
            $user->save();
            return response()->json(['success' => $user], $this->successStatus);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function details(Request $request)
    {
        $abc = $request->headers->get("authorization");
        dd($abc);
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });
    }

}
