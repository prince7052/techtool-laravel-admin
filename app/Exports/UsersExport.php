<?php

namespace App\Exports;

use App\Models\File_data;
use App\Models\Import_data;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Import_data::where('agent_id', $this->id)->select('name', 'phone', 'remark_option', 'recorded_call', 'follow_up')->get();
       
    }
}
