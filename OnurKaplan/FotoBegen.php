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



if(($GelenID != "")){
    
    $BegeniGuncelle     = $db->prepare("UPDATE Images SET BegeniSayisi = BegeniSayisi + 1 WHERE id = ?");
    $BegeniGuncelle->execute([$GelenID]);
    $Control            = $BegeniGuncelle->rowCount();
    
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