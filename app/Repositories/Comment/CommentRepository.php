<?php

namespace App\Repositories\Comment;

use App\Models\Product_comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    public function getModel()
    {
        return Product_comment::class;
    }
}
