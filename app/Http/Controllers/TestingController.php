<?php

namespace App\Http\Controllers;

use App\Reports\TransactionReport;

class TestingController extends Controller
{
    public function index()
    {
        $report = new TransactionReport;
        $report->run();
        return view("testing",["report"=>$report]);
    }

}

