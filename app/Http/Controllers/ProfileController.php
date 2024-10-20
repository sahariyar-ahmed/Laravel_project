<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }

    public function name_update(Request $request)
    {
        $old_name = Auth::user()->name;
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/u',
        ]);

        User::find(auth()->user()->id)->update([
            'name' => $request->name,
            'updated_at' => now(),
        ]);

        return back()->with('name_update', "name update successful $old_name to $request->name");
    }

    public function email_update(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    User::find(auth()->user()->id)->update([
        'email' => $request->email,
        'updated_at' => now(),
    ]);

    return back()->with('email_update', "email update successful");
}





    public function password_update(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:8|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)) {

            User::find(auth()->user()->id)->update([
                'password' => $request->password,
                'updated_at' => now(),
            ]);

            return back()->with('password_update', "Password update successful");
        } else {
            return back()->withErrors(["current_password" => "authorization didn't match"])->withInput();
        }
    }


    public function image_update(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,bmp,webp,svg|max:2048|',
        ]);

        if ($request->hasFile('image')) {
            if (Auth::user()->image) {
                $oldpath = base_path('public/uploades/profile/'.Auth::user()->image);
                if (file_exists($oldpath)) {
                    unlink($oldpath);
                }
            }


            $new_name = Auth::user()->id.'-'.now()->format('M d, y').'-'.rand(0, 9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploades/profile/'.$new_name));
            User::find(auth()->user()->id)->update([
                'image' => $new_name,
                'updated_at' => now(),
            ]);
            return back()->with('image_update', "Image update successful");
        }
    }
}
