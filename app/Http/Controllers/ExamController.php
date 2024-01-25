<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Marks;
use App\Models\Set;
use App\Models\Question;
use App\Models\QuestionSet;
use App\Models\SiteOption;
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
        //Mark
        $markCount = 0.0;
        $negativeMarkData = SiteOption::all()->where('id', '=', 8)->first();
        $negativeMark = doubleval($negativeMarkData->value);
        //
        $data = Set::find($id);
        $QuestionSet = QuestionSet::all()->where('set_id', '=', $data->id);
        $i = 0;
        foreach ($QuestionSet as $question) {
            $matchData = Question::all()->where('id', '=', $question->question_id)->first();
            $stringQ = 'answer' . $i;
            $match = $request->$stringQ == $matchData->ans;
            if ($match) {
                $markCount += 1;
            } else {
                $markCount = $markCount - $negativeMark;
            }
            $i++;
        }
        $markUpdate = new Exam();
        $markUpdate->user_id = Auth::user()->id;
        $markUpdate->set_id = $id;
        $markUpdate->mark = $markCount;
        $markUpdate->save();
        //Send This Mark to Top Marks
        $this->topMarks(Auth::user()->id, $markCount, $id, $markUpdate->id);
        //
        return redirect()->route('user.exam.result')->with('success', 'Exam Completed Successfully!');
    }
    public function topMarks(string $user_id, string $marks, string $set_id, string $exam_id)
    {
        $data = Marks::all()->where('user_id', $user_id)->where('set_id', $set_id)->first();
        if ($data != null) {
            if ($marks >= $data->mark) {
                $data->exam_id = $exam_id;
                $data->mark = $marks;
                $data->save();
            }
        } else {
            $markUpdate = new Marks();
            $markUpdate->user_id = $user_id;
            $markUpdate->set_id = $set_id;
            $markUpdate->exam_id = $exam_id;
            $markUpdate->mark = $marks;
            $markUpdate->save();
        }
    }
    public function marksHome()
    {
        //
        // $data = Marks::all()->sortBy('mark', 1, 1);
        $data = Marks::select('user_id', \DB::raw('SUM(mark) as total'))->groupBy('user_id')->orderByDesc('total')->get();
        $setData = Set::all();
        return view('marks', ['data' => $data, 'setData' => $setData]);
    }
    public function marksSetHome(string $id)
    {
        //
        // $data = Marks::all()->sortBy('mark', 1, 1);
        $data = Marks::where('set_id', $id)->orderBy('mark', 'desc')->get();
        $set = Set::find($id);
        return view('marksset', ['data' => $data, 'set' => $set]);
    }
}
