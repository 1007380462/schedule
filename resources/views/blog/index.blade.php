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
                <div id="jstree_demo_div">

                </div>
                <h2>Title 1</h2>
                <p>Lorem ipsum enim a mi pulvinar aliquet.</p>
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

        {{--jstrss file https://www.jstree.com/--}}
        <link rel="{{asset('jsTree/dist/themes/default-dark/style.min.css')}}">
        <script src="{{asset('jsTree/jstree.min.js')}}"></script>
        <script type="text/javascript">
            $(function () {
                //create an instance when the dom is ready
                $('#jstree_demo_div').jstree();
                //bind to events triggered on the tree
                $('#jstree_demo_div').on("changed.jstree", function (e, data) {
                    console.log(data.selected);
                });
                //interact with the tree-either way is ok
                $('button').on('click', function () {
                    $('#jstree').jstree(true).select_node('child_node_1');
                    $('#jstree').jstree('select_node', 'child_node_1');
                    $.jstree.reference('#jstree').select_node('child_node_1');
                });
            });


        </script>

    </body>
</html>
