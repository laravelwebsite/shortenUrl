<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Dmy_statictis extends Eloquent
{
    protected $connection="mongodb";
    protected $collection="dmy_statictis";
    protected $primaryKey = "id";
}
