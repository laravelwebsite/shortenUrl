<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Count extends Eloquent
{
    protected $connection="mongodb";
    protected $collection="counts";
    protected $primaryKey = "id";

   	
}
