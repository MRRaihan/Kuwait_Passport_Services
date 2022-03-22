<?php

namespace App\Exports;

use App\Models\ManualPassport;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ManualPassportExport implements
    FromCollection,
    Responsable,
    WithHeadings,
    ShouldAutoSize
{
    use Exportable;

    private $fileName = "manaul-passport.xlsx";
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ManualPassport::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'user_creator_id',
            'branch_id',
            'delivery_branch',
            'deleted_by',
            'name',
            'passport_number',
            'civil_id',

            'mailing_address',
            'expiry_date',
            'extended_to',
            'kuwait_phone',
            'permanent_address',
            'bd_phone',
            'delivery_date',
            'profession_id',
            'profession_file',
            'application_form',
            'passport_photocopy',
            'salary',
            'ems',
            'date',
            'post_office',
            'dob',
            'shift_to_admin',
            'embassy_status',
            'branch_status',
            'is_delivered',
            'is_shifted',

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
            'remarks',
            'remarks_by',
            'model_name',
            'delivery_method'

        ];
    }
}
