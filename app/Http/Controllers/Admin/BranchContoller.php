<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class BranchContoller extends Controller
{

    public function index()
    {
        $branchs = Branch::orderBy('created_at', 'DESC')->get();
        return view('Admin.branch.index', compact('branchs'));
    }


    public function create()
    {
        return view('Admin.branch.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
        ]);
        $branch = new Branch();
        $branch->name = $request->first_name;
        $branch->status = $request->status;


        try {
            $branch->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successsfully Branch created !',
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


    public function edit($id)
    {
        $branch = Branch::findOrfail($id);
        return view('Admin.branch.edit', compact('branch'));
    }


    public function update(Request $request, $id)
    {


        $request->validate([
            'name' => 'required',
        ]);

        $branch = Branch::findOrfail($id);
        $branch->name = $request->name;
        $branch->status = $request->status;

        try {
            $branch->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully update!',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Failed!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activeNow($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->status = 1;
        try {
            $branch->save();
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
        $branch = Branch::findOrFail($id);
        $branch->status = 0;
        try {
            $branch->save();
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
}
