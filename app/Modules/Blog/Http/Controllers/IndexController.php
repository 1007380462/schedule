<?php

namespace App\Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Parsedown;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{



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

    public function fixedTheNavigationBar()
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
        //store h value and title name in sequence
        $h_value=array();

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
        foreach ($h_value as $k=>$value){
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

        $str2=json_encode($str);
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
        return view('blog.fixTheNavBar', ['text' => $b,'tree'=>$str2]);

    }

    public function modifyNodeName(Request $request){

    }

    public function adjustNodePlace(Request $request){
        $str = '[
                {"title": "Node 1", "key": "1"},
                {"title": "Folder 2", "key": "2", "folder": true, 
                "children": 
                    {"title": "Node 2.1", "key": "3"}
                ]';
        $str = json_decode($str);      //get a array type
        $nodeNameOne=$request->get(''); //the name of the moved node,
        $nodeNameTwo=$request->get(''); //Target location above the name of the node
        /*notice:nodeName*/
        /*modify table ,add a record and modify a record */

    }

    public function addNewNode(Request $request){

    }


    public function deleteNode(Request $request){

    }

    public function editBlog(Request $request){
        return view('blog.editBlog');
    }


}

