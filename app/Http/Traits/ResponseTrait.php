<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

trait ResponseTrait {

    public function success() {
        return "Successfully saved!!";
    }

    public function updated() {
        return "Successfully updated!!";
    }

    public function deleted() {
        return "Successfully deleted!!";
    }

    public function tryAgain() {
        return "Please try again!!";
    }

}
