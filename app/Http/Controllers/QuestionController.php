<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Questiontype;
use App\Models\Answer;
use App\Models\User;
use App\Models\Selection;
use App\Models\Privacy;
use Validator;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // userの回答状況の取得
        $answers = Answer::select('id')
            ->whereColumn('question_id', 'questions.id')
            ->where('user_id', Auth::id())
            ->getQuery();

        $questionType = Questiontype::select('typeId')
            ->whereColumn('id', 'questions.questiontype_id')
            ->getQuery();

        // questionの取得
        $questions = Question::select('id', 'title', 'description', 'created_at')
            ->where('status', 0)
            ->selectSub($answers, 'answer_status')
            ->selectSub($questionType, 'typeId')
            ->withCount('answers')
            ->get()
            ->shuffle();

        return Inertia::render('Question/Index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // typeを取得して質問を作成する
        $questionTypes = Questiontype::select('id', 'typeId', 'typename')->get()->toArray();
        // dd($questionTypes);
        return Inertia::render('Question/Create', ['questionTypes' => $questionTypes]);
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
        //バリデーション 
        $validator = Validator::make($input, [
            'title' => ['required'],
            'questionType' => ['required'],
            'status' => ['required'],
            'caution' => ['accepted'],
            'selections.*' => ['max:100'],
        ])->validateWithBag('questionCreate');

        // dd($input);
        $questionTypeId = Questiontype::where('typeId', $request->questionType)->value('id');

        // db登録
        $question = new Question;
        $question->title = $request->title;
        $question->description = $request->description;
        $question->result = $request->result;
        $question->questiontype_id = $questionTypeId;
        $question->status = $request->status;
        $question->user_id = Auth::id();
        $question->save();

        $last_insert_id = $question->id;
        
        if($$request->questionType == 2){
            foreach($request->selections as $selection){
                if($selection) {
                    $selections = new Selection;
                    $selections->question_id = $last_insert_id;
                    $selections->selection = $selection;
                    $selections->save();
                }
            }
        }

        return Redirect::route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $selections = $question->selections;
        $questionType = $question->questiontype;
        $privacies = Privacy::all();
        return Inertia::render(
            'Answer/Create',
            ['question' => $question, 'questionType' => $questionType, 'selections' => $selections, 'privacies' => $privacies]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
