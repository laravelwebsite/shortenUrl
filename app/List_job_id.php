<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class List_job_id extends Eloquent
{
    protected $connection="mongodb";
    protected $collection="list_job_ids";
    protected $primaryKey = "id";
}
