<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Model\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\GlobalController;


class ScheduleController extends GlobalController
{

    public function schedule(){
        /*get current month schedule data*/
        $currentMonthStart=date('Y-m-00 00:00:00');
        $currentMonthEnd=date('Y-m-01 00:00:00',mktime(0,0,0,date('m')+1,date('d'),date('Y')));
        $scheduleModel=Schedule::where('startTime','>=',$currentMonthStart)
                 ->where('endTime','<',$currentMonthEnd)
                 ->get();
        $arr='';
        $scheduleModel=Schedule::get();
        foreach ($scheduleModel as $k=>$value){
            $startTime=$value->startTime;
            $startTime=strtotime($startTime);
            $start=array((int)date("Y",$startTime),(int)date("m",$startTime)-1,(int)date("d",$startTime),(int)date("H",$startTime),(int)date("i",$startTime),(int)date("s",$startTime));
            $endTime=$value->endTime;
            $endTime=strtotime($endTime);
            $end=array((int)date("Y",$endTime),(int)date("m",$endTime)-1,(int)date("d",$endTime),(int)date("H",$endTime),(int)date("i",$endTime),(int)date("s",$endTime));

            $arr[]=array(
                'title'=>$value->content,
                'start'=>$start,   //array(2017,2,7,0,0,0), //y-m-d h-m-s attention js month starting  from zero so Date(2017,2,7) is 2017-3-7 in javascript
                'end'=>$end,       //array(2017,2,7,11,0,0),
                'allDay'=>false,
                'backgroundColor'=>$value->backgroundColor,
                'borderColor'=>$value->borderColor,
            );
        }
        /*get many element from table according to condition*/
       /* $arr[]=array(
            'title'=>'dddddd',
            'start'=>array(2017,02,07,00,00,00), //y-m-d h-m-s attention js month starting  from zero so Date(2017,2,7) is 2017-3-7 in javascript
            'end'=>array(2017,02,07,11,00,00),
            'allDay'=>false,
            'backgroundColor'=>'#3c8dbc',
            'borderColor'=>'#3c8dbc',
        );*/

        return view('schedule.index',['eventsData'=>json_encode($arr)]);
    }

    /**
     * transfer rgb to hes,for example rgb(255,255,255) to #FFFFFF;
     * @param $rgb
     */
    public function RGBToHex($rgb)
    {
        $regexp = "/^rgb\(([0-9]{0,3})\,\s*([0-9]{0,3})\,\s*([0-9]{0,3})\)/";
        preg_match($regexp, $rgb, $match);
        $hex = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');
        $endResult = '#';
        foreach ($match as $k => $value) {
            if($k==0)continue;
            /*将数组转换为十六进制*/
            $a = $value;
            $g = ''; //除数
            $p = ''; //余数
            $result = '';
            while (true) {
                $g = intval($a / 16);
                $p = (string)$a % 16;
                if ($g == 0) {
                    $result = $hex[$p] . $result;
                    $endResult .= $result;
                    break;
                } else {
                    $result = $hex[$p] . $result;
                    $a = $g;
                }
            }
        }

        return $endResult;

    }

    /**
     * add a strip of schedule
     * @param Request $request
     */
    public function addSchedule(Request $request){
        $startTime=$request['startTime'];
        $endTime=$request['endTime'];

        $backgroundColor=$this->RGBToHex($request['backgroundColor']);
        $borderColor=$this->RGBToHex($request['borderColor']);
        $content=$request['content'];

        $arr=['backgroundColor'=>$backgroundColor,'borderColor'=>$borderColor];
        $arrJSoned=json_encode($arr);

        $scheduleMode=new Schedule();
        $scheduleMode->startTime=$startTime;
        $scheduleMode->endTime=$endTime;
        $scheduleMode->content=$content;
        $scheduleMode->ext=$arrJSoned;
        $scheduleMode->backgroundColor=$backgroundColor;
        $scheduleMode->borderColor=$borderColor;
        $scheduleMode->addTime=date('Y-m-d H:i:s');

        if($scheduleMode->save()){
            $this->echoOk();
        }

        $this->echoErr([]);
    }

    /**
     * get data by modify duration
     * @param Request $request
     */
    public function modifyDuration(Request $request){
        $duratioin=$request['duration'];
        /*for example duration*/
        /*week model:  Oct 16 — 22, 2016 */
        /*day model: October 16, 2016 date("Y",strtotime(''))*/
        /*month model: October 2016  date("Y",strtotime(''))*/

        if(preg_match('/-/',$duratioin)){
            /*week model:  Oct 16 — 22, 2016 */
            $duratioin=trim($duratioin);
            $arr=explode(' ',$duratioin);
            $length=count($arr);
            $m=$arr[0];
            $y=$arr[$length-1];
            $time=$m.' '.$y;
            $m=date("m",strtotime($time));

            $currentMonthStart=date('Y-m-00 00:00:00',mktime(0,0,0,$m,1,$y));
            $currentMonthEnd=date('Y-m-01 00:00:00',mktime(0,0,0,$m+1,1,$y));
            $scheduleModel=Schedule::where('startTime','>=',$currentMonthStart)
                ->where('endTime','<',$currentMonthEnd)
                ->get();
        }else{
            $y=date("Y",strtotime($duratioin));
            $m=date("m",strtotime($duratioin));

            $currentMonthStart=date('Y-m-00 00:00:00',mktime(0,0,0,$m,1,$y));
            $currentMonthEnd=date('Y-m-01 00:00:00',mktime(0,0,0,$m+1,1,$y));
            $scheduleModel=Schedule::where('startTime','>=',$currentMonthStart)
                ->where('endTime','<',$currentMonthEnd)
                ->get();
        }

        $arr='';
        foreach ($scheduleModel as $k=>$value){
            $startTime=$value->startTime;
            $startTime=strtotime($startTime);
            $start=array((int)date("Y",$startTime),(int)date("m",$startTime)-1,(int)date("d",$startTime),(int)date("H",$startTime),(int)date("i",$startTime),(int)date("s",$startTime));
            $endTime=$value->endTime;
            $endTime=strtotime($endTime);
            $end=array((int)date("Y",$endTime),(int)date("m",$endTime)-1,(int)date("d",$endTime),(int)date("H",$endTime),(int)date("i",$endTime),(int)date("s",$endTime));

            $arr[]=array(
                'title'=>$value->content,
                'start'=>$start,   //array(2017,2,7,0,0,0), //y-m-d h-m-s attention js month starting  from zero so Date(2017,2,7) is 2017-3-7 in javascript
                'end'=>$end,       //array(2017,2,7,11,0,0),
                'allDay'=>false,
                'backgroundColor'=>$value->backgroundColor,
                'borderColor'=>$value->borderColor,
            );
        }

        $this->echoOk(['data'=>json_encode($arr)]);
    }
    /**
     * remove a strip of schedule
     * @param Request $request
     */
    public function removeSchedule(Request $request){
        $id=$request['id'];
        if(Schedule::where('id',$id)->delete()){
            $this->echoOk();
        }
        $this->echoErr([]);
    }

    /**
     * edit a strip of schedule
     * @param Request $request
     */
    public function editSchedule(Request $request){
        $startTime=$request['startTime'];
        $endTime=$request['endTime'];
        $backgroundColor=$this->RGBToHex($request['backgroundColor']);
        $borderColor=$this->RGBToHex($request['borderColor']);
        $content=$request['content'];

        $scheduleMode=Schedule::where('startTime',$startTime)
                        ->where('endTime',$endTime)
                        ->where('backgroundColor',$backgroundColor)
                        ->where('borderColor',$borderColor)
                        ->first();
        if(empty($scheduleMode)){
            $this->echoErr([]);
        }

        $scheduleMode->content=$content;
        if($scheduleMode->save()){
            $this->echoOk();
        }

        $this->echoErr([]);
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

