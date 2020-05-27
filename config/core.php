<?php

ini_set('display_errors', 1);

error_reporting(E_ALL);

$base_url = "http://localhost:8888/create-api/";

$page = isset($_GET["page"]) ? $_GET["page"] : 1;

$items_on_page = 5;

$max_on_page_num = ($items_on_page * $page) - $items_on_page;
//0, 5, 10