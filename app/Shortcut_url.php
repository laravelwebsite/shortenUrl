<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\User;
use App\Category;
class Shortcut_url extends Eloquent
{
    protected $connection="mongodb";
    protected $collection="shortcut_urls";
    protected $primaryKey = "id";

    public function user()
    {
    	return $this->belongsTo(User::class,'email_user','email','id');
    }
    public function category()
    {
    	return $this->belongsTo(Category::class,'category_id','id');
    }
}
