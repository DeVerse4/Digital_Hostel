<?php

function connect()
{
    return mysqli_connect("localhost", "root", "", "digital_hostel", "3306");
}

function addUser($collegeid, $name, $encrypted_password, $mailid, $verification_code)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "INSERT INTO tbllogin(`collegeid`,`pass`,`lastmodified`) values('$collegeid','$encrypted_password',now())");
    if ($x == 1) {
        $x = mysqli_query($dsn, "INSERT INTO tblregistration(`collegeid`, `name`, `mailid`, `verification_code`, `lastmodified`) values('$collegeid','$name','$mailid', '$verification_code',now())");
        return $x;
    }
    return 0;
}

function checkId($collegeid, $pass)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT `wmode`,`name` FROM `tblLogin` e,`tblRegistration` r WHERE e.`collegeid`='$collegeid' AND BINARY `pass`='$pass' AND e.`collegeid` = r.`collegeid`");
    return $x;
}

function fetchEmail($collegeid)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT mailid from tblregistration where collegeid='$collegeid'");
    return $x;
}
function getRoomNo()
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT roomno,floor,wing,hostalname from tblRoom order by 1");
    return $x;
}
function roomAlloted($collegeid, $roomno, $roomtype, $roomstatus, $roomallotmentdate)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "INSERT INTO tblroomallotment(`collegeid`, `roomno`, `roomtype`, `roomstatus`, `allotmentdate`) values('$collegeid','$roomno','$roomtype','$roomstatus',now())");
    return $x;
}
function getAllRooms()
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT r.roomno,r.roomtype,r.floor,r.wing,a.allotmentdate,a.collegeid,reg.name FROM tblroom r,tblroomallotment a,tblregistration reg WHERE r.roomno=a.roomno AND a.collegeid=reg.collegeid");
    return $x;
}
function getCollegeId()
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT collegeId,name,mobile from tblRegistration order by 1");
    return $x;
}


function checkEmail($email)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT verification_code from tblregistration where mailid='$email'");
    return $x;
}
function isVerified($collegeid)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT verification_code,mailid from tblregistration where collegeid='$collegeid'");
    return $x;
}

function updateVerifyStatus($mailid)
{
    $dsn = connect();
    mysqli_query($dsn, "update tblregistration set verification_code='verified' where mailid='$mailid'");
}

function addComplaint($collegeid, $subject, $msg)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "INSERT INTO `tblcomplaint`(`collegeid`, `subject`, `message`, `lastmodified`) VALUES('$collegeid','$subject','$msg',now())");
    return $x;
}

function getAllComplaintsReport()
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT * from tblcomplaint order by 1");
    return $x;
}

function getUserComplaints($u)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT `sno`,`subject`,`message`,`lastmodified`,`complaint_status`,`resolvemessage`,`resolve_date` FROM `tblcomplaint` WHERE `collegeid` = '$u'");
    return $x;
}

function deleteComplaint($sno)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "delete from tblComplaint where sno = $sno");
    return $x;
}

function getComplaint($sno)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT * from tblComplaint where sno = $sno");
    return $x;
}

function updComplaint($sno, $rmsg)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "update tblcomplaint set complaint_status='RESOLVED', resolvemessage='$rmsg', resolve_date=now() where sno = $sno");
    return $x;
}
function uploadPhoto($collegeid, $photo, $photoTag)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "INSERT INTO `tblgallery`(`collegeid`, `photo`, `phototag`, `upload_date`) VALUES ('$collegeid','$photo','$photoTag',now())");
    return $x;
}
function fetchPhoto($n)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT `photo` FROM `tblgallery` WHERE `s.No` = $n");
    return $x;
}
function showPhoto()
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT * from tblgallery order by 1 desc");
    return $x;
}

function addMessage($name, $email, $subject, $message)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "INSERT INTO `tblcontact`(`name`, `email`, `subject`, `message`, `contact_datetime`) VALUES('$name','$email','$subject','$message',now())");
    return $x;
}
function fetchfaq()
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT * FROM `tblfaq`");
    return $x;
}

function singeleUserComplaint($collegeid)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "SELECT * FROM `tblcomplaint` WHERE `collegeid` = '$collegeid'");
    return $x;
}
function addPass($name, $collegeid, $room_no, $phone_no, $destination, $purpose, $out_date, $return_date, $passid)
{
    $dsn = connect();
    $x = mysqli_query($dsn, "INSERT INTO `passgeneration`(`name`, `college_id`, `room_no`, `phone_no`, `destination`, `purpose`, `out_date`,returndate,passid) VALUES ('$name','$collegeid','$room_no','$phone_no','$destination','$purpose','$out_date','$return_date','$passid')");
    return $x;
}