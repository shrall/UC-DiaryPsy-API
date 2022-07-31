<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\UserQuizResource;
use App\Models\Quiz;
use App\Models\UserQuestion;
use App\Models\UserQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserQuestionController extends Controller
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
        $quiz = Quiz::find($request->quiz_id);
        UserQuiz::create([
            'status' => 1,
            'user_id' => Auth::id(),
            'quiz_id' => $request->quiz_id
        ]);
        foreach ($request->question_id as $key => $value) {
            UserQuestion::create([
                'choice' => $request->choice[$key],
                'answer' => $request->answer[$key],
                'open_question' => $request->open_question[$key],
                'question_id' => $request->question_id[$key],
                'user_id' => Auth::id(),
                'quiz_id' => $request->quiz_id,
                'status' => 1
            ]);
        }

        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => UserQuizResource::make($quiz)
        ];
        return SuccessResource::make($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserQuestion  $userQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(UserQuestion $userQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserQuestion  $userQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserQuestion $userQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserQuestion  $userQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserQuestion $userQuestion)
    {
        //
    }
}
