<?php

namespace App\Http\Resources;

use App\Models\UserQuestion;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserQuizExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    private function successOrNot(String $choice)
    {
        if ($choice == "0") {
            return "Gagal";
        } else {
            return "Berhasil";
        }
    }
    public function toArray($request)
    {
        $response = [
            "ID User" => $this->user_id,
            "Nama" => $this->user->name,
            "E-Mail" => $this->user->email,
            "Tahun Lahir" => $this->user->year_born,
            "Telepon" => $this->user->phone,
            "Alamat" => $this->user->address,
            "Institusi" => $this->user->institute->name,
            "Pendidikan" => $this->user->education->name,
            "Agama" => $this->user->religion->name,
            "Suku" => $this->user->tribe->name,
            "Kota" => $this->user->city->name,
            "Modul" => $this->quiz->character->module->name,
            "Karakter" => $this->quiz->character->name,
            "Status Karakter" => "Belum Selesai",
            "Quiz" => $this->quiz->name,
        ];
        $questions = "";
        $emptyopenquestion = 0;
        $successes = 0;
        foreach ($this->quiz->questions->sortBy('order') as $key => $question) {
            if ($key == 2) {
                $questions .= $question->question;
                $questions .= " (" . $this->successOrNot($question->answers->where('user_id', $this->user_id)->first()->choice ?? 0) . ")";
            } else {
                if ($question->questiontype_id == 2) {
                    if ($question->answers->where('user_id', $this->user_id)->first()->open_question) {
                        $questions .= "\n" . $question->answers->where('user_id', $this->user_id)->first()->open_question;
                        $questions .= " (" . $this->successOrNot($question->answers->where('user_id', $this->user_id)->first()->choice ?? 0) . ")";
                    } else {
                        $emptyopenquestion = 1;
                    }
                } else if ($question->questiontype_id == 1) {
                    $questions .= "\n" . $question->question;
                    $questions .= " (" . $this->successOrNot($question->answers->where('user_id', $this->user_id)->first()->choice ?? 0) . ")";
                }
            }
            $successes += $question->answers->where('user_id', $this->user_id)->first()->choice;
        }
        $response["Pertanyaan"] = $questions;
        $refleksi = "";
        foreach ($this->quiz->questions->sortBy('order') as $key => $question) {
            if ($key != 2) {
                if ($question->questiontype_id == 3) {
                    $refleksi = $question->answers->where('user_id', $this->user_id)->first()->answer;
                }
            }
        }
        $response["Refleksi"] = $refleksi;
        $response["Total Berhasil"] = $successes;
        $response["Total Gagal"] = $this->quiz->questions->count() - 1 - $successes - $emptyopenquestion;
        $response["Status Quiz"] = $successes >= ($this->quiz->questions->count() - 1 - $successes) ? "Berhasil" : "Gagal";
        $response["Tanggal"] = $this->created_at;

        $quiz_count = $this->quiz->character->quizzes->count();
        $quiz_successes = 0;
        $quiz_answered = 0;
        foreach ($this->quiz->character->quizzes as $key => $quiz) {
            $question_successes = 0;
            foreach ($quiz->questions->sortBy('order') as $key => $question) {
                $question_successes += $question->answers->where('user_id', $this->user_id)->first()->choice ?? 0;
            };
            if ($question_successes >= $quiz->questions->count() - 1 - $successes) {
                $quiz_successes += 1;
            }
            $quiz_answered += 1;
        }
        if ($quiz_count == $quiz_answered) {
            if ($quiz_successes >= $quiz_count / 2) {
                $response["Status Karakter"] = "Berhasil";
            } else {
                $response["Status Karakter"] = "Gagal";
            }
        }
        return $response;
    }
}
