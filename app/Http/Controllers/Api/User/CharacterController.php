<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CharacterResource;
use App\Http\Resources\SuccessResource;
use App\Models\Character;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $characters = Character::withCount(['quizzes' => function ($query) {
            $query->whereHas('users', function ($query) {
                $query->where('user_id', Auth::id());
            });
        }, 'quizzes as qu_count'])->get();

        $the_array = array();

        foreach ($characters as $key => $character) {
            if ($character->quizzes_count != $character->qu_count) {
                $character->complete = 0;
            } else {
                $character->complete = 1;
            }
            $quizzes = $character->quizzes()
                ->whereHas('users', function ($query) {
                    $query->where('user_id', Auth::id());
                })->get();
            $quizes = $character->quizzes;
            $completed_at = Carbon::now();
            foreach ($quizes as $key => $quiz) {
                if ($quizzes->contains('id', $quiz->id)) {
                    $quiz->complete = 1;
                } else {
                    $quiz->complete = 0;
                }
                foreach ($quiz->users as $key => $userQuiz) {
                    if ($userQuiz->user_id == Auth::id()) {
                        $completed_at = $userQuiz->created_at;
                    }
                }
                $quiz->completed_at = $completed_at;
            }
            $character->quizzes = $quizes;
            array_push($the_array, $character);
        }
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $the_array
        ];
        return SuccessResource::make($return);
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
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => CharacterResource::make($character)
        ];
        return SuccessResource::make($return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        //
    }
}
