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

        $accountManager = new User();
        $accountManager->name = $request->name;
        $accountManager->phone = $request->phone;
        $accountManager->email = $request->email;

        $accountManager->parent_id = Auth::user()->id;
        $accountManager->created_by = Auth::user()->id;
        $accountManager->password = Hash::make('12345');
        $accountManager->user_type = 'account-manager';
        $accountManager->status = '1';


        if ($request->hasFile('image')) {
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $accountManager->image   = $folder_path . $image_new_name;
        }


        try {
            $accountManager->save();
            $accountManager->assignRole('account-manager');

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
        $accountManager = User::findOrFail($id);
        $accountManager->status = 1;
        try {
            $accountManager->save();
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
        $accountManager = User::findOrFail($id);
        $accountManager->status = 0;
        try {
            $accountManager->save();
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
        $accountManager =  User::findOrFail($id);
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

        $accountManager = User::findOrFail($id);
        $accountManager->fill($request->except('image'));

        if ($request->hasFile('image')) {

            if ($request->image != null) {
                File::delete(public_path($accountManager->image)); //Old image delete
            }
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $accountManager->image   = $folder_path . $image_new_name;
        }

        $accountManager->update();

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
        $accountManager = User::findOrFail($id);
        if ($accountManager->image) {
            unlink($accountManager->image);
        }
        try {
            $accountManager->deleted_at = Carbon::now();
            $accountManager->save();
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
