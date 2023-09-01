<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __call($method, $parameters)
    {
        $data = Models\Survey::with('author')->where('user_id', auth()->user()->id);
        if ($method == 'latest') $data = $data->orderBy('updated_at', 'desc');
        $data = $data->paginate(10);

        if (\request()->ajax()) {
            switch ($method) {
                case 'latest':
                    return view('surveys.surveys-latest', ['data' => $data]);
                    break;
                case 'surveys':
                    return view('surveys.surveys-table', ['data' => $data]);
                    break;
            }
        }

        return view($method, [
            'data' => $data,
        ]);
    }

    public function login()
    {
        return redirect('/login');
    }

    public function check($uri)
    {
        return redirect('/');
    }

    public function stats()
    {
        $survey = Models\Survey::where('id', '=', explode('/', \request()->path())[1])->get();
        $data = [
            'type' => $survey[0]->questions()->get()->countBy('type'),
        ];

        $ids = [];
        $question = [];
        foreach ($survey[0]->questions()->get() as $value) {
            $ids[] = $value->id;
            $question[$value->id] = [
                'answers'   => $value['answers']->countBy('answer'),
                'question'  => $value->question,
                'type'      => $value->type,
            ];
        }

        $data['question'] = $question;
        return view('stats', [
            'data'  => [
                'question'  => $data,
                'ids'       => $ids,
                'survey'    => $survey[0],
                ]
        ]);
    }
}
