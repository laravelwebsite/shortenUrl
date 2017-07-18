<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Messager extends Eloquent
{
    protected $connection="mongodb";
    protected $collection="messagers";
    protected $primaryKey = "id";
}
