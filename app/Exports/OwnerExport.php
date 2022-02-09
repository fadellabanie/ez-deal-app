<?php

namespace App\Exports;

use App\Models\Owner;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OwnerExport implements FromCollection, WithHeadings, WithStyles, WithMapping
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Owner::all();
    }
    public function headings(): array
    {
        $attributes = [
            'id',  'name', 'description', 'code', 'discount',
            'discount type', 'usage limit', 'usage used', 'expiry date', 'status',
            'created at'
        ];
        return  array_map('ucfirst', $attributes);
    }

    public function map($owner): array
    {
        return [
            $owner->id,
            $owner->name,
          
            $owner->status ? 'Active' : 'Not Active',
            $owner->created_at,
            // Date::dateTimeToExcel($coupon->created_at),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
