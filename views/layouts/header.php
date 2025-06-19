<?php
session_start();
$logoPath = file_exists('../../assets/images/logo.png')
    ? '../../assets/images/logo.png'
    : 'assets/images/logo.png';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= $logoPath ?>" type="image/x-icon">
    <title><?= $pagetitle ?? 'PAGE' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.0/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-TjEsBrREQ8e4UQZBv0t+xyJqXlIR9Z0I2S84WzGcxjOpwG3287e0uXc5MqDVOLPh" crossorigin="anonymous"> -->

    <!-- fontawesome --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- JQuery ---->
    <!-- <link rel="stylesheet" href="assets/css/jquery-ui.css"> -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <!--DATA TABLES INITIALIZE --->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- custom css  --->
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/layout.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/nami.css">

</head>

<body style="background-color: #31363F;padding:10px;">