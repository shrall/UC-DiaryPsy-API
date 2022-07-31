<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => UserResource::make($user)
        ];
        return SuccessResource::make($return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->photo) {
            $photo = 'user-' . time() . '-' . $request['photo']->getClientOriginalName();
            $request->photo->move(public_path('uploads'), $photo);
        } else {
            $photo = $user->photo;
        }
        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = $user->password;
        }
        $user->update([
            'name' => $request->name,
            'photo' => $photo,
            'password' => $password,
            'year_born' => $request->year_born,
            'phone' => $request->phone,
            'address' => $request->address,
            'education_id' => $request->education_id,
            'institute_id' => $request->institute_id,
            'religion_id' => $request->religion_id,
            'tribe_id' => $request->tribe_id,
            'city_id' => $request->city_id,
        ]);
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => UserResource::make($user)
        ];
        return SuccessResource::make($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function module_add(Request $request, User $user)
    {
        $ums = UserModule::all();
        $bool = true;
        foreach ($ums as $key => $usermodule) {
            if ($usermodule->module_id == $request->module_id) {
                $bool = false;
            }
        }
        if ($bool) {
            UserModule::create([
                'user_id' => $user->id,
                'module_id' => $request->module_id,
                'status' => 1
            ]);
        }
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => UserResource::make($user)
        ];
        return SuccessResource::make($return);
    }
}
