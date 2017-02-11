<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/FontAwesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/navbar-fixed-side.css')}}">

    <title>JT</title>
</head>

<body>

{{--use bootstrap nav  and navbar-fixed-side.css to implement a left side navigation bar  and the use fancytree to implement a tree structure --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-lg-2">
            <nav class="navbar navbar-default navbar-fixed-side">
                <div class="" style="position: fixed;height: 100% !important;">
                    <aside id="sidebar" class="sticky" style="top: 20px;height:100%">
                        <div class="inside" style="position:relative;width:220px;height:100%; overflow:auto;">

                            <div id="tree"></div>

                        </div>
                    </aside>
                </div>
                <!-- normal collapsible navbar markup -->
            </nav>
        </div>
        <div class="col-sm-9 col-lg-10">

            <div id="summernote">Hello Summernote</div>
        <!-- your page content -->
        </div>
    </div>
</div>

<footer style="">

</footer>

<!-- include summernote css/js-->
<link href="{{asset('summernote/summernote.css')}}" rel="stylesheet">
<script src="{{asset('summernote/summernote.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>

{{--baidu condensed or compressed version--}}
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>


<script type="text/javascript">

    $("#sidebar_fold").on('click', function () {
        $("#jstree_demo_div_instead").removeAttr('hidden');
        $("#jstree_demo_div").attr('hidden', 'true');
        $("#sidebar_fold").attr('hidden', 'true');
    });

    $("#sidebar_unfold").on('click', function () {
        $("#jstree_demo_div").removeAttr('hidden', 'true');
        $("#jstree_demo_div_instead").attr('hidden', 'true');
        $("#sidebar_fold").removeAttr('hidden');
    });
</script>


{{--fancytree--}}


<script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


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
    $(function(){
        // Initialize Fancytree
        $("#tree").fancytree({
            extensions: ["dnd", "edit", "glyph"],
            checkbox: true,
            dnd: {
                scroll:true,
                autoExpandMS: 400,
                focusOnClick: true,
                preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
                preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
                dragStart: function(node, data) {
                    /** This function MUST be defined to enable dragging for the tree.
                     *  Return false to cancel dragging of node.
                     */
                    return true;
                },
                dragEnter: function(node, data) {
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
                dragExpand: function(node, data) {
                    // return false to prevent auto-expanding data.node on hover
                },
                dragOver: function(node, data) {
                },
                dragLeave: function(node, data) {
                },
                dragStop: function(node, data) {
                },
                dragDrop: function(node, data) {
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
                        data: {destination: data.node.key, node: data.otherNode.key },
                        dataType: 'json',
                        // cache:false,
                        async:true,
                        //  timeout:1000,
                        beforeSend:function () {
                        },
                        complete:function () {
                        },
                        success:function (data) {
                        },
                        error:function (xhr) {
                        },
                    });
                }
            },
            glyph: glyph_opts,
            selectMode: 2,
            source: {!! $tree !!},
            toggleEffect: { effect: "drop", options: {direction: "left"}, duration: 400 },

            lazyLoad: function(event, data) {
                data.result = {url: "ajax-sub2.json", debugDelay: 1000};
            }
        });

    });
</script>

</body>
</html>
