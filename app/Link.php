<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Link extends Eloquent
{
    protected $connection="mongodb";
    protected $collection="links";
    protected $primaryKey = "id";
}
