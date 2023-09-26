<?php
require_once "./Cannel/Router.php";

function index()
{
    require_once "./Layout/Header.php";
    Router::handle();
    require_once "./Layout/Footer.php";
}
