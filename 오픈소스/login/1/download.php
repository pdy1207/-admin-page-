<?php
set_time_limit(120);
ini_set("memory_limit", "256M");
?>

<?php
include '../connect.php';   


$file = $_GET['file'];
//$mysqli = new mysqli('127.0.0.1', 'root', '비번', '테이블명');

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 영상리스트.xls" );     //filename = 저장되는 파일명을 설정합니다.
header( "Content-Description: PHP4 Generated Data" );

//엑셀 파일로 만들고자 하는 데이터의 테이블을 만듭니다.
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
            IFNULL(VIDEO_NO,'0') AS VIDEO_NO
            ,IFNULL(VIDEO_RC,'0') AS VIDEO_RC 
            ,IFNULL(VIDEO_PHONE,'0') AS VIDEO_PHONE
            ,IFNULL(VIDEO_IDX,'0') AS VIDEO_IDX
            ,IFNULL(VIDEO_FLAG,'0') AS VIDEO_FLAG 
            ,IFNULL(VIDEO_MODTIME,'0') AS VIDEO_MODTIME 
            FROM TB_VIDEO
ORDER BY VIDEO_NO ASC ;";



$res = $connect->query($sql);



// // DB 에 저장된 데이터를 테이블 형태로 저장합니다.
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

// 만든 테이블을 출력해줘야 만들어진 엑셀파일에 데이터가 나타납니다.
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $EXCEL_FILE;
?>