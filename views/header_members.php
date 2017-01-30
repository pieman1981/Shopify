<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo (isset($this->title) ? $this->title . ' | ' : ''); ?></title>

    <link href='//fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo URL ?>public/css/build/production.min.css" rel="stylesheet">
    <link href="<?php echo URL ?>public/css/build/global.css" rel="stylesheet">
    <link href="<?php echo URL ?>public/css/drag.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="members">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
        <div class="navbar-header">
          <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a href="<?php echo MEMBERSURL ?>" class="navbar-brand">
          <?php if (Session::get('loggedIn')) : ?>
              <small>- <strong>Logged in as:</strong> <?php echo Session::get('name'); ?></small>
            <?php endif; ?>
          </a>
        </div>
        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if (Session::get('loggedIn')) : ?>
              <li><a href="<?php echo MEMBERSURL ?>logout"><span class="fa fa-sign-out"></span> Logout</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </nav>
      
      <div class="container">
        <div class="main-content">  

          <div class="row">
            <!-- Sidebar Column -->
            <div class="col-md-3" id="membersLink">
                <div class="list-group">
										<?php include ('views/members_links.php'); ?>

                </div>
            </div>
            