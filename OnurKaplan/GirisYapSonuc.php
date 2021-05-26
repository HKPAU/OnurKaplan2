<?php

session_start();
try {
	$db = new PDO("mysql:host=localhost;dbname=OnurKaplan;charset=utf8" , "root" , "");
} catch (Exception $error) {
	echo "Baglantı Hatası.<br/>";
	echo "Hata : " . $error->getMessage();
	die();
}

function Guvenlik($Value){
    $First      = trim($Value);
    $Second     = htmlspecialchars($First);
    $Three      = strip_tags($Second);
    return $Three;
}


function FilterForNumber($Value){
    $First      = Guvenlik($Value);
    $Flush      = preg_replace("/[^0-9]/" , "" , $First);
    return $Flush;
}

function Sifrele($Value){
    return md5(sha1($Value));
}


if($_POST["Username"] != ""){
    $GelenUserName  = Guvenlik($_POST["Username"]);
}else{
    $GelenUserName  = "";
}


if($_POST["Password"] != ""){
    $GelenPassword  = Guvenlik($_POST["Password"]);
}else{
    $GelenPassword  = "";
}


if(($GelenUserName != "") and ($GelenPassword != "")){
    $SifreliPassword    = Sifrele($GelenPassword);
    $ReadMember         = $db->prepare("SELECT * FROM members WHERE Username = ? AND Sifre = ? LIMIT 1");
    $ReadMember->execute([
        $GelenUserName ,
        $SifreliPassword
    ]);
    $ControlForSignIN   = $ReadMember->rowCount();

    if($ControlForSignIN > 0){
        $_SESSION["uye"] 	= $GelenUserName;
        header("Location:OnurKaplan.php");
        exit();
    }else{
        header("Location:GirisYapHata.php");
        exit();
    }
}else{
    header("Location:GirisYapBosDeger.php");
    exit();
}


?>