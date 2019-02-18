<?php
/**
 * Created by PhpStorm.
 * User: kkoud
 * Date: 11/02/2019
 * Time: 10:42
 */

class Zamestnanec
{
    public $ZamestnanecID;

    public $Jmeno;
    public $Prijmeni;
    public $Pozice;
    public $MistnostID;
    public $Mzda;

    public $Keys;
    public $Mistnost;

    /**
     * Zamestnanec constructor.
     */
    public function __construct()
    {

    }

    public function GetKeys() {
        $dbConn = new DatabaseConnector();
        $this->Keys = $dbConn->GetKliceByZamesnanecID($this->ZamestnanecID);
    }

    public function GetMistnost() {
        $dbConn = new DatabaseConnector();
        $this->Mistnost = $dbConn->GetMistnostByID($this->MistnostID);
    }
}