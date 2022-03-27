<?php

namespace App\Exports;

use App\Models\History;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistoryExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithColumnFormatting
// , FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */

use Exportable;

    public function headings(): array{
        return [
            'History ID',
            'Guards Name',
            'Checkpoint Name',
            'Checkpoint Desc.',
            'Checkpoint Date',
            'Checkpoint Time',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 50,
            'C' => 30,
            'D' => 30,
            'E' => 16,
            'F' => 16,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
    }

    public function columnFormats(): array
    {
        return [
            // 'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'F' => NumberFormat::FORMAT_DATE_TIME2,
        ];
    }

    public function pic(String $pic){
        $this->pic = $pic;
        return $this;
    }

    public function cp(String $cp){
        $this->cp = $cp;
        return $this;
    }

    public function range(String $range){
        if ($range == "week"){
            $this->range = "wk";
        }
        if ($range == "biweek"){
            $this->range = "wk";
        }
        if ($range == "month"){
            $this->range = "wk";
        }
        if ($range == "quart"){
            $this->range = "wk";
        }

        $this->range = $range;
        return $this;
    }

    // public function collection()
    // {
    //     return DB::table('histories')
    //     ->leftJoin('users','histories.user_id','=','users.id')
    //     ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
    //     ->select('histories.id','users.name','checkpoints.cp_name','checkpoints.cp_desc',
    //         DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
    //     ->orderBy('histories.id')
    //     ->get();
    // }

    public function collection()
    {
        // return DB::table('histories')
        //     ->leftJoin('users','histories.user_id','=','users.id')
        //     ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
        //     ->select('histories.id','users.name','checkpoints.cp_name','checkpoints.cp_desc',
        //         DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
        //     ->where('histories.user_id', '=', $this->pic, 'AND', 'histories.cp_id', '=', $this->cp)
        //     // ->where('histories.cp_id', '=', $this->cp)
        //     ->orderBy('histories.id')
        //     ->get();

        if($this->pic != "" AND $this->cp != ""){
            return DB::table('histories')
            ->leftJoin('users','histories.user_id','=','users.id')
            ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
            ->select('histories.id','users.name','checkpoints.cp_name','checkpoints.cp_desc',
                DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
            ->where('histories.user_id', '=', $this->pic)
            ->where('histories.cp_id', '=', $this->cp)
            ->orderBy('histories.id')
            ->get();
        }elseif($this->pic != "" AND $this->cp == ""){
            return DB::table('histories')
            ->leftJoin('users','histories.user_id','=','users.id')
            ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
            ->select('histories.id','users.name','checkpoints.cp_name','checkpoints.cp_desc',
                DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
            ->where('histories.user_id', '=', $this->pic)
            ->orderBy('histories.id')
            ->get();
        }elseif($this->pic == "" AND $this->cp != ""){
            return DB::table('histories')
            ->leftJoin('users','histories.user_id','=','users.id')
            ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
            ->select('histories.id','users.name','checkpoints.cp_name','checkpoints.cp_desc',
                DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
            ->where('histories.cp_id', '=', $this->cp)
            ->orderBy('histories.id')
            ->get();
        }else{
            return DB::table('histories')
            ->leftJoin('users','histories.user_id','=','users.id')
            ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
            ->select('histories.id','users.name','checkpoints.cp_name','checkpoints.cp_desc',
                DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
            ->orderBy('histories.id')
            ->get();
        }
    }
}
