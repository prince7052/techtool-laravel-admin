<?php

namespace App\Exports;

use App\Models\File_data;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return File_data::all();
    }
}
