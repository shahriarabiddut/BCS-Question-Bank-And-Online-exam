<?php

namespace App\Http\Controllers\Staff;

use App\Models\Set;
use App\Models\Subject;
use App\Models\Question;
use App\Models\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuestionSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = QuestionSet::all();
        return view('staff.questionset.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        //
        $set = Set::find($id);
        $subject_id = $set->subject_id;
        $subject = Subject::find($subject_id);
        $questions = Question::all()->where('subject_id', '=', $subject_id);
        return view('staff.questionset.create', ['questions' => $questions, 'set' => $set, 'subject' => $subject]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'set_id' => 'required',
            'question' => 'required',
        ]);
        //Question relation with Set save
        if (count($request->question) >= 1) {
            foreach ($request->question as $question) {
                //Movie Data save to Set 
                $data = new QuestionSet();
                $data->set_id = $request->set_id;
                $data->question_id = $question;
                $data->save();
            }
        }
        //Data Saved
        return redirect()->route('staff.quesset.index')->with('success', 'QuestionSet Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Set::find($id);
        $QuestionSet = QuestionSet::all()->where('set_id', '=', $data->id);
        $questions = [];
        foreach ($QuestionSet as $question) {
            $questions[] = Question::all()->where('id', '=', $question->question_id)->first();
        }
        return view('staff.questionset.show', ['data' => $data, 'questions' => $questions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $questionSet = QuestionSet::all()->where('set_id', '=', $id);
        $data = Set::find($id);
        $subject = Subject::all()->where('id', '=', $data->subject_id)->first();
        $questions = Question::all()->where('subject_id', '=', $data->subject_id);
        return view('staff.questionset.edit', ['data' => $data, 'subject' => $subject, 'questions' => $questions, 'questionSet' => $questionSet]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $data = Set::find($request->set_id);
        $request->validate([
            'question' => 'required',
            'set_id' => 'required',
        ]);
        //Question Set relation Update
        if (count($request->question) >= 1) {
            $oldQuestionSetData = QuestionSet::all()->where('set_id', '=', $data->id);
            $status = 0;
            //Delete Removed Set
            foreach ($oldQuestionSetData as $oldquestion) {
                foreach ($request->question as $question) {
                    if ($question == $oldquestion->question_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status == 0) {
                    $dataoldSet = DB::table('question_sets')
                        ->where('question_id', '=', $oldquestion->question_id)
                        ->delete();
                }
            }
            //Add If not existed in relation
            foreach ($request->question as $question) {
                foreach ($oldQuestionSetData as $oldquestion) {
                    if ($question == $oldquestion->question_id) {
                        $status = 1;
                        break;
                    } else {
                        $status = 0;
                    }
                }
                if ($status != 1) {
                    //Movie Data save to New Set 
                    $QuestionSetData = new QuestionSet();
                    $QuestionSetData->set_id = $data->id;
                    $QuestionSetData->question_id = $question;
                    $QuestionSetData->save();
                }
            }
        }
        //Data Saved
        return redirect()->route('staff.quesset.index')->with('success', 'QuestionSet Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = QuestionSet::find($id);
        $data->delete();
        return redirect()->route('staff.quesset.index')->with('danger', 'QuestionSet has been deleted Successfully!');
    }
}
