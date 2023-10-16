<?php

namespace App\Imports;

use App\Models\User;
use App\Models\File_data;
use App\Models\Import_data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   


    public function model(array $row)
    { 

        $request = request()->all();
       
       
        $user = new Import_data([

            "name" => $row['name'],
            "phone" => $row['phone'],
            'agent_id'=> $request['user_id'],
            'update_date'=>  $request['currentDate']
           
        ]); 

       

        return $user; 
    }
}
