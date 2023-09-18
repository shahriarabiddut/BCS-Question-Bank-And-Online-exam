<?php

namespace App\Http\Controllers\Staff;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Support\Facades\File;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Subject::all();
        return view('staff.subject.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $languages = Language::all();
        return view('staff.subject.create', ['languages' => $languages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'language_id' => 'required',
        ]);
        //Data save to Database 
        $data = new Subject();
        $data->title = $request->title;
        $data->language_id = $request->language_id;
        $data->info = $request->info;

        // PHOTO for subject
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('subjectPhoto', 'public');
        }

        $data->save();
        //Data Saved
        return redirect()->route('staff.subject.index')->with('success', 'Subject Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Subject::find($id);
        return view('staff.subject.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $languages = Language::all();
        $data = Subject::find($id);
        return view('staff.subject.edit', ['data' => $data, 'languages' => $languages]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Subject::find($id);
        $request->validate([
            'title' => 'required',
            'language_id' => 'required',
        ]);
        //Data save to Database 
        $data->title = $request->title;
        $data->language_id = $request->language_id;
        $data->info = $request->info;

        // PHOTO for subject
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('subjectPhoto', 'public');
            //Delete Previous Photo from storage
            $path = 'storage/' . $request->prev_photo;
            if (File::exists($path)) {
                //Delete the Previous Photo file
                File::delete($path);
            }
        } else {
            $formFields['photo'] = $request->prev_photo;
        }
        $data->save();
        //Data Saved
        return redirect()->route('staff.subject.index')->with('success', 'Subject Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Subject::find($id);
        $data->delete();
        return redirect()->route('staff.subject.index')->with('danger', 'Subject has been deleted Successfully!');
    }
}
