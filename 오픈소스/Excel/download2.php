<?php

ini_set('display_errors', '1'); // ★
ini_set('display_startup_errors', '1'); // ★
error_reporting(E_ALL); // ★

set_time_limit(120);
ini_set("memory_limit", "256M");

include 'connect.php'; 
 
 
// $file = $_GET['file'];
 
 
header( "Content-type: application/vnd.ms-excel; charset=utf-8"); // ★
header( "Content-Disposition: attachment; filename = 영상리스트.xls" ); // ★   
header( "Content-Description: PHP4 Generated Data" ); // ★
 
 
$EXCEL_FILE = "
        <table border='1'>
            <tr>
                <td>번호</td>
                <td>사번</td>
                <td>휴대폰</td>
                <td>IDX</td>
                <td>동의</td>
                <td>등록시간</td>
            </tr>
        ";
 
$sql ="SELECT 
        IFNULL(video_no,'0') AS VIDEO_NO
        ,IFNULL(video_rc,'0') AS VIDEO_RC 
        ,IFNULL(video_phone,'0') AS VIDEO_PHONE
        ,IFNULL(video_idx,'0') AS VIDEO_IDX
        ,IFNULL(video_flag,'0') AS VIDEO_FLAG 
        ,IFNULL(video_modtime,'0') AS VIDEO_MODTIME 
        FROM tb_video
        ORDER BY video_no ASC ;";
 
 
 
 
$res = $connect->query($sql);
// if (!$res) {
//     echo printf("에러: %s\n", $mysqli->error);
// }

//  echo var_dump($res);
 
 
while ($row = $res->fetch_object()) {
   
    $EXCEL_FILE .= "
        <tr>
        <td>".$row->VIDEO_NO."</td>
        <td>".$row->VIDEO_RC."</td>     
        <td>".substr($row->VIDEO_PHONE, 0, 3).'-'.substr($row->VIDEO_PHONE, 3)."</td>     
        <td>".$row->VIDEO_IDX."</td>
        <td>".$row->VIDEO_FLAG."</td>
        <td>".$row->VIDEO_MODTIME."</td>
        </tr> 
    ";
}
 
$EXCEL_FILE .= "</table>";
 
 
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $EXCEL_FILE;

?>
