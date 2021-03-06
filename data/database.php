<?php
    global $connection;
    global $login;
    function connectDB(){
        $db_host = "localhost";
        //$db_username = "id12624664_gamewiki";
        //$db_password = "gamewiki";
        //$db_name = "id12624664_gamewikiphp";
        $db_username = "root";
	    $db_password = "";
        $db_name = "wiki";

        global $connection;
        $connection = mysqli_connect($db_host,
									 $db_username,
									 $db_password,
                                     $db_name);
        if(mysqli_connect_errno()!=0){
            return false;
        }else{
            return true;
        }
    }
    function getPendingUpdates(){
        $sql = "SELECT * FROM updates
                WHERE updatetag = 1";
        global $connection;
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            return false;
        }else{
            $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
            return $row;
        }
    }
    function setUpdateTag($tag, $updateid){
        $sql = "UPDATE updates
                SET updatetag = '$tag'
                WHERE updateid = '$updateid'";
        global $connection;
        $result = mysqli_query($connection, $sql);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
    function insertContent($path, $uid, $updatetag = 1){
        $sql = "INSERT INTO updates(updatepath, updatetag, uid)
                VALUES('$path', '$updatetag', '$uid')";
        global $connection;
        $result = mysqli_query($connection, $sql);
        if($result){
            return true;
        }
        else{
            return false;
        }

    }
    function uploadImage($path, $uid){

        $sql = "UPDATE users
                SET upfp = '$path'
                WHERE `uid` = '$uid'";
        global $connection;
        $result = mysqli_query($connection, $sql);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
    function closeDB(){
        global $connection;
        mysqli_close($connection);
    }
    function isEmailExisting($email){
        $sql = "SELECT uemail FROM users
                WHERE uemail = '$email'";
        
        global $connection;
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            return false;
        }else{
            return true;
        }
    }

    function isUsernameExisting($username){
        $sql = "SELECT username FROM users
                WHERE username = '$username'";
        global $connection;
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            return false;
        }else{
            return true;
        }
    }
    function checkIfUniqueUsername($username, $uid){
        $sql = "SELECT username FROM users
                WHERE  username = '$username'
                AND `uid` != $uid";
        global $connection; 
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            return true;
        }else{
            return false;
        }
    }
    function checkIfUniqueEmail($email, $uid){
        $sql = "SELECT username FROM users
                WHERE uemail = '$email'
                AND `uid` != '$uid'";
        global $connection; 
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            return true;
        }else{
            return false;
        }

    }
    function checkPassword($password, $uid){
        $sql = "SELECT upassword FROM users
        WHERE `uid` = '$uid' 
        AND upassword = '$password'";
        global $connection; 
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
            return false;
        }else{
            return true;
        }
    }
    function registerUser($username, $password, $email, $type = 1, $pfp='img/default.png'){
        
        $sql = "INSERT INTO users(username, upassword, uemail, utype, upfp)
                VALUES('$username', '$password', '$email', '$type', '$pfp')";
        global $connection;
        $result = mysqli_query($connection, $sql);
        if ($result) {
            return true;
        } else {
            return "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Invalid inputs</strong>.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
    }
    function updateUser($username, $password, $email, $path, $uid){
        $sql = "UPDATE users
                SET username = '$username',
                    uemail = '$email',
                    upassword = '$password',
                    upfp = '$path'
                WHERE `uid` = '$uid'";
        global $connection; 
        $result = mysqli_query($connection, $sql);
        if($result) {
            
            $sql = "SELECT * FROM users
                WHERE `uid` = '$uid'";
            $connection;
            $result = mysqli_query($connection, $sql);
            if(mysqli_num_rows($result) == 0){
                return "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Session did not update</strong>. Contact admin for support.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            }else{
                $row = mysqli_fetch_array($result);
                $client = array("uid" => $row['uid'],
                            "username" => $row['username'],
                            "uemail" => $row['uemail'],
                            "utype" => $row['utype'],
                            "upfp"  => $row['upfp']);
                $_SESSION['client'] = $client;
                return true;
            }
        } else {
            return "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Invalid inputs</strong>.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
    }
    function loginUser($username, $password){
        $sql = "SELECT * FROM users
        WHERE username = '$username'
        AND upassword = '$password'";
        global $connection, $login;
        $login = mysqli_query($connection, $sql);

        if(mysqli_num_rows($login) == 0){
            return false;
        }else{
            $row = mysqli_fetch_array($login);
            $client = array("uid" => $row['uid'],
                        "username" => $row['username'],
                        "uemail" => $row['uemail'],
                        "utype" => $row['utype'],
                        "upfp"  => $row['upfp']);
            $_SESSION['client'] = $client;
            return true;
        }
    }    
?>