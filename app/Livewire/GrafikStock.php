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
    
    public $day = 'week';

    public function render()
    {
        $chartdata = [];
        $chrtdate = [];
        $data = $this->stockTransactionService->FilterStock($this->day);
            foreach ($data as $d) {
                $productName = $d->product->name;
                $quantity = $d->quantity;
            
                // Group by product name
                if (!isset($chartdata[$productName])) {
                    $chartdata[$productName] = [
                        'name' => $productName,
                        'data' => [],
                    ];
                }
            
                // Add the quantity to the appropriate product series (grouping by product)
                $chartdata[$productName]['data'][] = $quantity;
                
                
            }
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            
            // Iterate through each day of the week
            while ($startOfWeek <= $endOfWeek) {
                // Add the formatted date to the array
                $chrtdate[] = $startOfWeek->format('Y-m-d');
                
                // Move to the next day
                $startOfWeek->addDay();
            }
            // sort($chrtdate); 
            $chartdata = array_values($chartdata);
            $chrtdate = array_values($chrtdate);
            // dd($chrtdate);
            
            // dd($chartdata);
        return view('livewire.grafik-stock',[
            'chart' => $chartdata,
            'prod' => $data,
            'date' => $chrtdate,
        ]);
    }
}
