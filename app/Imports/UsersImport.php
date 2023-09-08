<?php

namespace App\Imports;

use App\Models\User;
use App\Models\File_data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    { 
       
        $user = new File_data([
            "Dest" => $row['dest'],
            "SN" => $row['sn'],
            "KIOSK_NAME" => $row['kiosk_name'],
            "OWNER_NAME" => $row['owner_name'],
            "KIOSK_ADDRESS" => $row['kiosk_address'],
            "MOBILE_NO" => $row['mobile_no'],
            "EMAIL_ID" => $row['email_id']
        ]); 

        // Delete Any Existing Role
      //  DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            
        // Assign Role To User
        //$user->assignRole($user->role_id);

        return $user; 
    }
}
