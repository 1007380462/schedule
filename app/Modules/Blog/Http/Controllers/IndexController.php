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


class IndexController extends Controller
{
    /**
     * current don't use
     * suspension navigation bar
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function floatingNavigationBar()
    {
        $a = '# My article
                 Welcome to my article,
                * Point one
                * Point two
                * Point three
                ```
                <?php
                foreach(range(1,10) as $k){
                echo $x;
                }
                ?>
                ```
                Here is some echo `\'inline code\'`;';
        $fileContent = '';
        $time = 0;
        /*get directory of file*/
        $handle = fopen(public_path('jdy.txt'), 'r');

        /*add a anchor to each title and then use javascript to Automatically generate directory*/
        while (!feof($handle)) {
            $lineStr = fgets($handle);
            if (substr($lineStr, 0, 1) == '#') {

                if (substr($lineStr, 0, 4) == '####') {
                    /*this is h4*/
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }
                if (substr($lineStr, 0, 3) == '###' && substr($lineStr, 0, 4) != '####') {
                    /*this is h3*/
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }
                if (substr($lineStr, 0, 2) == '##' && substr($lineStr, 0, 3) != '###') {
                    /*this is h2*/
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }
                if (substr($lineStr, 0, 1) == '#' && substr($lineStr, 0, 2) != '##') {
                    /*this is h1*/
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }

            } else {
                $fileContent .= $lineStr;
            }

        }

        fclose($handle);
        $b = Parsedown::instance()->text($fileContent);

        return view('blog.index', ['text' => $b]);

    }


    /**
     * fixed navigation bar ,blog navigation use it style.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fixedTheNavigationBar()
    {

        $fileContent = '';
        $time = 0;
        //store h value and title name in sequence
        $h_value = array();

        /*get path of file*/
        $handle = fopen(public_path('jdy.txt'), 'r');
        /*add a anchor to each title and then use javascript to Automatically generate directory*/
        while (!feof($handle)) {
            $lineStr = fgets($handle);
            if (substr($lineStr, 0, 1) == '#') {

                if (substr($lineStr, 0, 6) == '######') {
                    /*this is h6*/
                    $tmp[0] = 6;
                    $tmp[1] = substr($lineStr, 6);
                    $h_value[] = $tmp;
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }
                if (substr($lineStr, 0, 5) == '#####' && substr($lineStr, 0, 6) != '######') {
                    /*this is h5*/
                    $tmp[0] = 5;
                    $tmp[1] = substr($lineStr, 5);
                    $h_value[] = $tmp;
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }
                if (substr($lineStr, 0, 4) == '####' && substr($lineStr, 0, 5) != '#####') {
                    /*this is h4*/
                    $tmp[0] = 4;
                    $tmp[1] = substr($lineStr, 4);
                    $h_value[] = $tmp;
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }
                if (substr($lineStr, 0, 3) == '###' && substr($lineStr, 0, 4) != '####') {
                    /*this is h3*/
                    $tmp[0] = 3;
                    $tmp[1] = substr($lineStr, 3);
                    $h_value[] = $tmp;
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }
                if (substr($lineStr, 0, 2) == '##' && substr($lineStr, 0, 3) != '###') {
                    /*this is h2*/
                    $tmp[0] = 2;
                    $tmp[1] = substr($lineStr, 2);
                    $h_value[] = $tmp;
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }
                if (substr($lineStr, 0, 1) == '#' && substr($lineStr, 0, 2) != '##') {
                    /*this is h1*/
                    $tmp[0] = 1;
                    $tmp[1] = substr($lineStr, 1);
                    $h_value[] = $tmp;
                    $anchor = '<p><a name=' . $time . '></a></p>';
                    $fileContent .= $anchor . "\n";
                    $fileContent .= $lineStr;
                    $time++;
                }

            } else {
                $fileContent .= $lineStr;
            }

        }
        fclose($handle);

        $b = Parsedown::instance()->text($fileContent);
        //store tree node
        $str = array();
        //the number of the first level
        $str_length = 0;
        foreach ($h_value as $k => $value) {
            $title = "<a href=#$k  style=text-decoration:none>$value[1]</a>";
            $key = $k;
            $folder = false;
            $children = "";
            $tmp = array('title' => $title, 'key' => $key, 'folder' => $folder, 'children' => $children);
            $current_level = $h_value[$k][0];
            if ($k == 0) {
                $str[] = $tmp;
                continue;
            }
            /*this node is first level*/
            if ($current_level == $h_value[$str[$str_length]['key']][0]) {
                $str[] = $tmp;
                $str_length++;
                continue;
            }
            /*this node is first level*/
            if ($current_level < $h_value[$str[$str_length]['key']][0]) {
                $str[] = $tmp;
                $str_length++;
                continue;
            }

            /*this node is current level's next level*/
            if ($current_level > $h_value[$str[$str_length]['key']][0]) {
                $tp =& $str[$str_length];

                while (is_array($tp['children'])) {
                    $tp['folder'] = true;
                    $tp_length = count($tp['children']);

                    if ($current_level <= $h_value[$tp['children'][$tp_length - 1]['key']][0]) {
                        $tp['children'][] = $tmp;
                        break;
                    }
                    $tp =& $tp['children'][$tp_length - 1];
                }

                if (!is_array($tp['children'])) {
                    $tp['folder'] = true;
                    $tp['children'][] = $tmp;
                }

            }

        }

        $str2 = json_encode($str);
        $s = '[
            {"title": "<a href=#  style=text-decoration:none>Node 1</a>", "key": "1"},
            {"title": "Folder 2", "key": "2", "folder": true,
                     "children": 
                           [
                            {"title": "Node 2.1", "key": "3"},  
                             {"title": "Node 2.2", "key": "4"} 
                                ]}            
                                     ]';
        /*notice:key is node's name*/
        return view('blog.fixTheNavBar', ['text' => $b, 'tree' => $str2]);

    }

    /**
     * modify node name
     * @param Request $request
     */
    public function modifyNodeName(Request $request)
    {

    }

    /**
     * modify file's and directory's name'
     * @param Request $request
     */
    public function modifyFileName(Request $request)
    {
        $name = $request['title'];
        $name = trim($name);
        $blogId = $request['modifyBlogId'];
        $fileModel = File::find($blogId);
        $nameKey = $fileModel->nameKey;
        $fileModel->name = $name;
        $fileModel->nameKey = md5($name);
        $fileModel->save();
        if ($fileModel->type == 1) {  //if file type is file,the file name will be modified.
            rename($nameKey, md5($name));
        }
    }

    /**
     * adjust node place
     * @param Request $request
     */
    public function adjustNodePlace(Request $request)
    {
        echo 'false';
        exit;
        $id = $request['node'];             //moving node
        $pid = $request['destination'];     //this is moving node's parent node.
        /*if pid is file node ,the operation will be error*/
        $fileModel = File::find($pid);
        if ($fileModel->type == 1) {
            echo 'false';
            exit;
        }
        $fileRelationModel = FileRelation::where('fileIdOne', $id)->first();
        $fileRelationModel->fileIdTwo = $pid;
        $fileRelationModel->save();

        echo 'true';
    }

    public function addNewNode(Request $request)
    {

    }

    public function deleteNode(Request $request)
    {

    }

    /*show blog and blog directory*/
    public function showBlogList(Request $request)
    {
        $tree = $this->organizeNodeStructureAndDirectoryWithoutId(0);
        // var_dump($tree);exit;
        return view('blog.showBlogList', ['tree' => $tree]);
    }

    /**
     * return file content
     * @param Request $request
     */
    public function getBlogContent(Request $request)
    {
        $blogId = $request['id'];
        $fileModel = File::find($blogId);
        $name = $fileModel->name;
        $nameKey = $fileModel->nameKey;
        $filepath = '/xampp/htdocs/fileStore/' . $nameKey;
        $content = file_get_contents($filepath);
        $result = [
            'name' => $name,
            'content' => $content,
            'blogId' => $fileModel->fileId,
            'modTime' => $fileModel->modTime,
        ];
        echo json_encode($result);
    }

    /**
     * edit blog file
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editBlog(Request $request)
    {
        $blogId = $request['blogId'];
        $fileModel = File::where('fileId', $blogId)->first();
        if (empty($fileModel)) {
            echo '<script type="text/javascript">alert("文件不存在或者你选择的是目录");history.back();</script>';
            exit;
        }
        $title = $fileModel->name;
        $filePath = '/xampp/htdocs/fileStore/' . $fileModel->nameKey;
        $inputContent = file_get_contents($filePath);

        return view('blog.editBlog', ['blogId' => $blogId, 'inputContent' => $inputContent, 'title' => $title]);
    }

    /**
     * create a new directory
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createDirectory(Request $request)
    {
        $tree = $this->organizeNodeStructure(0);
        return view('blog.createDirectory', ['tree' => $tree]);
    }

    /**
     * create a file directory
     * @param Request $request
     */
    public function storeDirectory(Request $request)
    {
        $pid = isset($request['pid']) ? $request['pid'] : 0;
        $name = $request['title'];
        $name = trim($name);
        $nameKey = md5($name);
        /*store file information*/
        $fileModle = new File();
        $fileModle->name = $name;
        $fileModle->nameKey = $nameKey;
        $fileModle->type = 2;
        $fileModle->addTime = date("Y-m-d H:i:s");
        $fileModle->save();

        $fileModleResult = File::where('nameKey', $nameKey)->first();
        /*store file relation information*/
        $fileId = $fileModleResult->fileId;

        $fileRelationModel = new FileRelation();
        $fileRelationModel->fileIdOne = $fileId;
        if (empty($pid)) {
            $fileRelationModel->fileIdTwo = 0;
        } else {
            $fileRelationModel->fileIdTwo = $pid;
        }
        $fileRelationModel->preveFile = 0;
        $fileRelationModel->addTime = date('Y-m-d H:i:s');
        $fileRelationModel->save();


        return redirect()->to('/blog/showBlogList');
    }


    public function createBlog()
    {
        $tree = $this->organizeNodeStructure(0);
        return view('blog.createBlog', ['tree' => $tree]);
    }


    /**
     * store a blog file
     */
    public function storeBlog()
    {
        ///xampp/htdocs/fileStore
        $blogId = $_REQUEST['blogId'];
        $title = $_REQUEST['title'];
        $pid = $_REQUEST['pid'];
        $title = trim($title);
        $inputContent = $_REQUEST['inputContent'];
        if (empty($title) || empty($inputContent)) {
            echo "<script type=\"text/javascript\">alert('文件标题和内容不能为空');history.back()</script>";
            exit;
        }
        $titleKey = md5($title);
        $filePath = '/xampp/htdocs/fileStore/';
        try {
            /*modify file content*/
            if ($blogId) {
                $fileRecord = File::where('fileId', $blogId)->first();
                $filename = $fileRecord->nameKey;
                $filePath .= $filename;
                $handle = fopen($filePath, 'w+');
                fwrite($handle, $inputContent);
                fclose($handle);

                //modify name and nameKey;
                $fileModel = File::where('fileId', $blogId)->first();
                $fileModel->name = $title;
                $fileModel->nameKey = $titleKey;
                $fileModel->size = filesize($filePath);
                $fileModel->save();
            }

            /*create file and store file content*/
            if (empty($blogId)) {
                $filePath .= $titleKey;
                $handle = fopen($filePath, 'w+');
                fwrite($handle, $inputContent);
                fclose($handle);
                /*record file table*/
                $fileModel = new File();
                $fileModel->name = $title;
                $fileModel->nameKey = $titleKey;
                $fileModel->size = filesize($filePath);
                $fileModel->type = 1;     //1 文件 2 目录
                $fileModel->addTime = date("Y-m-d H:i:s");
                $fileModel->save();

                /*record fileRelation table*/
                $fileModeResult = File::where('nameKey', $titleKey)->first();
                $fileRelationModel = new FileRelation();
                $fileRelationModel->fileIdOne = $fileModeResult->fileId;   //current node id
                $fileRelationModel->fileIdTwo = $pid;                      //current node's parent id
                $fileRelationModel->preveFile = 0;
                $fileRelationModel->addTime = date("Y-m-d H:i:s");
                $fileRelationModel->save();
            }
        } catch (Exception $e) {
            echo 'is error';
            exit;
        }

        echo 'true';
        exit;
    }

    /**
     * delete a blog
     * @param Request $request
     * @return bool
     */
    public function deleteBlog(Request $request)
    {
        $blogId = $request['blogId'];
        File::where('fileId', $blogId)->delete();
        return true;
    }


    /*get all node to organize a format of  front end need's*/
    public function organizeNodeStructure($userId)
    {
        /*$str = '[
                {"title": "Node 1", "key": "1"},
                {"title": "Folder 2", "key": "2", "folder": true, 
                "children": 
                    {"title": "Node 2.1", "key": "3"}
                ]';
        $title = "<a href=#$k  style=text-decoration:none>$value[1]</a>";
        $s = '[
            {"title": "<a href=#  style=text-decoration:none>Node 1</a>", "key": "1"},
            {"title": "Folder 2", "key": "2", "folder": true,
                     "children": 
                           [
                            {"title": "Node 2.1", "key": "3"},  
                             {"title": "Node 2.2", "key": "4"} 
                                ]}            
                                     ]';*/
        $fileRelationModel = FileRelation::all(); //get all record;
        // $tmp=array('fileIdOne'=>'','title'=>'','fileIdTwo'=>'','children'=>'');
        $arr = array();
        $allFileId = array();
        foreach ($fileRelationModel as $k => $value) {
            $allFileId[] = $value->fileIdOne; //store all flieId

            $arr[$value->fileIdOne] = [
                'fileIdOne' => $value->fileIdOne,
                'fileIdTwo' => $value->fileIdTwo,
                'title' => $value->title,
                'key' => $value->fileIdOne,
                // 'folder' => true,
                'children' => array(),
            ];
        }
        /*get file id corresponding to the file name*/
        /*operation of get file name may be modiy by user id condition*/
        $fileName = array();
        $allFileName = DB::table('file')->select('name', 'fileId', 'nameKey', 'type')->whereIn('fileId', $allFileId)->get();
        foreach ($allFileName as $k => $value) {
            $fileName[$value->fileId]['name'] = $value->name;
            $fileName[$value->fileId]['nameKey'] = $value->nameKey;
            $fileName[$value->fileId]['type'] = $value->type;
            $fileName[$value->fileId]['fileId'] = $value->fileId;
        }

        //combine a structure
        foreach ($arr as $k => $value) {
            $arr[$value['fileIdOne']]['title'] = "<a  style='text-decoration:none' class='blogId' href=" . url('/blog/getBlogContent?id=' . $fileName[$value['fileIdOne']]['fileId']) . ">" . $fileName[$value['fileIdOne']]['name'] . "</a>";

            if ($value['fileIdTwo'] != 0) {
                $arr[$value['fileIdTwo']]['children'][] =& $arr[$value['fileIdOne']];
            }
        }

        $finalResult = [];
        foreach ($arr as $k => $value) {
            if ($value['fileIdTwo'] == 0) {
                $finalResult[] = $value;
            }
        }

        return json_encode($finalResult);
    }

    /*get all node to organize a format of  front end need's*/
    public function organizeNodeStructureAndDirectoryWithoutId($userId)
    {
        /*$str = '[
                {"title": "Node 1", "key": "1"},
                {"title": "Folder 2", "key": "2", "folder": true,
                "children":
                    {"title": "Node 2.1", "key": "3"}
                ]';
        $title = "<a href=#$k  style=text-decoration:none>$value[1]</a>";
        $s = '[
            {"title": "<a href=#  style=text-decoration:none>Node 1</a>", "key": "1"},
            {"title": "Folder 2", "key": "2", "folder": true,
                     "children":
                           [
                            {"title": "Node 2.1", "key": "3"},
                             {"title": "Node 2.2", "key": "4"}
                                ]}
                                     ]';*/
        $fileRelationModel = FileRelation::all(); //get all record;
        // $tmp=array('fileIdOne'=>'','title'=>'','fileIdTwo'=>'','children'=>'');
        $arr = array();
        $allFileId = array();
        foreach ($fileRelationModel as $k => $value) {
            $allFileId[] = $value->fileIdOne; //store all flieId

            $arr[$value->fileIdOne] = [
                'fileIdOne' => $value->fileIdOne,
                'fileIdTwo' => $value->fileIdTwo,
                'title' => $value->title,
                // 'folder' => true,
                'children' => array(),
            ];
        }
        /*get file id corresponding to the file name*/
        /*operation of get file name may be modiy by user id condition*/
        $fileName = array();
        $allFileName = DB::table('file')->select('name', 'fileId', 'nameKey', 'type')->whereIn('fileId', $allFileId)->get();
        foreach ($allFileName as $k => $value) {
            $fileName[$value->fileId]['name'] = $value->name;
            $fileName[$value->fileId]['nameKey'] = $value->nameKey;
            $fileName[$value->fileId]['type'] = $value->type;
            $fileName[$value->fileId]['fileId'] = $value->fileId;
        }

        //combine a structure
        foreach ($arr as $k => $value) {
            if ($fileName[$value['fileIdOne']]['type'] == 2) {
                // $arr[$value['fileIdOne']]['title'] = $fileName[$value['fileIdOne']]['name'];
                $arr[$value['fileIdOne']]['title'] = "<a  class='blogId' style='text-decoration:none' href=" . url('/blog/getBlogContent?id=' . $fileName[$value['fileIdOne']]['fileId']) . '&type=2' . ">" . $fileName[$value['fileIdOne']]['name'] . "</a>";
            }
            if ($fileName[$value['fileIdOne']]['type'] == 1) {
                $arr[$value['fileIdOne']]['title'] = "<a  class='blogId' href=" . url('/blog/getBlogContent?id=' . $fileName[$value['fileIdOne']]['fileId']) . '&type=1' . ">" . $fileName[$value['fileIdOne']]['name'] . "</a>";
            }

            if ($value['fileIdTwo'] != 0) {
                $arr[$value['fileIdTwo']]['children'][] =& $arr[$value['fileIdOne']];
            }
        }

        $finalResult = [];
        foreach ($arr as $k => $value) {
            if ($value['fileIdTwo'] == 0) {
                $finalResult[] = $value;
            }
        }

        return json_encode($finalResult);
    }


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

