<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliverys = Delivery::orderBy('created_at', 'DESC')->get();
        return view('Admin.delivery.index', compact('deliverys'));
    }


    public function create()
    {
        return view('Admin.delivery.create');
    }


    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'first_name' => 'required',
            'cost' => 'required',
        ]);
        $delivery = new Delivery();
        $delivery->name = $request->first_name;
        $delivery->cost = $request->cost;
        $delivery->status = $request->status;


        try {
            $delivery->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Successsfully Delivery created !',
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
        $delivery = Delivery::findOrfail($id);
        return view('Admin.delivery.edit', compact('delivery'));
    }


    public function update(Request $request, $id)
    {


        $request->validate([
            'name' => 'required',
            'cost' => 'required',
        ]);

        $delivery = Delivery::findOrfail($id);
        $delivery->name = $request->name;
        $delivery->cost = $request->cost;
        $delivery->status = $request->status;

        try {
            $delivery->save();
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


    public function activeNow($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->status = 1;
        try {
            $delivery->save();
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
        $delivery = Delivery::findOrFail($id);
        $delivery->status = 0;
        try {
            $delivery->save();
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

    public function destroy($id)
    {
        $user = Delivery::findOrFail($id);

        try {
            $user->delete();
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
