<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Model\File;
use App\Model\FileRelation;
use App\Model\Schedule;
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
        return view('schedule.index');
    }

    /**
     * add a strip of schedule
     * @param Request $request
     */
    public function addSchedule(Request $request){
        $startTime=$request['startTime'];
        $endTime=$request['endTime'];
        $backgroundColor=$request['backgroundColor'];
        $borderColor=$request['borderColor'];
        $content=$request['content'];
        $arr=['backgroundColor'=>$backgroundColor,'borderColor'=>$borderColor];
        $arrJSoned=json_encode($arr);

        $scheduleMode=new Schedule();
        $scheduleMode->startTime=$startTime;
        $scheduleMode->endTime=$endTime;
        $scheduleMode->content=$content;
        $scheduleMode->ext=$arrJSoned;

        if($scheduleMode->save()){
            echo 'true';
        }

        echo 'false';
    }

    /**
     * remove a strip of schedule
     * @param Request $request
     */
    public function removeSchedule(Request $request){
        $id=$request['id'];
        if(Schedule::where('id',$id)->delete()){
         echo 'true';
        }
        echo 'false';
    }

    /**
     * edit a strip of schedule
     * @param Request $request
     */
    public function editSchedule(Request $request){
        $startTime=$request['startTime'];
        $endTime=$request['endTime'];
        $backgroundColor=$request['backgroundColor'];
        $borderColor=$request['borderColor'];
        $content=$request['content'];
        $arr=['backgroundColor'=>$backgroundColor,'borderColor'=>$borderColor];
        $arrJSoned=json_encode($arr);
        $id=$request['id'];
        $scheduleMode=Schedule::find($id);
        $scheduleMode->startTime=$startTime;
        $scheduleMode->endTime=$endTime;
        $scheduleMode->content=$content;
        $scheduleMode->ext=$arrJSoned;

        if($scheduleMode->save()){
            echo 'true';
        }

        echo 'false';
    }

    /**according to the condition to get many schedule;
     * @param $condition
     */
    public function getManySchedule($condition){

    }

    /**
     * display schedule to user
     * @param Request $request
     */
    public function showSchedule(Request $request){
        $condition = array();
        $data = $this->getManySchedule($condition);
        $style='';
        //provide many kind of dispaly style.
        $tempalte='';
        return view($tempalte, ['data' => $data]);
    }



    /**
     * use quote to solve cycle output value problem
     */
    public function ddd(){
        //['value',children=[]];
        $i=0;
        $arr=array();
        while($i<100){
            if($i==0){
                $arr[$i]=['id'=>$i,'children'=>array()];$i++;continue;
            }else{
                $arr[$i]=['id'=>$i,'children'=>array()];
                $arr[$i-1]['children']=&$arr[$i];
            }
            if($i==99){
                $arr[$i]['children']=&$arr[0];
            }
            $i++;
        }

        $current=$arr[0];
        $b=6;
        for ($i=1;$i<=$b;$i++){
            if($current['id']==$current['children']['id']){
                break;
            }
           if($i==$b){
               $i=1;
               echo $current['children']['id'];
               $current['children']=$current['children']['children'];
               continue;
           }
           $current=$current['children'];
        }

    }

    /**
     * traversal folder
     * @param $path
     */
    public function traversalFolder($path)
    {
        /*print all file name and folder name*/
        if (is_dir($path)) {
            $dirObj = dir($path);
            while (false !== ($entry = $dirObj->read())) {
                if ($entry == '.' || $entry == '..') continue;
                $entry = $path . '/' . $entry;
                if (is_dir($entry)) {
                    traversalFolder($entry);
                }
                if (is_file($entry)) {
                    echo $entry . "\n";
                }
            }
            $dirObj->close();
            return;
        } else {
            print_r($path);
            return;
        }
    }

}

