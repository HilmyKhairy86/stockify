<?php

namespace App\Rules;

class TransactionExists implements Rule
{
    public function passes($attribute, $value)
    {
        // You will need to inject additional data to check against
        $data = request()->only(['product_id', 'user_id', 'quantity']);

        // Check if the transaction exists in the database
        return DB::table('stock_transactions')
            ->where('product_id', $data['product_id'])
            ->where('user_id', $data['user_id'])
            ->where('quantity', $data['quantity'])
            ->exists();
    }

    public function message()
    {
        return 'The specified transaction does not exist.';
    }
}
