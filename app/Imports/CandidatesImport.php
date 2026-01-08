<?php

namespace App\Imports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CandidatesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Parse previous experience if exists
        $previousExperience = [];
        if (!empty($row['previous_experience'])) {
            // Expecting format: "Company1:Position1,Company2:Position2"
            $experiences = explode(',', $row['previous_experience']);
            foreach ($experiences as $exp) {
                $parts = explode(':', $exp);
                if (count($parts) == 2) {
                    $previousExperience[trim($parts[0])] = trim($parts[1]);
                }
            }
        }

        return new Candidate([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'experience_years' => $row['experience_years'],
            'previous_experience' => $previousExperience,
            'age' => $row['age'],
            'status' => 'pending',
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|string',
            'experience_years' => 'required|integer',
            'age' => 'required|integer|min:18',
        ];
    }
}