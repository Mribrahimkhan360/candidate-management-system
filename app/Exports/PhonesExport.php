<?php

namespace App\Exports;

use App\Models\Interview;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PhonesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Interview::with('candidate')
            ->where('status', 'upcoming')
            ->orderBy('scheduled_date')
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Candidate Name',
            'Phone Number',
            'Email',
            'Interview Type',
            'Scheduled Date',
        ];
    }

    /**
     * @param mixed $interview
     * @return array
     */
    public function map($interview): array
    {
        return [
            $interview->candidate->name,
            $interview->candidate->phone,
            $interview->candidate->email,
            ucfirst($interview->interview_type),
            $interview->scheduled_date->format('Y-m-d H:i'),
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}