<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Print Preview Example Page</title>
    <link rel="stylesheet" href="css/960.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
    <link rel="stylesheet" href="src/css/print-preview.css" type="text/css" media="screen">
    <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>
    <script src="src/jquery.print-preview.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function() {
            /*
             * Initialise example carousel
             */
            $("#feature > div").scrollable({interval: 2000}).autoscroll();
            
            /*
             * Initialise print preview plugin
             */
            // Add link for print preview and intialise
            $('#aside').prepend('<a class="print-preview">Print this page</a>');
            $('a.print-preview').printPreview();
            
            // Add keybinding (not recommended for production use)
            $(document).bind('keydown', function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code == 80 && !$('#print-modal').length) {
                    $.printPreview.loadPrintPreview();
                    return false;
                }            
            });
        });
    </script>
</head>
<body>                
<div id="header" class="container_12">
    <strong>Lorem ipsum dolor sit amet</strong>
</div>

<div id="content" class="container_12 clearfix">

    <div id="content-main" class="grid_8">
        <div id="feature">
        <div>
           <h2>HALLO THERE</h2>
         </div>  
        </div>
        

            <div id="aside" class="grid_3 push_1">

            </div>
</div>
</div>
</body>
</html>