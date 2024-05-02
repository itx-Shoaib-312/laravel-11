<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrudRequest;
use App\Models\Crud;

class CrudController extends Controller
{
    public function index()
    {
        $get = Crud::get();
        return response($get);
    }
    public function add_record(CrudRequest $request)
    {
        $request->validated();
        if ($request->id == null) {
            $user = Crud::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
            ]);
        } else {

            $user = Crud::find($request->id);
            // dd($user);
            $user->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
            ]);
        }

        return response($user);
    }
    public function del_record($id)
    {
        // dd($id);
        Crud::find($id)->delete();
    }
    public function fetch_data($id)
    {
        // dd($id);
        $fetch = Crud::find($id);
        // dd($fetch);
        return response($fetch);
    }
}
