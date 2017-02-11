<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--baidu condensed or compressed version--}}
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
<!-- include summernote css/js-->
<!-- include libraries(jQuery, bootstrap) -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link href="{{asset('summernote/summernote.css')}}" rel="stylesheet">
<script src="{{asset('summernote/summernote.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>







</body>
</html>
