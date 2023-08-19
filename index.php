<?php
if (isset($_SESSION['nm'])) {
    header("location:buzzer.php");
}
$cn = mysqli_connect("localhost", "root", "", "bz");
if (isset($_POST['jok'])) 
{
    $nm = strtoupper($_POST['nm']);
    $tnm = strtoupper($_POST['tnm']);
    $code = $_POST['code'];
    $co = mysqli_query($cn, "SELECT * FROM `host`");
    while ($fco = mysqli_fetch_array($co)) {
        if ($fco['code'] == $code) {
            $query = "INSERT INTO `join`(`id`, `nm`, `tnm`, `code`) VALUES ('', '$nm', '$tnm', '$code')";
            $result = mysqli_query($cn, $query);
            $p = mysqli_fetch_array(mysqli_query($cn, "SELECT * FROM `join` WHERE nm = '$nm' && tnm = '$tnm' && code = '$code'"));

            $row = mysqli_affected_rows($cn);
            if ($row > 0) {
                echo "<script>if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                  }</script>";
                session_start();
                $_SESSION['nm'] = $p['id'];
                echo "<script>alert('Join Sucessfully...');window.location.assign('buzzer.php');</script>";
            } else {
                $msg = "Something Wrong.";
            }
        } else{echo "<script>alert('Enter Correct Code')</script>";}
    }
    if(mysqli_num_rows($co) == 0){echo "<script>alert('Host unavailable')</script>";}
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
    </style>
</head>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-3 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-3 text-center">
                            <div class="mb-md-5 mt-md-4">
                            <form class="modal-content animate" action="" method="POST">
                                <div class="form-outline form-white mb-4"><img src="logo.jpg" class="rounded-4 shadow-4" style="width:70px;"></div>
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label">Name</label>
                                    <input type="text" id="name" name="nm" class="form-control form-control-lg" required/>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label">Team Name</label>
                                    <input type="text" id="tname" name="tnm" class="form-control form-control-lg" required/>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label">Code</label>
                                    <input type="number" id="code" name="code" class="form-control form-control-lg" required/>
                                </div>
                                <button class="btn btn-outline-light btn-lg px-5" name="jok" type="submit">Join</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>