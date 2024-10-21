<?php

namespace App\Services;

use Illuminate\Http\Request;

class CompanyAAdapter implements AdapterInterface
{
    public function parse(Request $request)
    {
        if ($this->isXml($request)) {
            $xmlData = simplexml_load_string($request->getContent());
            $data = json_decode(json_encode($xmlData), true);
        } else {
            throw new \Exception("Data format should be XML");
        }

        return $this->mapToStandardStructure($data);
    }

    private function isXml($request)
    {
        return $request->header('Content-Type') === 'application/xml' || 
               $request->header('Content-Type') === 'text/xml';
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
