<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use PDF;

class ReportService
{
    public function collectReportData()
    {
        $reportData = [];
        User::chunk(200, function ($users) use (&$reportData) {

            foreach ($users as $user) {
                $countTweets = count($user->tweets);
                $averageTweets = $user->averageTweets($countTweets);
                $reportData[] = [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'countTweets' => $countTweets,
                    'averageTweets' => $averageTweets
                ];
            }
        });

        return $reportData;
    }

    public function generateReportPDF()
    {
        $reportData = $this->collectReportData();
        $pdf = PDF::loadView('report', ['users' => $reportData]);
        $content = $pdf->download()->getOriginalContent();
        Storage::put('reports/user_actions_report.pdf', $content);
        return [
            'download_link' => URL::to('/download/reports/user_actions_report.pdf')
        ];
    }
}
