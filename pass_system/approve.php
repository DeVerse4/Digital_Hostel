<?php

include "../admin.php";
include "mail.php";
$sno = $_GET["id"];
// $code = "$_SESSION['id'].rand(1000,2000)";
$dsn = connect();
$passid = rand(1000, 9999);
$query = mysqli_query($dsn, "UPDATE `passgeneration` SET status='Approved' WHERE status ='Pending' and sno = $sno");
if ($query == 1) {
  $query = mysqli_query($dsn, "select * from `passgeneration` where sno = $sno");
  $rs = mysqli_fetch_row($query);
  $q1 = mysqli_query($dsn, "select mailid from tblRegistration where collegeid='$rs[2]'");
  $subject = 'Pass Generated';
  $message .= '<div style="border:2px solid #4b49ac; border-radius: 10px; padding: 1rem; background-color:#fff; color:#222; width: 400px;">';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; gap: 10px;">';
  $message .= '<b style="width:100px;">Pass Id: </b><span>' . $rs[10] . '</span>';
  $message .= '</h3>';
  $message .= '</div>';
  $message .= '<h1 style="text-align:center;">VGI Hostel, Dadri</h1>';
  $message .= ' <h2 style="text-align:center; ">GATE PASS (for Hostellers)</h2>';
  $message .= '<h3 style="text-align:center;">Online Generated Pass</h3>';
  $message .= '<div style="width: 80%; text-transform: uppercase;">';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; "><b style="width:100px;">Hosteller Name :</b>';
  $message .= '<span style="width:200px; text-align: end;">' . $rs[1] . '</span>';
  $message .= '</h3>';
  $message .= '</div>';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; "><b style="width:100px;">College ID :</b>';
  $message .= '<span style="width:200px; text-align: end;">' . $rs[2] . '</span>';
  $message .= ' </h3>';
  $message .= '</div>';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; "><b style="width:100px;">Room No :</b>';
  $message .= '<span style="width:200px; text-align: end;">' . $rs[3] . '</span>';
  $message .= '</h3>';
  $message .= '</div>';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; "><b style="width:100px;">Phone No:</b>';
  $message .= '<span style="width:200px; text-align: end;">' . $rs[4] . '</span>';
  $message .= '</h3>';
  $message .= ' </div>';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; ">';
  $message .= '<b style="width:100px;">Visiting Address :</b>';
  $message .= '<span style="width:200px; text-align: end;">' . $rs[5] . '</span>';
  $message .= '</h3>';
  $message .= ' </div>';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; ">';
  $message .= '<b style="width:100px;">Purpose :</b>';
  $message .= '<span style="width:200px; text-align: end;">' . $rs[6] . '</span>';
  $message .= '</h3>';
  $message .= ' </div>';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; ">';
  $message .= '<b style="width:100px;">Departure Date/Time :</b>';
  $message .= '<span style="width:200px; text-align: end;">' . $rs[7] . '</span>';
  $message .= '</h3>';
  $message .= ' </div>';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; "><b style="width:100px;">Return Date:</b>';
  $message .= '<span style="width:200px; text-align: end;">' . $rs[8] . '</span>';
  $message .= '</h3>';
  $message .= ' </div>';
  $message .= '<div>';
  $message .= '<h3 style="display: flex; flex-direction: row; justify-content: space-between; ">';
  $message .= '<b style="width:100px;">Pass Status:</b>';
  $message .= '<span style="width:200px; text-align: end;">Approved</span>';
  $message .= '</h3>';
  $message .= ' </div>';
  $message .= ' </div>';
  $message .= ' </div>';
  $r = mysqli_fetch_row($q1);
  send_mail($subject, $message, $r[0]);
  header('location:passform.php?pr=1');
} else {
  echo "Data not inserted";
}

header("location:passReport.php?kk=1");

?>