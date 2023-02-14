<?php 
  include 'inc_head.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>V비즈링 영상관리자</title>
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div class="login-box">
      <h2>영상관리자 로그인</h2>
      <form action="login_result.php" method="POST" id="form" class="login">
        <div class="user-box">
          <input type="text" name="" required="" />
          <label>Username</label>
        </div>
        <div class="user-box">
          <input type="password" name="pwd" required="" />
          <label>Password</label>
        </div>
        <button href="#">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          
          Login
          
        </button>
      </form>
    </div>
    <script>
      var eye = document.getElementById('eye');

eye.addEventListener('click',togglePass);

function togglePass(){

eye.classList.toggle('active');

(pwd.type == 'password') ? pwd.type = 'text' : pwd.type = 'password';
}

    

</script>
  </body>
</html>
