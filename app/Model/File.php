<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';
    protected $primaryKey = 'fileId';
    public $timestamps = false;
    //protected $fillable = ['picKey','addTime'];


}
