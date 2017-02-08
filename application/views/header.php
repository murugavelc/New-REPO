<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Salvage</title>
    <link href="<?php echo BASE; ?>assets/css/bootstrap-english.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/salvage-english.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/slider.css" rel="stylesheet" >
    <link href="<?php echo BASE; ?>assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
	<link type="text/css" href="<?php echo BASE; ?>assets/css/sweetalert.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo BASE; ?>assets/css/responsive.css" rel="stylesheet" />
    <!--<link href="<?php echo BASE; ?>assets/css/icons/icomoons/styles.css" rel="stylesheet" type="text/css">-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet"> 
</head>
<body>
<div class="main-pannel">
    <div class="top-bg"></div>
    <!---Header pannel-->
    <header>
        <div class="container">
            <div class="row">

                <!---logo section-->
                <div class="col-md-2 col-xs-12 logo">
                    <a class="header-logo"  href="#page-top"><img src="<?php echo BASE; ?>assets/images/logo.png" class="img-responsive"/></a>
                </div>
                <!---Menu section-->
                <div class="col-md-10">


                    <!---Top contact section-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="top-contact">
                                <ul>
                                    <li><i class="fa fa-fw fa-phone"></i> 8002499988</li>
                                    <li class="lest"><i class="fa fa-fw fa-envelope"></i> examplemail@gmail.com</li>
                                     <li>
                                           <div class="btn-group language">
                                              <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sort-desc" aria-hidden="true"></i> English </a>
                                              <div class="dropdown-menu">
                                                <a href="javascript:void(0)" onclick="languagechange('1');">العربية</a>
                                              </div>
										   </div>	  
                                   </li>
                                </ul>
                                <div class="sing-det">
                                            
							 <?php if(isset($_SESSION['sv_user_logged']) && $_SESSION['sv_user_logged'] != ''){ ?>
							<div class="btn-group">
								<a  class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></a>
								<div class="dropdown-menu">
								<a href="<?php echo BASE; ?>myaccount">My Account</a>
								<a href="<?php echo BASE; ?>myaccount/forgetpassword">Change Password</a>
								<a href="<?php echo BASE; ?>login/logout">Sign Out</a>
								</div>

								<?php }else{ ?>
								<a href="<?php echo BASE; ?>">Sign In</a>
								<?php } ?>

							</div>

                            </div>
                        </div></div>
                    <!---Top contact section-->

                    <!---Menu section-->
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    
                    <div class="navbar-collapse collapse menu">
                        <div class="row">
						 <?php if(isset($_SESSION['sv_user_logged']) && $_SESSION['sv_user_logged'] != ''){ ?>
                            <?php $pmenu = $this->uri->segment(1); $pmenu1 = $this->uri->segment(2)?>
                            <ul class="nav navbar-nav">
                                <!--<li><a href="<?php echo BASE; ?>" class="<?php echo ($pmenu == '' || $pmenu == 'home' ? 'active':''); ?>">HOME</a></li>-->
                                <li><a href="<?php echo BASE; ?>biddings" class="<?php echo (($pmenu == 'biddings' && $pmenu1 == '')  ? 'active':''); ?>">BIDDINGS</a></li>
                                <li><a href="<?php echo BASE; ?>biddings/motor" class="<?php echo ($pmenu1 == 'motor' ? 'active':''); ?>">MOTOR</a></li>
                                <li><a href="<?php echo BASE; ?>biddings/non_motor" class="<?php echo ($pmenu1 == 'non_motor' ? 'active':''); ?>">NON MOTOR</a></li>
                            </ul>
						<?php } else { ?>
						    <ul class="nav navbar-nav">
                                <li class="withoutmenu">Please Register or Login to Start Bidding</li>
							</ul>
                        <?php } ?> 							
                        </div> </div>

                </div>
                <!---Menu section-->


            </div>
        </div>
    </header>
    <!---Header pannel-->

    