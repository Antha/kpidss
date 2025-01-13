<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to BARBARA</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <!-- SCRIPT -->
    <script type="text/javascript" src="<?php echo base_url('/script/jquery-3.7.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/script/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://kit.fontawesome.com/47796dec6e.js" crossorigin="anonymous"></script>

    <!-- STYLES -->
    <link rel="stylesheet" href="<?php echo base_url('/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/css/menu_page_style.css') ?>">
</head>

<?= $this->renderSection('content'); ?>

</html>
