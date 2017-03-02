<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Model\File;
use App\Model\FileRelation;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Parsedown;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;


class ScheduleController extends Controller
{
    public function schedule(){
        echo 'sdsd';
    }
}

