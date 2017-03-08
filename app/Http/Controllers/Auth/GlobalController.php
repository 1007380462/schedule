<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GlobalController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function echoOk(  $data = array(),   $msg = "", $code = "00000", $type = "json", $exit = true)
    {
        return $this->echoOut(["data" => $data], $msg,   $code,    $type,    $exit);
    }

    public function echoErr($data = array(), $msg = "", $code = "10000", $type = "json", $exit = true)
    {
        $_data = $data;
        $_error = $_data['error'] ?? array();
        if (isset($_data['error'])) {
            unset($_data['error']);
        }
        return $this->echoOut(array("data" => $_data, "error" => $_error), $msg, $code,  $type, $exit);
    }


    public function echoOut($data = array(),  $msg = "", $code = "00000",  $type = "json", $exit = true)
    {

        if ($type == "json" || (isset($_REQUEST['apiType']) && $_REQUEST['apiType'] == "json")) {
            $this->echoJson($data, $msg,$code);
        } else {
            $this->echoJsonp($data, $code, $msg);
        }
        Yii::$app->end();
        if ($exit) {
            //$this->computeRunTime();
        }
    }


    /**
     * echoJson
     * 输出json
     *
     * @param mixed $data
     * @access private
     * @return void
     */
    private function echoJson($data = array(), $msg = "",  $code = "00000")
    {
        @ob_clean();
        //这里用text/html主要是因为ie6不支持application/json
        header("Content-type:text/html; charset=utf-8");
        $res = $data;
        $res['status'] = substr($code, 0, 1);
        $res['msg'] = $msg;
        $res['code'] = $code;
        echo json_encode($res);
    }

    /**
     * echoJsonp
     * 输出jsonp
     *
     * @param mixed $data
     * @access private
     * @return void
     */
    private function echoJsonp($data = array(), $msg = "",$code = "00000")
    {
        header("Content-type:application/json; charset=utf-8");
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        if (!isset($data['status'])) {
            $data['status'] = substr($code, 0, 1);
            $data['code'] = $code;
            $data['msg'] = $msg;
        }
        echo json_encode($data);
        return;
    }

}
