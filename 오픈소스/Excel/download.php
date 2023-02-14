<?php
include 'connect.php';

$file = $_GET['file'];
//$mysqli = new mysqli('127.0.0.1', 'root', '비번', '테이블명');

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = excel_list.xls" );     //filename = 저장되는 파일명을 설정합니다.
header( "Content-Description: PHP4 Generated Data" );

//엑셀 파일로 만들고자 하는 데이터의 테이블을 만듭니다.
$EXCEL_FILE = "
<table border='1'>
    <tr>
       <td>타잎</td>
       <td>이름</td>
       <td>RC번호</td>
       <td>통신사</td>
       <td>전화번호</td>
       <td>생년월일</td>
       <td>성별</td>
       <td>등록시간</td>
       <td>상태</td>
       <td>영상</td>
    </tr>
";

$sql ="SELECT 
                IFNULL(biz_key, '0') AS biz_key, 
                IFNULL(biz_type, '0') AS biz_type, 
                IFNULL(biz_name, '0') AS biz_name, 
                IFNULL(biz_rc, '0') AS biz_rc, 
                IFNULL(biz_phonecorp, '0') AS biz_phonecorp, 
                IFNULL(biz_phone, '0') AS biz_phone, 
                IFNULL(biz_birth, '0') AS biz_birth, 
                IFNULL(biz_gender, '0') AS biz_gender, 
                IFNULL(biz_regtime, '0') AS biz_regtime, 
                IFNULL(biz_flag, '0') AS biz_flag,
                IFNULL(biz_move, '') AS biz_move
        FROM tb_bizring 
        WHERE biz_type = '간편' 
        ORDER BY biz_regtime DESC;";

$res = $connect->query($sql);

// DB 에 저장된 데이터를 테이블 형태로 저장합니다.
while ($row = $res->fetch_object()) {
    if ($row->biz_phonecorp == 'KTF'){
        $phonecorp = 'KT';
    } else { 
        $phonecorp = $row->biz_phonecorp;
    }
$EXCEL_FILE .= "
    <tr>
       <td>".$row->biz_type."</td>
       <td>".$row->biz_name."</td>
       <td>".$row->biz_rc."</td>
       <td>".$phonecorp."</td>
       <td>".substr($row->biz_phone, 0, 3).'-'.substr($row->biz_phone, 3)."</td>
       <td>".$row->biz_birth."</td>
       <td>".mb_substr($row->biz_gender,0,1,'UTF-8')."</td>
       <td>".$row->biz_regtime."</td>
       <td>".$row->biz_flag."</td>
       <td>".$row->biz_move."</td>
    </tr>  
";
}

$EXCEL_FILE .= "</table>";

// 만든 테이블을 출력해줘야 만들어진 엑셀파일에 데이터가 나타납니다.
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $EXCEL_FILE;
?>
