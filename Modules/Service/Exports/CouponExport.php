<?php

namespace Modules\Service\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Events\AfterSheet;

class CouponExport implements FromView, ShouldAutoSize, WithStyles, WithColumnWidths, WithHeadings, WithEvents
{
    use Exportable;

    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('service::file-exports.coupon-export', [
            'data' => $this->data,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            // 'A' => 55,
            // 'B' => 45,
            // 'C' => 45,
        ];
    }

    public function styles(Worksheet $sheet) {
        $sheet->getStyle('A2:I3')->getFont()->setBold(true);
        $sheet->getStyle('A3:I3')->getFont()->setBold(true)->getColor()
            ->setARGB('FFFFFF');

        $sheet->getStyle('A3:I3')->getFill()->applyFromArray([
            'fillType' => 'solid',
            'rotation' => 0,
            'color' => ['rgb' => '005D5F'],
        ]);

//        $sheet->getStyle('H4:I'.$this->data['coupons']->count() + 3)->getFill()->applyFromArray([
//            'fillType' => 'solid',
//            'rotation' => 0,
//            'color' => ['rgb' => 'FFE599'],
//        ]);

        $sheet->setShowGridlines(false);

        return [
            'A1:I' . ($this->data['coupons']->count() + 3) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:I1')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $event->sheet->getStyle('A2:C2')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $event->sheet->getStyle('A3:I' . ($this->data['coupons']->count() + 3))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $event->sheet->getStyle('D2:I2')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $event->sheet->mergeCells('A1:I1');
                $event->sheet->mergeCells('B2:H2');
                $event->sheet->getRowDimension(2)->setRowHeight(100);
                $event->sheet->getDefaultRowDimension()->setRowHeight(30);
                $workSheet = $event->sheet->getDelegate();
            },
        ];
    }

    public function headings(): array
    {
        return [
            '1'
        ];
    }
}
