<?php

namespace App\Exports;

use App\Models\RenewPassport;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RenewPassportExport implements
    FromCollection,
    Responsable,
    WithHeadings,
    ShouldAutoSize
{
    use Exportable;

    private $fileName = "renew-passport.xlsx";
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return RenewPassport::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'user_creator_id',
            'deleted_by',
            'branch_id',
            'delivery_branch',
            'passport_type_id',
            'profession_id',
            'name',
            'civil_id',

            'passport_number',
            'passport_photocopy',
            'application_form',
            'profession_file',
            'mailing_address',
            'kuwait_phone',
            'permanent_address',
            'expiry_date',
            'extended_to',
            'bd_phone',
            'special_skill',
            'residence',
            'delivery_date',
            'salary',
            'ems',
            'dob',
            'shift_to_admin',
            'embassy_status',
            'branch_status',
            'is_delivered',

            'is_manual',
            'is_shifted_to_branch_manager',
            'r_id',
            'entry_person',
            'passport_type_title',
            'passport_type_government_fee',
            'passport_type_versatilo_fee',
            'passport_type_fees_total',
            'remarks',
            'bio_enrollment_id',
            'status',
            'remarks_by',
            'model_name',
            'delivery_method'
        ];
    }
}
