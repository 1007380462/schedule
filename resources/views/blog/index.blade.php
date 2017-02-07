<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/FontAwesome/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>Laravel</title>
    </head>

    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">

                <div class="container">
                    <div class="row">
                        <div class="span12">
                            {!! $text !!}
                        </div>
                    </div>



                </div>

            </div>

        </div>

        <aside id="sidebar" class="sticky" style="top: 20px;">
            <div class="inside">
                <button type="button" id="sidebar_fold">
                    <b>hit</b>
                </button>
                <div id="jstree_demo_div">
                </div>

                <div id="tree">

                </div>

                <div id="jstree_demo_div_instead" hidden>
                    <h6 style="margin-top: 0px; margin-bottom: 0px;">
                        <button type="button" id="sidebar_unfold">
                            <b>hit me</b>
                        </button>
                    </h6>
                </div>
            </div>
        </aside>


        {{--baidu condensed or compressed version--}}
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
        <script src="{{asset('js/stickySidebar/stickySidebar.js')}}"></script>
       <link rel="stylesheet" href="{{asset('css/stickySidebar/style.css')}}">
       {{--Side navigation http://www.htmleaf.com/jQuery/Menu-Navigation/201503011440.html--}}
        <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebar').stickySidebar();
            })
        </script>

       {{--put the title into the side navigation--}}
        <script type="text/javascript">
            var i = 0;
            var str = '';
            var s = null;
            while (1) {
                s = $(":header").eq(i).text();

                if (s == null) {
                    break;
                }
                if (typeof(s) == "undefined") {
                    break;
                }
                if (s == "") {
                    break;
                }

                str = str + '<a href="#' + i + '">' + s + '</a>';
                i++;
            }

            $('#jstree_demo_div').html(str);
        </script>

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
        <link href="{{asset('fancytree/dist/skin-win8/ui.fancytree.min.css')}}" rel="stylesheet">
        <script src="{{asset('fancytree/dist/jquery.fancytree-all.min.js')}}"></script>
        <script type="text/javascript">
            $(function(){
                // Create the tree inside the <div id="tree"> element.
                $("#tree").fancytree({
                    source:[
                        {title: "Node 1", key: "1"},
                        {title: "Folder 2", key: "2", folder: true, children: [
                            {title: "Node 2.1", key: "3"},
                            {title: "Node 2.2", key: "4"}
                        ]}
                    ],
                    checkbox:true,
                });
            });
        </script>

    </body>
</html>
