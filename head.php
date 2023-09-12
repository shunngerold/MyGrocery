<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
// Bootstrap core CSS
$file1 = "./assets/css/bootstrap.min.css";

if (file_exists($file1)) {
?>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
<?php
} else {
?>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<?php
}
// Bootstrap core JS
$file2 = "./assets/js/bootstrap.bundle.min.js";

if (file_exists($file2)) {
?>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
<?php
} else {
?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
<?php
}
// ICON
$file3 = "./assets/images/logo_icon.ico";

if (file_exists($file3)) {
?>
    <link rel="shortcut icon" href="./assets/images/logo_icon.ico" type="image/x-icon">
<?php
} else {
?>
    <link rel="shortcut icon" href="../assets/images/logo_icon.ico" type="image/x-icon">
<?php
}
// JQuery CDN
$file4 = "./assets/js//jquery-1.9.1.min.js";

if (file_exists($file4)) {
?>
    <script src="./assets/js//jquery-1.9.1.min.js"></script>
<?php
} else {
?>
    <script src="../assets/js//jquery-1.9.1.min.js"></script>
<?php
}
// SweetAlert CDN
$file5 = "./assets/js/sweetalert.min.js";

if (file_exists($file5)) {
?>
    <script src="./assets/js/sweetalert.min.js"></script>
<?php
} else {
?>
    <script src="../assets/js/sweetalert.min.js"></script>
<?php
}

?>
<!-- Load Icons -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">