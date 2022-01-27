<!DOCTYPE html>
<html lang="en">
<head>
    <title> <?=  $title ?></title>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url()?>assets/dist/images/nepal_logo.png"/>

    <link rel="stylesheet" href="<?= base_url()?>assets/dist/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/select2-bootstrap.main.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/select2.main.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/material.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/style.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/calendar/nepali.datepicker.v2.1.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>



</head>

<body style="background:white;" class='  ls-opened  theme-violet '>
<div class="overlay"></div>

<div class="page-wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-deep-blue">
        <div class="visible-xs">
            <div class="button close_button" id="id_close_button" >
                <div class="bar top"></div>
                <div class="bar middle"></div>
                <div class="bar bottom"></div>
            </div>
        </div>

        <div class="hidden-xs mt-1">
            <div class="button  open_button  active " id="id_open_button" onclick="menuToggle()";>
                <div class="bar top"></div>
                <div class="bar middle"></div>
                <div class="bar bottom"></div>
            </div>
        </div>

        <img alt="logo" src="<?=base_url()?>assets/images/icons/logo.png" class="img-responsive ml-3" height="50px;">
        <a class="navbar-brand ml-2 font-27 font-kalimati" href="<?=base_url()?>dashboard"><?= SITE_OFFICE ?></a>


        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a style="color:white;" class="nav-link dropdown-toggle user" href="#" id="navbarDropdown" role="button" data-toggle="dropdown " aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle"></i> <?= $this->session->userdata('username')?>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right user-div" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="<?= base_url()?>change-password">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <?php if($this->session->userdata('mode') == 'superadmin'):?>
                        <a class="dropdown-item" href="<?= base_url()?>user-view">View All User</a>
                        <div class="dropdown-divider"></div>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?= base_url()?>logout">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Side Bar Start -->
    <section>

        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar font-kalimati">
            <div>
            </div>
            <!-- Menu -->
            <div class="menu" id="style-1">
                <ul class='list'>
                    <li id="id_home">
                        <a href="<?= base_url()?>dashboard">

                        <span> <i class="fa fa-tachometer sidebar-icon"></i> गृह (Dashboard)</span>

                        </a>
                        <hr style="margin:0;padding:0;">

                    </li>
                    <li id="save-disable-detail">
                        <a href="<?= base_url()?>save-disable-detail">
                            <span> <i class="fa fa-plus sidebar-icon"></i>अपाङ्गता व्यक्ति थप्नुहोस</span>
                        </a>
                    </li>
                    <li id="disable-details-list">
                        <a href="<?= base_url()?>disable-details-list">
                            <span> <i class="fa fa-list sidebar-icon"></i>अपाङ्गता व्यक्तिहरु हेर्नुहोस</span>
                        </a>
                    </li>
                    <?php if($this->session->userdata('mode') == 'superadmin'): ?>
                    <li id="id_parent" style="">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span> <i class="fa fa-cogs sidebar-icon"></i> सेटिङ्हरू</span>
                        </a>
                        <ul class="ml-menu">
                             <li id="pramanit-garne">
                                <a href="<?= base_url()?>pramanit-garne">
                                    <span>प्रमाणित गर्ने</span>
                                </a>
                            </li>
                            <li id="district">
                                <a href="<?= base_url()?>district">
                                    <span>जिल्ला</span>
                                </a>
                            </li>
                            <li id="district">
                                <a href="<?= base_url()?>district">
                                    <span>जिल्ला</span>
                                </a>
                            </li>
                            <li id="session">
                                <a href="<?= base_url()?>session">
                                    <span>आर्थिक वर्ष</span>
                                </a>
                            </li>
                            <li id="blood-type">
                                <a href="<?= base_url()?>blood-type">
                                    <span>रक्त समूह</span>
                                </a>
                            </li>
                            <li id="disable-type">
                                <a href="<?= base_url()?>disable-type">
                                    <span>अपाङ्गको किसिम</span>
                                </a>
                            </li>
                            <li id="disable-severity">
                                <a href="<?= base_url()?>disable-severity">
                                    <span>अपाङ्गको गम्भिरता</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
            <div class="legal">
                <div class="copyright" id="id_copyright">
                    &copy; <b id="id_year">2021 </b> &nbsp; 
                </div>
            </div>
        </aside>
    </section>
    <!-- Side Bar End -->
