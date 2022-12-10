<?php
session_start();
include('dbcontroller.php');
$db_handle = new DBController();
$sess_id = $_SESSION['sess_id'];

   // while($history){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<link rel="stylesheet" type="text/css" href="adminhomestyle.css"/>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login/css/main.css">
</head>
<body>
<div id="logo">
        <span class="big-logo">Shop Lite Admin</span>
        <span class="small-logo">Shop Lite Admin</span>
    </div>
    <div id="left-menu">
        <ul>
            <li class="active"><a href="#">
            <i class="las la-user"></i>
                            <span>Dashboard</span>
            </a></li>
            <li class="has-sub">
                <a href="#">
                    <i class="las la-coins"></i>
                    <span>Arrears</span>
                </a>
                <ul>
                    <li><a href="adminStudentArrears.php">Student Arrears</a></li>
                    <li><a href="otherPaymentSources.php">Others Payment sources</a></li>
                </ul>
            </li>
            <li><a href="adminViewHistory.php">
                <i class="las la-history"></i>
                <span>All Transaction History</span>
            </a></li>
            <li ><a href="adminadduser.php">
            <i class="las la-sign-out-alt"></i>
                            <span>Add User</span>
            </a></li>
            <li ><a href="logout.php">
            <i class="las la-sign-out-alt"></i>
                            <span>Logout</span>
            </a></li>
            

        </ul>
    </div>
    <div id="main-content">
        <div id="header">
            <div class="header-left float-left">
                <i id="toggle-left-menu" class="las la-bars"></i>
            </div>
            <div class="header-right float-right">
                <i class="ion-ios-people"></i>
            </div>
        </div>

        <div id="page-container">
            <div class="card">
                <div class="title">Number of transactions</div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Number of transactions</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Number of users</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    Yo
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                   Me
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    Hem
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="title">Number of users</div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>

    <span id="show-lable">Hello</span>
	<script>
        $('#toggle-left-menu').click(function() {
        if ($('#left-menu').hasClass('small-left-menu')) {
            $('#left-menu').removeClass('small-left-menu');
        } else {
            $('#left-menu').addClass('small-left-menu');
        }
        $('#logo').toggleClass('small-left-menu');
        $('#page-container').toggleClass('small-left-menu');
        $('#header .header-left').toggleClass('small-left-menu');

        $('#logo .big-logo').toggle('300');
        $('#logo .small-logo').toggle('300');
        $('#logo').toggleClass('p-0 pl-1');
    });

    $(document).on('mouseover', '#left-menu.small-left-menu > ul > li', function() {
        if (!$(this).hasClass('has-sub')) {
            var label = $(this).find('span').text();
            var position = $(this).position();
            $('#show-lable').css({
                'top': position.top + 79,
                'left': position.left + 59,
                'opacity': 1,
                'visibility': 'visible'
            });

            $('#show-lable').text(label);
        } else {
            var position = $(this).position();
            $(this).find('ul').addClass('open');

            if ($(this).find('ul').hasClass('open')) {
                const height = 47;
                var count_submenu_li = $(this).find('ul > li').length;
                if (position.top >= 580) {
                    var style = {
                        'top': (position.top + 100) - (height * count_submenu_li),
                        'height': height * count_submenu_li + 'px'
                    }
                    $(this).find('ul.open').css(style);
                } else {
                    var style = {
                        'top': position.top + 79,
                        'height': height * count_submenu_li + 'px'
                    }

                    $(this).find('ul.open').css(style);
                }

            }
        }

    });

    $(document).on('mouseout', '#left-menu.small-left-menu li a', function(e) {
        $('#show-lable').css({
            'opacity': 0,
            'visibility': 'hidden'
        });
    });

    $(document).on('mouseout', '#left-menu.small-left-menu li.has-sub', function(e) {
        $(this).find('ul').css({
            'height': 0,
        });
    });

    $(window).resize(function() {
        windowResize();
    });

    $(window).on('load', function() {
        windowResize();
    });

    $('#left-menu li.has-sub > a').click(function() {
        var _this = $(this).parent();

        _this.find('ul').toggleClass('open');
        $(this).closest('li').toggleClass('rotate');

        _this.closest('#left-menu').find('.open').not(_this.find('ul')).removeClass('open');
        _this.closest('#left-menu').find('.rotate').not($(this).closest('li')).removeClass('rotate');
        _this.closest('#left-menu').find('ul').css('height', 0);

        if (_this.find('ul').hasClass('open')) {
            const height = 47;
            var count_submenu_li = _this.find('ul > li').length;
            _this.find('ul').css('height', height * count_submenu_li + 'px');
        }
    });


    function windowResize() {
        var width = $(window).width();
        if (width <= 992) {
            $('#left-menu').addClass('small-left-menu');
            $('#logo').addClass('small-left-menu p-0 pl-1');
        } else {
            $('#left-menu').removeClass('small-left-menu');
            $('#logo').removeClass('small-left-menu p-0 pl-1');
        }
    }
    </script>

</body>
</html>