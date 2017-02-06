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

                <h2>Title 1</h2>

                <p>Lorem ipsum enim a mi pulvinar aliquet.</p>

                <h2>Title 2</h2>

                <p>Lorem a sollicitudin tempor.  </p>

            </div>

        </aside>

    <script type="text/javascript">
        var text=$('h1').innerText();
        console.log()
    </script>
        {{--baidu condensed or compressed version--}}
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
        <script src="{{asset('js/stickySidebar/stickySidebar.js')}}"></script>
       <link rel="stylesheet" href="{{asset('css/stickySidebar/style.css')}}">

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebar').stickySidebar();
        })
    </script>

    </body>
</html>
