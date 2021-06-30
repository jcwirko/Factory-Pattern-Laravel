<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function getByIds(array $productsIds)
    {
        return $this->model->whereIn('id', $productsIds)->get();
    }
}
