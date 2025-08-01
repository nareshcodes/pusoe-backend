<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $syllabi = syllabus::all();
        return view("admin.syllabus.index",compact("syllabi"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.syllabus.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { $request->validate(
            [
                "title" => "required|unique:syllabi,Title",
                "semester_id" => "required",
                "category_id" => "required",
                "document"=> "required"
            ],
            [
                "title.required" => "Title is required field",
                "semester_id.required" => "Select Semester",
                "category_id.required" => "Select Category",
                "unique"=> "Syllabus Already exists.",
                "document.required"=> "Document is required"
        ],
        );
        $syllabus = new syllabus();
        $syllabus->title = Str::title($request->title);
        $syllabus->slug = Str::slug($request->title,"-");
        $syllabus->semester_id = $request->semester_id;
        $syllabus->category_id = $request->category_id;
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/syllabus", $newfile);
            $syllabus->photo = ("images/syllabus/$newfile");
        } else {
            $syllabus->photo = ("images/no-image.png");
        }
        if ($request->hasfile("document")) {
            $doc = $request->document;
            $newdoc = time() . "." . $doc->GetClientOriginalExtension();
            $doc->move("doc/syllabus", $newdoc);
            $syllabus->document = ("doc/syllabus/$newdoc");
        }
        $syllabus->save();
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
        $syllabus = syllabus::find($id);
        return view("admin.syllabus.edit",compact("syllabus"));
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
        try{$syllabus = syllabus::find($id);
        $syllabus->title = Str::title($request->title);
        $syllabus->slug = Str::slug($request->title,"-");
        $syllabus->semester_id = $request->semester_id;
        $syllabus->category_id = $request->category_id;
        if ($request->hasfile("document")) {
            $doc = $request->document;
            $olddoc =  $syllabus->document;
            if (File::exists(public_path($olddoc))) {
                File::delete(public_path($olddoc));
            }
            $newdoc = time() . "." . $doc->GetClientOriginalExtension();
            $doc->move("doc/syllabus", $newdoc);
            $syllabus->document = ("doc/syllabus/$newdoc");
        }
        $syllabus->update();
    }catch(\illuminate\database\QueryException $e){
        $errorcode = $e->errorInfo[1];
        if($errorcode==1062){
             toast('Operation failed. Syllabus Already exists!', 'warning')->position('bottom-end');
            return back();
        }

    };
    if ($request->hasfile("photo")) {
            $file = $request->photo;
            $oldfile =  $syllabus->photo;
              if ($oldfile != 'images/no-image.png') {
                if (File::exists(public_path($oldfile))) {
                    File::delete(public_path($oldfile));
                }
            }
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/syllabus", $newfile);
            $syllabus->photo = ("images/syllabus/$newfile");
        }
        $syllabus->update();
        return redirect("/syllabus");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $syllabus= Syllabus::find($id);
         $oldfile =  $syllabus->photo;
         $olddoc =  $syllabus->document;
           if ($oldfile != 'images/no-image.png') {
                if (File::exists(public_path($oldfile))) {
                    File::delete(public_path($oldfile));
                }
            }
        if (File::exists(public_path($olddoc))) {
            File::delete(public_path($olddoc));
        }
        $syllabus->delete();
        return back();
    }
}
