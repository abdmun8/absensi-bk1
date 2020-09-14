<?php

if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = NULL;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_SESSION['username'])) {
        load("login");
    }

    switch ($_REQUEST['action']) {
        case 'logout':
            session_destroy();
            header("location:" . BASE_URL);
            break;
        case 'data':
            header('Content-Type: application/json');
            getData();
            break;
        default:
            load("index");
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_REQUEST['action'] == 'login') {
        login();
    }

    if (!isset($_SESSION['username'])) {
        load("login");
    }

    switch ($_REQUEST['action']) {
        case 'simpan':
            saveData();
            break;
        case 'delete':
            deleteData();
            break;
        case 'clustering':
            processClustering();
            break;
        default:
            header("location:" . BASE_URL);
            break;
    }
}
