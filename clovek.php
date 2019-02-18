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

$zamestnanec = $dbConn->GetZamestnanecByID($_GET['id'], true);
?>
<div class="container">
    <div class="row"><h1>Karta osoby <?php echo "{$zamestnanec->Jmeno} {$zamestnanec->Prijmeni}"; ?></h1></div>
    <div class="row">
        <div class="col-2"><strong>Jméno</strong></div>
        <div class="col-6"><?php echo $zamestnanec->Jmeno; ?></div>
    </div>
    <div class="row">
        <div class="col-2"><strong>Příjmení</strong></div>
        <div class="col-6"><?php echo $zamestnanec->Prijmeni; ?></div>
    </div>
    <div class="row">
        <div class="col-2"><strong>Pozice</strong></div>
        <div class="col-6"><?php echo $zamestnanec->Pozice; ?></div>
    </div>
    <div class="row">
        <div class="col-2"><strong>Mzda</strong></div>
        <div class="col-6"><?php echo number_format((float)$zamestnanec->Mzda, 2, ',', '.'); ?></div>
    </div>
    <div class="row">
        <div class="col-2"><strong>Místnost</strong></div>
        <div class="col-6"><?php echo "<a href='./mistnost.php?id={$zamestnanec->Mistnost->MistnostID}'>{$zamestnanec->Mistnost->Nazev}</a>"; ?></div>
    </div>
    <div class="row">
        <div class="col-2"><strong>Klíče</strong></div>
        <div class="col-10">
            <?php
            foreach ($zamestnanec->Klice as $klic) {
                echo "<div class='col-12'>
                <a href='./mistnost.php?id={$klic->Mistnost->MistnostID}'>{$klic->Mistnost->Nazev}</a>
                </div>";
            }
            ?>


        </div>
    </div>
    <div class="row"><a href="./lide.php">Zpět na člověky</a></div>

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
