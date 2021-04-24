<?php

namespace App\Services;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function generateReport()
    {
        $report = [];
        Tweet::chunk(200, function ($tweets) {
            foreach ($tweets as $tweet) {
                $report[] = [
                    'tweet' => $tweet->id
                ];
            }
        });

        return $report;
    }
}
