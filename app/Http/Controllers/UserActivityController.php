<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
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

        // $pdf = SnappyPdf::loadView("Export.useractivitypdf", ["data" => $data]);
        $pdf = Pdf::loadView("Export.useractivitypdf", ["data" => $data]);
        $act = [
            "user_id" => Auth::user()?->id,
            "kegiatan" => "mengeksport laporan user activity",
            "tanggal" => now(),
        ];
        $this->userActivityService->createActivity($act);

        $response = $pdf->download("laporan_user activity_" . now());
        return $response;
    }
}
