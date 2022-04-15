<?php

namespace App\Exports;

use App\Models\History;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportXlsx implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, WithDrawings, WithCustomStartCell, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    use Exportable;

    public function startCell(): string
    {
        return 'A5';
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('SPaCS');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/spacs2.png'));
        $drawing->setHeight(100);
        $drawing->setOffsetX(35);
        // $drawing->setCoordinates('B3');

        return $drawing;
    }

    public function headings(): array{
        return [
            // 'History ID',
            'Guards Name',
            'Checkpoint Name',
            'Checkpoint Desc.',
            'Checkpoint Date',
            'Checkpoint Time',
        ];
    }

    // public function columnWidths(): array
    // {
    //     return [
    //         // 'A' => 10,
    //         'A' => 50,
    //         'B' => 30,
    //         'C' => 30,
    //         'D' => 16,
    //         'E' => 16,
    //     ];
    // }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true)->setSize(24);
        $sheet->getStyle('1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('5')->getFont()->setBold(true);
        // $sheet->getStyle('A5:E5')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        // $sheet->getStyle('A2:E1000')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        // $sheet->getStyle('A2:E1000')->getFont()->setSize(16);
        $sheet->mergeCells('A1:H4');
        $sheet->getCell('A1')->setValue('                       Security Patrol Clocking System (SPACS) Report');
        $sheet->getRowDimension('1')->setRowHeight(30);
        $sheet->getRowDimension('5')->setRowHeight(20);
        $sheet->setShowGridlines(false);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $to = $event->sheet->getDelegate()->getHighestRowAndColumn();
                $event->sheet->getStyle('A6:'.$to['column'].$to['row'])
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->getStyle('A5:E5')
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
                $event->sheet->getStyle('G6');
            },
        ];
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

    public function range(String $start, String $end){
        $this->start = $start;
        $this->end = $end;
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
            ->select('users.name','checkpoints.cp_name','checkpoints.cp_desc',
                DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
            ->where('histories.user_id', '=', $this->pic)
            ->where('histories.cp_id', '=', $this->cp)
            ->whereBetween('histories.created_at', [$this->start, $this->end])
            ->orderBy('histories.id')
            ->get();
        }elseif($this->pic != "" AND $this->cp == ""){
            return DB::table('histories')
            ->leftJoin('users','histories.user_id','=','users.id')
            ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
            ->select('users.name','checkpoints.cp_name','checkpoints.cp_desc',
                DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
            ->where('histories.user_id', '=', $this->pic)
            ->whereBetween('histories.created_at', [$this->start, $this->end])
            ->orderBy('histories.id')
            ->get();
        }elseif($this->pic == "" AND $this->cp != ""){
            return DB::table('histories')
            ->leftJoin('users','histories.user_id','=','users.id')
            ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
            ->select('users.name','checkpoints.cp_name','checkpoints.cp_desc',
                DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
            ->where('histories.cp_id', '=', $this->cp)
            ->whereBetween('histories.created_at', [$this->start, $this->end])
            ->orderBy('histories.id')
            ->get();
        }else{
            return DB::table('histories')
            ->leftJoin('users','histories.user_id','=','users.id')
            ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
            ->select('users.name','checkpoints.cp_name','checkpoints.cp_desc',
                DB::raw('date_format(histories.created_at, "%e/%m/%Y") AS datee'),DB::raw('time_format(histories.created_at, "%h:%i:%s %p") AS timee'))
            ->whereBetween('histories.created_at', [$this->start, $this->end])
            ->orderBy('histories.id')
            ->get();
        }
    }
}
