<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = company::first();
        return view("admin.company.index", compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.company.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = company::First();
        if (empty($company)) {
            $request->validate([
                "name" => "required",
                "address" => "required",
                "phone" => "required",
                "email" => "required",
            ], [

                "name.required" => "Title is required.",
                "address.required" => "Address is required.",
                "phone.required" => "Phone is required.",
                "email.required" => "Email is required."

            ]);
            $company = new company();
            $company->name = $request->name;
            $company->address = $request->address;
            $company->phone = $request->phone;
            $company->email = $request->email;

            $company->website = $request->website;
            if ($request->hasfile("logo")) {
                $file = $request->logo;
                $newfile = time() . "." . $file->GetClientOriginalExtension();
                $file->move("images/company", $newfile);
                $company->logo = ("images/company/$newfile");
            }
            $company->save();
            return redirect('/company');
        } else {
            return redirect("/login");
        };
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
        $company = company::find($id);
        return view("admin.company.edit", compact("company"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "address" => "required",
            "phone" => "required",
            "email" => "required",
        ], [

            "name.required" => "Title is required.",
            "address.required" => "Address is required.",
            "phone.required" => "Phone is required.",
            "email.required" => "Email is required."

        ]);
        $company = company::find($id);
        $company->name = $request->name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;

        $company->website = $request->website;
        if ($request->hasfile("logo")) {
            $file = $request->logo;
            $oldfile =  $company->logo;
            if(File::exists(public_path($oldfile))){
            File::delete(public_path($oldfile));}
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/company", $newfile);
            $company->logo = ("images/company/$newfile");
        }
        $company->update();
        return redirect('/company');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
