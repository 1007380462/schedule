<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FileRelation extends Model
{
    protected $table = 'fileRelation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    //protected $fillable = ['picKey','addTime'];
}
