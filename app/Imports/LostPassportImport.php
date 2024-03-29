<?php

namespace App\Imports;

use App\Models\LostPassport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class LostPassportImport implements
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
        return new LostPassport([
            'user_creator_id' => $row['user_creator_id'],
            'branch_id' => $row['branch_id'],
            'deleted_by' => $row['deleted_by'],
            'name' => $row['name'],
            'passport_number' => $row['passport_number'],
            'civil_id' => $row['civil_id'],

            'mailing_address' => $row['mailing_address'],
            'permanent_address' => $row['permanent_address'],
            'ems' => $row['ems'],
            'profession_file' => $row['profession_file'],
            'passport_photocopy' => $row['passport_photocopy'],
            'kuwait_phone' => $row['kuwait_phone'],
            'bd_phone' => $row['bd_phone'],
            'special_skill' => $row['special_skill'],
            'residence' => $row['residence'],
            'delivery_date' => $row['delivery_date'],
            'profession_id' => $row['profession_id'],
            'salary' => $row['salary'],
            'date' => $row['date'],
            'dob' => $row['dob'],
            'delivery_branch' => $row['delivery_branch'],
            'gd_report_kuwait' => $row['gd_report_kuwait'],
            'application_form' => $row['application_form'],
            'shift_to_admin' => $row['shift_to_admin'],
            'embassy_status' => $row['embassy_status'],
            'branch_status' => $row['branch_status'],
            'is_delivered' => $row['is_delivered'],


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
            'delivery_method' => $row['delivery_method'],
            'model_name' => $row['model_name'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.passport_number' => ['required', 'unique:lost_passports'],
            '*.ems' => ['unique:lost_passports'],
            '*.shift_to_admin' => ['required'],
            'embassy_status'  => ['required'],
            'branch_status' => ['required'],
            'is_delivered' => ['required'],


        ];
    }

    // public function onFailure(Failure ...$failures)
    // {
    // }
}
