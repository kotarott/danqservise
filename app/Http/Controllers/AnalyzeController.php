<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Questiontype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Validator;
use Auth;

class AnalyzeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::where('status', 0)
            ->whereHas('answers', function($q){
                $q->where('user_id', Auth::id());
            })
            ->whereHas('answers.privacy', function($s) {
                $s->where('privacyId', 3);
            })
            ->get();
        
        return Inertia::render(
            'Analyze/Index',
            ['questions' => $questions]
        );
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
    public function show()
    {
        //
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
    
    public function report(Request $request)
    {
        $input = $request->all();

        // バリデーション
        $validator = Validator::make($input, [
            'selected' => ['max:5', 'min:1'],
        ])->validateWithBag('reportGet');

        $ids = $request->selected;

        $questionType = Questiontype::select('typeId')
            ->whereColumn('id', 'questions.questiontype_id')
            ->getQuery();

        $questions = Question::whereIn('id', $ids)
            ->select('id', 'title')
            ->selectSub($questionType, 'typeId')
            ->get()
            ->toArray();
                
        $answers = Answer::from('answers as A')
            ->select(DB::raw('MAX(id) As "0"'))
            ->whereIn('question_id', $ids)
            ->groupBy('user_id');

        foreach($questions as $question) {
            if($question['typeId'] == 1) {
                $answer = Answer::select('text')
                    ->whereColumn('user_id', 'A.user_id')
                    ->where('question_id', $question['id'])
                    ->whereHas('privacy', function($q){
                        $q->where('privacyId', 3);
                    })
                    ->getQuery();
            }else if($question['typeId'] == 2) {
                $answer = Answer::select('selection')
                    ->whereColumn('user_id', 'A.user_id')
                    ->where('question_id', $question['id'])
                    ->whereHas('privacy', function($q){
                        $q->where('privacyId', 3);
                    })
                    ->getQuery();
            } else if($question['typeId'] >=3 && $question['typeId'] <= 6) {
                $answer = Answer::select('int')
                    ->whereColumn('user_id', 'A.user_id')
                    ->where('question_id', $question['id'])
                    ->whereHas('privacy', function($q){
                        $q->where('privacyId', 3);
                    })
                    ->getQuery();
            }
            $answers = $answers->selectSub($answer, $question['id']);
            
        }
        $answers = $answers->get()->shuffle()->toArray();
        // dd($answers, $questions);

        // $columns[] = [
        //     "type" => "numeric",
        //     "title" => "#",
        //     "width"=> "10px"
        // ];

        foreach($questions as $key=>$question){

            if($question['typeId'] <= 2) {
                $questions[$key]['type'] = 'text';
            } else if($question['typeId'] >= 3 && $question['typeId'] <= 6) {
                $questions[$key]['type'] = "numeric";
            }

        //     $columns[] = [
        //         "type" => $type,
        //         "title" => $question['title'],
        //         "width"=> "30px"
        //     ];
        };

        // dd($questions);
        return Inertia::render(
            'Analyze/Report',
            ['columns' => $questions, 'answers' => $answers]
        );
    }

    public function result(Request $request) 
    {
        $input = $request->all();

        // バリデーション
        $validator = Validator::make($input, [
            'selected' => ['max:5', 'min:1'],
        ])->validateWithBag('reportGet');

        $ids = collect($request->selected)->sort()->values()->toArray();
        
        $questionType = Questiontype::select('typeId')
            ->whereColumn('id', 'questions.questiontype_id')
            ->getQuery();

        $questions = Question::whereIn('id', $ids)
            ->select('id', 'title')
            ->selectSub($questionType, 'typeId')
            ->get()
            ->toArray();

        $answers = Answer::from('answers as A')
            ->select(DB::raw('MAX(id) As id'))
            ->whereIn('question_id', $ids)
            ->groupBy('user_id');

        foreach($questions as $question) {
            if($question['typeId'] == 1) {
                $answer = Answer::select('text')
                    ->whereColumn('user_id', 'A.user_id')
                    ->where('question_id', $question['id'])
                    ->whereHas('privacy', function($q){
                        $q->where('privacyId', 3);
                    })
                    ->getQuery();
            }else if($question['typeId'] == 2) {
                $answer = Answer::select('selection')
                    ->whereColumn('user_id', 'A.user_id')
                    ->where('question_id', $question['id'])
                    ->whereHas('privacy', function($q){
                        $q->where('privacyId', 3);
                    })
                    ->getQuery();
            } else if($question['typeId'] >=3 && $question['typeId'] <= 6) {
                $answer = Answer::select('int')
                    ->whereColumn('user_id', 'A.user_id')
                    ->where('question_id', $question['id'])
                    ->whereHas('privacy', function($q){
                        $q->where('privacyId', 3);
                    })
                    ->getQuery();
            }
            $answers = $answers->selectSub($answer, $question['id']);
            
        }
        $answers = $answers->get()->shuffle();
        // dd($answers);
        // dd(array_column($answers->toArray(),'id'));

        foreach($questions as $question) {
            $result = $answers->countBy($question['id'])->toArray();
            $labels = array_keys($result);

            $mod_labels = [];
            foreach($labels as $value){
                if(empty($value)){
                    $mod_labels[] = "非共有データ";
                } else {
                    $mod_labels[] = (string) $value;
                }
            }
            $results[$question['title']][] = $mod_labels;
            $results[$question['title']][] = array_values($result);
        }

        return Inertia::render(
            'Analyze/Result',
            ['answers' => $results]
        );
    }
}
