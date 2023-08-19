<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<?php
session_start();
$_SESSION['nm'];
$cn = mysqli_connect("localhost", "root", "", "bz");
$p = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM `join` WHERE id = '$_SESSION[nm]'"));
$t = true;
while ($t == true) {
    $sc = mysqli_num_rows(mysqli_query($cn, "SELECT * FROM `" . $p['code'] . "`"));
    if ($sc == 0) {
        $t = false;
        header("location:buzzer.php");
    }
}
?>
<html>
<body background="success1.jpg"></body>
</html>