<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notes as ResourcesNotes;
use App\Http\Resources\Books as ResourcesBooks;
use App\Http\Resources\company as ResourcesCompany;
use App\Http\Resources\question as ResourcesQuestion;
use App\Http\Resources\semester as ResourcesSemester;
use App\Http\Resources\syllabus as ResourcesSyllabus;
use App\Models\books;
use App\Models\company;
use App\Models\notes;
use App\Models\questions;
use App\Models\semester;
use App\Models\syllabus;

class AdminController extends Controller
{
    public function company(){
        $company=company::first();
        if(!empty($company)){

        return new ResourcesCompany($company);
        }
    }
    public function semester(){
        $semesters = semester::all();
        if(!empty($semester)){

        return ResourcesSemester::collection($semesters);
        }
    }
    public function syllabus(){
        $syllabus = syllabus::all();
        if(!empty($syllabus)){
        return ResourcesSyllabus::collection($syllabus);
        }
    }
    public function questions(){
         $questions = questions::all();
        if(!empty($questions)){

        return ResourcesQuestion::collection($questions);
        }
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
       if(!empty($books)){
        return ResourcesBooks::collection($books);
       }
    }
}
