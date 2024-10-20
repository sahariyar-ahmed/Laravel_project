<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.index',compact('categories'));
    }

    public function store(Request $request){
        $manager = new ImageManager(new Driver());

        $request->validate([
            'title' => 'required|regex:/^[a-zA-Z\s]+$/u',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,bmp,webp,svg|max:2048|',
        ]);

        if($request->hasFile('image')){
            $new_name = auth()->user()->id .'-'. $request->title .'-'. rand(1111,9999) .'.'. $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploades/category/'.$new_name));


            if($request->slug){

                Category::insert([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->slug,'-'),
                    'image' => $new_name,
                    'created_at' => now(),
                ]);
                return back()->with('category_success','Category Insert Successful');
            }else{
                Category::insert([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->title,'-'),
                    'image' => $new_name,
                    'created_at' => now(),
                ]);
                return back()->with('category_success','Category Insert Successful');
            }


        }

    }

    public function edit($id)
    {
       $category = Category::where('id', $id)->first();
       return view('dashboard.category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $manager = new ImageManager(new Driver());
        $category = Category::where('id', $id)->first();

        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,gif,bmp,webp,svg|max:2048|',
        ]);

        if ($request->hasFile('image')) {

            if ($category->image) {
                $oldpath = base_path('public/uploades/category/'. $category->image);
                if (file_exists($oldpath)) {
                    unlink($oldpath);
                }
            }

            $new_name = auth()->user()->id .'-'. $request->title .'-'. rand(1111,9999) .'.'. $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploades/category/'.$new_name));

            if ($request->slug) {
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'image' => $new_name,
                    'update_at' => now(),
                ]);
                return redirect()->route('category.index')->with('category_success','Category Edit  Successful');
            } else {
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'image' => $new_name,
                    'update_at' => now(),
                ]);
                return redirect()->route('category.index')->with('category_success','Category Edit Successful');
            }


        } else {

            if ($request->slug) {
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'update_at' => now(),
                ]);
                return redirect()->route('category.index')->with('category_success','Category Edit  Successful');
            } else {
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'update_at' => now(),
                ]);
                return redirect()->route('category.index')->with('category_success','Category Edit Successful');
            }


        }



    }


    public function delete($id){
        $category = Category::where('id', $id)->first();
        if ($category->image) {
            $oldpath = base_path('public/uploades/category/'. $category->image);
            if (file_exists($oldpath)) {
                unlink($oldpath);
            }
        }
        Category::find($category->id)->delete();
        return redirect()->route('category.index')->with('category_success','Category Delete Successful');
    }

    public function status($id){
        
       $category = Category::where('id', $id)->first();
       if ($category->status == 'active') {
        Category::find($category->id)->update([
            'status' => 'deactive',
            'update_at' => now(),
        ]);
        return redirect()->route('category.index')->with('category_success','Category status Change Successful');
       } else {
        Category::find($category->id)->update([
            'status' => 'active',
            'update_at' => now(),
        ]);
        return redirect()->route('category.index')->with('category_success','Category status Change Successful');
       }


    }
}
