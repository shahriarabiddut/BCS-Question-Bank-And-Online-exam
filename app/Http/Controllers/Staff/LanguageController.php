<?php

namespace App\Http\Controllers\Staff;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Language::all();
        return view('staff.language.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('staff.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
        ]);
        //Data save to Database 
        $data = new Language();
        $data->title = $request->title;

        // PHOTO for language
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('languagePhoto', 'public');
        }

        $data->save();
        //Data Saved
        return redirect()->route('staff.language.index')->with('success', 'Language Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Language::find($id);
        return view('staff.language.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Language::find($id);
        return view('staff.language.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Language::find($id);
        $request->validate([
            'title' => 'required',
        ]);
        //Data save to Database 
        $data->title = $request->title;

        // PHOTO for language
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('languagePhoto', 'public');
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
        return redirect()->route('staff.language.index')->with('success', 'Language Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Language::find($id);
        $data->delete();
        return redirect()->route('staff.language.index')->with('danger', 'Language has been deleted Successfully!');
    }
}
