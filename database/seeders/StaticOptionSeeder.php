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
        set_static_option('uae_office_link', 'https://versatilo.org/');
        set_static_option('kuwait_office_link', 'https://kuwaithc.versatilo.london/');
        set_static_option('bahrain_office_link', 'https://versatilo.london/');
        set_static_option('facebook_link', '#');
        set_static_option('instagram_link', '#');
        set_static_option('linkedin_link', '#');
        set_static_option('twitter_link', '#');
        set_static_option('no_image', 'uploads/images/setting/no-image.png');
        set_static_option('user', 'uploads/images/setting/user.png');
        set_static_option('banner_text', 'For title, select "Header 2" from style upper tab');
        set_static_option('banner_image', 'frontend_assets/img/Banner/banner-home.png');

        set_static_option('why_chose_section', 'We are simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged');

        set_static_option('renew_passport_service_details', 'Individuals whose passports are expired or closed to the expiry date can get their passport renewal services through all our branches throughout Kuwait.');

        set_static_option('manual_passport_service_details', ' This service is mainly for individuals with urgent need of their passports whose expiry dates have been attained.');
        set_static_option('lost_passport_service_details', ' For those who have lost their passports and wish to get a new one, our happy centers can provide you with the necessary service to get issued with a new passport without you going to the embassy');
        set_static_option('new_born_passport_service_details', 'For any queries employees have either with their employers such as no salary
        payment, or any abuse of their rights, our legal service and welfare department
        is available and ready to see into restoring the joy of the complaining
        employee. Also, individuals with cases including police or court that threatens
        their peaceful stay in the Kuwait, can get solutions from our
        legal team.');
        set_static_option('e_passport_service_details', '  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, hic?Lorem, ipsum dolor sit amet consectetur
        adipisicing elit. Ducimus sapiente tempore ea et suscipit eius. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque, hic?Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ducimus sapiente tempore ea et suscipit eius. Atque, hic?Lorem, ipsum dolor sit amet consectetur suscipitAtque, hic?');
        set_static_option('banner_btn_text', 'Check Passport');
        set_static_option('banner_btn_url', '#passport');
        set_static_option('footer_email', ' tfpsolutionsbd@gmail.com');
        set_static_option('footer_phone', ' +971 50 852 5155');
        set_static_option('footer_address', '(Complex 9A, Nasser sports), Block-3(41), Street-Habeeb Manuawar, Office- Second Floor, Farwania, Kuwait');
    }
}
