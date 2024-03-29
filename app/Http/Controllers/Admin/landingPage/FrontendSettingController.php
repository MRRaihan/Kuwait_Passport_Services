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

    public function linkEdit()
    {
        return view('Admin.frontendSettings.link');
    }

    public function linkUpdate(Request $request)
    {
        $request->validate([
            'uae_office_link' => 'required',
            'kuwait_office_link' => 'required',
            'bahrain_office_link' => 'required',
            'facebook_link' => 'required',
            'instagram_link' => 'required',
            'linkedin_link' => 'required',
            'twitter_link' => 'required',
        ]);

        update_static_option('uae_office_link', $request->uae_office_link);
        update_static_option('kuwait_office_link', $request->kuwait_office_link);
        update_static_option('bahrain_office_link', $request->bahrain_office_link);
        update_static_option('facebook_link', $request->facebook_link);
        update_static_option('instagram_link', $request->instagram_link);
        update_static_option('linkedin_link', $request->linkedin_link);
        update_static_option('twitter_link', $request->twitter_link);

        return back()->with('success', 'Update successfully');
    }
    public function serviceDetailsEdit()
    {
        return view('Admin.frontendSettings.service_details');
    }

    public function serviceDetailsUpdate(Request $request)
    {
        $request->validate([
            'renew_passport_service_details' => 'required',
            'manual_passport_service_details' => 'required',
            'lost_passport_service_details' => 'required',
            'new_born_passport_service_details' => 'required',
            'e_passport_service_details' => 'required',
        ]);

        update_static_option('renew_passport_service_details', $request->renew_passport_service_details);
        update_static_option('manual_passport_service_details', $request->manual_passport_service_details);
        update_static_option('lost_passport_service_details', $request->lost_passport_service_details);
        update_static_option('new_born_passport_service_details', $request->new_born_passport_service_details);
        update_static_option('e_passport_service_details', $request->e_passport_service_details);

        return back()->with('success', 'Update successfully');
    }

}
