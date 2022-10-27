<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResource;
use App\Models\ProjectEnvironment;
use Illuminate\Http\Request;

class ProjectEnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $env = ProjectEnvironment::first();

        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $env
        ];
        return SuccessResource::make($return);
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
     * @param  \App\Models\ProjectEnvironment  $projectEnvironment
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectEnvironment $projectEnvironment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectEnvironment  $projectEnvironment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectEnvironment $projectEnvironment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectEnvironment  $projectEnvironment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectEnvironment $projectEnvironment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectEnvironment  $projectEnvironment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectEnvironment $projectEnvironment)
    {
        //
    }
}
