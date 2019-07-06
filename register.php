<?php
    include('connection.php');
?>



<!-- user login modal -->

<div class="modal fade" id="signup" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">
    
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">SignUp</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" class="form-control" id="name1"  placeholder="Enter name" name="newusername" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" id="email1"  placeholder="Enter email" name="newuseremail" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password*</label>
                        <input type="password" class="form-control" id="pwd2" placeholder="Enter password" name="newuserpassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                    </div>
                    <button type="submit" class="btn btn-default" name="userregister"  style="background-color: green;color: white;font-family: sans-serif; margin-left: 145px;">SignUp</button>
                </form>
            </div>
        </div>
    </div>
</div>   
  

  
<?php
if(isset($_POST['userregister'])){  
    $newusername = mysqli_real_escape_string($connect,$_POST['newusername']);
    $newuseremail = mysqli_real_escape_string($connect,$_POST['newuseremail']);
    $newuserpassword = mysqli_real_escape_string($connect,$_POST['newuserpassword']);
    $sql="INSERT INTO users(name, email, password)VALUES('$newusername', '$newuseremail','$newuserpassword')";
    $result=mysqli_query($connect,$sql);
    echo "<script>location.href('index.php');</script>";
}
?>


