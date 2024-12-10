<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Services\UserActivity\UserActivityService;

class UserActivityController extends Controller
{
    protected $userActivityService;
    public function __construct(UserActivityService $userActivityService)
    {
        $this->userActivityService = $userActivityService;
    }

    public function generatePDF()
    {
        $data = $this->userActivityService->viewActivity()->get();

        $pdf = SnappyPdf::loadView("Export.useractivitypdf", ["data" => $data])
        ->setPaper('a4')
        ->setOption('margin-top', 20)
        ->setOption('margin-bottom', 20)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10);
        
        $date = now();
        $act = [
            "user_id" => Auth::user()?->id,
            "kegiatan" => "mengeksport laporan user activity",
            "tanggal" => now(),
        ];
        $this->userActivityService->createActivity($act);
        return $pdf->download("laporan user activity " . $date);
    }
}
