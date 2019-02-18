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

<div class="container">
<table class="table" id="mainTable">
    <thead>
    <tr>
        <th>Název</th>
        <th>Číslo</th>
        <th>Telefon</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $dbConn = new DatabaseConnector();
    $mistnosti = $dbConn->GetAllMistnosti();

    foreach ($mistnosti as $m) {
        echo "<tr>
        <td><a href=\"mistnost.php?id={$m->MistnostID}\">{$m->Nazev}</a></td>
        <td>{$m->Cislo}</td>
        <td>{$m->Telefon}</td>
    </tr>";
    }

    ?>

    </tbody>
</table>
</div>


<!-- Bootstrap core JavaScript -->
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script>
    $(document).ready( function () {
        $('#mainTable').DataTable();
    } );
</script>


</body>

</html>
