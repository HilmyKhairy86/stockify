<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\StockTransaction\StockTransactionService;

class GrafikStock extends Component
{
    protected $stockTransactionService;
    public function boot(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }
    public $filterstock = 'week';
    public function render()
    {
        $chartdata = [];
        // $chrtdate = [];
        $data = $this->stockTransactionService->FilterStock($this->filterstock);
        // dd($data);
        // $data = $this->stockTransactionService->FilterStock($this->filterstock);
        foreach ($data as $d) {
                $productName = $d->pname;
                $quantity = $d->total;
                $date = $d->date;
            
                // Group by product name
                if (!isset($chartdata[$productName])) {
                    $chartdata[$productName] = [
                        'name' => $productName,
                        'data' => [],
                    ];
                }

                $chartdata[$productName]['data'][] = [
                    'x' => $date, // Date for the x-axis
                    'y' => $quantity, // Quantity for the y-axis
                ];
                
                
            }
            $chartdata = array_values($chartdata);
            // dd($chrtdate);
            // dd($chartdata);
            // dd($this->filterstock);
            
            return view('livewire.grafik-stock',[
                'chart' => $chartdata,
                'prod' => $data,
                // 'date' => $chrtdate,
            ]);
    }
}
