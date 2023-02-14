<?php 
  include 'inc_head.php';
  include '../connect.php';
?>
<html lang="ko">

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>V비즈링 영상관리자</title>

</head>

<body>
    <?php
      if ( $jb_login ) {
        echo '<h1>이미 로그인하셨습니다.</h1>';
        echo "<script>document.location.href='list.php';</script>";
      }
       else {
        
        $pwd = $_POST[ 'pwd' ];

        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
        
        $sql = "SELECT * FROM tb_video 
                WHERE video_rc='99999999' 
                AND video_phone='$pwd'";
        //administrator
        //echo $sql;
        $result = $connect->query($sql);
        
        if ($result->num_rows == 0) {
            $connect->close();
            echo "
            <script>
              window.alert('관리자 ID 또는 비밀번호를 확인하세요.')
              history.go(-1)
              </script>";
            }
        else {
          $row = mysqli_fetch_array( $result );
          /*          
            echo
              '<p>'
              . $row[ 'RC_KEY' ]
              . $row[ 'RC_CODE' ]
              . $row[ 'RC_NAME' ]
              . $row[ 'RC_PHONE' ]
              . $row[ 'RC_POINT' ]
              . '</p>'
            ;
          */
         
          $_SESSION[ 'login' ] = $pwd;


  

//              echo $_SESSION[ 'rcpoint' ]."<br>";

          $connect->close();

            echo "<script>document.location.href='list.php';</script>";
        }
        
      }
      
    ?>
</body>

</html>