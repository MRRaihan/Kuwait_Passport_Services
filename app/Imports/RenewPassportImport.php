<?php

namespace App\Imports;

use App\Models\RenewPassport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RenewPassportImport implements
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
        return new RenewPassport([
            'user_creator_id' => $row['user_creator_id'],
            'deleted_by' => $row['deleted_by'],
            'branch_id' => $row['branch_id'],
            'delivery_branch' => $row['delivery_branch'],
            'passport_type_id' => $row['passport_type_id'],
            'profession_id' => $row['profession_id'],
            'name' => $row['name'],
            'civil_id' => $row['civil_id'],

            'passport_number' => $row['passport_number'],
            'passport_photocopy' => $row['passport_photocopy'],
            'application_form' => $row['application_form'],
            'profession_file' => $row['profession_file'],
            'mailing_address' => $row['mailing_address'],
            'kuwait_phone' => $row['kuwait_phone'],
            'permanent_address' => $row['permanent_address'],
            'expiry_date' => $row['expiry_date'],
            'extended_to' => $row['extended_to'],
            'bd_phone' => $row['bd_phone'],
            'special_skill' => $row['special_skill'],
            'residence' => $row['residence'],
            'delivery_date' => $row['delivery_date'],
            'salary' => $row['salary'],
            'ems' => $row['ems'],
            'dob' => $row['dob'],
            'shift_to_admin' => $row['shift_to_admin'],
            'embassy_status' => $row['embassy_status'],
            'branch_status' => $row['branch_status'],
            'is_delivered' => $row['is_delivered'],
            'is_shifted' => $row['is_shifted'],
            'is_received' => $row['is_received'],
            'is_manual' => $row['is_manual'],
            'is_shifted_to_branch_manager' => $row['is_shifted_to_branch_manager'],
            'r_id' => $row['r_id'],
            'entry_person' => $row['entry_person'],
            'passport_type_title' => $row['passport_type_title'],
            'passport_type_government_fee' => $row['passport_type_government_fee'],
            'passport_type_versatilo_fee' => $row['passport_type_versatilo_fee'],
            'passport_type_fees_total' => $row['passport_type_fees_total'],
            'remarks' => $row['remarks'],
            'bio_enrollment_id' => $row['bio_enrollment_id'],
            'status' => $row['status'],
            'remarks_by' => $row['remarks_by'],
            'model_name' => $row['model_name'],
            'delivery_method' => $row['delivery_method']
        ]);
    }
    public function rules(): array
    {
        return [
            '*.passport_number' => ['required'],
            '*.ems' => ['unique:renew_passports'],
            '*.shift_to_admin' => ['required'],
            'embassy_status'  => ['required'],
            'branch_status' => ['required'],
            'is_delivered' => ['required'],
            'is_shifted' => ['required'],
            // 'is_received' => ['required']
        ];
    }
}
