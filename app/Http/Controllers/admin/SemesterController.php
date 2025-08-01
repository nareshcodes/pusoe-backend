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
        $semesters = semester::orderBy("id", "asc")->get();
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
                "title" => "required|unique:semesters,title",
            ],
            [
                "title.required" => "Title is required field",
                "unique" => "Semester Already exists."
            ],
        );
        $semester = new semester();
        $semester->title = Str::title($request->title);
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/semester", $newfile);
            $semester->photo = ("images/semester/$newfile");
        } else {
            $semester->photo = ("images/no-image.png");
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
                "title" => "required",
            ],
            [
                "title.required" => "Title is required field",

            ],
        );
        try {
            $semester = semester::find($id);
            $semester->title = Str::title($request->title);

            $semester->update();
            toast('Semester has been updated successfully!', 'success')->position('bottom-end');
        } catch (\illuminate\Database\QueryException $e) {
            $errorcode = $e->errorInfo[1];
            if ($errorcode == 1062) {
                toast('Operation failed. Semester Already exists!', 'warning')->position('bottom-end');
                return back();
            }
        };
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $oldfile =  $semester->photo;
             if ($oldfile != 'images/no-image.png') {
                if (File::exists(public_path($oldfile))) {
                    File::delete(public_path($oldfile));
                }
            }
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/semester", $newfile);
            $semester->photo = ("images/semester/$newfile");
        }
        $semester->update();
        return redirect('/semester');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $semester = semester::find($id);
            $semester->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorcode = $e->errorInfo[1];
            if ($errorcode == 1451) {

                toast('Semester cannot be deleted!', 'warning')->position('bottom-end');
                return back();
            }
        };
        $oldfile =  $semester->photo;
         if ($oldfile != 'images/no-image.png') {
                if (File::exists(public_path($oldfile))) {
                    File::delete(public_path($oldfile));
                }
            }
        return redirect()->back();
    }
}
