<?php
namespace App\Reports;

use App\Models\Product;
use KoolReport\DataSource;
use koolreport\KoolReport;

class TransactionReport extends KoolReport
{
    use \koolreport\laravel\Friendship;
    

    function settings()
    {
        return array(
            "dataSources"=>array(
                "stockify"=>array(
                    "class"=>'\koolreport\laravel\Eloquent', // This is important
                )
            )
        );
    }
    function setup()
    {
        //Now you can use Eloquent inside query() like you normally do
        $this->src("stockify")->query(
            Product::where('id','1')
                ->orderBy('name', 'desc')
                ->take(10)
        )
        ->pipe($this->dataStore("products"));
    }

}