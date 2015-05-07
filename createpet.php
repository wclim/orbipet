<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description">
        <meta name="author"><!-- Le styles -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/chui-ios-3.5.2.css">
        <script src="js/chui-3.5.2.js"></script>
        <script>
            $(document).ready(function(){
                var data = $.get("data.sav");
                data.done(function(data, status){
                    $("#popupMessageTarget").on("webkitAnimationEnd", function() {
                        this.className = "";
                        this.textContent = "";
                    });
                    $.UIPopup({
                        id: "warning",
                        title: 'Save File detected!', 
                        message: 'Starting a new game will erase the current save file', 
                        continueButton: 'Got it!',
                    });
                    $("#test").html(data + ", " + status);
                })
            })
        </script>
        <style type="text/css">
            .glyphicon-chevron-left,glyphicon-chevron-right {
                position: absolute;
                top: 50%;
                z-index: 5;
                display: inline-block;
            }
        </style>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        </style><!-- HTML5 shim, for IE6-8 support of HTML5 elements --><!--[if lt IE 9]>
<script src="../assets/js/html5shiv.js"></script>
<![endif]--><!-- Fav and touch icons -->
        <link href="css/custom.css" rel="stylesheet" type="text/css">
        <script src="js/custom.js" type="text/javascript"></script>
    </head>
    <body style=";">
        <a href="index.html" class="btn btn-info btn-lg">
            <span class="glyphicon glyphicon-chevron-left"></span>Back
        </a>
        <div data-mercury="full" id="mercuryblock" style="overflow: visible;">
            <div class="container">
                <div class="masthead">
                    <h3 id="test"></h3>
                </div><!-- /container -->
            </div>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
        </body>
    </html>