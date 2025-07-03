<?php

namespace App\Http\Controllers\admin;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Models\semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = semester::Orderby("id", "asc")->get();
        return view("admin.semester.index", compact("semesters"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.semester.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                "title" => "required|unique:semesters,Title",
            ],
            [
                "title.required" => "Title is required field",
                "unique"=> "Semester Already exists."
        ],
        );
        $semester = new semester();
        $semester->title = Str::title($request->title);
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/semester", $newfile);
            $semester->photo = ("images/semester/$newfile");
        }
        $semester->save();
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
        $semester = semester::find($id);
        return view("admin.semester.edit", compact("semester"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate(
            [
                "title" => "required|unique:semesters,Title",
            ],
            [
                "title.required" => "Title is required field",
                "unique"=> "Semester Already exists."
        ],
        );
        $semester = semester::find($id);
        $semester->title = Str::title($request->title);
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $oldfile =  $semester->photo;
            if (File::exists(public_path($oldfile))) {
                File::delete(public_path($oldfile));
            }
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/semester", $newfile);
            $semester->photo = ("images/semester/$newfile");
        }
        $semester->update();
        toast('Semester has been updated successfully!','success')->position('bottom-end');

        return redirect('/semester');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $semester = semester::find($id);
        $oldfile =  $semester->photo;
        if (File::exists(public_path($oldfile))) {
            File::delete(public_path($oldfile));
        }
        $semester->delete();
        return redirect()->back();
    }
}
