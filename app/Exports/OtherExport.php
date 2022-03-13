<?php

namespace App\Exports;

use App\Models\Other;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OtherExport implements
    FromCollection,
    Responsable,
    WithHeadings,
    ShouldAutoSize
{
    use Exportable;

    private $fileName = "other-service.xlsx";
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Other::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'creator_id',
            'branch_id',
            'deleted_by',
            'profession_id',
            'name',
            'passport_number',
            'passport_type_id',
            'civil_id',
            'passport_photocopy',
            'profession_file',
            'mailing_address',
            'kuwait_phone',
            'permanent_address',
            'bd_phone',
            'special_skill',
            'residence',
            'salary',
            'fee',
            'remarks',
            'ems',
            'delivery_date',
            'delivery_branch',
            'dob',
            'entry_person',
            'status'

        ];
    }
}
