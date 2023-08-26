<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Fromview;
use Illuminate\Contracts\View\View;
use App\Models\Lead;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Lead::get();

        foreach($data as $k => $lead)
        {
            unset($lead->password, $lead->email, $lead->created_by, $lead->email, $lead->is_converted, $lead->is_active, $lead->products
        ,$lead->user_id,$lead->pipeline_id,$lead->stage_id,$lead->sources,
        $lead->labels,$lead->order,$lead->notes,$lead->id,$lead->created_at,$lead->updated_at);
         
        }

        return $data;
    }
    // public function __construct($leads){
    //     $this->leads = $leads;
    // }
    // public function view(): View
    // {
    //     return view('leads.print',[
    //         'leads'=>$this->products
    //     ]);
    // }

    public function headings(): array
    {
        return [
            "Date",
           
            "Name",
          
            "Phone",
            "Subject",
            "houseno",
            "streetno",
            "sector",
            "Area",
            "HouseSize",
            "Whoishe",
            
          
        ];
    }
}
