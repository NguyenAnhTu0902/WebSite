<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class UserHelper {

    /**
     * Return the path to public dir
     * @param null $path
     * @return string
     */
    public function public_path($path = null) // Hàm có thể dùng để gọi trong controller hoặc các nơi khác trừ view
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }

    /**
     * Get users info currently login
     * @param $field
     * @return string
     */
    static function user_login($field) // Hàm có thể dùng để gọi trong view
    {
        return Auth::user($field);
    }

}
