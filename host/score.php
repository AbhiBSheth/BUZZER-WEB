<?php
session_start();
if (!isset($_SESSION['ho'])) {
    header("location:index.php");
}
if (isset($_SESSION['lo'])) {
    echo "<audio id='bgAudio' src='kbc.mp3' autoplay ></audio>
    <script>
        var audio = document.getElementById('bgAudio'); 
    </script>";
    unset($_SESSION['lo']);
}
$cn = mysqli_connect("localhost", "root", "", "bz");
$sc = mysqli_query($cn, "SELECT * FROM `" . $_SESSION['ho'] . "`");
if(isset($_POST['so'])){
    $_SESSION['lo'] = 'lo';
    header("location:score.php");
}
if (isset($_POST['st'])) {
    mysqli_query($cn, "TRUNCATE TABLE `bz`.`" . $_SESSION['ho'] . "`");
    echo "<script>if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }</script>";
    header("location:score.php");
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buzzer</title>
    <link href="../logo.png" rel="icon">
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
    </style>
</head>

<body>
    <section class="vh-200 gradient-custom">
    <?php echo "<a class='link-light' href='../logout.php?key=o&id=" . $_SESSION['ho'] ." '>Logout</a>";?>
        <div class="container h-100">
            <img src="../logo.jpg" class="rounded-5 mx-auto d-block" style="width:90px;">
            <div class="row d-flex justify-content-center py-2 align-items-center h-60">
                <div class="card bg-dark text-warning" style="border-radius: 1rem;">
                 <lable class="lable mx-auto d-block"><b>CODE : <?php echo $_SESSION['ho']; ?></lable>
                    <div class="row card-body text-center">
                        <div class="col">Rank</div>
                        <div class="col">Name</div>
                        <div class="col">Team Name</div>
                    </div></b>
                    <?php
                    while ($fsc = mysqli_fetch_array($sc)) {
                        if ($fsc['id'] === "1"){
                        echo "<div class='row card-body text-center'>
                        <div class='col bg-success'><b>" . $fsc['id'] . "</b></div>
                        <div class='col bg-success'><b>" . $fsc['nm'] . "</b></div>
                        <div class='col bg-success'><b>" . $fsc['tnm'] . "</b></div>
                    </div>";}
                        else{
                            echo "<div class='row card-body text-center'>
                        <div class='col'><b>" . $fsc['id'] . "</b></div>
                        <div class='col'><b>" . $fsc['nm'] . "</b></div>
                        <div class='col'><b>" . $fsc['tnm'] . "</b></div>
                    </div>";
                        }
                    }
                    ?>
                    <form class="modal-content animate" action="" method="POST">
                        <div class='col mx-auto d-block'><button class="btn btn-outline-light btn-mm px-5" name="so" type="submit">Result</button>
                        <button class="btn btn-outline-light btn-mm px-5" name="st" type="submit">Reset</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>