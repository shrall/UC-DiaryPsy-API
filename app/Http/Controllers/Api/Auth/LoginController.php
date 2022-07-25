<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\FailedResource;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function login(Request $request)
    {

        $http = new GuzzleHttpClient;

        $user = [
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 1,
        ];
        $admin = [
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 2,
        ];

        $check = User::where('email', $request->email)->first();

        if ($check != null) {
            // if ($check->email_verified_at != null) {
            if (Auth::attempt($user) || Auth::attempt($admin)) {
                $response = Http::asForm()->post(URL::to('/') . '/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => $this->client->id,
                    'client_secret' => $this->client->secret,
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ]);
                $var = json_decode((string) $response->getBody(), true);
                $var = collect($var);
                $var->put("user_id", $check->id);
                $var->put("role_id", $check->role_id);
                $var = json_decode((string) $var, true);
                $return = [
                    'api_code' => 200,
                    'api_status' => true,
                    'api_message' => 'Berhasil masuk aplikasi.',
                    'api_results' => $var
                ];
                return SuccessResource::make($return);
            } else {
                $return = [
                    'api_code' => Response::HTTP_FORBIDDEN,
                    'api_status' => false,
                    'api_message' => 'Login gagal, password tidak sesuai.',
                ];
                return FailedResource::make($return);
            }
            // } else {
            //     $return = [
            //         'api_code' => Response::HTTP_UNAUTHORIZED,
            //         'api_status' => false,
            //         'api_message' => 'Email belum terverifikasi.'
            //     ];
            //     return FailedResource::make($return);
            // }
        } else {
            $return = [
                'api_code' => Response::HTTP_UNAUTHORIZED,
                'api_status' => false,
                'api_message' => 'Email belum terdaftar.'
            ];
            return FailedResource::make($return);
        }
    }

    public function logout()
    {
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Berhasil logout.',
            'api_results' => Auth::user()
        ];
        $accesstoken = Auth::user()->currentAccessToken();
        DB::table('oauth_refresh_tokens')->where('access_token_id', $accesstoken->id)->update(['revoked' => true]);
        $accesstoken->revoke();

        return SuccessResource::make($return);
    }

    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'));
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        $return = [
                            'api_code' => 200,
                            'api_status' => true,
                            'api_message' => 'Sukses',
                        ];
                        return FailedResource::make($return);
                    case Password::INVALID_USER:
                        $return = [
                            'api_code' => 404,
                            'api_status' => false,
                            'api_message' => 'Email belum terdaftar.'
                        ];
                        return FailedResource::make($return);
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        $return = [
            'api_code' => 425,
            'api_status' => false,
            'api_message' => 'Mohon coba beberapa saat kembali untuk meminta ulang pengiriman E-Mail.',
        ];
        return FailedResource::make($return);
    }
}
