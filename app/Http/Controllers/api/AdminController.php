<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notes as ResourcesNotes;
use App\Http\Resources\Books as ResourcesBooks;
use App\Http\Resources\company as ResourcesCompany;
use App\Models\books;
use App\Models\company;
use App\Models\notes;
use App\Models\semester;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

use function Laravel\Prompts\note;

class AdminController extends Controller
{
    public function company(){
        $company=company::first();
        if(!empty($company)){

        return new ResourcesCompany($company);
        }
    }
    public function semester(){
        return response()->json(["semester"]);
    }
    public function syllabus(){
        return response()->json(["syllabus"]);
    }
    public function questions(){
        return response()->json(["questions"]);
    }
    public function notes(string $request)
    {
            $sem = semester::where('title','Like','%'.$request.'%')->first();

            if(!empty($sem->id)){
                $notes = notes::where('semester_id',$sem->id)->get();
                return ResourcesNotes::collection($notes);
            }
    }
    public function books(){
       $books = books::all();
       return ResourcesBooks::collection($books);
    }
}
