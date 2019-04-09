<?php
include "Team095produktSoapClient.php";
include "client.php";

$client = new SoapClient('http://labss2.fiit.stuba.sk/pis/ws/Students/Team095produkt?WSDL');
$obj = new produktType();
$obj->name = "meno";
$obj->nazov = "nazob";
$obj->cena = 5.99;
$obj->id = 1;
$obj->zaciatok ="2010-01-01";
$obj->schvalene = "2010-01-01";
$obj->koniec = "2010-01-01";
$obj->popis = "popis";
//$b = $client->getById(188092);
//$id = $client->insert(client::TEAM_ID, client::TEAM_PWD, $obj);
$id = $client->insert(["team_id" => "095", "team_password" => "pHkXun", "produkt" => $obj]);
echo($id);
