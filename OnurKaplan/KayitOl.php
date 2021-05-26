<?php

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


if($_POST["PasswordTekrar"] != ""){
    $GelenPasswordTekrar  = Guvenlik($_POST["PasswordTekrar"]);
}else{
    $GelenPasswordTekrar  = "";
}


if($_POST["EMail"] != ""){
    $GelenEMail  = Guvenlik($_POST["EMail"]);
}else{
    $GelenEMail  = "";
}


if($_POST["Cinsiyet"] != ""){
    $GelenCinsiyet  = Guvenlik($_POST["Cinsiyet"]);
}else{
    $GelenCinsiyet  = "";
}


if($_POST["SecurityQuestion"] != ""){
    $GelenSecurityQuestion  = Guvenlik($_POST["SecurityQuestion"]);
}else{
    $GelenSecurityQuestion  = "";
}


if($_POST["SecurityAnswer"] != ""){
    $GelenSecurityAnswer  = Guvenlik($_POST["SecurityAnswer"]);
}else{
    $GelenSecurityAnswer  = "";
}


if(($GelenUserName != "") and ($GelenPassword != "") and ($GelenPasswordTekrar != "") and ($GelenEMail != "") and ($GelenCinsiyet != "") and ($GelenSecurityQuestion != "") and ($GelenSecurityAnswer != "")){
    if($GelenPassword == $GelenPasswordTekrar){


        $MemberControl  = $db->prepare("SELECT * FROM members WHERE EMailAdresi = ?");
        $MemberControl->execute([$GelenEMail]);
        $ControlForEMail    = $MemberControl->rowCount();

        if($ControlForEMail == 0){
            $UsernameControl    = $db->prepare("SELECT * FROM members WHERE Username = ?");
            $UsernameControl->execute([$GelenUserName]);
            $ControlForUsername     = $UsernameControl->rowCount();

            if($ControlForUsername == 0){
                $Sifre          = Sifrele($GelenPassword);
                $SifreliCevap   = Sifrele($GelenSecurityAnswer);
                $NewMember      = $db->prepare("INSERT INTO members (Username , Sifre , EMailAdresi , Cinsiyet , SecurityQuestion , SecurityAnswer , MemberState) values (? , ? , ? , ? , ? , ? , ?)");
                $NewMember->execute([
                    $GelenUserName , 
                    $Sifre ,
                    $GelenEMail , 
                    $GelenCinsiyet , 
                    $GelenSecurityQuestion , 
                    $SifreliCevap ,
                    1
                ]);
                $Control        = $NewMember->rowCount();
                if($Control == 1){
                    header("Location:KayitOlTamam.php");
                    exit();
                }else{
                    header("Location:KayitOlHata.php");
                    exit();
                }
            }else{
                header("Location:VarOlanEMailUserName.php");
                exit();
            }
        }else{
            header("Location:VarOlanEMailUserName.php");
            exit();
        }
    }else{
        header("Location:KayitOlUyumsuzSifreler.php");
        exit();
    }
}else{
    header("Location:KayitOlBosDeger.php");
    exit();
}


?>

