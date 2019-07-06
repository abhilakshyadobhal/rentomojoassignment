<?php
    require_once('connection.php');
?>
<!-- user login modal -->

<div class="modal fade" id="signin" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="width: 400px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Login</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email"
                            name="useremail" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd1" placeholder="Enter password"
                            name="userpassword" required>
                    </div>
                    <button type="submit" class="btn btn-default text-center" name="login"
                        style="background-color: green;color: white;font-family: sans-serif; margin-left: 145px;">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['login'])){
    $useremail = $_POST['useremail'];

    $userpassword = $_POST['userpassword'];

    $row = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM users WHERE email='$useremail' AND password='$userpassword'"));
        
    // $_SESSION['cart']=array();
        
    $_SESSION['name'] = $row['name'];
}
?>