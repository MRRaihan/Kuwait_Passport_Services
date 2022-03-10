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

class EmbassyController extends Controller
{
    public function index()
    {
        $embassys = User::where('user_type', 'embassy')->orderBy('created_at', 'DESC')->get();
        return view('Admin.embassy.index', compact('embassys'));
    }


    public function create()
    {
        // $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.embassy.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            // 'branch_id' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->status = 1;
        // $user->branch_id = $request->branch_id;
        $user->parent_id = Auth::user()->id;
        $user->created_by = Auth::user()->id;
        $user->password = Hash::make('12345');
        $user->user_type = 'embassy';


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
            $user->assignRole('embassy');

            return response()->json([
                'type' => 'success',
                'message' => 'Successsfully  Embassy Created !',
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
        return view('Admin.embassy.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
            'name' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->fill($request->except('image'));


        // if($request->image){
        //     if ($user->image){
        //         @unlink($request->old_img); //Old image delete
        //     }
        // }

        if ($request->hasFile('image')) {
            if ($user->image != null)
                File::delete(public_path($user->image)); //Old image delete

            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $user->image   = $folder_path . $image_new_name;
        }

        $user->save();

        try {
            return response()->json([
                'type' => 'success',
                'message' => ' Embassy Updated Successfully!',
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
            @unlink($user->image);
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
