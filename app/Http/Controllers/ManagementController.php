<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;




class ManagementController extends Controller
{
    public function index()
    {
        $managers = User::where('role', 'manager')->get();
        return view('dashboard.management.auth.register', compact('managers'));
    }

    public function store_register(Request $request)
    {
        $role = ucfirst($request->role);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|in:manager,blogger,user',
        ]);


        if (!$request->role == "") {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);
            return back()->with("register_complete", "$role Register Complete");
        } else {
            return back()->withErrors(['role' => 'please, select role first '])->withInput();
        }
    }

    public function manager_down($id)
    {
        $manager = User::where('id', $id)->first();


        if ($manager->role == 'manager') {
            User::find($manager->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
            return back()->with('register_complete', "Manager Demotion Successful");
        }
    }


    // role manage
    public function role_index()
    {

        $users = User::where('role', 'user')->where('block', false)->get();
        $bloggers = User::where('role', 'blogger')->get();

        return view('dashboard.management.role.index', [
            'only_users' => $users,
            'only_bloggers' => $bloggers,
        ]);
    }

    public function role_assign(Request $request)
    {

        $request->validate([
            'role' => 'required|in:manager,blogger,user',
        ]);

        $user = User::where('id', $request->user_id)->first();

        User::find($user->id)->update([
            'role' => $request->role,
            'updated_at' => now(),
        ]);

        Session::flash("role_assign", "Role Assign Successful");
        return back();
    }

    public function blogger_grade_down($id)
    {
        $user = User::where('id', $id)->first();

        if ($user->role == 'blogger') {
            User::find($user->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
            Session::flash('role_assign', 'Role Down Successful');

            return back();
        }
    }

    public function user_grade_down($id)
    {
        $user = User::where('id', $id)->first();


        if ($user->role == 'user') {
            User::find($user->id)->update([
                'block' => true,
                'updated_at' => now(),
            ]);
            Session::flash('role_assign', 'Block This User Successful');

            return back();
        }
    }


    // black list
    public function block_list()
    {

        $users = User::where('role', 'user')->where('block', true)->get();
        return view('dashboard.management.block-list.index', [
            'only_users' => $users,
        ]);
    }

    public function block_delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete(); // Permanently delete the user
            return redirect()->route('management.block.list')->with('block_delete', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'blogger not found.');
        }
    }

    // -------------------------------------------- manager------------------------------------------------------------------


    // manager edit

    public function manager_edit($id)
    {
        $manager = User::where('id', $id)->first();
        return view('dashboard.management.auth.edti', compact('manager'));
    }
    // manager update

    public function manager_update(Request $request, $id)
    {
        $manager = User::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => '|email|unique:users,email,' . $manager->id,

        ]);
        if (User::where('email', $request->email)->where('id', '!=', $manager->id)->exists()) {
            return redirect()->back()->withErrors(['email' => 'The email is already taken by another user.']);
        }
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->save();

        return redirect()->route('management.index')->with('register_complete', 'Manager updated successfully.');
    }


    // manager delete
    public function manager_delete($id)
    {

        $manager = User::find($id);

        if ($manager) {
            $manager->delete(); // Permanently delete the user
            return redirect()->route('management.index')->with('register_complete', 'Manager deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Manager not found.');
        }
    }


    // -------------------------------------------- manager------------------------------------------------------------------





    // -------------------------------------------- blogger------------------------------------------------------------------


    // blogger edit

    public function blogger_edit($id)
    {
        $blogger = User::where('id', $id)->first();
        return view('dashboard.management.role.blogger-edit', compact('blogger'));
    }

    // blogger update

    public function blogger_update(Request $request, $id)
    {
        $blogger = User::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => '|email|unique:users,email,' . $blogger->id,

        ]);
        if (User::where('email', $request->email)->where('id', '!=', $blogger->id)->exists()) {
            return redirect()->back()->withErrors(['email' => 'The email is already taken by another user.']);
        }
        $blogger->name = $request->name;
        $blogger->email = $request->email;
        $blogger->save();

        return redirect()->route('management.role.index')->with('register_complete', 'Blogger updated successfully.');
    }


    // blogger delete
    public function blogger_delete($id)
    {

        $blogger = User::find($id);

        if ($blogger) {
            $blogger->delete(); // Permanently delete the user
            return redirect()->route('management.role.index')->with('role_assign', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'blogger not found.');
        }
    }


    // -------------------------------------------- blogger------------------------------------------------------------------




    // -------------------------------------------- user ------------------------------------------------------------------


    // user-edit

    public function user_edit($id)
    {

        $user = User::where('id', $id)->first();
        return view('dashboard.management.role.user-edit', compact('user'));
    }


    // user-edit

    public function user_update(Request $request, $id)
    {

        $user = User::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'User not found.']);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route("management.role.index")->with('role_assign', 'User updated successfully.');
    }



    // user delete
    public function user_delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('management.role.index')->with('role_assign', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
}
