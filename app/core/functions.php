<?php
function dd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}

function auth()
{
    if (!isset($_SESSION['authUser'])) {
        header('Location: ' . ROOT . 'url=auth');
        exit();
    }
}

function createData($model, array $data)
{
    $model = new $model();
    foreach ($data as $d) {
        $model->insert($d);
    }
}

function checkPermission($featureName, $permissionName)
{
    if (isset($_SESSION['authUser'])) {
        $userData = $_SESSION['authUser'];
        $user = new UserModel();
        return $user->userHasPermission($userData->id, $featureName, $permissionName);
    }
}