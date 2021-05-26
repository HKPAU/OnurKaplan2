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

if($_GET["ID"] != ""){
    $GelenID  = Guvenlik($_GET["ID"]);
}else{
    $GelenID  = "";
}


if($_POST["Yorum"] != ""){
    $GelenYorum  = Guvenlik($_POST["Yorum"]);
}else{
    $GelenYorum  = "";
}

$UyeOku     = $db->prepare("SELECT * FROM members where Username = ?");
$UyeOku->execute([$_SESSION["uye"]]);
$UyeBilgileri   = $UyeOku->fetch();
$UyeID      = $UyeBilgileri["id"];


if(($GelenYorum != "")){
    $NewComment     = $db->prepare("INSERT INTO Comments (PhotoID , UyeID , Comment) values (? , ? , ?)");
    $NewComment->execute([$GelenID , $UyeID , $GelenYorum]);
    $Control        = $NewComment->rowCount();

    

    if($Control > 0){
        header("Location:AnaSayfa.php");
        exit();
    }else{
        header("Location:YorumYapHata.php");
        exit();
    }
}else{
    header("Location:YorumYapBosDeger.php");
    exit();
}


?>