<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;


class CompanyExport implements FromCollection,WithHeadings
{
	
    public function collection()
    {
		$type = DB::table('companies')
        ->where('companies.is_deleted', 0)
        ->join('payment_terms', 'companies.payment_term', '=', 'payment_terms.id')
        ->join('industries', 'companies.industry', '=', 'industries.id')
        ->join('rfq_ranges', 'companies.rfq_range', '=', 'rfq_ranges.id')
       
        ->select('companies.id','companies.name','companies.contact_name','companies.no_of_users','payment_terms.name AS payment_term','industries.name AS industry',DB::raw("CONCAT(rfq_ranges.sequence_letter,'',rfq_ranges.start_from,' - ',rfq_ranges.sequence_letter,'',rfq_ranges.end_to) AS rfq_range") , 'companies.created_at')
        ->get();
		
        return $type ;
    }
     public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Contact Name',
            'No of Users',
            'Payment Terms',
            'Industry',
            'RFQ Range',
            'Created Date',
        ];
    }
	
  

}
