<?php

namespace App\Http\Controllers\Admin\landingPage;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\StaticOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class FrontendSettingController extends Controller
{
    /**
     * banner footer
     */
    public function BannerFooter()
    {

        return view('Admin.frontendSettings.bannerFooter.bannerFooter');
    }

    /**
     * banner footer update
     */
    public function BannerFooterUpdate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'banner_image' => 'required',
            'banner_btn_text' => 'required',
            'banner_btn_url' => 'required',
            'footer_phone' => 'required',
            'footer_email' => 'required',
            'footer_address' => 'required',
            'why_chose_section' => 'required',
            'banner_text' => 'required',
        ]);

        update_static_option('banner_text', $request->banner_text);
        update_static_option('banner_btn_text', $request->banner_btn_text);
        update_static_option('banner_btn_url', $request->banner_btn_url);
        update_static_option('footer_phone', $request->footer_phone);
        update_static_option('footer_email', $request->footer_email);
        update_static_option('footer_address', $request->footer_address);
        update_static_option('why_chose_section', $request->why_chose_section);

        if ($request->hasFile('banner_image')) {
            $image             = $request->file('banner_image');
            $folder_path       = 'uploads/images/users/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->resize(600, 600)->save($folder_path . $image_new_name, 100);
            // $image->move($folder_path, $image_new_name);
            $fileUrl   = $folder_path . $image_new_name;
            update_static_option('banner_image', $fileUrl);
        }

        return redirect()->back()->with('success', 'Information Update successfully');
    }
}
