<?php
    if(isset($_SESSION['id']) && isset($_SESSION['log'])){
        $client = $_SESSION['client'];
        $email = $client['uemail'];
        $username = $client['username'];
	}else{
        $email = "";
        $username = "";
    }
    if(isset($_POST['edit'])){
        require_once('data/database.php'); 
        if(connectDB()){
            if(checkPassword($_POST['password'], $client['uid'])){
                if($_POST['email'] != $client['uemail']){
                    if(handleUniqueEmail($_POST['email'], $client['uid'])){
                        if($_POST['username'] != $client['username']){
                            if(handleUniqueUsername($_POST['username'],$client['uid'])){
                                if(isset($_POST['chpassword']) && isset($_POST['cpassword']) && !empty($_POST['chpassword'])){
                                    if($_POST['chpassword'] == $_POST['cpassword']){
                                        if(updateUser($_POST['username'],$_POST['cpassword'],$_POST['email'],$client['uid'])){
                                            if(retrieveUser($client['uid'])){
                                                if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){
                                                    
                                                    $path = "img/profile_image/". $client['uid'] . time() . MD5($_FILES['image']['name']). ".png";
                                                    $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
                                                    if($upload){
                                                        if(uploadImage($path, $client['uid'])){
                                                            $client['upfp'] = $path;
                                                        }else{
                                                            echo "error uploading to db";
                                                        }
                                                        
                                                    }else{
                                                        echo "error uploading to server";
                                                    }
                                                }
                                                echo "<script type='text/javascript'> window.location='dashboard.php'; </script>";  
                                            }else{
                                                echo "retrieval failed";
                                            }
                                        }else{
                                            echo "update user failed";
                                        }
                                    }else{
                                        echo "oops passwords";
                                    }
                                }else{
                                    if(updateUser($_POST['username'],$_POST['password'],$_POST['email'],$client['uid'])){
                                        if(retrieveUser($client['uid'])){
                                            if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']) ){
                                                
                                                $path = "img/profile_image/". $client['uid'] . time() . MD5($_FILES['image']['name']). ".png";
                                                $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
                                                if($upload){
                                                    if(uploadImage($path, $client['uid'])){
                                                        $client['upfp'] = $path;
                                                    }else{
                                                        echo "error uploading to db";
                                                    }
                                                    
                                                }else{
                                                    echo "error uploading to server";
                                                }
                                            }
                                             echo "<script type='text/javascript'> window.location='dashboard.php'; </script>";
                                        }else{
                                            echo "retrieval failed";
                                        }
                                    }else{
                                        echo "update user failed";
                                    }
                                }
                            }else{
                                echo "oops username already taken";
                            }
                        }else{
                            if(isset($_POST['chpassword']) && isset($_POST['cpassword'])&& !empty($_POST['chpassword'])){
                                if($_POST['chpassword'] == $_POST['cpassword']){
                                    if(updateUser($_POST['username'],$_POST['cpassword'],$_POST['email'],$client['uid'])){
                                        if(retrieveUser($client['uid'])){
                                            if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']) ){
                                                
                                                $path = "img/profile_image/". $client['uid'] . time() . MD5($_FILES['image']['name']). ".png";
                                                $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
                                                if($upload){
                                                    if(uploadImage($path, $client['uid'])){
                                                        $client['upfp'] = $path;
                                                    }else{
                                                        echo "error uploading to db";
                                                    }
                                                    
                                                }else{
                                                    echo "error uploading to server";
                                                }
                                            }
                                            echo "<script type='text/javascript'> window.location='dashboard.php'; </script>";
                                        }else{
                                            echo "retrieval failed";
                                        }
                                    }else{
                                        echo "update user failed";
                                    }
                                }else{
                                    echo "oops passwords";
                                }
                            }else{
                                if(updateUser($_POST['username'],$_POST['password'],$_POST['email'],$client['uid'])){
                                    if(retrieveUser($client['uid'])){
                                        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']) ){
                                            
                                            $path = "img/profile_image/". $client['uid'] . time() . MD5($_FILES['image']['name']). ".png";
                                            $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
                                            if($upload){
                                                if(uploadImage($path, $client['uid'])){
                                                    $client['upfp'] = $path;
                                                }else{
                                                    echo "error uploading to db";
                                                }
                                                
                                            }else{
                                                echo "error uploading to server";
                                            }
                                        }
                                        echo "<script type='text/javascript'> window.location='dashboard.php'; </script>";
                                    }else{
                                        echo "retrieval failed";
                                    }
                                }else{
                                    echo "update user failed";
                                }
                            }
                        }
                    }else{
                        echo "oops email already taken";
                    }
                }else{
                    if($_POST['username'] != $client['username']){
                        if(handleUniqueUsername($_POST['username'],$client['uid'])){
                            if(isset($_POST['chpassword']) && isset($_POST['cpassword']) && !empty($_POST['chpassword'])){
                                if($_POST['chpassword'] == $_POST['cpassword']){
                                    if(updateUser($_POST['username'],$_POST['cpassword'],$_POST['email'],$client['uid'])){
                                        if(retrieveUser($client['uid'])){
                                            if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']) ){
                                                
                                                $path = "img/profile_image/". $client['uid'] . time() . MD5($_FILES['image']['name']). ".png";
                                                $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
                                                if($upload){
                                                    if(uploadImage($path, $client['uid'])){
                                                        $client['upfp'] = $path;
                                                    }else{
                                                        echo "error uploading to db";
                                                    }
                                                    
                                                }else{
                                                    echo "error uploading to server";
                                                }
                                            }
                                            echo "<script type='text/javascript'> window.location='dashboard.php'; </script>";
                                        }else{
                                            echo "retrieval failed";
                                        }
                                    }else{
                                        echo "update user failed";
                                    }
                                }else{
                                    echo "oops passwords";
                                }
                            }else{
                                if(updateUser($_POST['username'],$_POST['password'],$_POST['email'],$client['uid'])){
                                    if(retrieveUser($client['uid'])){
                                        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']) ){
                                            
                                            $path = "img/profile_image/". $client['uid'] . time() . MD5($_FILES['image']['name']). ".png";
                                            $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
                                            if($upload){
                                                if(uploadImage($path, $client['uid'])){
                                                    $client['upfp'] = $path;
                                                }else{
                                                    echo "error uploading to db";
                                                }
                                                
                                            }else{
                                                echo "error uploading to server";
                                            }
                                        }
                                        echo "<script type='text/javascript'> window.location='dashboard.php'; </script>";
                                    }else{
                                        echo "retrieval failed";
                                    }
                                }else{
                                    echo "update user failed";
                                }
                            }
                        }else{
                            echo "oops username already taken";
                        }
                    }else{
                        if(isset($_POST['chpassword']) && isset($_POST['cpassword'])&& !empty($_POST['chpassword'])){
                            if($_POST['chpassword'] == $_POST['cpassword']){
                                if(updateUser($_POST['username'],$_POST['cpassword'],$_POST['email'],$client['uid'])){
                                    if(retrieveUser($client['uid'])){
                                        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']) ){
                                            
                                            $path = "img/profile_image/". $client['uid'] . time() . MD5($_FILES['image']['name']). ".png";
                                            $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
                                            if($upload){
                                                if(uploadImage($path, $client['uid'])){
                                                    $client['upfp'] = $path;
                                                }else{
                                                    echo "error uploading to db";
                                                }
                                                
                                            }else{
                                               echo "error uploading to server";
                                            }
                                            
                                        }
                                        echo "<script type='text/javascript'> window.location='dashboard.php'; </script>";
                                    }else{
                                        echo "retrieval failed";
                                    }
                                }else{
                                    echo "update user failed";
                                }
                            }else{
                                echo "oops passwords";
                            }
                        }else{
                            if(updateUser($_POST['username'],$_POST['password'],$_POST['email'],$client['uid'])){
                                if(retrieveUser($client['uid'])){
                                    if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']) ){
                                        
                                        $path = "img/profile_image/". $client['uid'] . time() . MD5($_FILES['image']['name']). ".png";
                                        $upload = move_uploaded_file($_FILES['image']['tmp_name'], $path);
                                        if($upload){
                                            if(uploadImage($path, $client['uid'])){
                                                $client['upfp'] = $path;
                                            }else{
                                                echo "error uploading to db";
                                            }
                                            
                                        }else{
                                            echo "error uploading to server";
                                        }
                                    }
                                    echo "<script type='text/javascript'> window.location='dashboard.php'; </script>";
                                }else{
                                    echo "retrieval failed";
                                }
                            }else{
                                echo "update user failed";
                            }
                        }
                    }
                }
                
            }else{
                echo "oops password";
            }
            echo $client['upfp'];
            closeDB();
        }
    }
    function handleUniqueEmail($email, $uid){
        if(checkIfUniqueEmail($email, $uid)){
            return true;
        }else{
            return false;
        }
    }
 
    function handleUniqueUsername($username, $uid){
        if(checkIfUniqueUsername($username, $uid)){
            return true;                 
        }
        else{
            return false;
        }
    }
?>
<header class="e:header-section header-section">
    <?php
        include('template/navbar.php'); 
    ?>
</header>
<section class="e:main-section container">
    <form class="login-form" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="register-email">Email</label>
                <input type="email" name="email" class="form-control" id="register-email" placeholder="Email"  value="<?php echo $email?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="register-username">Username</label>
                <input type="text" name="username" class="form-control" id="register-username" placeholder="Username"  value="<?php echo $username?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="register-password" class="col-sm-2 col-form-label">Change Password</label>
            <div class="col-sm-10">
                <input type="password" name="chpassword" class="form-control" id="register-new-password" placeholder="New Password">
            </div>
        </div>
        <div class="form-group row">
            <label for="register-con-password" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" name="cpassword" class="form-control" id="register-connew-password" placeholder="Confirm New Password">
            </div>
        </div>
        <div class="form-group row">
            
            <label for="file" class="col-sm-2 col-form-label"><img src="<?php echo $client['upfp']; ?>" class="rounded-circle" alt="profile image" height="150px" width="120px"></label>
            <div class="col-sm-10">
                <input type="file" name="image" class="form-control" id="file">
            </div>
        </div>
        <div class="form-group row">
            <label for="register-con-password" class="col-sm-2 col-form-label">Confirm Changes</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="register-con-password" placeholder="Current Password" required>
            </div>
        </div>
        
        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
    </form>
</section>