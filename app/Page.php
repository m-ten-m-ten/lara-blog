<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    // モデルのルートキーの取得
    public function getRouteKeyName()
    {
        return 'page_name';
    }
}
