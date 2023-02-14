<?php  
  include '../connect.php';    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />        
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>V비즈링 영상관리자</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body{
            background: #1E3047;
        }
        table{
            margin: 0 auto;
            margin-top: 50px;
        }
        .btn{
            display:flex;
            justify-content: center;
            margin-top: 50px;
            
        }
        .btn-excel{
            background-color: #009000;
            box-shadow: 0px 0px 7px #009000;
        }
    </style>

    <?php
    
        $sql = "SELECT 
                    IFNULL(video_no, '0') AS video_no, 
                    IFNULL(video_rc, '0') AS video_rc, 
                    IFNULL(video_phone, '0') AS video_phone, 
                    IFNULL(video_idx, '0') AS video_idx, 
                    IFNULL(video_flag, '0') AS video_flag,
                    IFNULL(video_modtime, '0') AS video_modtime 
                FROM tb_video
                ORDER BY video_no ASC;";
    ?>
    
</head>

<body>


<?php
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
        echo "서버 연결 실패!";
    }

    $result = $connect->query($sql);
    $total_rows = mysqli_num_rows($result);

?>
    <div class="btn">
        <a onclick="location.href ='download.php';">
            <button class="btn-excel">
                엑셀 다운로드
            </button>
        </a>
    </div>
    <table id="table_customers">
        <thead> 
            <tr>
                <th>번호</th>
                <th>사번</th>
                <th>휴대폰</th>
                <th>IDX</th>
                <th>동의</th>
                <th>등록시간</th>
            </tr>
            </thead> 
        <?php


                while($row = $result->fetch_array()){

        ?>

        <tbody>
            <tr >
                <td><?php echo $row['video_no'];?></td>
                <td><?php echo $row['video_rc'];?></td>
                <td><?php echo $row['video_phone'];?></td>
                <td><?php echo $row['video_idx'];?></td>
                <td><?php echo $row['video_flag'];?></td>
                <td><?php echo $row['video_modtime'];?></td>
            </tr>
        

                <?php } ?>

        </tbody>  
        </table>
    <?php
        $connect->close();
    ?>

</body>

</html>