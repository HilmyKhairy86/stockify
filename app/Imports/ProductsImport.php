<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Define how each row from the CSV will be imported to the Product model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'category_id' => $row['category_id'], // Match CSV columns to model attributes
            'supplier_id' => $row['supplier_id'],
            'name' => $row['name'],
            'sku' => $row['sku'],
            'description' => $row['description'] ?? null, // Handle nullable description
            'purchase_price' => $row['purchase_price'],
            'selling_price' => $row['selling_price'],
            'image' => $row['image'] ?? null, // Handle nullable image
        ]);
    }

    /**
     * Define validation rules for each row of the CSV.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'sku' => 'required|unique:products,sku', // Ensure SKU is unique in the products table
            'name' => 'required',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ];
    }
}
