<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class SurveyController extends Controller
{
    public function show(Models\Survey $survey)
    {
        if (!$survey->published) {
            throw new ModelNotFoundException();
        }

        return view('surveys.survey', [
            'survey' => [
                'questions' => $this->getOrderedQuestions($survey),
                'surveys' => $survey,
                ]
        ]);
    }

    public function create()
    {
        $data = request()->validate([
            'title'     => 'required|string',
            'name'      => 'required|unique:surveys,name',
            'published' => 'required',
        ]);
        $data['published'] = filter_var($data['published'], FILTER_VALIDATE_BOOLEAN);

        return redirect('/surveys/'. (auth()->user()->surveys()->create($data))->id);
    }

    public function index(Models\Survey $survey)
    {
        $last = Models\Question::latest('id')->first();

//        $data = $survey->filter(['id' => $survey->id])->first();
//        if(!$data) $data = $survey;

        return view('surveys.survey-edit', [
            'survey' => [
                'questions' => $this->getOrderedQuestions($survey),
                'survey' => $survey,
                'last' => $last,
            ],
        ]);
    }

    public function delete()
    {
        $data = \request()->post();
        if (!$data) throw new \Exception('Missing data');
        if (!Models\Survey::find($data['id'])) throw new \Exception('No existing survey');
        return (Models\Survey::destroy($data['id']));
    }

    private function getOrderedQuestions(Models\Survey $survey)
    {
        return Models\Survey::select(['surveys.*', 'questions.*'])
            ->join('questions', 'surveys.id', '=', 'questions.survey_id')
            ->where('survey_id', '=', $survey->id)
//            ->groupBy('answers.question_id')
            ->orderBy('questions.order')
            ->get()
            ;
    }
}
