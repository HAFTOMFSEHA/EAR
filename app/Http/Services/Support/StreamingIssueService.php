<?php

namespace App\Http\Services\Support;

use App\Models\StreamingIssueReport;

class StreamingIssueService
{
    public function create($data)
    {
        return StreamingIssueReport::create($data);
    }

    public function update($report, $data)
    {
        return $report->update($data);
    }

    public function delete($report)
    {
        return $report->delete();
    }
}