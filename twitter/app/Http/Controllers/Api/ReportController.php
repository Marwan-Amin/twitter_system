<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(ApiResponse $apiResponse, ReportService $service)
    {
        $this->service = $service;
        $this->apiResponse = $apiResponse;
    }

    public function generateReport()
    {
        $report = $this->service->generateReport();
        return $this->apiResponse->setSuccess(__('report.generated_success'))->setData($report)->returnJson();
    }
}
