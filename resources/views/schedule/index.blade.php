<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Coopbee | Calendar</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../adminLTE-2.3.6/bootstrap/css/bootstrap.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="../adminLTE-2.3.6/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="../adminLTE-2.3.6/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="../adminLTE-2.3.6/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Theme style -->
    <link rel="stylesheet" href="../adminLTE-2.3.6/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../adminLTE-2.3.6/dist/css/skins/_all-skins.min.css">
     <!--layer css-->

</head>

<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper" style="min-height: 231px; margin-left: 0px;">
        <section class="content-header">
            <h1>
                日程表
                <small>日程表</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Calendar</li>
            </ol>
        </section>
        <button type="button" class="goodsClass" hidden>sdsd</button>
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h4 class="box-title">Draggable Events</h4>
                        </div>
                        <div class="box-body">
                            <!-- the events -->
                            <div id="external-events">
                                <div class="external-event bg-green ui-draggable ui-draggable-handle"
                                     style="position: relative;padding-top: 20px;"></div>
                                <div class="external-event bg-yellow ui-draggable ui-draggable-handle"
                                     style="position: relative;padding-top: 20px;"></div>
                                <div class="external-event bg-aqua ui-draggable ui-draggable-handle"
                                     style="position: relative;padding-top: 20px;"></div>
                                <div class="external-event bg-light-blue ui-draggable ui-draggable-handle"
                                     style="position: relative;padding-top: 20px;"></div>
                                <div class="external-event bg-red ui-draggable ui-draggable-handle"
                                     style="position: relative;padding-top: 20px;"></div>
                                <div class="checkbox" style="display: none">
                                    <label for="drop-remove">
                                        <input type="checkbox" id="drop-remove">
                                        remove after drop
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                    <div class="box box-solid" style="display: none;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Event</h3>
                        </div>
                        <div class="box-body">
                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                <ul class="fc-color-picker" id="color-chooser">
                                    <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                                </ul>
                            </div>
                            <!-- /btn-group -->
                            <div class="input-group">
                                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                <div class="input-group-btn">
                                    <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add
                                    </button>
                                </div>
                                <!-- /btn-group -->
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <div id="calendar" class="fc fc-ltr fc-unthemed">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

</div>

<!-- jQuery 2.2.3 -->
<script src="../adminLTE-2.3.6/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../adminLTE-2.3.6/bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<script src="../adminLTE-2.3.6//jquery-ui.min.js"></script>

<!-- Slimscroll -->
<script src="../adminLTE-2.3.6/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../adminLTE-2.3.6/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../adminLTE-2.3.6/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../adminLTE-2.3.6/dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../adminLTE-2.3.6/moment.min.js"></script>
<script src="../adminLTE-2.3.6/plugins/fullcalendar/fullcalendar.min.js"></script>

<!--layer-->
<script type="text/javascript" src="../layui/layui.js"></script>
<link href="../layui/layui.css">
<script type="text/javascript">
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate();
    });
</script>



<!-- Page specific script -->
<script>
    $(function () {
        var dada=new Date(y, m, d, h, min, sec, ms);
        var ttttt=dada.getDate();
     console.log(ttttt);
       // console.log(new Date(y,m,d-5));
        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }

        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
            selectable:true,

            dayClick: function(date, jsEvent, view) {
                return false;
                console.log($(this));
                console.log(date);
                console.log(jsEvent);
                console.log(view);

                var _that=$(this);
                layui.use('layer', function(){
                    var layer = layui.layer;
                    window.wmr=_that;
                    var planRecord='<a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#00a65a;border-color:#00a65a">' +
                                  '<div class="fc-content">' +
                                 '<span class="fc-time">7p</span>' +
                                 '<span class="fc-title">wwwwwwwwwwwwwwwwwwwwwwwwwwwww</span></div></a>';
                    _that.html(planRecord);
                    var colorChoose='<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#00c0ef;background-color:#00c0ef;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#0073b7;background-color:#0073b7;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#3c8dbc;background-color:#3c8dbc;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#39cccc;background-color:#39cccc;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#f39c12;background-color:#f39c12;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#ff851b;background-color:#ff851b;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#00a65a;background-color:#00a65a;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#01ff70;background-color:#01ff70;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#dd4b39;background-color:#dd4b39;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#605ca8;background-color:#605ca8;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#f012be;background-color:#f012be;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#777;background-color:#777;width: 20px;height: 20px;"></button>' +
                            '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#001f3f;background-color:#001f3f;width: 20px;height: 20px;"></button>';

                    var preview='<a class="">' +
                            '<div class="content" >' +
                            '<span hidden class="time" style="color: #fff;border-color:#00c0ef;background-color:#00c0ef;">12a</span>' +
                            '<span class="title" style="color: #fff;border-color:#00c0ef;background-color:#00c0ef;">All Day Event</span>' +
                            '</div></a>';

                    layer.open({
                        type: 1 //Page层类型
                        ,area: ['500px', '300px']
                        ,title: '编辑分类'
                        ,shade: 0.6 //遮罩透明度
                        ,maxmin: true //允许全屏最小化
                        ,anim: 1 //0-6的动画形式，-1不开启
                        ,content: '<input class="planContent" value="sss">' +
                        '<input class="layui-input" placeholder="日期" ' +
                        'onclick="layui.laydate({elem: this, istime: true, format:'+ "'"+'YYYY-MM-DD hh:mm:ss'+"'"+'})">' +
                        '<button type="button" class="modify">添加</button>'+colorChoose+preview+
                        '<script>$(".colorRender").on("click",function() {var color=$(this).css("background-color");' +
                        'var inputValue=$(".planContent").val();$(".title").html(inputValue);' +
                        '$(".title").css("background-color",color);$(".title").css("border-color",color);});' +
                        '$(".modify").on("click",function() {var modifyContent=$(".planContent").val();' +
                        'var time=$(".layui-input").val();console.log(time);window.wmr.find("span.fc-title").html(modifyContent)});' +
                        '<\/script>',
                    });
                });
                console.log("single click");
              //alert('single click');
            },

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },

            timezone:'local',

            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            //Random default events
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    backgroundColor: "#f56954", //red
                    borderColor: "#f56954" //red
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: "#f39c12", //yellow
                    borderColor: "#f39c12" //yellow
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    backgroundColor: "#0073b7", //Blue
                    borderColor: "#0073b7" //Blue
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    backgroundColor: "#00c0ef", //Info (aqua)
                    borderColor: "#00c0ef" //Info (aqua)
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    backgroundColor: "#00a65a", //Success (green)
                    borderColor: "#00a65a" //Success (green)
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                  //url: 'http://google.com/',
                    backgroundColor: "#3c8dbc", //Primary (light-blue)
                    borderColor: "#3c8dbc" //Primary (light-blue)
                }
            ],

            eventClick: function(event) {
                /*动态进行添加日程数据的添加*/
                var ar=[{
                    title: 'Meeting-two',
                    start: new Date(y, m, d, 11, 30),
                    allDay: false,
                    backgroundColor: "#0073b7", //Blue
                    borderColor: "#0073b7" //Blue
                }];
                $('#calendar').fullCalendar("addEventSource",ar);


                /*
                * <a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable"
                * style="background-color:#00a65a;border-color:#00a65a">
                * <div class="fc-content">
                * <span class="fc-time">7p</span>
                * <span class="fc-title">Birthday Party</span>
                * </div>
                * </a>
                * */

                var _that=$(this);
               // console.log($(this).find("span.fc-title").html());
               // console.log($(this).find("span.fc-time").html());
               // console.log(event);

                var text=event.title;
                var backgroundColor=event.backgroundColor;
                var borderColor=event.borderColor;
                var contentTime=_that.find("span.fc-time").html();
                var content=_that.find("span.fc-title").html();

                layui.use('layer', function(){
                    var layer = layui.layer;
                    window.wmr=_that;
                   var colorChoose='<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#00c0ef;background-color:#00c0ef;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#0073b7;background-color:#0073b7;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#3c8dbc;background-color:#3c8dbc;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#39cccc;background-color:#39cccc;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#f39c12;background-color:#f39c12;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#ff851b;background-color:#ff851b;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#00a65a;background-color:#00a65a;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#01ff70;background-color:#01ff70;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#dd4b39;background-color:#dd4b39;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#605ca8;background-color:#605ca8;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#f012be;background-color:#f012be;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#777;background-color:#777;width: 20px;height: 20px;"></button>' +
                           '<button type="button" class="colorRender btn btn-default" style="margin-right: 3px;margin-left: 3px;border-color:#001f3f;background-color:#001f3f;width: 20px;height: 20px;"></button>';
                    colorChoose='';

                    var preview='<a class="">' +
                            '<div class="content" >' +
                            '<span hidden class="time" style="color: #fff;border-color:#00c0ef;background-color:#00c0ef;">12a</span>' +
                            '<span class="title" style="color: #fff;border-color:#00c0ef;background-color:#00c0ef;">All Day Event</span>' +
                            '</div></a>';
                        preview='';

                    layer.open({
                        type: 1    //Page层类型
                        ,area: ['500px', '300px']
                        ,title: '编辑分类'
                        ,shade: 0.6     //遮罩透明度
                        ,maxmin: true  //允许全屏最小化
                        ,anim: 1       //0-6的动画形式，-1不开启
                        ,content: '<input class="planContent" value="sss">' +
                        '<input hidden class="layui-input" placeholder="日期" ' +
                        'onclick="layui.laydate({elem: this, istime: true, format:'+ "'"+'YYYY-MM-DD hh:mm:ss'+"'"+'})">' +
                        '<a class="modify layui-layer-close layui-layer-close1" href="javascript:;">添加</a>'+colorChoose+preview+
                        '<script>$(".colorRender").on("click",function() {var color=$(this).css("background-color");' +
                        'var inputValue=$(".planContent").val();$(".title").html(inputValue);' +
                        '$(".title").css("background-color",color);$(".title").css("border-color",color);});' +
                        '$(".modify").on("click",function() {var modifyContent=$(".planContent").val();' +
                        'var time=$(".layui-input").val();window.wmr.find("span.fc-title").html(modifyContent)});' +
                        '<\/script>',
                    });
                });

                if (event.url) {
                    return false;
                    window.open(event.url);
                    return false;
                }
            },

            eventMouseover: function(event) {
                // alert('eventMouseover');
                if (event.url) {
                  //  alert(event.url);return false;
                    window.open(event.url);
                    return false;
                }
            },

            eventMouseout: function(event) {
                // alert('eventMouseout');
                if (event.url) {
                  //  alert(event.url);return false;
                    window.open(event.url);
                    return false;
                }
            },

            eventDragStart:function( event, jsEvent, ui, view ) {
                console.log('this is event drag start');
                console.log(event);
                //alert('eventDragStart');
            },

            eventDragStop:function( event, jsEvent, ui, view ) {
                console.log(event);
                console.log('this is drag stop');
                //alert('eventDragStop');
            },

            eventDrop:function( event, delta, revertFunc, jsEvent, ui, view ) {
                //console.log(event.start.format('YYYY-MM-DD hh:mm:ss'));
                var startTime=event.start.format('YYYY-MM-DD hh:mm:ss');
                var defaultDuration = moment.duration($('#calendar').fullCalendar('option', 'defaultTimedEventDuration')); // get the default and convert it to proper type
                var end = event.end || event.start.clone().add(defaultDuration); // If there is no end, compute it，默认时间区间是两小时
                //console.log('end is ' + end.format('YYYY-MM-DD hh:mm:ss'));
                var endTime=end.format('YYYY-MM-DD hh:mm:ss');
                //alert('eventDrop');
            },

            eventResizeStart:function( event, jsEvent, ui, view ) {
               // alert('eventResizeStart');
            },
            eventResizeStop:function( event, jsEvent, ui, view ) {
                /*获取移动前的开始时间和结束时间*/
               console.log('eventResizeStop');
                console.log(event);
                console.log(event.start);
                var startTime=moment(event.start["_d"]).format('YYYY-MM-DD hh:mm:ss');
                console.log('this is starttime'+startTime);
                //event.end || event.start.clone().add(defaultDuration);
                var endTime='';  //移动之前的结束时间
                if(event.end==null){
                    //var defaultDuration = moment.duration($('#calendar').fullCalendar('option', 'defaultTimedEventDuration'));
                    //endTime=event.start.clone().add(defaultDuration);
                    endTime='';
                }else{
                    endTime=moment(event.end["_d"]).format('YYYY-MM-DD hh:mm:ss');
                }
                console.log('this is endTime'+endTime);
               // alert('eventResizeStop');
            },
            eventResize:function( event, delta, revertFunc, jsEvent, ui, view ) {
                /*获取移动后的开始时间和结束时间*/
                console.log(event);
                var startTime=moment(event.start["_d"]).format('YYYY-MM-DD hh:mm:ss');
                console.log(startTime);
                var endTime=moment(event.end["_d"]).format('YYYY-MM-DD hh:mm:ss'); //移动之前的结束时间
                console.log(endTime);
                console.log(delta);
                console.log('eventResize');
               // alert('eventResize');
            },
            eventReceive:function( event ) {
               // alert('fdfsd');
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped
                console.log(this);
                console.log(date);
                console.log(allDay);
               // alert('drop');
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("border-color");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            }
        });



        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
            e.preventDefault();
            //Get value and make sure it is not null
            var val = $("#new-event").val();
            if (val.length == 0) {
                return;
            }

            //Create events
            var event = $("<div />");
            event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
            event.html(val);
            $('#external-events').prepend(event);

            //Add draggable funtionality
            ini_events(event);

            //Remove event from text input
            $("#new-event").val("");
        });
    });
</script>



<div hidden role="log" aria-live="assertive" aria-relevant="additions" class="ui-helper-hidden-accessible"></div>
</body>
</html>