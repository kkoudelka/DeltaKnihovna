<?php include "./config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- COMMON TAGS -->
    <meta charset="utf-8">
    <title>Knihovna od Janka</title>

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <style>

        .col-12 {
            padding-left: 0 !important;
        }
    </style>

</head>

<body id="page-top" style="padding-right: 0px !important;">
<?php
if (!isset($_GET['id'])) {
    echo "<script>window.location.replace(\"http://http://hovna.q-soc.eu/lide.php\");</script>";
    die();
}

$dbConn = new DatabaseConnector();

$mistnost = $dbConn->GetMistnostByID($_GET['id'], true);
?>
<div class="container">
    <div class="row"><h1>Místnost č. <?php echo "{$mistnost->Cislo}"; ?></h1></div>
    <div class="row">
        <div class="col-2"><strong>Číslo</strong></div>
        <div class="col-6"><?php echo $mistnost->Cislo; ?></div>
    </div>
    <div class="row">
        <div class="col-2"><strong>Název</strong></div>
        <div class="col-6"><?php echo $mistnost->Nazev; ?></div>
    </div>
    <div class="row">
        <div class="col-2"><strong>Telefon</strong></div>
        <div class="col-6"><?php echo $mistnost->Telefon; ?></div>
    </div>
    <div class="row">
        <div class="col-2"><strong>Lidé</strong></div>
        <div class="col-10">
            <?php
            $mzdy = array();
            foreach ($mistnost->Lide as $l) {
                echo "<div class='col-12'>
                    <a href='./clovek.php?id={$l->ZamestnanecID}'>{$l->Jmeno} {$l->Prijmeni}</a>
                </div>";
                array_push($mzdy, $l->Mzda);
            }
            ?>


        </div>

    </div>
    <div class="row">
        <div class="col-2"><strong>Průměrná mzda</strong></div>
        <div class="col-6"><?php 
        if (count($mzdy) < 1) $prumernaMzda = 0;
        else $prumernaMzda = array_sum($mzdy) / count($mzdy);
        echo number_format((float)$prumernaMzda, 2, ',', '.'); ?></div>

    </div>
    <div class="row">
        <div class="col-2"><strong>Klíče</strong></div>
        <div class="col-10">
            <?php
            foreach ($mistnost->Klice as $l) {
                echo "<div class='col-12'>
                    <a href='./clovek.php?id={$l->ZamestnanecID}'>{$l->Jmeno} {$l->Prijmeni}</a>
                </div>";
            }
            ?>


        </div>
    </div>
    <div class="row"><a href="./mistnosti.php">Zpět na místnosti</a></div>

</div>


<!-- Bootstrap core JavaScript -->
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function () {
        $('#mainTable').DataTable();
    });
</script>


</body>

</html>
