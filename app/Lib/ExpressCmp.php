<?php
namespace App\Lib;
/*
$pList = CityUtil2::getProvinceList();
$cList = CityUtil2::getCityList(230000);
$aList = CityUtil2::getAreaList(210600);
$aList = CityUtil2::getAreaList(110000);
var_dump($aList);
echo CityUtil2::getCodeByName('辽宁省','丹东市','东港市');
echo CityUtil2::getCodeByName('北京市','北京市','通州区');
 */

class ExpressCmp
{
    public static $expressCmpNum =array(
        '0'=>'顺丰速运 ',
        '1'=>'邮政EMS ',
        '2'=>'跨越速运 ',
        '3'=>'圆通快递 ',
        '4'=>'申通快递',
        '5'=>'韵达快运',
        '6'=>'中通快递',
        '7'=>'汇通快递',
        '8'=>'天天快递',
        '9'=>'宅急送'
    ) ;
    public static $expressCmpName=array(
        '顺丰速运'=>0,
        '邮政EMS'=>1,
        '跨越速运'=>2,
        '圆通快递'=>3,
        '申通快递'=>4,
        '韵达快运'=>5,
        '中通快递'=>6,
        '汇通快递'=>7,
        '天天快递'=>8,
        '宅急送'=>9
    );

     public static function getNameByNumber($number){
       if(!empty($number)){
           return ExpressCmp::$expressCmpNum[$number];
       }
       return false;
     }


    public static function getNumByName($name){
      if(!empty($name)){
          $name=trim($name);
          return ExpressCmp::$expressCmpName[$name];
      }
      return false;
    }
}

?>
