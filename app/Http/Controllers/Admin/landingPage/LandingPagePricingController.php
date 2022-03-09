<?php

namespace App\Http\Controllers\Admin\landingPage;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class LandingPagePricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricingPlans = PricingPlan::latest()->get();
        return view('Admin.frontendSettings.pricingPlan.index', compact('pricingPlans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.frontendSettings.pricingPlan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content_samary' => 'required',
            'content_details' => 'required',
        ]);

        $pricing = new PricingPlan();
        $pricing->title = $request->title;
        $pricing->content_samary = $request->content_samary;
        $pricing->content_details = $request->content_details;
        $pricing->status = $request->status;
        $pricing->save();

        return redirect()->route('admin.pricingPlan.index')->with('success', 'Pricing Plan Added Successfully');
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
        $pricingPlan = PricingPlan::find($id);
        return view('Admin.frontendSettings.pricingPlan.edit', compact('pricingPlan'));
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
        // dd($request->status);
        $request->validate([
            'title' => 'required',
            'content_samary' => 'required',
            'content_details' => 'required',
        ]);

        $pricing = PricingPlan::find($id);
        $pricing->title = $request->title;
        $pricing->content_samary = $request->content_samary;
        $pricing->content_details = $request->content_details;
        $pricing->status = $request->status;
        $pricing->save();

        return redirect()->route('admin.pricingPlan.index')->with('success', 'Pricing Plan Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PricingPlan = PricingPlan::findOrFail($id);

        try {
            $PricingPlan->delete();
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
