<?php

namespace App\Imports;

use App\Models\ManualPassport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ManualPassportImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ManualPassport([
            'user_creator_id' => $row['user_creator_id'],
            'branch_id' => $row['branch_id'],
            'delivery_branch' => $row['delivery_branch'],
            'deleted_by' => $row['deleted_by'],
            'name' => $row['name'],
            'passport_number' => $row['passport_number'],
            'emirates_id' => $row['emirates_id'],
            'govt_passport_id' => $row['govt_passport_id'],
            'mailing_address' => $row['mailing_address'],
            'expiry_date' => $row['expiry_date'],
            'extended_to' => $row['extended_to'],
            'uae_phone' => $row['uae_phone'],
            'permanent_address' => $row['permanent_address'],
            'bd_phone' => $row['bd_phone'],
            'delivery_date' => $row['delivery_date'],
            'profession_id' => $row['profession_id'],
            'profession_file' => $row['profession_file'],
            'application_form' => $row['application_form'],
            'passport_photocopy' => $row['passport_photocopy'],
            'salary' => $row['salary'],
            'ems' => $row['ems'],
            'date' => $row['date'],
            'post_office' => $row['post_office'],
            'dob' => $row['dob'],
            'shift_to_admin' => $row['shift_to_admin'],
            'embassy_status' => $row['embassy_status'],
            'branch_status' => $row['branch_status'],
            'is_delivered' => $row['is_delivered'],
            'is_shifted' => $row['is_shifted'],
            'is_received' => $row['is_received'],
            'is_shifted_to_branch_manager' => $row['is_shifted_to_branch_manager'],
            'passport_type_id' => $row['passport_type_id'],
            'passport_type_title' => $row['passport_type_title'],
            'passport_type_government_fee' => $row['passport_type_government_fee'],
            'passport_type_versatilo_fee' => $row['passport_type_versatilo_fee'],
            'passport_type_fees_total' => $row['passport_type_fees_total'],
            'r_id' => $row['r_id'],
            'entry_person' => $row['entry_person'],
            'otp' => $row['otp'],
            'otp_verify_at' => $row['otp_verify_at'],
            'status' => $row['status'],
            'bio_enrollment_id' => $row['bio_enrollment_id'],
            'remarks' => $row['remarks'],
            'remarks_by' => $row['remarks_by'],
            'model_name' => $row['model_name'],
            'delivery_method' => $row['delivery_method']
        ]);
    }
    public function rules(): array
    {
        return [
            '*.passport_number' => ['required', 'unique:manual_passports'],
            '*.ems' => ['unique:manual_passports'],
            '*.shift_to_admin' => ['required'],
            'embassy_status'  => ['required'],
            'branch_status' => ['required'],
            'is_delivered' => ['required'],
            'is_shifted' => ['required'],
            'is_received' => ['required']
        ];
    }
}
