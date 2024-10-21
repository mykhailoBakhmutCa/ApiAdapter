<?php

namespace App\Services;

class CompanyAdapterFactory
{
    const COMPANY_A = 'CompanyA';

    const COMPANY_B = 'CompanyB';

    public static function make($company)
    {
        switch ($company) {
            case self::COMPANY_A:
                return new CompanyAAdapter();
            case self::COMPANY_B:
                return new CompanyBAdapter();
            default:
                throw new \Exception("Unknown company: $company");
        }
    }
}
