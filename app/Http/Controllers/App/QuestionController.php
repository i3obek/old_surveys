<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Models\Survey $survey)
    {
        $data = \request()->validate([
            'questions'             => 'required',
            'questions.*.question'  => 'required|string',
            'questions.*.type'      => 'required',
            'published'             => 'required',
        ]);

        foreach ($data['questions'] as &$item) {
            $item['survey_id'] = $survey->id;
        }

        $survey->published = filter_var($data['published'], FILTER_VALIDATE_BOOLEAN);
        $ids = array_keys($data['questions']);

        $survey->questions()->whereNotIn('id', $ids)->delete();
        $survey->questions()->upsert($data['questions'], 'id');
        $survey->save();

        return redirect('/surveys/' . $survey->id);
    }
}
