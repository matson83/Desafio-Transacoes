<?php

use App\Models\Transaction;

class TransactionRepository
{

    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

}
