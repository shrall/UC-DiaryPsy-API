<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\SuccessResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $questions
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
        if (Question::where('question', $request->question)->exists()) {
            $question = Question::where('question', $request->question)->first();
            $return = [
                'api_code' => 200,
                'api_status' => true,
                'api_message' => 'Sukses',
                'api_results' => $question
            ];
            return SuccessResource::make($return);
        } else {
            $question = Question::create([
                'question' => $request->question,
                'order' => Question::where('quiz_id', $request->quiz_id)->where('questiontype_id', 1)->get()->count() + 1,
                'quiz_id' => $request->quiz_id,
                'questiontype_id' => $request->questiontype_id
            ]);

            Question::where('quiz_id', $request->quiz_id)->where('questiontype_id', 2)->first()->update([
                'order' => Question::where('quiz_id', $request->quiz_id)->where('questiontype_id', 1)->get()->count() + 1,
            ]);
            Question::where('quiz_id', $request->quiz_id)->where('questiontype_id', 3)->first()->update([
                'order' => Question::where('quiz_id', $request->quiz_id)->where('questiontype_id', 1)->get()->count() + 2,
            ]);

            $return = [
                'api_code' => 200,
                'api_status' => true,
                'api_message' => 'Sukses',
                'api_results' => $question
            ];
            return SuccessResource::make($return);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => QuestionResource::make($question)
        ];
        return SuccessResource::make($return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update([
            'question' => $request->question,
            'questiontype_id' => $request->questiontype_id,
        ]);
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $question
        ];
        return SuccessResource::make($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses Terhapus.',
            'api_results' => $question
        ];
        $question->delete();
        return SuccessResource::make($return);
    }

    public function reorder(Request $request)
    {
        foreach ($request->questions as $key => $question) {
            $quest = Question::find($question['id']);
            $quest->update([
                'order' => $key + 1
            ]);
        }

        $return = [
            'api_code' => 200,
            'api_status' => true,
            'api_message' => 'Sukses',
            'api_results' => $request->questions
        ];
        return SuccessResource::make($return);
    }
}
