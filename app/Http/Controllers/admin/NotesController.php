<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = notes::all();
        return view("admin.note.index",compact("notes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.note.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "title" => "required|unique:notes,title",
                "semester_id" => "required",
                "category_id" => "required",
                "document"=> "required"
            ],
            [
                "title.required" => "Title is required field",
                "semester_id.required" => "Select Semester",
                "category_id.required" => "Select Category",
                "unique"=> "note Already exists.",
                "document.required"=> "Document is required"
        ],
        );
        $note = new notes();
        $note->title = Str::title($request->title);
        $note->slug = Str::slug($request->title,"-");
        $note->semester_id = $request->semester_id;
        $note->category_id = $request->category_id;
        $note->featured = $request->featured;
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/note", $newfile);
            $note->photo = ("images/note/$newfile");
        }
        if ($request->hasfile("document")) {
            $doc = $request->document;
            $newdoc = time() . "." . $doc->GetClientOriginalExtension();
            $doc->move("doc/note", $newdoc);
            $note->document = ("doc/note/$newdoc");
        }
        $note->save();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $note = notes::find($id);
        return view("admin.note.edit",compact("note"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                "title" => "required",
                "semester_id" => "required",
            ],
            [
                "title.required" => "Title is required field",
                "semester_id.required" => "Select Semester",
        ],
        );
        try{$note = notes::find($id);
        $note->title = Str::title($request->title);
        $note->slug = Str::slug($request->title,"-");
        $note->semester_id = $request->semester_id;
        $note->category_id = $request->category_id;
        $note->featured = $request->featured;
        if ($request->hasfile("document")) {
            $doc = $request->document;
            $olddoc =  $note->document;
            if (File::exists(public_path($olddoc))) {
                File::delete(public_path($olddoc));
            }
            $newdoc = time() . "." . $doc->GetClientOriginalExtension();
            $doc->move("doc/note", $newdoc);
            $note->document = ("doc/note/$newdoc");
        }
        $note->update();
    }catch(\illuminate\database\QueryException $e){
        $errorcode = $e->errorInfo[1];
        if($errorcode==1062){
             toast('Operation failed. note Already exists!', 'warning')->position('bottom-end');
            return back();
        }

    };
    if ($request->hasfile("photo")) {
            $file = $request->photo;
            $oldfile =  $note->photo;
            if (File::exists(public_path($oldfile))) {
                File::delete(public_path($oldfile));
            }
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/note", $newfile);
            $note->photo = ("images/note/$newfile");
        }
        $note->update();
        return redirect("/notes");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note= notes::find($id);
         $oldfile =  $note->photo;
         $olddoc =  $note->document;
        if (File::exists(public_path($oldfile))) {
            File::delete(public_path($oldfile));
        }
        if (File::exists(public_path($olddoc))) {
            File::delete(public_path($olddoc));
        }
        $note->delete();
        return back();
    }
}
