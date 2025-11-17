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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

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

    <!------lottie loadfile  cdn-------->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Inside <head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- QR CODE --->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>


    <!-- custom css  --->
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/layout.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/nami.css">
    <link rel="stylesheet" type="text/css" href="assets/css/registration.css">
     <link rel="stylesheet" type="text/css" href="../../assets/css/elements.css">
     <link rel="stylesheet" type="text/css" href="../../assets/css/popups.css">
     <link rel="stylesheet" type="text/css" href="../../assets/css/modals.css">

     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <!------ Google fonts -------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">

    <style>
        .dm-sans-error {
            font-family: "DM Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 300;
            font-style: normal;
        }
    </style>

</head>

<body style="background-color: #31363F;padding:10px;">