<?php

namespace App\Imports;

use App\Models\Other;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OtherImport implements
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
        return new Other([
            'creator_id' => $row['creator_id'],
            'branch_id' => $row['branch_id'],
            'deleted_by' => $row['deleted_by'],
            'profession_id' => $row['profession_id'],
            'name' => $row['name'],
            'passport_number' => $row['passport_number'],
            'passport_type_id' => $row['passport_type_id'],
            'emirates_id' => $row['emirates_id'],
            'passport_photocopy' => $row['passport_photocopy'],
            'profession_file' => $row['profession_file'],
            'mailing_address' => $row['mailing_address'],
            'uae_phone' => $row['uae_phone'],
            'permanent_address' => $row['permanent_address'],
            'bd_phone' => $row['bd_phone'],
            'special_skill' => $row['special_skill'],
            'residence' => $row['residence'],
            'salary' => $row['salary'],
            'fee' => $row['fee'],
            'remarks' => $row['remarks'],
            'ems' => $row['ems'],
            'delivery_date' => $row['delivery_date'],
            'delivery_branch' => $row['delivery_branch'],
            'dob' => $row['dob'],
            'entry_person' => $row['entry_person'],
            'status' => $row['status']
        ]);
    }
    public function rules(): array
    {
        return [
            '*.passport_number' => ['required', 'unique:others'],
            '*.ems' => ['unique:others'],

        ];
    }
}
