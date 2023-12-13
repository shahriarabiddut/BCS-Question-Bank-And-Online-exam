<?php

namespace App\Http\Controllers\Staff;

use App\Models\Set;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionSet;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Set::all();
        return view('staff.question.set.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subjects = Subject::all();
        return view('staff.question.set.create', ['subjects' => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'type' => 'required',
            'time' => 'required',
            'status' => 'required',
        ]);
        //Data save to Database 
        $data = new Set();
        $data->title = $request->title;
        $data->subject_id = $request->subject_id;
        $data->type = $request->type;
        $data->time = $request->time;
        $data->status = $request->status;
        // Check subject is given
        if ($request->subject_id == 0) {
            return redirect()->back()->with('error', 'Please Select a Subject!');
        }
        // Check type is given
        if ($request->type == 0) {
            return redirect()->back()->with('error', 'Please Select a Type!');
        }
        $data->save();
        //Data Saved
        return redirect()->route('staff.qset.index')->with('success', 'Set Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Set::find($id);
        $count = QuestionSet::all()->where('set_id', '=', $data->id)->count();
        return view('staff.question.set.show', ['data' => $data, 'count' => $count]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $subjects = Subject::all();
        $data = Set::find($id);
        return view('staff.question.set.edit', ['data' => $data, 'subjects' => $subjects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Set::find($id);
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'time' => 'required',
            'status' => 'required',
        ]);
        // Check subject is given
        if ($request->subject_id == 0) {
            return redirect()->back()->with('error', 'Please Select a Subject!');
        }
        // If Set type is not multiple
        if ($request->type != 2) {
            if ($request->subject_id != $request->old_subject_id) {
                return redirect()->back()->with('error', 'You can not Change Subject of this set for This Type!');
            }
        }

        //Data save to Database 
        $data->title = $request->title;
        $data->subject_id = $request->subject_id;
        $data->time = $request->time;
        $data->status = $request->status;

        //Data Saved
        $data->save();
        return redirect()->route('staff.qset.index')->with('success', 'Set Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Set::find($id);
        $SetData = QuestionSet::all()->where('set_id', '=', $id);
        foreach ($SetData as $question) {
            $question->delete();
        }
        $data->delete();

        return redirect()->route('staff.qset.index')->with('danger', 'Set has been deleted Successfully!');
    }
}
