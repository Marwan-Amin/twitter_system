<?php

namespace App\Services;

use App\Models\User;

class ReportService
{
    public function generateReport()
    {
        $users = User::withCount(['tweets'])->get();

        $report = [];
        foreach ($users as $user) {
            $report[] = [
                'id' => $user->id,
                'name' => $user->name,
                'tweets_no' => $user->tweets_count
            ];
        }

        return $report;
    }
}
