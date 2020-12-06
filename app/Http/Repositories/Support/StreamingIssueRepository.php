<?php

namespace App\Http\Repositories\Support;

use App\Models\StreamingIssueReport;

class StreamingIssueRepository
{
    public function getFormData(StreamingIssueReport $report)
    {
        return [
            'report'    => $report,
        ];
    }

    public function findAll()
    {
        return StreamingIssueReport::latest('id')->get();
    }

    public function find($id)
    {
        return StreamingIssueReport::find($id);
    }

    public function firstForApp($id)
    {
        return StreamingIssueReport::where('id', $id)->first();
    }

    public function getGroupByRadio()
    {
        $report = StreamingIssueReport::all()->groupBy('radio_list_id');

        $result = $report->map(function($item) {
            return [
                'id' => $item[0]->id,
                'name' => $item[0]->radio ? $item[0]->radio->name : "",
                'count' => $item->count(),
            ];
        });

        return $result;
    }
}