<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StreamingIssueReport;
use Auth;
use App\Http\Repositories\Support\StreamingIssueRepository;
use App\Http\Services\Support\StreamingIssueService;

class StreamingReportController extends Controller
{
    protected $streamingIssueRepository;

    protected $streamingIssueService;

    public function __construct(
        StreamingIssueRepository $streamingIssueRepository, 
        StreamingIssueService $streamingIssueService
    )
    {
        $this->streamingIssueRepository = $streamingIssueRepository;

        $this->streamingIssueService = $streamingIssueService;

    }

    public function store(Request $request)
    {
        $storeData = $request->only('radio_list_id', 'message');

        $complain = $this->streamingIssueService->create($storeData);

        return response()->json(['message' => 'Thank you for reporting.'], 200);
    }

    
}