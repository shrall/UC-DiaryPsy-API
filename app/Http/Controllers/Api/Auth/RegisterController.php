<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\FailedResource;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'year_born' => 'required|numeric',
            'phone' => 'required|numeric',
            'address' => 'required',
            'institute' => 'required|exists:institutes,id',
            'city' => 'required|exists:regencies,id',
            'tribe' => 'required|exists:tribes,id',
            'education' => 'required|exists:education,id',
            'religion' => 'required|exists:religions,id',
            'role' => 'required|exists:roles,id',
        ], [
            'email.unique' => 'E-Mail sudah terdaftar di database.'
        ]);
        if ($validator->fails()) {
            $return = [
                'api_code' => Response::HTTP_BAD_REQUEST,
                'api_status' => false,
                'api_message' => $validator->errors(),
            ];
            return FailedResource::make($return);
        }

        $user = $this->create($request->all());
        if (empty($user)) {
            $return = [
                'api_code' => Response::HTTP_BAD_REQUEST,
                'api_status' => false,
                'api_message' => 'Error.',
            ];
            return FailedResource::make($return);
        } else {
            // note harus ada event ini biar ngetrigger email verifynya
            event(new Registered($user));
            $newuser = User::where('email', $user->email)->first();
            $return = [
                'api_code' => 200,
                'api_status' => true,
                'api_message' => 'Akun berhasil terbuat!',
                'api_results' => $newuser
            ];
            return SuccessResource::make($return);
        }
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'year_born' => $data['year_born'],
            'address' => $data['address'],
            'institute_id' => $data['institute'],
            'city_id' => $data['city'],
            'tribe_id' => $data['tribe'],
            'education_id' => $data['education'],
            'role_id' => $data['role'],
            'religion_id' => $data['religion'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function resend_email(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->sendEmailVerificationNotification();
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => 'Link verifikasi berhasil dikirim.'
        ];
        return SuccessResource::make($return);
    }
}
