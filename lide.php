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
        .noselect {
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
            -khtml-user-select: none; /* Konqueror HTML */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none;
            /* Non-prefixed version, currently
                                             supported by Chrome and Opera */
        }

        .masthead-landing {

            width: 100%;
            height: auto;
            min-height: 35rem;
            padding: 15rem 0;
            background: -webkit-gradient(linear, left top, left bottom, from(rgba(22, 22, 22, .1)), color-stop(75%, rgba(22, 22, 22, .5)), to(#161616)), url(./img/bg-masthead.jpg);
            background: linear-gradient(to bottom, rgba(22, 22, 22, .1) 0, rgba(22, 22, 22, .5) 75%, #161616 100%), url(./img/bg-masthead.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover
        }
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
        <th>Jméno</th>
        <th>Místnost</th>
        <th>Telefon</th>
        <th>Pozice</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $dbConn = new DatabaseConnector();
    $zamestnanci = $dbConn->GetAllZamestnanci();

    foreach ($zamestnanci as $z) {
        echo "<tr>
        <td><a href=\"clovek.php?id={$z->ZamestnanecID}\">{$z->Prijmeni} {$z->Jmeno}</a></td>
        <td>{$z->Mistnost->Nazev}</td>
        <td>{$z->Mistnost->Telefon}</td>
        <td>{$z->Pozice}</td>
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
