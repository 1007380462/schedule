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


</body>
</html>
