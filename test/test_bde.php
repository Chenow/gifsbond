<?php

session_start();
include_once 'includes/connexion_bdd.php';
ini_set('display_errors', 'on');

$lol = "2021cheneauan";
$cotis = curl_init();
curl_setopt($cotis, CURLOPT_URL, "https://api.bde-cs.fr/api/v1/cotisants/check/$lol");
curl_setopt($cotis, CURLOPT_HTTPHEADER, array("X-API-Key: 7zmwy18b5RZ-0APmduPvM69Wo1rAMH5ZJ-YrG_me6U0"));
curl_setopt($cotis, CURLOPT_RETURNTRANSFER, true);
$reponse_cotisant = curl_exec($cotis);
$cotisant_array = json_decode($reponse_cotisant, true);
print_r($reponse_cotisant);
curl_close($cotis);
