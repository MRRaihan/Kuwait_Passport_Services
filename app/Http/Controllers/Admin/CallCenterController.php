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
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;



class CallCenterController extends Controller
{

    public function index()
    {
        $callCenters = User::where('user_type', 'call-center')->orderBy('created_at', 'DESC')->get();
        return view('Admin.callCenter.index', compact('callCenters'));
    }


    public function create()
    {
        return view('Admin.callCenter.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            // 'branch_id' => 'required',

        ]);

        $callCenter = new User();
        $callCenter->name = $request->name;
        $callCenter->phone = $request->phone;
        $callCenter->email = $request->email;
        $callCenter->status = 1;

        $callCenter->parent_id = Auth::user()->id;
        $callCenter->created_by = Auth::user()->id;
        $callCenter->password = Hash::make('12345');
        $callCenter->user_type = 'call-center';



        if ($request->hasFile('image')) {
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $callCenter->image   = $folder_path . $image_new_name;
        }

        try {
            $callCenter->save();
            $callCenter->assignRole('call-center');
            return response()->json([
                'type' => 'success',
                'message' => 'Successsfully call center created !',
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
        $callCenter = User::findOrFail($id);
        $callCenter->status = 1;
        try {
            $callCenter->save();
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
        $callCenter = User::findOrFail($id);
        $callCenter->status = 0;
        try {
            $callCenter->save();
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
        $callCenter = User::findOrFail($id);
        return view('Admin.callCenter.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
            'name' => 'required',
        ]);

        $callCenter = User::findOrFail($id);
        $callCenter->fill($request->except('image'));

        if ($request->hasFile('image')) {
            if ($callCenter->image != null)
                File::delete(public_path($callCenter->image)); //Old image delete

            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            // Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $image->move($folder_path, $image_new_name);
            $callCenter->image   = $folder_path . $image_new_name;
        }

        $callCenter->save();

        try {
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Updated!',
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

        $callCenter = User::findOrFail($id);
        if ($callCenter->image) {
            unlink($callCenter->image);
        }

        try {
            $callCenter->deleted_at = Carbon::now();
            $callCenter->save();
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
