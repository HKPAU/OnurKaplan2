<?php

require_once("Verot/src/class.upload.php");

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

$GelenResim 	= $_FILES['Resim1'];

$UyeOku     = $db->prepare("SELECT * FROM members where Username = ?");
$UyeOku->execute([$_SESSION["uye"]]);
$UyeBilgileri   = $UyeOku->fetch();
$UyeID      = $UyeBilgileri["id"];

$ResimOku       = $db->prepare("SELECT * FROM images id ORDER BY id DESC");
$ResimOku->execute();
$ResimBilgileri = $ResimOku->fetch();
$ResimID        = $ResimBilgileri["id"];

$KlasorYolu     = dirname (__FILE__);
if(($GelenResim != "")){
    if(($GelenResim["name"] != "") AND ($GelenResim["type"] != "") AND($GelenResim["tmp_name"] != "") AND ($GelenResim["error"] == 0) AND ($GelenResim["size"] > 0)){
        $Resim1 	= new Verot\Upload\Upload($GelenResim);

        if($Resim1->uploaded){
            $VerotIcınKlasorYolu 	= "./Resimler" . "/";
			$Resim1->mime_magic_check 	 		= true;
			$Resim1->allowed			 		= array("image/*");
			$Resim1->file_new_name_body 		= "Resim" . ($ResimID + 1);
		   	$Resim1->image_convert 				= "png";
		   	$Resim1->image_quality 				= 100;
		   	$Resim1->image_background_color		= null; 
		   	$Resim1->image_resize 				= true;
		   	$Resim1->image_x 					= false;
		   	$Resim1->image_y 					= false;
		   	$Resim1->process($VerotIcınKlasorYolu);

            if($Resim1->processed){

                $Resim1     = "Resim" . ($ResimID + 1) . ".png";
    
                $ResimEkle  = $db->prepare("INSERT INTO Images (ImageName , UyeID , BegeniSayisi) values (? , ? , ?)");
                $ResimEkle->execute([$Resim1 , $UyeID , 0]);

                header("Location:OnurKaplan.php");
                exit();
            }else{
                echo "Hata";        
            }
        }
    }else{
        echo "Hata";
    }
}else{
    header("Location:ResimEkleBos.php");
    exit();
}


?>