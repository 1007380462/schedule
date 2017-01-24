<?php
/***************************************************************************
 * 
 * Copyright (c) 2013 gaosimeng@gmail.com, Inc. All Rights Reserved
 * @file YyImgUtil.php
 * @author work(gaosimeng@gmail.com)
 * @date 2013/08/19 16:41:01
 * 
 **************************************************************************/
namespace App\Lib;
class ImgUtil
{

	static public function getDomain()
	{
		return "http://image.yiliangche.cn/";
	}

	static public function getImgKey($file_path)
	{
	    return md5_file($file_path);
	}
	
	static public function getImgKeyFromUrl($url)
	{
	    return strstr(substr(strrchr($url,"/"),1),"!",true);
	}

    //原图
	static public function getImgUrl($imgKey, $imgSize='')
	{
		if (empty($imgKey)) {
			return '';
		}
		if (empty($imgSize)) {
			return self::getDomain($imgKey)."$imgKey";
		} else {
			return self::getDomain($imgKey)."$imgKey"."$imgSize";
		}
	}
	
	//300*..
	static public function getImgUrlP1($imgKey)
	{
	    return self::getDomain($imgKey)."$imgKey!p1";
	}
	
	//..*400
	static public function getImgUrlP2($imgKey)
	{
	    return self::getDomain($imgKey)."$imgKey!p2";
	}
	
	//300*450
	static public function getImgUrlP3($imgKey)
	{
	    return self::getDomain($imgKey)."$imgKey!p3";
	}

    //450*300
	static public function getImgUrlP4($imgKey)
	{
	    return self::getDomain($imgKey)."$imgKey!p4";
	}
    
	//宽高最大320
	static public function getImgUrlP5($imgKey)
	{
	    return self::getDomain($imgKey)."$imgKey!p5";
	}
    
	//80*80
	static public function getImgUrlHead($imgKey)
	{
	    return self::getDomain($imgKey)."$imgKey!head";
	}
	
	//160*160
	static public function getImgUrlHead2($imgKey)
	{
	    return self::getDomain($imgKey)."$imgKey!head2";
	}

	//待定
	static public function getImgUrlLarge($imgKey)
	{
	    return self::getDomain($imgKey)."$imgKey!large";
	}

	/**
	 * escapeFaceUrl 
	 * 
	 * @param mixed $str 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function escapeFaceUrl($str)
	{
	    $pattern = '/&lt;img src=&quot;(.*?)&quot; style=&quot;(.*?)&quot;&gt;/i';
	    $replacement = '<img src="$1" style="$2">';
        $str = preg_replace($pattern, $replacement, $str);
	    $pattern = '/&lt;IMG style=&quot;(.*?)&quot; src=&quot;(.*?)&quot;&gt;/i';
	    $replacement = '<img src="$2" style="$1">';
        $str = preg_replace($pattern, $replacement, $str);
		return $str;
	}
}
