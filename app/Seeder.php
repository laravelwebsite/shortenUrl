<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Seeder extends Eloquent
{
    protected $connection="mongodb";
    protected $collection="seeders";
    protected $primaryKey = "id";
}
