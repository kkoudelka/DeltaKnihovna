<?php
/**
 * Created by PhpStorm.
 * User: kkoud
 * Date: 11/02/2019
 * Time: 10:40
 */

class DatabaseConnector
{
    private function getPdo()
    {
        return new PDO("mysql:dbname=d176025_hovna;host=wm156.wedos.net;charset=utf8", "w176025_hovna", "29bae7fh", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }


    public function GetAllMistnosti()
    {
        $pdo = $this->getPdo();

        $query = $pdo->prepare("SELECT * FROM Mistnosti");
        $query->setFetchMode(PDO::FETCH_CLASS, "mistnost");

        $result = $query->execute();

        $pdo = null;

        if ($result) {
            return $query->fetchAll();
        }
        return null;
    }

    public function GetAllZamestnanci()
    {
        $pdo = $this->getPdo();

        $query = $pdo->prepare("SELECT * FROM Zamestnanci");
        $query->setFetchMode(PDO::FETCH_CLASS, "Zamestnanec");

        $result = $query->execute();

        $pdo = null;

        if ($result) {
            $zamestnanci = $query->fetchAll();
            foreach ($zamestnanci as $z) {
                $z->Mistnost = $this->GetMistnostByID($z->MistnostID, true);
            }
            return $zamestnanci;
        }
        return null;
    }

    public function GetZamestnanecByID($ZamestnanecID, $fill = false) {
        $pdo = $this->getPdo();

        $query = $pdo->prepare("SELECT * FROM Zamestnanci WHERE ZamestnanecID = :zamestnanecId");
        $query->setFetchMode(PDO::FETCH_CLASS, "Zamestnanec");

        $result = $query->execute(array(
            ":zamestnanecId" => (int)$ZamestnanecID
        ));

        $pdo = null;

        if ($result) {
            $zamestnanec = $query->fetch();
            if ($fill) {

                $zamestnanec->Mistnost = $this->GetMistnostByID($zamestnanec->MistnostID);
                $zamestnanec->Klice = $this->GetKliceByZamesnanecID($ZamestnanecID);
            }

            return $zamestnanec;
        }
        return null;
    }

    public function GetKliceByMistnostID($MistnostID)
    {

        $pdo = $this->getPdo();

        $query = $pdo->prepare("SELECT * FROM `Keys` WHERE MistnostID = :mistnostID");
        $query->setFetchMode(PDO::FETCH_CLASS, "Klic");

        $result = $query->execute(array(
            ":mistnostID" => $MistnostID
        ));

        $pdo = null;

        if ($result) {
            $mistnosti = $query->fetchAll();

            return $mistnosti;
        }
        return null;
    }

    public function GetZamestnanciByMistnostID($MistnostID) {
        $pdo = $this->getPdo();

        $zamestnanci = array();
        $query = $pdo->prepare("SELECT * FROM `Keys` WHERE `MistnostID` = :mistnostID");
        $query->setFetchMode(PDO::FETCH_CLASS, "Klic");

        $result = $query->execute(array(
            ":mistnostID" => $MistnostID
        ));

        $pdo = null;

        if ($result) {
            $keys = $query->fetchAll();
            foreach ($keys as $k) {
                array_push($zamestnanci, $this->GetZamestnanecByID($k->ZamestnanecID));
            }
            return $zamestnanci;
        }
        return $zamestnanci;


    }

    public function GetDomaciZamestnanciByMistnostID($MistnostID){
        $pdo = $this->getPdo();

        $query = $pdo->prepare("SELECT * FROM `Zamestnanci` WHERE `MistnostID` = :mistnostID");
        $query->setFetchMode(PDO::FETCH_CLASS, "Klic");

        $result = $query->execute(array(
            ":mistnostID" => $MistnostID
        ));

        $pdo = null;

        if ($result) {
            return $query->fetchAll();
        }
        return null;
    }

    public function GetKliceByZamesnanecID($ZamestnanecID)
    {
        $pdo = $this->getPdo();

        $query = $pdo->prepare("SELECT * FROM `Keys` WHERE `ZamestnanecID` = :zamestnanecID");
        $query->setFetchMode(PDO::FETCH_CLASS, "Klic");

        $result = $query->execute(array(
            ":zamestnanecID" => (int)$ZamestnanecID
        ));

        $pdo = null;

        if ($result) {
            $klice = $query->fetchAll();

            foreach ($klice as $k)
            {
                $k->Mistnost = $this->GetMistnostByID($k->MistnostID);
            }

            return $klice;
        }
        return null;
    }

    public function GetMistnostByID($MistnostID, $fill = false) {
        $pdo = $this->getPdo();

        $query = $pdo->prepare("SELECT * FROM Mistnosti WHERE MistnostID = :mistnostID");
        $query->setFetchMode(PDO::FETCH_CLASS, "Mistnost");

        $result = $query->execute(array(
            ":mistnostID" => $MistnostID
        ));

        $pdo = null;

        if ($result) {
            $mistnost = $query->fetch();
            if ($fill) {

                $mistnost->Klice = $this->GetZamestnanciByMistnostID($MistnostID);
                $mistnost->Lide = $this->GetDomaciZamestnanciByMistnostID($MistnostID);
            }

            return $mistnost;
        }
        return null;
    }

}