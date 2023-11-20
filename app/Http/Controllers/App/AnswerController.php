<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Models\Answer $answer, Models\Survey $survey)
    {
        $data = \request()->validate([
            'answers.*.question_id'  => 'required',
            'answers.*.answer'  => 'required',
            'reply_amount'      => 'required',
        ]);

        $answer->insert(array_values($data['answers']));
        $survey->update(['reply_amount' => $data['reply_amount']]);

        return back();
    }
}
