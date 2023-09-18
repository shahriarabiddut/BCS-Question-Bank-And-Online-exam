<?php

namespace App\Http\Controllers\Staff;

use App\Models\Book;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Book::all();
        return view('staff.book.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subjects = Subject::all();
        return view('staff.book.create', ['subjects' => $subjects]);
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
            'author' => 'required',
            'file' => 'required',
        ]);
        //Data save to Database 
        $data = new Book();
        $data->title = $request->title;
        $data->author = $request->author;
        $data->subject_id = $request->subject_id;
        $data->info = $request->info;
        $file = $request->file;

        // PHOTO for book
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('bookPhoto', 'public');
        }
        // File for book
        if ($request->hasFile('file') && $file->getClientMimeType() == 'application/pdf') {
            $data->file = $request->file('file')->store('bookFile', 'public');
        } else {
            return redirect()->back()->with('error', 'File Type is not PDF');
        }

        $data->save();
        //Data Saved
        return redirect()->route('staff.book.index')->with('success', 'Book Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Book::find($id);
        return view('staff.book.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $subjects = Subject::all();
        $data = Book::find($id);
        return view('staff.book.edit', ['data' => $data, 'subjects' => $subjects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Book::find($id);
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'author' => 'required',
        ]);
        //Data save to Database 
        $data->title = $request->title;
        $data->author = $request->author;
        $data->subject_id = $request->subject_id;
        $data->info = $request->info;
        $file = $request->file;

        // PHOTO for book
        if ($request->hasFile('photo')) {
            $data->photo = $request->file('photo')->store('bookPhoto', 'public');

            //Delete Previous Photo from storage
            $path = 'storage/' . $request->prev_photo;
            if (File::exists($path)) {
                //Delete the Previous Photo file
                File::delete($path);
            }
        } else {
            $data->photo = $request->prev_photo;
        }
        // File for book
        if ($request->hasFile('file') && $file->getClientMimeType() == 'application/pdf') {
            $data->file = $request->file('file')->store('bookFile', 'public');
            //Path of File from storage
            $path = 'storage/' . $request->prev_file;
            //Delete File from storage
            if (File::exists($path)) {
                //Delete the pdf  file
                File::delete($path);
            }
        } else {
            $data->file = $request->prev_file;
        }
        $data->save();
        //Data Saved
        return redirect()->route('staff.book.index')->with('success', 'Book Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Book::find($id);

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

        return redirect()->route('staff.book.index')->with('danger', 'Book has been deleted Successfully!');
    }
}
