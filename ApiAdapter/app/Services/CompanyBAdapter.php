<?php

namespace App\Services;

use Illuminate\Http\Request;

class CompanyBAdapter implements AdapterInterface
{
    public function parse(Request $request)
    {
        if ($request->isJson()) {
            $data = $request->json()->all();
        } else {
            throw new \Exception("Data format should be JSON");
        }

        return $this->mapToStandardStructure($data);
    }

    private function mapToStandardStructure($data)
    {
        return [
            'jobTitle'          => $data['JobTitle'] ?? null,
            'firstName'         => $data['FirstName'] ?? null,
            'lastName'          => $data['LastName'] ?? null,
            'primaryPhone'      => $data['PrimaryPhone'] ?? null,
            'secondaryPhone'    => $data['SecondaryPhone'] ?? null,
            'email'             => $data['Email'] ?? null,
        ];
    }
}
