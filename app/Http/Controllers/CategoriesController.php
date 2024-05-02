<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $get = Category::get();
        // dd($get);
        return view('dashboard', compact('get'));
    }
    public function add_category(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif', // adjust max size as needed
        ]);
        $slug = Str::slug($request->name, '-');
        // dd($slug);
        $image = $request->file('thumbnail');
        $imageName = time() . '.' . $image->extension(); // generate unique filename
        $thumbnailPath =  $image->storeAs('public/images', $imageName);
        // $thumbnailPath = $request->file('thumbnail')->store('public/images');
        // dd($imageName);
        $user = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'thumbnail' => $imageName,
        ]);
        return redirect()->route('dashboard');
    }
    public function del_category($id)
    {

        Category::find($id)->delete();
        return redirect()->route('dashboard');
    }
    public function update_category(Request $request, $id)
    {
        // dd($id);
        $update = Category::find($id);
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif', // adjust max size as needed
        ]);
        $slug = Str::slug($request->name, '-');
        // dd($slug);
        $image = $request->file('thumbnail');
        $imageName = time() . '.' . $image->extension(); // generate unique filename
        $thumbnailPath =  $image->storeAs('public/images', $imageName);
        $update->update([
            'name' => $request->name,
            'slug' => $slug,
            'thumbnail' => $imageName,
        ]);

        return redirect()->route('dashboard');
    }
}
