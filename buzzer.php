<?php
session_start();
if (!isset($_SESSION['nm'])) {
    header("location:index.php");
}
$cn = mysqli_connect("localhost", "root", "", "bz");
$p = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM `join` WHERE id = '$_SESSION[nm]'"));
$q = mysqli_query($cn, "SELECT * FROM `join` WHERE id = '$_SESSION[nm]'");
if(mysqli_num_rows($q) == 0)
{
    unset($_SESSION['nm']);
    session_destroy();
    header("location:index.php");
}
if (isset($_POST['bz1'])) {
    $i = mysqli_query($cn, "INSERT INTO `" . $p['code'] . "`(`id`, `nm`, `tnm`) VALUES ('','$p[nm]','$p[tnm]')");
    echo "<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>";
    echo "<audio id='bgAudio' src='buzzer.mp3' autoplay ></audio>
<script>
  var audio = document.getElementById('bgAudio');
  audio.volume = 0.7;
</script>";
    $_SESSION['nm'] = $p['id'];
echo "<body background='success1.jpg'></body>";
    echo "<script>window.location.assign('submit.php');</script>";
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buzzer</title>
    <link href="logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
        .btn-circle.btn-xl {
            width: 232px;
            height: 230px;
            padding: 10px 16px;
            border-radius: 170px;
            font-size: 11px;
            text-align: center;
        }
    </style>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <?php echo "<a class='link-light' href='logout.php?key=bo&id=" . $_SESSION['nm'] . " '>Logout</a>"; ?>
        <div class="container py-3 h-100">
            <img src="logo.jpg" class="rounded-5 mx-auto d-block" style="width:90px;">
            <div class="row d-flex justify-content-center py-2 align-items-center h-60">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form class="modal-content animate" action="" method="POST">
                                <button type="submit" class="btn btn-circle btn-danger btn-xl" name="bz1" style="font-size: 45px">Buzzer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>