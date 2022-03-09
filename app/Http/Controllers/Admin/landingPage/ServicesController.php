<?php

namespace App\Http\Controllers\Admin\landingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Services::all();
        return view('Admin.frontendSettings.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.frontendSettings.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);

        $data = $request->except(['_token', 'logo']);

        if ($request->hasFile('logo')) {
            $file        = $request->file('logo');
            $path        = 'uploads/images/setting';
            $file_name   = time() . rand('0000', '9999') . '.' . $file->getClientOriginalName();
            $file->move($path, $file_name);
            $data['logo'] = $path . '/' . $file_name;
        }
        $services = Services::create($data);

        return redirect()->route('admin.pageServices.index', compact('services'))->with('success', 'Service Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Services::find($id);
        return view('Admin.frontendSettings.services.edit', compact('service'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);

        $service = Services::findOrFail($id);

        $service->fill($request->except('logo'));

        if ($request->hasFile('logo')) {

            if ($service->logo != null)
                File::delete(public_path($service->logo)); 

            $file        = $request->file('logo');
            $path        = 'uploads/images/setting';
            $file_name   = time() . rand('0000', '9999') . '.' . $file->getClientOriginalName();
            $file->move($path, $file_name);
            $service->logo = $path . '/' . $file_name;

         /*    if ($service->logo != null && file_exists($service->logo)) {
                unlink($service->logo);
            } */
        }

        $service->save();


        return redirect()->route('admin.pageServices.index')->with('success', 'Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $services = Services::findOrFail($id);
        if ($services->logo) {
            unlink($services->logo);
        }

        try {
            $services->delete();
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
