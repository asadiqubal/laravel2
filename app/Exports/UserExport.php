<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;


class UserExport implements FromCollection,WithHeadings
{
	
    public function collection()
    {
		$type = DB::table('users')
        ->where('users.role_id', '2')
        ->where('users.is_deleted', 0)
        ->join('companies', 'users.company_name', '=', 'companies.id')
       
        ->select('users.id','users.name','users.email','users.phone','companies.name AS company_name','users.created_at')
        ->get();
		
        return $type ;
    }
     public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Company Name',
            'Created Date',
        ];
    }
	
  

}
