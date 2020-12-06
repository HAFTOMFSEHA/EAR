<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StreamingIssueReport;
use Illuminate\Http\Request;
use App\Http\Repositories\Support\StreamingIssueRepository;
use Laracasts\Flash\Flash;
use App\Http\Traits\ResponseTrait;

class ReportController extends Controller
{
    use ResponseTrait;

    protected $streamingIssueRepository;

    public function __construct(StreamingIssueRepository $streamingIssueRepository)
    {
        $this->streamingIssueRepository = $streamingIssueRepository;

    }

    public function index()
    {   
        $report = $this->streamingIssueRepository->getGroupByRadio();

        return view('admin.report.index', compact('report')); 
    }

    public function destroy($id) 
    {
        $radio = StreamingIssueReport::find($id);
        
        if(StreamingIssueReport::where('radio_list_id', $radio->radio_list_id)->delete()) {

            Flash::success($this->deleted());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->back();
        
    }

}
