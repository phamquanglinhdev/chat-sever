<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            if (!isset($request->email) || !isset($request->password)) {
                return response()->json(["message" => "Không có email hoặc mật khẩu"], 503);
            }
            $user = User::where("email", $request->email)->first();
            if (!isset($user->name)) {
                return response()->json(["message" => "Không tồn tại email"], 501);
            }
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(["message" => "Sai mật khẩu"], 502);
            }
            if (!isset($request->device)) {
                return response()->json(["message" => "Lỗi thiết bị"], 504);
            }
            if (Device::where("token", $request->device)->count() != 0) {
                Device::where("token", $request->device)->update([
                    "user_id" => $user->id,
                ]);
            } else {
                Device::create([
                    'user_id' => $user->id,
                    'token' => $request->device,
                ]);
            }

            $token = $user->createToken("Bearer");
            return response()->json([
                "token" => "Bearer " . $token->plainTextToken,
            ], 200);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

}
