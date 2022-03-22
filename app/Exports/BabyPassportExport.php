<?php

namespace App\Exports;

use App\Models\NewBornBabyPassport;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BabyPassportExport implements
    FromCollection,
    Responsable,
    WithHeadings,
    ShouldAutoSize
{
    use Exportable;

    private $fileName = "baby-passport.xlsx";
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return NewBornBabyPassport::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'user_creator_id',
            'branch_id',
            'deleted_by',
            'name',
            'passport_number',
            'civil_id',

            'mailing_address',
            'permanent_address',
            'ems',
            'passport_photocopy',
            'application_form',
            'kuwait_phone',
            'bd_phone',
            'special_skill',
            'residence',
            'delivery_date',
            'profession_id',
            'salary',
            'date',
            'delivery_branch',
            'shift_to_admin',
            'embassy_status',
            'branch_status',
            'is_delivered',

            'is_shifted_to_branch_manager',
            'passport_type_id',
            'passport_type_title',
            'passport_type_government_fee',
            'passport_type_versatilo_fee',
            'passport_type_fees_total',
            'r_id',
            'entry_person',
            'otp',
            'otp_verify_at',
            'status',
            'bio_enrollment_id',
            'dob',
            'dob_id',
            'dob_file',
            'remarks',
            'remarks_by',
            'model_name',
            'delivery_method'
        ];
    }
}
