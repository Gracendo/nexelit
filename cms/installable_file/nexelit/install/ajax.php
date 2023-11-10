<?php
/**
 *
 * check database connection
 * */
if (isset($_POST['action']) && $_POST['action'] === '_install_script') {
    $installation_path = $_POST['installation_path'];
    $db_name = $_POST['db_name'];
    $db_username = $_POST['db_username'];
    $db_host = $_POST['db_host'];
    $db_password = $_POST['db_password'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $admin_username = $_POST['admin_username'];
    $admin_name = $_POST['admin_name'];

    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         $import_database = importDatabase($db);

        $env_update_status = systemInstall([
            'database_host' => $db_host,
            'database_name' => $db_name,
            'database_username' => $db_username,
            'database_password' => $db_password
        ]);
        
         $admin_update_status = setAdminDetails([
            'database_host' => $db_host,
            'database_name' => $db_name,
            'database_username' => $db_username,
            'database_password' => $db_password
        ],[
            'admin_email' => $admin_email,
            'admin_username' => $admin_username,
            'admin_password' => $admin_password,
            'admin_name' => $admin_name,
        ]);
        
       
        echo json_encode([
            [
                'type' => $import_database ? 'success' : 'danger',
                'msg' =>  $import_database ? 'Database Imported Successfully' : 'Database Import Failed'
            ],
            [
                'type' => $env_update_status ? 'success' : 'danger',
                'msg' => $env_update_status ? 'System Information Updated Succssfully' : 'System Information Update Failed'
            ],
            [
                'type' => $admin_update_status ? 'success' : 'danger',
                'msg' => $admin_update_status ? 'Admin Credentials Updated Successfully' : 'Admin Credentials Update Failed'
            ],
          [
              'type' => $admin_update_status && $env_update_status && $import_database ? 'success' : 'danger',
              'msg' => $admin_update_status && $env_update_status && $import_database ? '<a href="https://cutt.ly/PLFZenO" target="_blank">NullCave Community</a> | Insallation Succssfull, if you still see install notice in your website, clear your browser cache '.'<a href="'.$installation_path.'">visit website</a>' : 'Installation Failed'
          ]
        ]);

    } catch (PDOException $e) {
        echo json_encode([
           [
             'type' => 'danger',
             'msg' => $e->getMessage()
            ]
        ]);
    }

}
/* system info update */
function systemInstall($db_details)
{
    $status = false;

    if (file_exists('env-sample.txt')) {
        $str = file_get_contents('env-sample.txt');
        $str = str_replace(array(
            'YOUR_APP_URL',
            'YOUR_DATABASE_HOST',
            'YOUR_DATABASE_NAME',
            'YOUR_DATABASE_USERNAME',
            'YOUR_DATABASE_PASSWORD'
        ),array(
            'localhost',
            $db_details['database_host'],
            $db_details['database_name'],
            $db_details['database_username'],
            '"' . $db_details['database_password'] . '"'
        ), $str);

        if (file_put_contents('../@core/.env', $str) != false) {
            $status = true;
        }
    }

    return $status;
}

/* import admin details */
function setAdminDetails($db, $admin_details)
{
    
    $db_name = $db['database_name'];
    $db_username = $db['database_username'];
    $db_host = $db['database_host'];
    $db_password = $db['database_password'];
    
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    $res =  $db->query("INSERT INTO `admins` SET email='" .$admin_details['admin_email'] . "',name='".$admin_details['admin_name']."',username='" . $admin_details['admin_username'] . "',email_verified='".'1'."',role='".'1'."',image='".null."',password='". password_hash($admin_details['admin_password'], PASSWORD_BCRYPT)."',remember_token='".null."',created_at='". date('Y-m-d h:i:s')."',updated_at='".date('Y-m-d h:i:s')."'");
    return (bool)$res;
}

/* import database */
function importDatabase($db)
{
    if (file_exists("database.sql")){
        $query = file_get_contents("database.sql");
        $stmt = $db->prepare($query);
        return (bool)$stmt->execute();
    }
    return false;
}




/* check database connection */
if (isset($_POST['action']) && $_POST['action'] === '_db_connection_check') {
    $db_name = $_POST['db_name'];
    $db_username = $_POST['db_username'];
    $db_host = $_POST['db_host'];
    $db_password = $_POST['db_password'];
    try {
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo json_encode([
            'type' => 'success',
            'msg' => 'Database Connected Successfully'
        ]);

    } catch (PDOException $e) {
        echo json_encode([
            'type' => 'danger',
            'msg' => $e->getMessage()
        ]);
    }
}

die();