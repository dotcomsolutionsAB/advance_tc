<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //
    // genearate otp and send to `whatsapp`
    // public function generate_otp(Request $request)
    // {
    //     $request->validate([
    //         'username' => ['required', 'string'],
    //     ]);

    //     $username = $request->input('username');

    //     $get_user = User::select('mobile','email','role')
    //                     ->where('username', $username)
    //                     ->first();

    //     if(!$get_user == null)
    //     {
    //         $six_digit_otp = random_int(100000, 999999);

    //         $expiresAt = now()->addMinutes(10);

    //         $store_otp = User::where('username', $username)
    //                          ->update([
    //                             'otp' => $six_digit_otp,
    //                             'expires_at' => $expiresAt,
    //                         ]);

    //         if($store_otp)
    //         {
    //             $templateParams = [
    //                 'name' => 'ace_otp', // Replace with your WhatsApp template name
    //                 'language' => ['code' => 'en'],
    //                 'components' => [
    //                     [
    //                         'type' => 'body',
    //                         'parameters' => [
    //                             [
    //                                 'type' => 'text',
    //                                 'text' => $six_digit_otp,
    //                             ],
    //                         ],
    //                     ],
    //                     [
    //                         'type' => 'button',
    //                         'sub_type' => 'url',
    //                         "index" => "0",
    //                         'parameters' => [
    //                             [
    //                                 'type' => 'text',
    //                                 'text' => $six_digit_otp,
    //                             ],
    //                         ],
    //                     ]
    //                 ],
    //             ];

    //             $whatsappUtility = new sendWhatsAppUtility();

    //             if($get_user->role != 'super_admin')
    //             {
    //                 $response = $whatsappUtility->sendWhatsApp('918961043773', $templateParams, $get_user->mobile, 'OTP Campaign');
    //             }else
    //             {
    //                 $response = $whatsappUtility->sendWhatsApp($get_user->mobile, $templateParams, $get_user->mobile, 'OTP Campaign');
    //             }
    //             $recipientEmail = $get_user->email;
    //             if($recipientEmail != '')
    //             {
    //                 $subject = "Your Login OTP Code";
    //                 $body = '<!DOCTYPE html>
    //                 <html>
    //                 <head>
    //                     <style>
    //                         body {
    //                             font-family: Arial, sans-serif;
    //                             line-height: 1.6;
    //                             color: #333333;
    //                             margin: 0;
    //                             padding: 0;
    //                             background-color: #f7f7f7;
    //                         }
    //                         .email-container {
    //                             max-width: 600px;
    //                             margin: 20px auto;
    //                             background-color: #ffffff;
    //                             padding: 20px;
    //                             border-radius: 8px;
    //                             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    //                         }
    //                         .header {
    //                             text-align: center;
    //                             margin-bottom: 20px;
    //                         }
    //                         .header h1 {
    //                             font-size: 24px;
    //                             color: #4CAF50;
    //                         }
    //                         .otp-code {
    //                             display: inline-block;
    //                             padding: 10px 20px;
    //                             background-color: #4CAF50;
    //                             color: #ffffff;
    //                             font-size: 20px;
    //                             border-radius: 4px;
    //                             margin: 20px 0;
    //                             text-align: center;
    //                             font-weight: bold;
    //                         }
    //                         .content {
    //                             font-size: 16px;
    //                         }
    //                         .footer {
    //                             margin-top: 20px;
    //                             text-align: center;
    //                             font-size: 14px;
    //                             color: #777777;
    //                         }
    //                     </style>
    //                 </head>
    //                 <body>
    //                     <div class="email-container">
    //                         <div class="header">
    //                             <h1>Your OTP Code</h1>
    //                         </div>
    //                         <div class="content">
    //                             <p>Your One-Time Password (OTP) for logging in is:</p>
    //                             <p class="otp-code">'.$six_digit_otp.'</p>
    //                             <p>Please use this OTP to complete your login. This code is valid for 10 minutes.</p>
    //                             <p>If you did not request this OTP, please contact our support team immediately.</p>
    //                         </div>
    //                         <div class="footer">
    //                             <p>Thank you,<br>FMB 52 Team</p>
    //                         </div>
    //                     </div>
    //                 </body>
    //                 </html>
    //                 ';
    //                 if($get_user->role != 'super_admin')
    //                 {
    //                     $response = $this->mailService->sendMail('kburhanuddin12@gmail.com', $subject, $body);
    //                 }else{
    //                     $response = $this->mailService->sendMail($recipientEmail, $subject, $body);
    //                 }
    //             }

    //             return response()->json([
    //                 'message' => 'Otp send successfully!',
    //                 'data' => $store_otp
    //             ], 200);
    //         }
    //     }
    //     else {
    //         return response()->json([
    //             'message' => 'User has not registered!',
    //         ], 404);
    //     }
    // }

    // user `login`
    // public function login(Request $request, $otp = null)
    public function login(Request $request, $otp = null)
    {
        // if ($otp) {
        //     $request->validate([
        //         'username' => ['required', 'string'],
        //     ]);

        //     $otpRecord = User::select('otp', 'expires_at')
        //         ->where('username', $request->username)
        //         ->first();

        //     if ($otpRecord) {
        //         if (!$otpRecord || $otpRecord->otp != $otp) {
        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'Invalid OTP Entered',
        //             ], 200);
        //         } elseif ($otpRecord->expires_at < now()) {
        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'OTP has expired!',
        //             ], 200);
        //         } else {
        //             // Remove OTP record after successful validation
        //             User::where('username', $request->username)
        //                 ->update(['otp' => null, 'expires_at' => null]);

        //             // Retrieve the user
        //             $user = User::where('username', $request->username)->first();

        //             // Generate a Sanctum token
        //             $generated_token = $user->createToken('API TOKEN')->plainTextToken;

        //             // Retrieve user permissions
        //             $permissions = $user->getAllPermissions()->pluck('name');

        //             return response()->json([
        //                 'success' => true,
        //                 'data' => [
        //                     'token' => $generated_token,
        //                     'name' => $user->name,
        //                     'role' => $user->role,
        //                     'id' => $user->id,
        //                     'jamiat_id' => $user->jamiat_id,
        //                     'permissions' => $permissions, // Add permissions here
        //                 ],
        //                 'message' => 'User logged in successfully!',
        //             ], 200);
        //         }
        //     } else {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Username is not valid.',
        //         ], 200);
        //     }
        // } else {
            $request->validate([
                'email' => ['required', 'string'],
                'password' => 'required',
            ]);

            // Find the user by username
            $user = User::where('email', $request->username)->first();

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();

                // Generate a Sanctum token
                $generated_token = $user->createToken('API TOKEN')->plainTextToken;

                // Retrieve user permissions
                // $permissions = $user->getAllPermissions()->pluck('name');

                return response()->json([
                    'success' => true,
                    'data' => [
                        'token' => $generated_token,
                        'name' => $user->name,
                        'role' => $user->role,
                        'id' => $user->id,
                    ],
                    'message' => 'User logged in successfully!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid username or password.',
                ], 200);
            }
        // }
    }

    // user `logout`
    public function logout(Request $request)
    {
        // Check if the user is authenticated
        if(!$request->user()) {
            return response()->json([
                'success'=> false,
                'message'=>'Sorry, no user is logged in now!',
            ], 401);
        }

        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully!',
        ], 204);
    }
}
