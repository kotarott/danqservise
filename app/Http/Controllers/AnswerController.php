<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Validator;
use Auth;

class AnswerController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $type = $request->questionType;
        $question = Question::find($request->question_id);
    
        if(!$question->answers->where('user_id', Auth::id())->isEmpty()) {
            return Redirect::route('question.index');
        }

        //バリデーション 
        if($type <= 2) {
            $validator = Validator::make($input, [
                'answer_text' => ['required'],
                'privacy' => ['required']
            ])->validateWithBag('answerCreate');
        } else if($type >=3 && $type <= 6) {
            $validator = Validator::make($input, [
                'answer_num' => ['required'],
                'privacy' => ['required']
            ])->validateWithBag('answerCreate');
        }

        $answer = new Answer;
        $answer->question_id = $request->question_id;
        $answer->user_id =  Auth::id();
        $answer->privacy_id = $request->privacy;
        if($type == 1){
            $answer->text = $request->answer_text;
        }else if($type == 2){
            $answer->selection = $request->answer_text;
        }else if($type >= 3 && $type <= 6){
            $answer->int = $request->answer_num;
        }
        $answer->save();
        
        return Redirect::route('answer.show', $answer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        $questionId = $answer->question_id;
        $type = $answer->question->questiontype_id;
        $answers = Answer::where('question_id', $questionId);
        $privacies = Privacy::all();
        $question = $answer->question->withCount('answers')->find($questionId);

        if($type == 1){
            $result = $answers->oldest()->select('text', 'created_at')->get()->toArray();
        }else if($type == 2) {
            $result = $answers->select('selection')->get()->countBy('selection')->toArray();
        }else if($type >= 3 && $type <= 6) {
            $result = $answers->select('int')->get()->countBy('int')->toArray();
        }
        // dd($result);

        if($type != 1) {
            $labels = array_keys($result);
            $mod_labels = [];
            foreach($labels as $value){
                if(empty($value)){
                    $mod_labels[] = "非共有データ";
                } else {
                    $mod_labels[] = (string) $value;
                }
            }
            $results[$question->title][] = $mod_labels;
            $results[$question->title][] = array_values($result);
        } else {
            $results = $result;
        }

        if($answer->user_id != Auth::id()) {
            return Redirect::route('question.index');
        } else {
            return Inertia::render(
                'Answer/Show',
                ['question' => $question, 'result' => $results, 'yourAnswer' => $answer, 'privacies' => $privacies]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        // dd($answer, $request);
        $input = $request->all();

        $validator = Validator::make($input, [
            'privacy' => ['required']
        ])->validateWithBag('answerUpdate');

        $answer->privacy_id = $request->privacy;
        $answer->save();

        return Redirect::route('answer.show', $answer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        // dd($answer);
        $answer->delete();
        return Redirect::route('question.index');
    }
}
