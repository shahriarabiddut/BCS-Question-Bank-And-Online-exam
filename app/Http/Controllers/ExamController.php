<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Set;
use App\Models\Question;
use App\Models\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Set::all()->where('status', '=', '1');
        $mark = Exam::all()->where('user_id', '=', Auth::user()->id);
        // dd($data);
        return view('profile.exam.index', ['data' => $data]);
    }
    public function result()
    {
        //
        $mark = Exam::select('*')->where('user_id', '=', Auth::user()->id)->orderBy("created_at", "desc")->get();
        // dd($data);
        return view('profile.exam.marks', ['mark' => $mark]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Set::find($id);

        if ($data == null) {
            return redirect()->route('user.exam.index')->with('danger', 'Not Found!');
        }
        if ($data->status == '0') {
            return redirect()->route('user.exam.index')->with('danger', 'Not Permitted!');
        }
        $QuestionSet = QuestionSet::all()->where('set_id', '=', $data->id);
        $questions = [];
        foreach ($QuestionSet as $question) {
            $questions[] = Question::all()->where('id', '=', $question->question_id)->first();
        }
        return view('profile.exam.show', ['data' => $data, 'questions' => $questions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function check(Request $request, string $id)
    {
        $markCount = 0;
        //
        $data = Set::find($id);
        $QuestionSet = QuestionSet::all()->where('set_id', '=', $data->id);
        foreach ($QuestionSet as $key => $question) {
            $matchData = Question::all()->where('id', '=', $question->question_id)->first();
            $stringQ = 'answer' . $key - 1;
            $match = $request->$stringQ == $matchData->ans;
            if ($match) {
                $markCount += 1;
            }
        }
        $markUpdate = new Exam();
        $markUpdate->user_id = Auth::user()->id;
        $markUpdate->set_id = $id;
        $markUpdate->mark = $markCount;
        $markUpdate->save();
        return redirect()->route('user.exam.result')->with('success', 'Exam Completed Successfully!');
    }
}
