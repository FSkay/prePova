<?php

function db_connect() {
    $connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    return $connection;
}

function dateConvert($date) {
    if (!strstr($date, '/')) {
        // $date está no formato ISO (yyyy-mm-dd) e deve ser convertida
        // para dd/mm/yyyy
        sscanf($date, '%d-%d-%d', $y, $m, $d);
        return sprintf('%02d/%02d/%04d', $d, $m, $y);
    } else {
        // $date está no formato brasileiro e deve ser convertida para ISO
        sscanf($date, '%d/%d/%d', $d, $m, $y);
        return sprintf('%04d-%02d-%02d', $y, $m, $d);
    }

    return false;
}
