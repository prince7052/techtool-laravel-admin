<?php

namespace App\Exports;

use App\Models\Import_data;

use Maatwebsite\Excel\Concerns\FromCollection;


class RecordsExport implements FromCollection
{

    protected $id;
    protected $sdt;
    protected $edt;

    public function __construct($id, $sdt, $edt)
    {
        $this->id = $id;
        $this->sdt = $sdt;
        $this->edt = $edt;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->id == 'all') {

            return  Import_data::whereBetween('update_date', [$this->sdt,  $this->edt])->select('name', 'phone', 'remark_option', 'recorded_call', 'follow_up')->get();
        } else {

            return  Import_data::where('agent_id', $this->id)->whereBetween('update_date', [$this->sdt,  $this->edt])->select('name', 'phone', 'remark_option', 'recorded_call', 'follow_up')->get();
        }
    }
}
