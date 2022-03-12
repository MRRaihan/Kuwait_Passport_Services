<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;


class DataEntererController extends Controller
{

    public function index()
    {
        $dataEnterers = User::orderBy('created_at', 'DESC')->where('user_type', 'data-enterer')->get();
        return view('Admin.dataEnterer.index', compact('dataEnterers'));
    }


    public function create()
    {
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.dataEnterer.create', compact('branchs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'branch_id' => 'required'
        ]);

        $dataEnterer = new User();
        $dataEnterer->name = $request->name;
        $dataEnterer->phone = $request->phone;
        $dataEnterer->email = $request->email;
        $dataEnterer->status = 1;
        $dataEnterer->branch_id = $request->branch_id;
        $dataEnterer->parent_id = Auth::user()->id;
        $dataEnterer->created_by = Auth::user()->id;
        $dataEnterer->password = Hash::make('12345');
        $dataEnterer->user_type = 'data-enterer';


        if ($request->hasFile('image')) {
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $dataEnterer->image   = $folder_path . $image_new_name;
        }

        $dataEnterer->save();
        $dataEnterer->assignRole('data-enterer');

        try {
            return response()->json([
                'type' => 'success',
                'message' => 'Data Enterer Save Successfully!',
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
        $dataEnterer = User::findOrFail($id);
        $dataEnterer->status = 1;
        try {
            $dataEnterer->save();
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
        $dataEnterer = User::findOrFail($id);
        $dataEnterer->status = 0;
        try {
            $dataEnterer->save();
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


    public function entryActiveNow($id)
    {
        $dataEnterer = User::findOrFail($id);
        $dataEnterer->entry_status = 1;
        try {
            $dataEnterer->save();
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

    public function entryInactiveNow($id)
    {
        $dataEnterer = User::findOrFail($id);
        $dataEnterer->entry_status = 0;
        try {
            $dataEnterer->save();
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
        $enterer = User::findOrFail($id);
        $branchs = Branch::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('Admin.dataEnterer.edit', compact('enterer', 'branchs'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'branch_id' => 'required'
        ]);

        $dataEnterer = User::findOrFail($id);
        $dataEnterer->fill($request->except('image'));

        if ($request->hasFile('image')) {
            if ($dataEnterer->image != null)
                File::delete(public_path($dataEnterer->image)); //Old image delete

            $image             = $request->file('image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            $dataEnterer->image   = $folder_path . $image_new_name;
        }

        $dataEnterer->save();

        try {
            return response()->json([
                'type' => 'success',
                'message' => 'Data Enterer Updated Successfully!',
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
        $dataEnterer = User::findOrFail($id);

        if (if_have_passport_created_by_me($dataEnterer)) {
            return response()->json([
                'type' => 'error',
                'message' => 'This data enterer have some passport !'
            ]);
        }else{
            if ($dataEnterer->image) {
                unlink($dataEnterer->image);
            }
            try {
                $dataEnterer->deleted_at = Carbon::now();
                $dataEnterer->save();
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
