<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/FontAwesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/navbar-fixed-side.css')}}">
    <style>
        a{
            color: #3e454c;
        }
    </style>
    <title>coopbee</title>
</head>
<body>

{{--use bootstrap nav  and navbar-fixed-side.css to implement a left side navigation bar  and the use fancytree to implement a tree structure --}}
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-3 col-lg-2">
            <nav class="navbar navbar-default navbar-fixed-side">
                <div class="" style="position: fixed;height: 100%; !important;left: 0px;">
                    <aside id="sidebar" class="sticky" style="top: 20px;height:100%">
                        <div class="inside" style="position:relative;width:220px;height:100%; overflow:auto;">

                            <div id="tree"></div>

                        </div>
                    </aside>
                </div>
            </nav>
        </div>
        <div class="col-sm-9 col-lg-8">
            <button><a style="text-decoration: none" href="{{url('/blog/createBlog')}}">new blog</a></button>
            <button><a style="text-decoration: none" href="{{url('/blog/createDirectory')}}">new directory</a></button>
            <button id="modifyBlog">modify name</button>
            <button class="editBlog"><a style="text-decoration: none" class="editBlogUrl"
                                        href="{{url('/blog/editBlog/')}}">edit blog</a></button>
            <div class="fileContent">
                <div class="cp_blogId" hidden></div>
                <div class="title">
                </div>
                <div class="content">
                </div>
            </div>

            <form class="form-horizontal" method="post" action="{{url('blog/storeBlog')}}" hidden>
                <div class="control-group" style="padding-bottom: 50px;">
                    <label class="control-label col-sm-1">标题</label>
                    <div class="controls col-sm-10">
                        <input id="title" name="title" value="" class="form-control" type="text"/>
                        <input id="blogId" name="blogId" value="" type="text" hidden/>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <input id="inputContent" name="inputContent" type="text" hidden/>
                        <div id="summernote">

                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="submit">提交</button>
                        </div>
                    </div>
                </div>
            </form>


            <form class="form-horizontal modifyName" method="post" action="{{url('blog/modifyName')}}" hidden>
                <div class="control-group" style="padding-bottom: 50px;">
                    <label class="control-label col-sm-2">新名称：</label>
                    <div class="controls col-sm-10">
                        <input id="title" name="title" value="" class="form-control" type="text"/>
                        <input id="modifyBlogId" name="modifyBlogId" value="" type="text" hidden/>
                    </div>
                </div>

                <div class="control-group">
                    <div class="control-group">
                        <div class="controls control-label col-sm-2">
                            <button type="submit" class="submit">提交</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>


<footer style=""></footer>

{{--baidu condensed or compressed version--}}
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>


{{--fancytree--}}
<script src='../js/jquery/jquery-1.12.1.min.js'></script>
<script src='../js/jquery/jquery-ui.min.js'></script>
<link rel="stylesheet" href='../css/bootstrap-3.3.6.min.css'>

<link href="{{asset('fancytree/dist/skin-bootstrap/ui.fancytree.css')}}" rel="stylesheet" class="skinswitcher">

<script src="{{asset('fancytree/dist/src/jquery.fancytree.js')}}"></script>
<script src="{{asset('fancytree/dist/src/jquery.fancytree.dnd.js')}}"></script>
<script src="{{asset('fancytree/dist/src/jquery.fancytree.edit.js')}}"></script>
<script src="{{asset('fancytree/dist/src/jquery.fancytree.glyph.js')}}"></script>
<script src="{{asset('fancytree/dist/src/jquery.fancytree.table.js')}}"></script>
<script src="{{asset('fancytree/dist/src/jquery.fancytree.wide.js')}}"></script>



{{--glyph fonts ,bootstrap and drag drop--}}
<script type="text/javascript">
    glyph_opts = {
        map: {
            doc: "glyphicon glyphicon-file",
            docOpen: "glyphicon glyphicon-file",
            checkbox: "glyphicon glyphicon-unchecked",
            checkboxSelected: "glyphicon glyphicon-check",
            checkboxUnknown: "glyphicon glyphicon-share",
            dragHelper: "glyphicon glyphicon-play",
            dropMarker: "glyphicon glyphicon-arrow-right",
            error: "glyphicon glyphicon-warning-sign",
            expanderClosed: "glyphicon glyphicon-menu-right",
            expanderLazy: "glyphicon glyphicon-menu-right",  // glyphicon-plus-sign
            expanderOpen: "glyphicon glyphicon-menu-down",  // glyphicon-collapse-down
            folder: "glyphicon glyphicon-folder-close",
            folderOpen: "glyphicon glyphicon-folder-open",
            loading: "glyphicon glyphicon-refresh glyphicon-spin"
        }
    };
    $(function () {
        // Initialize Fancytree
        $("#tree").fancytree({
            extensions: ["dnd", "edit", "glyph"],
            checkbox: true,
            dnd: {
                scroll: true,
                autoExpandMS: 400,
                focusOnClick: true,
                preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
                preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
                dragStart: function (node, data) {
                    /** This function MUST be defined to enable dragging for the tree.
                     *  Return false to cancel dragging of node.
                     */
                    return true;
                },
                dragEnter: function (node, data) {
                    /** data.otherNode may be null for non-fancytree droppables.
                     *  Return false to disallow dropping on node. In this case
                     *  dragOver and dragLeave are not called.
                     *  Return 'over', 'before, or 'after' to force a hitMode.
                     *  Return ['before', 'after'] to restrict available hitModes.
                     *  Any other return value will calc the hitMode from the cursor position.
                     */
                    // Prevent dropping a parent below another parent (only sort
                    // nodes under the same parent)
                    /*           if(node.parent !== data.otherNode.parent){
                     return false;
                     }
                     // Don't allow dropping *over* a node (would create a child)
                     return ["before", "after"];
                     */
                    return true;
                },
                dragExpand: function (node, data) {
                    // return false to prevent auto-expanding data.node on hover
                },
                dragOver: function (node, data) {
                },
                dragLeave: function (node, data) {
                },
                dragStop: function (node, data) {
                },
                dragDrop: function (node, data) {
                    /** This function MUST be defined to enable dropping of items on
                     *  the tree.
                     */
                    data.otherNode.moveTo(node, data.hitMode);
                    console.log(data);
                    console.log(node);

                    console.log(data.node.key);
                    console.log(data.otherNode.key);

                    $.ajax({
                        url: 'index.php',
                        type: 'POST',
                        data: {destination: data.node.key, node: data.otherNode.key},
                        dataType: 'json',
                        // cache:false,
                        async: true,
                        //  timeout:1000,
                        beforeSend: function () {
                        },
                        complete: function () {
                        },
                        success: function (data) {
                        },
                        error: function (xhr) {
                        },
                    });
                }
            },
            glyph: glyph_opts,
            selectMode: 2,
            source: {!! $tree !!},
            toggleEffect: {effect: "drop", options: {direction: "left"}, duration: 400},

            lazyLoad: function (event, data) {
                data.result = {url: "ajax-sub2.json", debugDelay: 1000};
            }
        });

    });
</script>

<script type="text/javascript">
    $(document).on('click', '.blogId', function () {
        var _that = $(this);
        var url = $(this).attr('href');

        var arr = url.split("?");
        var tmp = arr[1].split('&');
        var id = tmp[0].split('=');
        var modifyBlogId = id[1];

        var typeArr = tmp[1].split('=');
        var type = typeArr[1];
        $('#modifyBlogId').val(modifyBlogId);
        console.log($('#modifyBlogId').val());

        if (type == 2) { //这是目录
            //console.log(type);
            return false;
        }

        $.ajax({
            url: url,
            type: 'POST',
            //  data: {destination: data.node.key, node: data.otherNode.key },
            dataType: 'json',
            cache: false,
            async: true,
            timeout: 1000,
            beforeSend: function () {
            },
            complete: '',
            success: function (data) {
                console.log(data);
                var name = '<h3>';
                name += data.name;
                name += '<h3>';
                $('.title').html(name);
                $('.content').html(data.content);
                $('.cp_blogId').html(data.blogId);
                var blogUrl = $('.editBlogUrl').attr('href');
                blogUrl += '?blogId=';
                blogUrl += data.blogId;
                console.log('wmr');
                console.log(blogUrl);
                $('.editBlogUrl').attr('href', blogUrl);
            },
            error: function (data) {
                $('.content').html('文章不存在');
            },
        });
        return false;
    });


    $('#modifyBlog').on('click', function () {
        console.log('fdfdf');
        var modifyBlogId = $('#modifyBlogId').val();
        if (modifyBlogId) {
            $('.fileContent').hide();
            $('form.modifyName').show();
        } else {
            alert('请选择需要修改的文件或目录');
        }

    })

</script>

<link href="{{asset('summernote/summernote.css')}}" rel="stylesheet">
<script src="{{asset('summernote/summernote.min.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summe
        });
    });

    $('.editBlog').on('click', function () {
        // console.log('dsdsd');
        $('.fileContent').hide();
        $('form').show();
        $('#title').val($('.title').html());
        $('#summernote').innerHTML($('.content').html());
        console.log($('.content').html());
        $('#blogId').val($('.blogId').html());
    });

    $('.submit').on('click', function () {
        var inputContent = $('#summernote').summernote('code');
        $('#inputContent').attr('value', inputContent);

    });
</script>
</body>
</html>
