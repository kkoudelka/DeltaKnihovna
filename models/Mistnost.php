<?php
/**
 * Created by PhpStorm.
 * User: kkoud
 * Date: 11/02/2019
 * Time: 10:42
 */

class Mistnost
{
    public $MistnostID;
    public $Cislo;
    public $Nazev;
    public $Telefon;

    public $Keys;

    /**
     * Mistnost constructor.
     */
    public function __construct()
    {
    }

    public function GetKeys() {
        $dbConn = new DatabaseConnector();
        $this->Keys = $dbConn->GetKliceByMistnostID($this->MistnostID);
    }

}