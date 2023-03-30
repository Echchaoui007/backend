<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $data=$request->validate([
            "name" =>'required|string',
            "email"=>'required|email',
            "password"=>'required|string'
        ]);
        $admin = Admin::create([
            "name" =>$data["name"],
            "email"=>$data["email"],
            "password"=>bcrypt($data["password"])
        ]);
        return response($admin, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $adminModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $adminModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $adminModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $adminModel)
    {
        //
    }
}
