<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = questions::all();
        return view("admin.questions.index",compact("questions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.questions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "title" => "required|unique:questions,title",
                "semester_id" => "required",
                "category_id" => "required",
                "document"=> "required"
            ],
            [
                "title.required" => "Title is required field",
                "semester_id.required" => "Select Semester",
                "category_id.required" => "Select Category",
                "unique"=> "question Already exists.",
                "document.required"=> "Document is required"
        ],
        );
        $question = new questions();
        $question->title = Str::title($request->title);
        $question->slug = Str::slug($request->title,"-");
        $question->semester_id = $request->semester_id;
        $question->category_id = $request->category_id;
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/question", $newfile);
            $question->photo = ("images/question/$newfile");
        }
        if ($request->hasfile("document")) {
            $doc = $request->document;
            $newdoc = time() . "." . $doc->GetClientOriginalExtension();
            $doc->move("doc/question", $newdoc);
            $question->document = ("doc/question/$newdoc");
        }
        $question->save();
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
          $question = questions::find($id);
        return view("admin.questions.edit",compact("question"));
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
        try{$question = questions::find($id);
        $question->title = Str::title($request->title);
        $question->slug = Str::slug($request->title,"-");
        $question->semester_id = $request->semester_id;
        $question->category_id = $request->category_id;
        if ($request->hasfile("document")) {
            $doc = $request->document;
            $olddoc =  $question->document;
            if (File::exists(public_path($olddoc))) {
                File::delete(public_path($olddoc));
            }
            $newdoc = time() . "." . $doc->GetClientOriginalExtension();
            $doc->move("doc/question", $newdoc);
            $question->document = ("doc/question/$newdoc");
        }
        $question->update();
    }catch(\illuminate\database\QueryException $e){
        $errorcode = $e->errorInfo[1];
        if($errorcode==1062){
             toast('Operation failed. Question Already exists!', 'warning')->position('bottom-end');
            return back();
        }

    };
    if ($request->hasfile("photo")) {
            $file = $request->photo;
            $oldfile =  $question->photo;
            if (File::exists(public_path($oldfile))) {
                File::delete(public_path($oldfile));
            }
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/question", $newfile);
            $question->photo = ("images/question/$newfile");
        }
        $question->update();
        return redirect("/questions");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question= questions::find($id);
         $oldfile =  $question->photo;
         $olddoc =  $question->document;
        if (File::exists(public_path($oldfile))) {
            File::delete(public_path($oldfile));
        }
        if (File::exists(public_path($olddoc))) {
            File::delete(public_path($olddoc));
        }
        $question->delete();
        return back();
    }
}
