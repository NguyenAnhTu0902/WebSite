<?php

namespace App\Repositories\Category;

use App\Models\Product_category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return Product_category::class;
    }
}
