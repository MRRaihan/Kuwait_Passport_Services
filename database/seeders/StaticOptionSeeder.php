<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaticOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        set_static_option('logo', 'uploads/images/logo.png');
        set_static_option('no_image', 'uploads/images/setting/no-image.png');
        set_static_option('user', 'uploads/images/setting/user.png');
        set_static_option('banner_text', 'For title, select "Header 2" from style upper tab');
        set_static_option('banner_image', 'frontend_assets/img/Banner/banner-home.png');
        set_static_option('why_chose_section', 'Why chose use');
        set_static_option('banner_btn_text', 'Check Passport');
        set_static_option('banner_btn_url', '#passport');
        set_static_option('footer_email', ' tfpsolutionsbd@gmail.com');
        set_static_option('footer_phone', ' +971 50 852 5155');
        set_static_option('footer_address', 'Office 19, Dubai National Insurance Building, Port Saeed, Deira,Dubai,UAE');
    }
}
