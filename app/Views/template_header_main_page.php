<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BALINUSRA BACKED ASSESMENT REPORTING APPS</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <!-- SCRIPT -->
    <script type="text/javascript" src="<?php echo base_url('/script/jquery-3.7.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/script/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://kit.fontawesome.com/47796dec6e.js" crossorigin="anonymous"></script>

    <!--Font Awesome-->
    <link href="<?php echo base_url('/assets/fontawesome/css/fontawesome.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/fontawesome/css/brands.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/fontawesome/css/solid.css') ?>" rel="stylesheet" />

    <!--STYLES-->
    <link rel="stylesheet" href="<?php echo base_url('/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/css/main_page_style.css') ?>">

    <style>
    /* Body fade-in */
    body {
      opacity: 0;
      transition: opacity 0.5s ease-in;
    }
    body.loaded {
      opacity: 1;
    }

    /* Preloader spinner */
    #preloader {
      position: fixed;
      top:0; left:0; right:0; bottom:0;
      background:#fff;
      display:flex;
      align-items:center;
      justify-content:center;
      z-index:9999;
    }
    .spinner-border {
      width: 3rem;
      height: 3rem;
    }
  </style>
</head>

<?= $this->renderSection('content'); ?>

</html>
