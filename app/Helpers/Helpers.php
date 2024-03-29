<?php

use App\Models\LostPassport;
use App\Models\ManualPassport;
use App\Models\NewBornBabyPassport;
use App\Models\OtherServiceFee;
use App\Models\RenewPassport;
use App\Models\StaticOption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Mail;
// use GuzzleHttp\Client;



if (!function_exists('random_code')) {

    function set_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function get_other_service_fee_name_by_id($id)
    {
        $otherServiceFee = OtherServiceFee::find($id);
        return $otherServiceFee->title;
    }

    function update_static_option($key, $value)
    {
        if (!StaticOption::where('option_name', $key)->first()) {
            StaticOption::create([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        } else {
            StaticOption::where('option_name', $key)->update([
                'option_name' => $key,
                'option_value' => $value
            ]);
            return true;
        }
        return false;
    }

    function set_env_value(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }

    function get_static_option($key)
    {
        if (StaticOption::where('option_name', $key)->first()) {
            $return_val = StaticOption::where('option_name', $key)->first();
            return $return_val->option_value;
        }
        return null;
    }

    function send_sms($message, $phone)
    {
        // app name given in here
        $app_name = env('APP_NAME');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('SMS_API_URL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'api_key' => env('SMS_API_KEY'),
                'msg' => $message,
                'to' => $phone
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
    }


    function passportOptions()
    {
        return array(
            "Renew Passport",
            "Manual Passport",
            "Lost Passport",
            "New Born Baby",
        );
    }

    function passportOptionsUsers()
    {
        return array(
            "Renew Passport",
            "Manual Passport",
            "Lost Passport",
            "New Born Baby",
            "E-Passport",
        );
    }

    function otherServiesOptions()
    {
        return array(
            "Premier Service",
            "Express Service",
            "Legal & Complaints",
            "Immigration",
            "Others",
        );
    }

    function remarks()
    {
        return array(
            "Call Received",
            "Not Received",
            "Call Busy",
            "Phone Off",
            "Others",
        );
    }

    function dateRange($from, $to, $format = "Y-m-d")
    {
        $range = [];
        if (strtotime($from) && strtotime($to)) {
            $begin = new \DateTime($from);
            $end = new \DateTime($to);

            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($begin, $interval, $end);


            foreach ($dateRange as $date) {
                $range[] = $date->format($format);
            }
            array_push($range, date('Y-m-d', strtotime($to)));
        }

        return $range;
    }



    function downloadExcel($view, $data, $name, $type)
    {
        return \Excel::download(new \App\Exports\Excel($view, $data), $name . '(' . date('F j,Y g:i a') . ')' . '.' . $type);
    }

    function is_save($object, $message)
    {
        if ($object) {
            success($message);
            return redirect()->back();
        }

        whoops();
        return redirect()->back();
    }

    function success($message = 'Your operation has been done successfully')
    {
        session()->flash('success', $message);
    }

    function whoops($message = 'Whoops! Something went Wrong!')
    {
        session()->flash('danger', $message);
    }

    function get_total_lost_passports()
    {

        $lostPassports = LostPassport::all()->count();
        return $lostPassports;
    }
    function get_total_manual_passports()
    {
        $manualPassports = ManualPassport::all()->count();
        return $manualPassports;
    }
    function get_total_renew_passports()
    {
        $renewPassports = RenewPassport::all()->count();
        return $renewPassports;
    }
    function get_total_new_born_baby_passports()
    {
        $newBornBabyPassports = NewBornBabyPassport::all()->count();
        return $newBornBabyPassports;
    }
    function get_total_passports()
    {
        $totalPassports = get_total_lost_passports() + get_total_manual_passports() + get_total_new_born_baby_passports();
        return $totalPassports;
    }

    /**
     * manual passport delivery day count
     */
    function get_manual_passport_dalivery()
    {
        $endDate = Carbon::now()->addDays(3);

        if ($endDate->dayOfWeek == Carbon::FRIDAY) {
            $deliveryDate = Carbon::now()->addDays(5);
        }elseif ($endDate->dayOfWeek == Carbon::SATURDAY) {
            $deliveryDate = Carbon::now()->addDays(4);
        }else{
            $deliveryDate = $endDate;
        }
        return $deliveryDate;
    }

    // three month and five days gap
    function get_three_month_five_days()
    {
        $endDate = Carbon::now()->addMonths(3)->addDays(6);

        if ($endDate->dayOfWeek == Carbon::FRIDAY) {
            $deliveryDate = Carbon::now()->addMonths(3)->addDays(8);
        }elseif ($endDate->dayOfWeek == Carbon::SATURDAY) {
            $deliveryDate = Carbon::now()->addMonths(3)->addDays(7);
        }else{
            $deliveryDate = $endDate;
        }
        return $deliveryDate;
    }
    function if_have_passport_created_by_me($dataEnterer)
    {
        if($dataEnterer->renewPassports->count() > 0 || $dataEnterer->manualPassports->count() > 0 || $dataEnterer->lostPassports->count() > 0 || $dataEnterer->newBornBabyPassports->count() > 0 ){
            return true;
        }else{
            return false;
        }
    }
    function get_all_data_enterers_under_a_branch_manager()
    {
        return User::where('user_type', 'data-enterer')->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get();
    }

    function this_url(){
        return request()->route()->uri;
    }

    function get_passport_model_name_by_option($option){
        if ($option == 0) {
            $passport_model_name = 'App\Models\RenewPassport';
        }
        if ($option == 1) {
            $passport_model_name = 'App\Models\ManualPassport';
        }
        if ($option == 2) {
            $passport_model_name = 'App\Models\LostPassport';
        }
        if ($option == 3) {
            $passport_model_name = 'App\Models\NewBornBabyPassport';
        }
        return $passport_model_name;
    }
}
