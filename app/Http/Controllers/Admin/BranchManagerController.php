<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BranchManagerController extends Controller
{

    public function index()
    {
        $branchManagers = User::orderBy('created_at', 'DESC')->where('user_type', 'branch-manager')->get();
        return view('Admin.branchManager.index', compact('branchManagers'));
    }


    public function create()
    {
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.branchManager.create', compact('branchs'));
    }


    public function store(Request $request)
    {


        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'branch_id' => 'required',
        ]);

        $branchManager = new User();
        $branchManager->name = $request->name;
        $branchManager->phone = $request->phone;
        $branchManager->email = $request->email;
        $branchManager->branch_id = $request->branch_id;
        $branchManager->parent_id = Auth::user()->id;
        $branchManager->created_by = Auth::user()->id;
        $branchManager->password = Hash::make('12345');
        $branchManager->user_type = 'branch-manager';
        $branchManager->status = '1';

        if ($request->hasFile('image')) {
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            // $image->move($folder_path, $image_new_name);
            $branchManager->image   = $folder_path . $image_new_name;
        }

        try {

            $branchManager->save();
            $branchManager->assignRole('branch-manager');
            return response()->json([
                'type' => 'success',
                'message' => 'Successsfully Branch Manager Created !',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Failed!',
            ]);
        }
    }


    public function show(User $user)
    {
        //
    }

    public function activeNow($id)
    {
        $branchManager = User::findOrFail($id);
        $branchManager->status = 1;
        try {
            $branchManager->save();
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
        $branchManager = User::findOrFail($id);
        $branchManager->status = 0;
        try {
            $branchManager->save();
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
        $branchManager =  User::findOrFail($id);
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.branchManager.edit', compact('branchManager', 'branchs'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
            'name' => 'required',
        ]);

        $branchManager = User::findOrFail($id);
        $branchManager->fill($request->except('image'));

        if ($request->hasFile('image')) {
            if ($branchManager->image != null)
                File::delete(public_path($branchManager->image)); //Old image delete

            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            // $image->move($folder_path, $image_new_name);
            $branchManager->image   = $folder_path . $image_new_name;
        }

        $branchManager->save();

        try {
            return response()->json([
                'type' => 'success',
                'message' => 'Manager Updated Successfully!',
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
        $branchManager = User::find($id);
        if ($branchManager->dataEnterersUnderMe->count() > 0) {
            return response()->json([
                'type' => 'error',
                'message' => 'This branch manager have some data enterer !'
            ]);
        }else{
            $branchManager = User::findOrFail($id);
            if ($branchManager->image) {
                unlink($branchManager->image);
            }
            try {
                $branchManager->deleted_at = Carbon::now();
                $branchManager->save();
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
}
