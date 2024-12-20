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
        $data = $this->stockTransactionService->FilterStock($this->filterstock);
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
                'x' => $date,
                'y' => $quantity,
            ];
        }
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        
        $daysOfWeek = [];
        
        $currentDay = $startOfWeek;
        while ($currentDay <= $endOfWeek) {
            $daysOfWeek[] = $currentDay->toDateString(); // Or use toDateTimeString() if you need time as well
            $currentDay->addDay(); // Move to the next day
        }
        
        foreach ($chartdata as $productName => &$productData) {
            $productData['data'] = array_map(function ($day) use ($productData) {
                // Find the quantity for each day, default to 0 if not found
                $dataForDay = collect($productData['data'])->firstWhere('x', $day);
                return [
                    'x' => $day,
                    'y' => $dataForDay ? $dataForDay['y'] : null,
                ];
            }, $daysOfWeek);
        }
        
        $chartdata = array_values($chartdata);
        // dd($chrtdate);
        // dd($chartdata);
        // dd($this->filterstock);
        // dd($daysOfWeek);
        
        return view('livewire.grafik-stock',[
            'chart' => $chartdata,
            'prod' => $data,
            'daysOfWeek' => $daysOfWeek,
        ]);
            
    }
}
