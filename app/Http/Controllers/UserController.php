<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.export', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function update_password(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'min:8'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);
        $user = User::find(Auth::id());
        if (Hash::check($data['current_password'], $user->password)) {
            $user->update([
                'password' => Hash::make($data['new_password']),
            ]);
            $return = [
                'api_code' => 200,
                'api_status' => true,
                'api_message' => 'Password berhasil diperbarui!',
                'api_results' => $user
            ];
            return SuccessResource::make($return);
        }
        $return = [
            'api_code' => 403,
            'api_status' => false,
            'api_message' => 'Password salah.',
            'api_results' => $user
        ];
        return SuccessResource::make($return);
    }
}
