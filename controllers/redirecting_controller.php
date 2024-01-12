<?php
session_start();
$action = $_POST['action'];

switch ($action) {

    case "baccarat":

        $_SESSION['baccarat_deal'] = "true";
        header("location: ../baccarat");

        break;

    case "3cardpoker":

        $_SESSION['3cardpoker_deal'] = "true";
        header("location: ../3cardpoker");

        break;

    case "match_details_show":

        header("location: ../matchdetails?matchid={$_POST['match_id']}");

        break;
}
