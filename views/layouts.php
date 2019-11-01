<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/assets/css/bootstrap.css?v=1">
    <link rel="stylesheet" href="/assets/css/bootstrap-responsive.css?v=1">
    <link rel="stylesheet" href="/assets/css/style.css?v=12">
    </head>
<body>

    <div class="top-panel">
            <a class="float-left" href="/index.php?r=tasks-index">Home</a>
        <?php if(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']) { ?>
            <a href="/index.php?r=signin-logout" class="float-right btn btn-danger but-logout">Logout</a>
        <?php } else { ?>
            <a href="/index.php?r=signin-login" class="float-right but-logout btn btn-success">Login</a>
        <?php } ?>
    </div>

    <?= $content ?>

    <script type="application/javascript" src="/assets/js/bootstrap.js"></script>
    <script type="application/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="/assets/js/jquery.js"></script>

</body>
</html>