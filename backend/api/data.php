<?php

/* ------------------------------- GET POST -------------------------------- */
// login
function login()
{
    global $db;
    $req = $_POST;
    $sql = "SELECT * FROM user WHERE username = '{$req['username']}' AND password = md5('{$req['password']}')";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['name'];
        $_SESSION['level'] = $data['level'];
    } else {
        $_SESSION['login_gagal'] = TRUE;
    }
    header("location:" . BASE_URL);
}

// delete Data
function deleteData()
{
    $req = $_POST;
    // unset extra keys from post
    unset($_POST['table']);
    unset($_POST['action']);

    // set variable
    $table = $req['table'];
    $msg = "Data berhasil dihapus";
    $success = TRUE;
    $desc = "";
    $sql = "DELETE FROM $table WHERE id='{$_POST['id']}'";
    $result = query($sql);
    if ($result != TRUE) {
        $msg = $result;
        $success = FALSE;
    }
    echo json_encode(['msg' => $msg,  'success' => $success, 'description' => $desc]);
}
// save Data
function saveData()
{
    $req = $_POST;
    // unset extra keys from post
    unset($_POST['table']);
    unset($_POST['action']);

    // set variable
    $table = $req['table'];
    $msg = "Data berhasil disimpan";
    $success = TRUE;
    $desc = "";
    $cols = implode(',', array_keys($_POST));
    $values = implode("','", array_values($_POST));
    $sql = "INSERT INTO {$table} ($cols) VALUES ('$values')";

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        unset($_POST['id']);
        $template = "";
        foreach ($_POST as $key => $value) {
            $template .= "{$key}='$value',";
        }
        $template = substr($template, 0, strlen($template) - 1);
        $sql = "UPDATE {$table} set $template WHERE id='{$id}'";
    }

    $result = query($sql);
    if ($result != TRUE) {
        $msg = "Data gagal disimpan";
        $success = FALSE;
        $desc = $result;
    }
    echo json_encode(['msg' => $msg,  'success' => $success, 'description' => $desc]);
}

// clustering process
function processClustering()
{
    $msg = "Data berhasil disimpan";
    $success = TRUE;
    $data = [];
    // data nilai
    $dns = json_decode($_POST['data_nilai'], TRUE);
    // standar nilai
    $sns = json_decode($_POST['standar_nilai'], TRUE);
    foreach ($dns as $keya => $dn) {
        $nilai = $dn;
        unset($nilai['id']);
        unset($nilai['id_siswa']);
        unset($nilai['nama']);
        unset($nilai['nisn']);

        // create sk
        $sk = [];
        // cek jarak
        foreach ($sns as $key => $sn) {
            $sk[$sn['kelas']] = getDistance($nilai, $sn);
        }
        $temp['nama'] = $dn['nama'];
        $temp['nisn'] = $dn['nisn'];
        $addedResult =  compareKey($sk);
        $newArr = array_merge($temp, $addedResult);
        $data[] = $newArr;
    }
    echo json_encode(['msg' => $msg,  'success' => $success, 'data' => $data]);
}

// compare closest standart
function compareKey($arr)
{
    $lowest = '';
    foreach (array_keys($arr) as $key => $value) {
        if ($key == 0) {
            $lowest = $value;
        } else {
            if ($arr[$value] < $arr[$lowest]) {
                $lowest = $value;
            }
        }
    }
    $arr['result'] = $lowest;
    return $arr;
}

// get distance nilai to standart
function getDistance($arrNilai, $arrStd)
{
    $keyNilai = array_keys($arrNilai);
    $cummulative = 0;
    foreach ($keyNilai as $key => $value) {
        $cummulative += pow(($arrStd[$value] - $arrNilai[$value]), 2);
    }

    return round(sqrt($cummulative), 2);
}

/* ------------------------------- GET REQUEST -------------------------------- */
function getData()
{
    $msg = "success";
    $success = TRUE;
    $sql = "";
    switch ($_GET['table']) {
        default:
            if (isset($_GET['row'])) {
                $sql = "SELECT * FROM {$_GET['table']} 
                    WHERE id='{$_GET['id']}'";
                $data = select($sql, TRUE);
            } else {
                $sql = "SELECT * FROM {$_GET['table']}";
                $data = select($sql);
            }
            break;
    }
    echo json_encode(['msg' => $msg,  'success' => $success, 'data' => $data]);
}

/* ------------------------------- BASE FUNCTION -------------------------------- */

// READ
function select($sql, $single = FALSE)
{
    global $db;
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute();
        if ($single) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

// INSERT - UPDATE - DELETE
function query($sql)
{
    global $db;
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute();
        return TRUE;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
