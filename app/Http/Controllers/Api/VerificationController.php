<?php

namespace App\Http\Controllers\Api;

use App\Models\Verification;
use Illuminate\Http\Request;
use App\Events\VerificationCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Firebase\Auth\Token\Exception\ExpiredToken;
use Firebase\Auth\Token\Verifier;
use App\Models\User;

class VerificationController extends Controller
{
    use ValidatesRequests;

    /**
     * Send or resend the verification code.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'phone' => ['required', 'unique:users,phone,'.auth()->id()],
        ], [], trans('verification.attributes'));

        $user = auth()->user();
        $user->phone = $request->phone;
        $user->phone_verified_at = null;
        $user->save();
        return $user->getResource();

    }

    /**
     * Verify the user's phone number.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function verify(Request $request)
    {
       $user = auth()->user();
       $user->forceFill([
            'phone_verified_at' => now(),
        ])->save();
        return $user->getResource();
    }

    /**
     * Check if the password of the authenticated user is correct.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Illuminate\Validation\ValidationException
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ], [], trans('auth.attributes'));

        if (! Hash::check($request->password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'password' => [trans('auth.password')],
            ]);
        }

        return $request->user()->getResource();
    }

    public function verifyFb(Request $request)
    {
       
        $this->validate($request, [
            'phone' => 'required',
            'token' => 'required',
        ], [], trans('verification.attributes'));
        $tokenParts = explode(".", $request->token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);
        $phone = trim($jwtPayload->phone_number);
        $phone = substr($phone, 4, 14);
        
        if ($phone != $request->phone) throw ValidationException::withMessages(['code' => [trans('verification.invalid')], ]);
        if (! $user = auth()->user()) $user = User::where('phone',$request->phone)->firstOrFail();
        $user->forceFill([
            'phone' => $phone,
            'phone_verified_at' => now(),
        ])->save();
        return $user->getResource()->additional([
            'token' => $user->createTokenForDevice(
                $request->header('user-agent')
            ),
        ]);
    }
}
