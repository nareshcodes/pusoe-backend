<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = books::all();
        return view("admin.book.index", compact("books"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.book.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                "title" => "required|unique:books,title",
                "semester_id" => "required",
                "category_id" => "required",
                "document" => "required"
            ],
            [
                "title.required" => "Title is required field",
                "semester_id.required" => "Select Semester",
                "category_id.required" => "Select Category",
                "unique" => "book Already exists.",
                "document.required" => "Document is required"
            ],
        );
        $book = new books();
        $book->title = Str::title($request->title);
        $book->slug = Str::slug($request->title, "-");
        $book->semester_id = $request->semester_id;
        $book->category_id = $request->category_id;
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/book", $newfile);
            $book->photo = ("images/book/$newfile");
        } else {
            $book->photo = ("images/no-image.png");
        }
        if ($request->hasfile("document")) {
            $doc = $request->document;
            $newdoc = time() . "." . $doc->GetClientOriginalExtension();
            $doc->move("doc/book", $newdoc);
            $book->document = ("doc/book/$newdoc");
        }
        $book->save();
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
        $book = books::find($id);
        return view("admin.book.edit", compact("book"));
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
        try {
            $book = books::find($id);
            $book->title = Str::title($request->title);
            $book->slug = Str::slug($request->title, "-");
            $book->semester_id = $request->semester_id;
            $book->category_id = $request->category_id;
            if ($request->hasfile("document")) {
                $doc = $request->document;
                $olddoc =  $book->document;
                if (File::exists(public_path($olddoc))) {
                    File::delete(public_path($olddoc));
                }
                $newdoc = time() . "." . $doc->GetClientOriginalExtension();
                $doc->move("doc/book", $newdoc);
                $book->document = ("doc/book/$newdoc");
            }
            $book->update();
        } catch (\illuminate\database\QueryException $e) {
            $errorcode = $e->errorInfo[1];
            if ($errorcode == 1062) {
                toast('Operation failed. book Already exists!', 'warning')->position('bottom-end');
                return back();
            }
        };
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $oldfile =  $book->photo;
            if ($oldfile != 'images/no-image.png') {
                if (File::exists(public_path($oldfile))) {
                    File::delete(public_path($oldfile));
                }
            }
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/book", $newfile);
            $book->photo = ("images/book/$newfile");
        }
        $book->update();
        return redirect("/books");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = books::find($id);
        $oldfile =  $book->photo;
        $olddoc =  $book->document;
        if ($oldfile != 'images/no-image.png') {
            if (File::exists(public_path($oldfile))) {
                File::delete(public_path($oldfile));
            }
        }
        if (File::exists(public_path($olddoc))) {
            File::delete(public_path($olddoc));
        }
        $book->delete();
        return back();
    }
}
