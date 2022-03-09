<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;


class AccountManagerController extends Controller
{

    public function index()
    {
        $accountManagers = User::orderBy('created_at', 'DESC')->where('user_type', 'account-manager')->get();
        return view('Admin.accountManager.index', compact('accountManagers'));
    }


    public function create()
    {
        // $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.accountManager.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'image' => 'image|max:2000'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        // $user->branch_id = $request->branch_id;
        $user->parent_id = Auth::user()->id;
        $user->created_by = Auth::user()->id;
        $user->password = Hash::make('12345');
        $user->user_type = 'account-manager';
        $user->status = '1';


        if ($request->hasFile('image')) {
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $user->image   = $folder_path . $image_new_name;
        }


        try {
            $user->save();
            $user->assignRole('account-manager');

            return response()->json([
                'type' => 'success',
                'message' => 'Successsfully Account Manager Created !',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Failed!',
            ]);
        }
    }


    public function show($id)
    {
        //
    }

    public function activeNow($id)
    {
        $user = User::findOrFail($id);
        $user->status = 1;
        try {
            $user->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Updated'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function inactiveNow($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        try {
            $user->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Updated'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $user =  User::findOrFail($id);
        // $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.accountManager.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'image' => 'image|max:2000',
        ]);

        $user = User::findOrFail($id);
        $user->fill($request->except('image'));

        if ($request->hasFile('image')) {

            if ($request->image != null) {
                File::delete(public_path($user->image)); //Old image delete
            }
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $user->image   = $folder_path . $image_new_name;
        }

        $user->update();

        try {
            return response()->json([
                'type' => 'success',
                'message' => 'Account Manager Updated Successfully!',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Failed!',
            ]);
        }
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->image) {
            unlink($user->image);
        }
        try {
            $user->deleted_at = Carbon::now();
            $user->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Deleted'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }
}
