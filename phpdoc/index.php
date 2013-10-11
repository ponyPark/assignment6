<?php
    $ipaddress = substr((string)$_SERVER['REMOTE_ADDR'], 0,7);
    if($ipaddress != "129.119")
    {
        die("The phpapi documentation cannot be shown on non-SMU networks.");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta charset="utf-8"/>
    <title>API Documentation</title>
    <meta name="author" content=""/>
    <meta name="description" content=""/>

    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prism.css" rel="stylesheet" media="all"/>
    <link href="css/template.css" rel="stylesheet" media="all"/>
    
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="js/jquery.smooth-scroll.js"></script>
    <script src="js/prism.min.js"></script>
    <!-- TODO: Add http://jscrollpane.kelvinluck.com/ to style the scrollbars for browsers not using webkit-->
    
    <link rel="shortcut icon" href="images/favicon.ico"/>
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png"/>
</head>
<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <i class="icon-ellipsis-vertical"></i>
            </a>
            <a class="brand" href="index.html">API Documentation</a>

            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">
                            API Documentation <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                                                    </ul>
                    </li>
                    <li class="dropdown" id="charts-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Charts <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="graphs/class.html">
                                    <i class="icon-list-alt"></i>&#160;Class hierarchy diagram
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown" id="reports-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Reports <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="reports/errors.html">
                                    <i class="icon-list-alt"></i>&#160;Errors
                                </a>
                            </li>
                            <li>
                                <a href="reports/markers.html">
                                    <i class="icon-list-alt"></i>&#160;Markers
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--<div class="go_to_top">-->
    <!--<a href="#___" style="color: inherit">Back to top&#160;&#160;<i class="icon-upload icon-white"></i></a>-->
    <!--</div>-->
</div>

<div id="___" class="container-fluid">
        <section class="row-fluid">
        <div class="span2 sidebar">
                                <div class="accordion" style="margin-bottom: 0">
        <div class="accordion-group">
            <div class="accordion-heading">
                                    <a class="accordion-toggle " data-toggle="collapse" data-target="#namespace-1763043204"></a>
                                <a href="namespaces/default.html" style="margin-left: 30px; padding-left: 0">\</a>
            </div>
            <div id="namespace-1763043204" class="accordion-body collapse in">
                <div class="accordion-inner">

                    
                    <ul>
                                                                                                    <li class="class"><a href="classes/phpapi.html">phpapi</a></li>
                                            </ul>
                </div>
            </div>
        </div>
    </div>

        </div>
    </section>
    <section class="row-fluid">
        <div class="span10 offset2">
            <div class="row-fluid">
                <div class="span8 content namespace">
                    <nav>
                                                
                                            </nav>
                    <h1><small></small>\</h1>

                    
                    
                    
                                        <h2>Classes</h2>
                    <table class="table table-hover">
                                            <tr>
                            <td><a href="classes/phpapi.html">phpapi</a></td>
                            <td><em>Designed by BAM Software.</em></td>
                        </tr>
                                        </table>
                                    </div>

                <aside class="span4 detailsbar">
                    <dl>
                        <dt>Namespace hierarchy</dt>
                        <dd class="hierarchy">
                                                                                                                                                <div class="namespace-wrapper">\</div>
                        </dd>
                    </dl>
                </aside>
            </div>

            
            
        </div>
    </section>

    <footer class="row-fluid">
        <section class="span10 offset2">
            <section class="row-fluid">
                <section class="span10 offset1">
                    <section class="row-fluid footer-sections">
                        <section class="span4">
                                                        <h1><i class="icon-code"></i></h1>
                            <div>
                                <ul>
                                                                    </ul>
                            </div>
                        </section>
                        <section class="span4">
                                                        <h1><i class="icon-bar-chart"></i></h1>
                            <div>
                                <ul>
                                    <li><a href="">Class Hierarchy Diagram</a></li>
                                </ul>
                            </div>
                        </section>
                        <section class="span4">
                                                        <h1><i class="icon-pushpin"></i></h1>
                            <div>
                                <ul>
                                    <li><a href="">Errors</a></li>
                                    <li><a href="">Markers</a></li>
                                </ul>
                            </div>
                        </section>
                    </section>
                </section>
            </section>
            <section class="row-fluid">
                <section class="span10 offset1">
                    <hr />
                    Documentation is powered by <a href="http://www.phpdoc.org/">phpDocumentor </a> and authored
                    on October 9th, 2013 at 18:43.
                </section>
            </section>
        </section>
    </footer>
</div>

</body>
</html>