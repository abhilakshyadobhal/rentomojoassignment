<?php
require_once 'connection.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comment Section</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container py-4">
        
    <nav class="mb-5">
            <ul class="pr-3">
                <!-- 
                <li><a class="cd-signup" href="#0" data-toggle="modal" data-target="#signup">Register</a></li> -->
                <?php
                if(isset($_SESSION['name']))
                {
                  
                   echo "<li class=\"pr-4\">
                            <a >"
                              .$_SESSION['name']."
                            </a>
                            </li>
                            <li class='nav-item'><a href=\"logout.php\">Logout</a></li>";

                }
                else
                {
                  echo "<li class='pr-4'><a data-toggle=\"modal\" data-target=\"#signin\">Login</a></li>";
                  echo "<li class='pr-4'><a data-toggle=\"modal\" data-target=\"#signup\">SignUp</a></li>";
                }
              ?>
            </ul>
        </nav>
        
        

        <!-- form to post a comment -->
        <main class="px-3 mt-4 pt-4">
            <form method="post" action="">
                <textarea class="form-control" name="comment" id="comment" rows="4"
                    placeholder="Type a Comment ....."></textarea>
                <input type="submit" value="Post Comment" name="post_comment" class="mt-4 float-right py-2 px-4 submit-btn">
            </form> 
            <?php
            if(isset($_POST['post_comment'])){
                $name=$_SESSION['name'];
                $comment=htmlspecialchars($_POST['comment']);
                $upvote=0;
                $downvote=0;
                $sql="INSERT INTO comments(commentername,commentbody,upvotes,downvotes) VALUES ('$name', '$comment','$upvote','$downvote')";
                $result=mysqli_query($connect,$sql);
            }
            ?>            
        </main>




        <!-- section containing all the comments -->
        <section class="px-4">
            <div class="all-comments">
               
                <?php
                    $sql = "SELECT * from comments order by id";
                    $result = mysqli_query($connect, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="commenter-details">
                                <span class="comment-id">
                                    <?php echo $row['id'];?>
                                </span>
                                <span class="commenter-name pl-2">
                                    <?php echo $row['commentername']; ?>
                                </span>
                            </div>
                            <div class="comment pl-4">
                                <?php echo $row['commentbody']; ?>
                            </div>
                        </div>
                        <div class="col-md-3 px-5">
                            <div class="upvote-downvote px-4">
                                <div class="upvote">
                                    <button class="btn">
                                        <i class="fas fa-thumbs-up" style="color: green;"></i>
                                    </button>
                                    <span id="upnum" name="upnum">
                                        <?php echo $row['upvotes']; ?>
                                    </span><span id="votes"> Votes</span>
                                </div>
                                <div class="downvote pt-0 mt-0">
                                    <button class="btn">
                                        <i class="fas fa-thumbs-down" style="color: red;"></i>
                                    </button>
                                    <span id="downum" name="downum">
                                        <?php echo $row['downvotes']; ?>
                                    </span><span id="votes"> Votes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                <?php
                    }                            
                ?>
                    
            </div>
        </section>  

    </div>


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

    <!-- php code for login  -->

    <?php
        if(isset($_POST['login'])){
            $useremail = $_POST['useremail'];

            $userpassword = $_POST['userpassword'];

            $row = mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM users WHERE email='$useremail' AND password='$userpassword'"));
                
            // $_SESSION['cart']=array();
                
            $_SESSION['name'] = $row['name'];
        }
    ?>

    <!-- user signup modal -->

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

    <!-- php code for signup -->
    <?php
        if(isset($_POST['userregister'])){  
            $newusername = mysqli_real_escape_string($connect,$_POST['newusername']);
            $newuseremail = mysqli_real_escape_string($connect,$_POST['newuseremail']);
            $newuserpassword = mysqli_real_escape_string($connect,$_POST['newuserpassword']);
            $sql="INSERT INTO users(name, email, password)VALUES('$newusername', '$newuseremail','$newuserpassword')";
            $result=mysqli_query($connect,$sql);
            $_SESSION['name']=  $newusername;
            echo "<script>location.href('index.php');</script>";
        }
    ?>

  

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>