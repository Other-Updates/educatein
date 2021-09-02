<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <title>Edugatein - Record Management System | <?php echo $title; ?></title>
        <meta name="resource-type" content="document" />
        <meta name="robots" content="all, index, follow"/>
        <meta name="googlebot" content="all, index, follow" />

        <link rel="icon" type="image/png" href="<?php echo base_url('assets/front/images/favicon.ico'); ?>"/>
        <?php
        /** -- Copy from here -- */
        if (!empty($meta))
            foreach ($meta as $name => $content) {
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
            }
        echo "\n";
        ?>

        <!-- Le styles -->  <!-- Bootstrap CSS -->       
        <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/bootstrap.min.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/custom.css'); ?>" >
        <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/bootstrap-icons.css'); ?>" >


        <!--<link rel="stylesheet" href="<?php // echo base_url('assets/admin/fontawesome-free-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css');      ?>" >-->
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
        <script src="<?php echo base_url('assets/admin/js/jquery-3.3.1.min.js'); ?>"></script>               
        <script src="<?php echo base_url('assets/admin/js/popper.min.js'); ?>" ></script>
        <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js'); ?>" ></script>
        <script src="<?php echo base_url('assets/admin/js/jquery.validate.min.js'); ?>" ></script>     
        <script src="<?php echo base_url('assets/admin/js/additional-methods.min.js'); ?>" ></script> 
        <link href="<?php echo base_url('assets/admin/chosen_v1.8.3/chosen.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('assets/admin/chosen_v1.8.3/chosen.jquery.min.js'); ?>" type="text/javascript"></script>
        <link href="<?php echo base_url('assets/admin/jquery-ui-1.12.1/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/admin/jquery-ui-1.12.1/jquery-ui.theme.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url('assets/admin/jquery-ui-1.12.1/jquery-ui.min.js'); ?>" type="text/javascript"></script>
        <link type='text/css' rel='stylesheet' href='<?php echo base_url('assets/admin/css/jquery-ui-timepicker-addon.css'); ?>' />
        <script src="<?php echo base_url('assets/admin/js/jquery-ui-timepicker-addon.js'); ?>" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/admin/chart/chart.bundle.min.js'); ?>"></script>
        <!--<script src="<?php echo base_url('assets/admin/moment/moment.js'); ?>"></script>-->       
        <?php
        if (!empty($canonical)) {
            echo "\n\t\t";
            ?><link rel="canonical" href="<?php echo $canonical ?>" /><?php
        }
        echo "\n\t";

        foreach ($css as $file) {
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";

        foreach ($js as $file) {
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";

        /** -- to here -- */
        ?>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <style>

            * {
                margin: 0;
            }
            html {
                position: relative;
                min-height: 100%;
            }
            

            .error
            { color: red; font-size: 12px}
            .error_input{
                border:  1px solid red !important;
            }
            .dropdown-item:focus, .dropdown-item:hover {
                background-color: #343a40;
                color: white;
            }
            .chosen-select {
                width: 100% !important;
            }
            .chosen-select-deselect {
                width: 100%;
            }
            .chosen-container {
                display: inline-block;
                font-size: 14px;
                position: relative;
                vertical-align: middle;
                width: 100% !important;
            }
            .chosen-container .chosen-drop {
                background: #ffffff;
                border: 1px solid #cccccc;
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
                -webkit-box-shadow: 0 8px 8px rgba(0, 0, 0, .25);
                box-shadow: 0 8px 8px rgba(0, 0, 0, .25);
                margin-top: -1px;
                position: absolute;
                top: 100%;
                left: -9000px;
                z-index: 1060;
            }
            .chosen-container.chosen-with-drop .chosen-drop {
                left: 0;
                right: 0;
            }
            .chosen-container .chosen-results {
                color: #555555;
                margin: 0 4px 4px 0;
                max-height: 240px;
                padding: 0 0 0 4px;
                position: relative;
                overflow-x: hidden;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
            .chosen-container .chosen-results li {
                display: none;
                line-height: 1.42857143;
                list-style: none;
                margin: 0;
                padding: 5px 6px;
            }
            .chosen-container .chosen-results li em {
                background: #feffde;
                font-style: normal;
            }
            .chosen-container .chosen-results li.group-result {
                display: list-item;
                cursor: default;
                color: #999;
                font-weight: bold;
            }
            .chosen-container .chosen-results li.group-option {
                padding-left: 15px;
            }
            .chosen-container .chosen-results li.active-result {
                cursor: pointer;
                display: list-item;
            }
            .chosen-container .chosen-results li.highlighted {
                background-color: #428bca;
                background-image: none;
                color: white;
            }
            .chosen-container .chosen-results li.highlighted em {
                background: transparent;
            }
            .chosen-container .chosen-results li.disabled-result {
                display: list-item;
                color: #777777;
            }
            .chosen-container .chosen-results .no-results {
                background: #eeeeee;
                display: list-item;
            }
            .chosen-container .chosen-results-scroll {
                background: white;
                margin: 0 4px;
                position: absolute;
                text-align: center;
                width: 321px;
                z-index: 1;
            }
            .chosen-container .chosen-results-scroll span {
                display: inline-block;
                height: 1.42857143;
                text-indent: -5000px;
                width: 9px;
            }
            .chosen-container .chosen-results-scroll-down {
                bottom: 0;
            }
            .chosen-container .chosen-results-scroll-down span {
                background: url("") no-repeat -4px -3px;
            }
            .chosen-container .chosen-results-scroll-up span {
                background: url("<?php echo base_url("/assets/admin/chosen_v1.8.3/chosen-sprite.png"); ?>") no-repeat -22px -3px;
            }
            .chosen-container-single .chosen-single {
                background-color: #ffffff;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                border: 1px solid #cccccc;
                border-top-right-radius: 4px;
                border-top-left-radius: 4px;
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                color: #555555;
                display: block;
                height: 39px;
                overflow: hidden;
                line-height: 34px;
                padding: 2px 0 0 13px;
                position: relative;
                text-decoration: none;
                white-space: nowrap;
            }
            .chosen-container-single .chosen-single span {
                display: block;
                margin-right: 26px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .chosen-container-single .chosen-single abbr {
                background: url("<?php echo base_url("/assets/admin/chosen_v1.8.3/chosen-sprite.png"); ?>") right top no-repeat;
                display: block;
                font-size: 1px;
                height: 10px;
                position: absolute;
                right: 26px;
                top: 12px;
                width: 12px;
            }
            .chosen-container-single .chosen-single abbr:hover {
                background-position: right -11px;
            }
            .chosen-container-single .chosen-single.chosen-disabled .chosen-single abbr:hover {
                background-position: right 2px;
            }
            .chosen-container-single .chosen-single div {
                display: block;
                height: 100%;
                position: absolute;
                top: 0;
                right: 0;
                width: 18px;
            }
            .chosen-container-single .chosen-single div b {
                background: url("<?php echo base_url("/assets/admin/chosen_v1.8.3/chosen-sprite.png"); ?>") no-repeat 0 7px;
                display: block;
                height: 100%;
                width: 100%;
            }
            .chosen-container-single .chosen-default {
                color: #777777;
            }
            .chosen-container-single .chosen-search {
                margin: 0;
                padding: 3px 4px;
                position: relative;
                white-space: nowrap;
                z-index: 1000;
            }
            .chosen-container-single .chosen-search input[type="text"] {
                background: url("<?php echo base_url("/assets/admin/chosen_v1.8.3/chosen-sprite.png"); ?>") no-repeat 100% -20px, #ffffff;
                border: 1px solid #cccccc;
                border-top-right-radius: 4px;
                border-top-left-radius: 4px;
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                margin: 1px 0;
                padding: 4px 20px 4px 4px;
                width: 100%;
            }
            .chosen-container-single .chosen-drop {
                margin-top: -1px;
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
            }
            .chosen-container-single-nosearch .chosen-search input {
                position: absolute;
                left: -9000px;
            }
            .chosen-container-multi .chosen-choices {
                background-color: #ffffff;
                border: 1px solid #cccccc;
                border-top-right-radius: 4px;
                border-top-left-radius: 4px;
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                cursor: text;
                height: auto !important;
                height: 1%;
                margin: 0;
                overflow: hidden;
                padding: 0;
                position: relative;
            }
            .chosen-container-multi .chosen-choices li {
                float: left;
                list-style: none;
            }
            .chosen-container-multi .chosen-choices .search-field {
                margin: 0;
                padding: 0;
                white-space: nowrap;
            }
            .chosen-container-multi .chosen-choices .search-field input[type="text"] {
                background: transparent !important;
                border: 0 !important;
                -webkit-box-shadow: none;
                box-shadow: none;
                color: #555555;
                height: 32px;
                margin: 0;
                padding: 4px;
                outline: 0;
            }
            .chosen-container-multi .chosen-choices .search-field .default {
                color: #999;
            }
            .chosen-container-multi .chosen-choices .search-choice {
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                background-color: #eeeeee;
                border: 1px solid #cccccc;
                border-top-right-radius: 4px;
                border-top-left-radius: 4px;
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
                background-image: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
                background-image: -o-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
                background-image: linear-gradient(to bottom, #ffffff 0%, #eeeeee 100%);
                background-repeat: repeat-x;
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffeeeeee', GradientType=0);
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                color: #333333;
                cursor: default;
                line-height: 13px;
                margin: 6px 0 3px 5px;
                padding: 3px 20px 3px 5px;
                position: relative;
            }
            .chosen-container-multi .chosen-choices .search-choice .search-choice-close {
                background: url("<?php echo base_url("/assets/admin/chosen_v1.8.3/chosen-sprite.png"); ?>") right top no-repeat;
                display: block;
                font-size: 1px;
                height: 10px;
                position: absolute;
                right: 4px;
                top: 5px;
                width: 12px;
                cursor: pointer;
            }
            .chosen-container-multi .chosen-choices .search-choice .search-choice-close:hover {
                background-position: right -11px;
            }
            .chosen-container-multi .chosen-choices .search-choice-focus {
                background: #d4d4d4;
            }
            .chosen-container-multi .chosen-choices .search-choice-focus .search-choice-close {
                background-position: right -11px;
            }
            .chosen-container-multi .chosen-results {
                margin: 0 0 0 0;
                padding: 0;
            }
            .chosen-container-multi .chosen-drop .result-selected {
                display: none;
            }
            .chosen-container-active .chosen-single {
                border: 1px solid #66afe9;
                -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
                box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
                -webkit-transition: border linear .2s, box-shadow linear .2s;
                -o-transition: border linear .2s, box-shadow linear .2s;
                transition: border linear .2s, box-shadow linear .2s;
            }
            .chosen-container-active.chosen-with-drop .chosen-single {
                background-color: #ffffff;
                border: 1px solid #66afe9;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
                -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
                box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
                -webkit-transition: border linear .2s, box-shadow linear .2s;
                -o-transition: border linear .2s, box-shadow linear .2s;
                transition: border linear .2s, box-shadow linear .2s;
            }
            .chosen-container-active.chosen-with-drop .chosen-single div {
                background: transparent;
                border-left: none;
            }
            .chosen-container-active.chosen-with-drop .chosen-single div b {
                background-position: -18px 7px;
            }
            .chosen-container-active .chosen-choices {
                border: 1px solid #66afe9;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
                -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
                box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
                -webkit-transition: border linear .2s, box-shadow linear .2s;
                -o-transition: border linear .2s, box-shadow linear .2s;
                transition: border linear .2s, box-shadow linear .2s;
            }
            .chosen-container-active .chosen-choices .search-field input[type="text"] {
                color: #111 !important;
            }
            .chosen-container-active.chosen-with-drop .chosen-choices {
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .chosen-disabled {
                cursor: default;
                opacity: 0.5 !important;
            }
            .chosen-disabled .chosen-single {
                cursor: default;
            }
            .chosen-disabled .chosen-choices .search-choice .search-choice-close {
                cursor: default;
            }
            .chosen-rtl {
                text-align: right;
            }
            .chosen-rtl .chosen-single {
                padding: 0 8px 0 0;
                overflow: visible;
            }
            .chosen-rtl .chosen-single span {
                margin-left: 26px;
                margin-right: 0;
                direction: rtl;
            }
            .chosen-rtl .chosen-single div {
                left: 7px;
                right: auto;
            }
            .chosen-rtl .chosen-single abbr {
                left: 26px;
                right: auto;
            }
            .chosen-rtl .chosen-choices .search-field input[type="text"] {
                direction: rtl;
            }
            .chosen-rtl .chosen-choices li {
                float: right;
            }
            .chosen-rtl .chosen-choices .search-choice {
                margin: 6px 5px 3px 0;
                padding: 3px 5px 3px 19px;
            }
            .chosen-rtl .chosen-choices .search-choice .search-choice-close {
                background-position: right top;
                left: 4px;
                right: auto;
            }
            .chosen-rtl.chosen-container-single .chosen-results {
                margin: 0 0 4px 4px;
                padding: 0 4px 0 0;
            }
            .chosen-rtl .chosen-results .group-option {
                padding-left: 0;
                padding-right: 15px;
            }
            .chosen-rtl.chosen-container-active.chosen-with-drop .chosen-single div {
                border-right: none;
            }
            .chosen-rtl .chosen-search input[type="text"] {
                background: url("<?php echo base_url("/assets/admin/chosen_v1.8.3/chosen-sprite.png"); ?>") no-repeat -28px -20px, #ffffff;
                direction: rtl;
                padding: 4px 5px 4px 20px;
            }
            @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-resolution: 144dpi) {
                .chosen-rtl .chosen-search input[type="text"],
                .chosen-container-single .chosen-single abbr,
                .chosen-container-single .chosen-single div b,
                .chosen-container-single .chosen-search input[type="text"],
                .chosen-container-multi .chosen-choices .search-choice .search-choice-close,
                .chosen-container .chosen-results-scroll-down span,
                .chosen-container .chosen-results-scroll-up span {
                    background-image: url("<?php echo base_url("/assets/admin/chosen_v1.8.3/chosen-sprite@2x.png"); ?>") !important;
                    background-size: 52px 37px !important;
                    background-repeat: no-repeat !important;
                }
            }

            .clickable-row {
                cursor: pointer;

            }


            .loader {
                position: absolute;
                left: 50%;
                top: 50%;
                z-index: 20;
                width: 150px;
                height: 150px;
                margin: -75px 0 0 -75px;
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #3498db;
                width: 120px;
                height: 120px;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
            }

            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .overlay {
                background: #e9e9e9;
                display: none;
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                opacity: 0.5;
            }

            .dropdown-submenu {
                position: relative;
            }

            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                -webkit-border-radius: 0 6px 6px 6px;
                -moz-border-radius: 0 6px 6px;
                border-radius: 0 6px 6px 6px;
            }

            .dropdown-submenu:hover>.dropdown-menu {
                display: block;
            }

            .dropdown-submenu>a:after {
                display: block;
                content: " ";
                float: right;
                width: 0;
                height: 0;
                border-color: transparent;
                border-style: solid;
                border-width: 5px 0 5px 5px;
                border-left-color: #ccc;
                margin-top: 5px;
                margin-right: -10px;
            }

            .dropdown-submenu:hover>a:after {
                border-left-color: #fff;
            }

            .dropdown-submenu.pull-left {
                float: none;
            }

            .dropdown-submenu.pull-left>.dropdown-menu {
                left: -100%;
                margin-left: 10px;
                -webkit-border-radius: 6px 0 6px 6px;
                -moz-border-radius: 6px 0 6px 6px;
                border-radius: 6px 0 6px 6px;
            }
            /*custom styles*/
            .btn-outline-red {
                color: #bf0000;
                background-color: transparent;
                background-image: none;
                border-color: #bf0000;
            }

            .btn-outline-red:hover {
                color: #fff;
                background-color: #bf0000;
                border-color: #bf0000;
            }
            fieldset.scheduler-border {
                border: 1px groove #ddd !important;
                padding: 0 1.4em 1.4em 1.4em !important;
                margin: 0 0 1.5em 0 !important;
                -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
            }

            legend.scheduler-border {
                font-size: 1.2em !important;
                font-weight: bold !important;
                text-align: left !important;
                width:auto;
                padding:0 10px;
                border-bottom:none;
            }
             
        </style>

    </head>

    <body id="myApp">
        <div  class="wrapper">
            <nav class="navbar navbar-expand-lg navbar-dark theme-bg py-0 mt-0">
                <a class="navbar-brand" href="<?php echo base_url('admin/dashboard'); ?>"><h3>Edugatein</h3></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto"> 
                        <li class="user dropdown open"> 
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" title="Admin"> Welcome ! <span><?php echo $_SESSION['display_name'] ?></span>
                                <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right icons-right">
<!--                                <a class="dropdown-item" href="<?php // echo base_url('admin/change_password');       ?>">Change Password</a>
                                <a class="dropdown-item" href="<?php // echo base_url('admin/edit_profile');       ?>">Edit Profile</a>-->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="<?php echo site_url('admin/logout'); ?>">Logout</a>
                            </ul> 
                        </li> 
                    </ul>
                </div> 
            </nav>
            <div class="clearfix"></div>
            <div class="container-fluid container-fluid-inner">
                
                    <?php if ($this->load->get_section('text_header') != '') { ?>
                        <h1><?php echo $this->load->get_section('text_header'); ?></h1>
                    <?php } ?> 
                    <?php echo $output; ?> 
                
            </div> <!--container -->
        </div>
        <!--Wrapper-->
        <footer class="footer">
            © Copyright 2021 <a target="_blank" href="http://edugatein.com">Edugatein</a>. All Rights Reserved. 
            <span class="float-right">Powered By <a href="http://f2fsolutions.co.in/" target="_blank">F2F Solutions</a></span>
        </footer>
        <div class="overlay">
            <div class="loader"></div>
        </div> 
        <?php if (!empty($listUrl)) { ?>        <script>  var list_url = "<?php echo $listUrl; ?>";</script> <?php } ?>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php echo base_url('assets/admin/js/notify.min.js'); ?>" ></script>
        <script>
<?php if ($this->session->flashdata('success_message')) { ?>
                $.notify('<?php echo $this->session->flashdata('success_message'); ?>', "success");
<?php } ?>
<?php if ($this->session->flashdata('error_message')) { ?>
                $.notify('<?php echo $this->session->flashdata('error_message'); ?>', "error");
<?php } ?>
            $('.show_overlay').click(function () {
                $(".overlay").show();
            });
            $('#cancel-button').click(function () {
                swal({
                    title: "Are you sure?",
                    text: "The data you had change may not be saved !. \n you want to go back to list? ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                        .then((a) => {
                            if (a) {
                                window.location = list_url;
                            }
                        });
            });

            $('.ajax_list').on('click', '.delete-row', function () {
                alert();
                var delete_url = $(this).attr('href');
                swal({
                    title: "Are you sure?",
                    text: "ypu want to deletethis record !! ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                        .then((yes) => {
                            if (yes) {
                                $.ajax({
                                    url: delete_url,
                                    dataType: 'json',
                                    success: function (data)
                                    {
                                        window.location = list_url;
                                    }
                                });
                            }
                        });
                return false;
            });

            $('#delete-row').click(function () {
                var delete_url = $(this).data('url');
                swal({
                    title: "Are you sure?",
                    text: "you want to delete this record !! ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                        .then((yes) => {
                            if (yes) {

                                $.ajax({
                                    url: delete_url,
                                    dataType: 'json',
                                    success: function (data)
                                    {

                                        window.location = list_url;
                                    }
                                });
                            }
                        });
                return false;
            });
            $(document).ready(function () {
<?php
if ($this->form_validation->error_array()) {
    foreach ($this->form_validation->error_array() as $key => $value) {
        ?>
                        $("#<?php echo $key; ?> ").removeClass('error_input').addClass('error_input');
                        if (jQuery($('#<?php echo $key . '_chosen'; ?>')).length > 0) {
                            $("#<?php echo $key . '_chosen'; ?>").removeClass('error_input').addClass('error_input');
                            //             $(".chosen-select").chosen();
                        }
        <?php
    }
}
?>

                $(".clickable-row").click(function () {
                    window.location = $(this).data("href");
                });
            });

            $(".datepicker").datepicker({
                dateFormat: "dd-mm-yy",
                changeMonth: true,
                changeYear: true
            });

            $(".chosen-select").chosen({disable_search_threshold: 10});

            $(".delete-row").click(function () {
                var URL = $(this).attr('data-href');
                var title = $(this).attr('title');
                swal({
                    title: "Are you sure ?",
                    text: "Delete " + $(this).attr('title'),
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                }).then((yes) => {
                    if (yes) {
                        $('.overlay').show();
                        $.ajax({
                            type: 'POST',
                            url: URL,
                            success: function (data) {
                                window.location.href = list_url;
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>
