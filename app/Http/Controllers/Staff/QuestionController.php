<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\File;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Question::all();
        return view('staff.question.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subjects = Subject::all();
        return view('staff.question.create', ['subjects' => $subjects]);
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
            'opt1' => 'required',
            'opt2' => 'required',
            'opt3' => 'required',
            'opt4' => 'required',
            'ans' => 'required',
        ]);
        //Data save to Database 
        $data = new Question();
        $data->title = $request->title;
        $data->subject_id = $request->subject_id;
        $data->opt1 = $request->opt1;
        $data->opt2 = $request->opt2;
        $data->opt3 = $request->opt3;
        $data->opt4 = $request->opt4;
        $data->ans = $request->ans;

        // Check subject is given
        if ($request->subject_id == 0) {
            return redirect()->back()->with('error', 'Please Select a Subject!');
        }
        // Check Answer is given
        if ($request->ans == 0) {
            return redirect()->back()->with('error', 'Please Select an Answer!');
        }
        $data->save();
        //Data Saved
        return redirect()->route('staff.question.index')->with('success', 'Question Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Question::find($id);
        return view('staff.question.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $subjects = Subject::all();
        $data = Question::find($id);
        return view('staff.question.edit', ['data' => $data, 'subjects' => $subjects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Question::find($id);
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'opt1' => 'required',
            'opt2' => 'required',
            'opt3' => 'required',
            'opt4' => 'required',
            'ans' => 'required',
        ]);
        //Data save to Database 
        $data->title = $request->title;
        $data->subject_id = $request->subject_id;
        $data->opt1 = $request->opt1;
        $data->opt2 = $request->opt2;
        $data->opt3 = $request->opt3;
        $data->opt4 = $request->opt4;
        $data->ans = $request->ans;

        // Check subject is given
        if ($request->subject_id == 0) {
            return redirect()->back()->with('error', 'Please Select a Subject!');
        }
        // Check Answer is given
        if ($request->ans == 0) {
            return redirect()->back()->with('error', 'Please Select an Answer!');
        }
        $data->save();
        //Data Saved
        return redirect()->route('staff.question.index')->with('success', 'Question Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Question::find($id);

        //Path of Photo from storage
        $pathPhoto = 'storage/' . $data->photo;
        //Path of File from storage
        $path = 'storage/' . $data->file;
        //Delete File from storage
        if (File::exists($path)) {
            //Delete the pdf  file
            File::delete($path);
        }
        if (File::exists($pathPhoto)) {
            //Delete the photo cover  file
            File::delete($pathPhoto);
        }

        // Delete the Data
        $data->delete();

        return redirect()->route('staff.question.index')->with('danger', 'Question has been deleted Successfully!');
    }
}
