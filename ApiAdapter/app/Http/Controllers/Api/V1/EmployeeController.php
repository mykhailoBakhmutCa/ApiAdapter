<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as ControllerBase;
use App\Services\CompanyAdapterFactory;
use App\Services\SendService;

class EmployeeController extends ControllerBase
{
    public function index()
    {
        return SendService::sendGetToExternalApi();
    }

    public function store(Request $request)
    {
        $company = $request->header('Company');
        $adapter = CompanyAdapterFactory::make($company);

        try {
            $data = $adapter->parse($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $validated = $this->validateData($data);

        if ($validated['status'] == 'error') {
            return response()->json($validated, 400);
        }

        return SendService::sendPostToExternalApi($data);
    }

    public function update(Request $request, int $id)
    {

        $company = $request->header('Company');
        $adapter = CompanyAdapterFactory::make($company);

        try {
            $data = $adapter->parse($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $validated = $this->validateData($data);

        if ($validated['status'] == 'error') {
            return response()->json($validated, 400);
        }

        return SendService::sendPatchToExternalApi($data, $id);
    }



    private function validateData($data)
    {
        if (!isset($data['firstName']) || !isset($data['lastName'])) {
            return [
                'status' => 'error',
                'message' => 'First name and last name are required'
            ];
        }

        return ['status' => 'success'];
    }
}
