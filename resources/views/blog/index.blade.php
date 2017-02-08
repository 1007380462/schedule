<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/FontAwesome/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>JT</title>
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

        <footer style="height: 200px">

        </footer>

        {{--baidu condensed or compressed version--}}
        <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>

       {{--Side navigation http://www.htmleaf.com/jQuery/Menu-Navigation/201503011440.html--}}
        <script src="{{asset('js/stickySidebar/stickySidebar.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/stickySidebar/style.css')}}">
        <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebar').stickySidebar({
                    footerThreshold: 200,
                });
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
<!--
        <link href="{{asset('fancytree/dist/skin-lion/ui.fancytree.min.css')}}" rel="stylesheet">
        <script src="{{asset('fancytree/dist/jquery.fancytree-all.min.js')}}"></script>
        <script src="{{asset('fancytree/dist/src/jquery.fancytree.glyph.js')}}"></script>

      <script src="{{asset('fancytree/dist/src/jquery.fancytree.js')}}"></script>
      <script src="{{asset('fancytree/dist/src/jquery.fancytree.dnd.js')}}"></script>
     <script src="{{asset('fancytree/dist/src/jquery.fancytree.edit.js')}}"></script>
-->

  <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <!--
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
-->

  <link href="{{asset('fancytree/dist/skin-bootstrap/ui.fancytree.css')}}" rel="stylesheet" class="skinswitcher">

  <script src="{{asset('fancytree/dist/src/jquery.fancytree.js')}}"></script>
  <script src="{{asset('fancytree/dist/src/jquery.fancytree.dnd.js')}}"></script>
  <script src="{{asset('fancytree/dist/src/jquery.fancytree.edit.js')}}"></script>
  <script src="{{asset('fancytree/dist/src/jquery.fancytree.glyph.js')}}"></script>
  <script src="{{asset('fancytree/dist/src/jquery.fancytree.table.js')}}"></script>
  <script src="{{asset('fancytree/dist/src/jquery.fancytree.wide.js')}}"></script>

<!--
        <script type="text/javascript">
            $(function(){
                // Create the tree inside the <div id="tree"> element.
                $("#tree").fancytree({
                    extensions: ["dnd", "edit"],
                    source:[
                        {title: "Node 1", key: "1"},
                        {title: "Folder 2", key: "2", folder: true, children: [
                            {title: "Node 2.1", key: "3"},
                            {title: "Node 2.2", key: "4"}
                        ]}
                    ],
                    checkbox:true,

                    dnd: {
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
        dragDrop: function(node, data) {
          /** This function MUST be defined to enable dropping of items on
           *  the tree.
           */
          data.otherNode.moveTo(node, data.hitMode);
        }
      },
                    activate: function (event, data) {
                       // alert("activate " + data.node);
                    },
                   lazyLoad: function(event, data) {
                    data.result = {url: "ajax-sub2.json"}
                  }

                });
            });
        </script>

-->
 <!--
 {{--glyph fonts and bootstrap--}}
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
      extensions: ["dnd", "edit", "glyph", "wide"],
      checkbox: true,
      dnd: {
        focusOnClick: true,
        dragStart: function(node, data) { return true; },
        dragEnter: function(node, data) { return false; },
        dragDrop: function(node, data) { data.otherNode.copyTo(node, data.hitMode); }
      },
      glyph: glyph_opts,
      selectMode: 2,
      source:[
                        {title: "Node 1", key: "1"},
                        {title: "Folder 2", key: "2", folder: true, children: [
                            {title: "Node 2.1", key: "3"},
                            {title: "Node 2.2", key: "4"}
                        ]}
                    ],
      toggleEffect: { effect: "drop", options: {direction: "left"}, duration: 400 },
      wide: {
        iconWidth: "1em",     // Adjust this if @fancy-icon-width != "16px"
        iconSpacing: "0.5em", // Adjust this if @fancy-icon-spacing != "3px"
        levelOfs: "1.5em"     // Adjust this if ul padding != "16px"
      },

      icon: function(event, data){
        // if( data.node.isFolder() ) {
        //   return "glyphicon glyphicon-book";
        // }
      },
      lazyLoad: function(event, data) {
        data.result = {url: "ajax-sub2.json", debugDelay: 1000};
      }
    });

  });
</script>
-->

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
                    source:[
                        {title: "Node 1", key: "1"},
                        {title: "Folder 2", key: "2", folder: true, children: [
                            {title: "Node 2.1", key: "3"},
                            {title: "Node 2.2", key: "4"}
                        ]}
                    ],
                    toggleEffect: { effect: "drop", options: {direction: "left"}, duration: 400 },

                    lazyLoad: function(event, data) {
                        data.result = {url: "ajax-sub2.json", debugDelay: 1000};
                    }
                });

            });
        </script>

    </body>
</html>
