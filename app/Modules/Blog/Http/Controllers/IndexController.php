<?php

namespace App\Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    /**
     * bolg list
     * @param Request $request
     */
    public function index(Request $request){

    }

    /**
     * add a blog
     * @param Request $request
     */
    public function getAddBlog(Request $request){

    }

    /**
     * store a new blog
     * @param Request $request
     */
    public function postAddBlog(Request $request){

    }

    /**
     * edit a blog
     * @param Request $request
     */
    public function getEditBlog(Request $request){

    }

    /**
     * store the result of edit a blog
     * @param Request $request
     */
    public function postEditBlog(Request $request){

    }


    /**
     * verify each option of your new add blog
     * @param $obj
     */
    public function checkAddBlog($obj){

    }

    /**
     * verify each option of your edit blog
     * @param $obj
     */
    public function checkEditBlog($obj){

    }

}
