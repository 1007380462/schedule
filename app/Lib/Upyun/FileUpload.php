<?php
namespace App\Lib\Upyun;
/**
 * upyun上传扩展
 *
 */
use UpYun\UpYun;

class FileUpload {
	
	public $bucketname='';//空间名
	public $username  ='';//空间管理员名
	public $password  ='';//空间管理名密码
	public $opts = NULL;
	public $endpoint  = NULL;
	public $timeout   = 600;
	public $domain = '';
	private  $_UpYuninstance = '';
	
	public function __construct(){
		if($this->_UpYuninstance==='')
			$this->createUpYunInstance();
	}
	public function getDomain(){
		return 'http://'.$this->bucketname.'.'.$this->domain;
	}

	private function createUpYunInstance(){
		$this->_UpYuninstance = new UpYun(\Config::get('upyun.bucketname'), \Config::get('upyun.username'), \Config::get('upyun.password'),$this->endpoint ,$this->timeout);
	}
	
	//upyun操作
	/**
	 * 上传文件
	 * @param string $path 存储路径
	 * @param mixed $content 需要上传的文件的件流或者文件内容
	 * @param boolean $auto_mkdir 自动创建目录
	 * @param array $opts 可选参数
	 */
	public function uploadFileByContent($content,$name,$auto_makdir=True,$type='img'){
		try {
            $remotePath = '/'.$name;
            if($type=='img'){
                $opts = $this->setOpts();//设置头像缩略图
                $return = $this->_UpYuninstance->writeFile($remotePath,$content,$auto_makdir,$opts);
                $return['path'] = $remotePath;
            }elseif($type == 'file'){
                $return =array();
                $return['status'] = $this->_UpYuninstance->writeFile($remotePath,$content,true);
                $return['path'] = $remotePath;
            }
            return $return;
		}catch(\Exception $e){
			return array('error'=>$e->getMessage());
		}		
	}
	
	public function uploadFileByContent1($content,$name,$auto_makdir=True){
		try {
			$remotePath = '/'.$name;
			$return =array();
			$return['status'] = $this->_UpYuninstance->writeFile($remotePath,$content,true);
			$return['path'] = $remotePath;
			return $return;
		}catch(\Exception $e){
			return array('error'=>$e->getMessage());
		}		
	}

	public function down($path){
		try {
			$return = $this->_UpYuninstance->readFile($path);
			return $return;
		}catch(\Exception $e){
			return array('error'=>$e->getMessage());
		}
	}

	/**
	 * 设置缩略图选项
	 */
	private function setOpts(){
		if($this->opts){
			return $upyunOpts = array(
					UpYun::X_GMKERL_TYPE    => isset($this->opts['X_GMKERL_TYPE'])?$this->opts['X_GMKERL_TYPE']:'square', // 缩略图类型
					UpYun::X_GMKERL_VALUE   => isset($this->opts['X_GMKERL_VALUE'])?$this->opts['X_GMKERL_VALUE']:100, // 缩略图大小
					UpYun::X_GMKERL_QUALITY => isset($this->opts['X_GMKERL_QUALITY'])?$this->opts['X_GMKERL_QUALITY']:95, // 缩略图压缩质量
					UpYun::X_GMKERL_UNSHARP => isset($this->opts['X_GMKERL_UNSHARP'])?$this->opts['X_GMKERL_UNSHARP']:true // 是否进行锐化处理
			);
		}else 
			return NULL;
	}
	public function getFileInfo($path){
		try {
			return $this->_UpYuninstance->getFileInfo($path);
		}catch (\Exception $e){
			return array('error'=>$e->getMessage());
		}
		
	}
	/**
	 * 删除文件
	 * @param string $path 存储路径
	 */
	
	public function deleteByPath($path,$thumb){
		return $this->_UpYuninstance->delete($path);
	}
	
	public function getFileUrl($path,$thumb=''){
		return 'http://'.$this->bucketname.'.'.$this->domain.$path.$thumb;
	}
	
	public function getFileByUrl($path,$thumb=''){
		return $path.$thumb;
	}
	private function generatePathByName($name){
		$len = strlen($name);
		if($len>4){
			return '/'.$name[0].'/'.$name[$len-1].'/'.$name[0].$name[1].'/'.$name[$len-2].$name[$len-1]; 
		}else
			return '';
	}
    public function readContentByName($name){
            try{
                    $remotePath = '/'.$name;
                    return $this->_UpYuninstance->readFile($remotePath);
            }catch(\Exception $e){
                    return '';
            }
    }
	//shuchuangxinxi空间使用情况
	public function getSpaceUse($remotePath='/'){
            try{
			$this->bucketname ='shuchuangxinxi';
		self::createUpYunInstance();	
                    return $this->_UpYuninstance->getFolderUsage($remotePath);//getBucketUsage();
            }catch(\Exception $e){
                    return '';
            }
    	}
}
