<?php

namespace App\Repositories\OrderDetail;

use App\Models\Order_detail;
use App\Repositories\BaseRepository;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{

    public function getModel()
    {
        return Order_detail::class;
    }
}
