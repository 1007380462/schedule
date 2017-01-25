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

                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            {!! $text !!}
                        </div>
                    </div>
                </div>

            </div>

            <table class="table table-striped">
                <caption>条纹表格布局</caption>
                <thead>
                <tr>
                    <th>名称</th>
                    <th>城市</th>
                    <th>邮编</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Tanmay</td>
                    <td>Bangalore</td>
                    <td>560001</td>
                </tr>
                <tr>
                    <td>Sachin</td>
                    <td>Mumbai</td>
                    <td>400003</td>
                </tr>
                <tr>
                    <td>Uma</td>
                    <td>Pune</td>
                    <td>411027</td>
                </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
