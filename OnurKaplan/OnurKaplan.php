<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangisi Daha Güzel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="OnurKaplan.css">
    <link rel="icon" type="image/png" href="Images/question.png"/>
    <script src="jquery/jquery-3.6.0.min.js"></script>
<body>

<?php
    session_start();

    try {
        $db = new PDO("mysql:host=localhost;dbname=OnurKaplan;charset=utf8" , "root" , "");
    } catch (Exception $error) {
        echo "Baglantı Hatası.<br/>";
        echo "Hata : " . $error->getMessage();
        die();
    }


    $UyeOku         = $db->prepare("SELECT * FROM members WHERE Username = ?");
    $UyeOku->execute([$_SESSION["uye"]]);
    $UyeBilgileri   = $UyeOku->fetch();


    $ResimOku      = $db->prepare("SELECT * FROM images WHERE UyeID = ? ORDER BY id DESC");
    $ResimOku->execute([$UyeBilgileri["id"]]);
    
    if($ResimOku->rowCount() >= 2){

        $Resim1Oku          = $db->prepare("SELECT * FROM images WHERE UyeID = ? ORDER BY id DESC");
        $Resim1Oku->execute([$UyeBilgileri["id"]]);
        $Resim1Bilgileri    = $Resim1Oku->fetch();


        $Resim2Oku          = $db->prepare("SELECT * FROM images WHERE id = ?");
        $Resim2Oku->execute([($Resim1Bilgileri["id"] - 1)]);
        $Resim2Bilgileri    = $Resim1Oku->fetch();
    ?>
        <div id="MainDiv">
        <div class="container" id="InsideDiv">
            <table id="MainTable">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td id="LogoTD"><div>HANGİSİ DAHA GÜZEL</div></td>
                                <td style="width: 200px;"><a href="AnaSayfa.php"><img src="Images/house.png" alt=""></a></td>
                                <td style="width: 200px;"><a href=""><img src="Images/info.png" alt=""></a></td>
                                <td style="width: 200px;"><a href=""><img src="Images/communicate.png" alt=""></a></td>
                                <td style="width: 200px;"><a href=""><img src="Images/user.png" alt=""></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 980px; height: 335px">
                        <img src="Images/banner2.png" alt="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="width : 450px ; height : 350px ; border : 2px solid #004447">
                                   <img src="Resimler/<?php echo $Resim1Bilgileri["ImageName"]; ?>" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100px">&nbsp;</td>
                                <td>
                                    <form action="ResimEkle.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="Resim1">
                                        <button type="submit" class="btn btn-success">Ekle</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100px">&nbsp;</td>
                                <td><img style="margin-right:5px ; margin-bottom:5px" src="Images/likeSmall.png" alt=""><?php echo $Resim1Bilgileri["BegeniSayisi"]; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td style="width : 50px">&nbsp;</td>
                                <td style="width : 450px ; height : 350px ; border : 2px solid #004447">
                                    <img src="Resimler/<?php echo $Resim2Bilgileri["ImageName"]; ?>" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50px">&nbsp;</td>
                                <td>
                                    <form action="ResimEkle.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="Resim2">
                                        <button type="submit" class="btn btn-success">Ekle</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50px">&nbsp;</td>
                                <td><img style="margin-right:5px ; margin-bottom:5px" src="Images/likeSmall.png" alt=""><?php echo $Resim2Bilgileri["BegeniSayisi"]; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                </tr>


                <tr>
                    <td>
                        <div style="height: 450px; padding : 15px ; overflow: auto; border: 1px solid #004447">
                            <table>
                                <?php

                                $YorumOku   = $db->prepare("SELECT * FROM Comments WHERE PhotoID = ?");
                                $YorumOku->execute([$Resim1Bilgileri["id"]]);
                                $YorumSayisi    = $YorumOku->rowCount();

                                if($YorumSayisi > 0){
                                    $Yorumlar   = $YorumOku->fetchAll();
                                    foreach($Yorumlar as $Comment){
                                        $ReadMember     = $db->prepare("SELECT * FROM members WHERE id = ?");
                                        $ReadMember->execute([$Comment["UyeID"]]);
                                        $MemberInfos    = $ReadMember->fetch();
                                ?>
                                <tr>
                                    <td class="text-muted" style="width : 600px ; height : 50px ; font-size : 22px ; font-weight : bold ; font-family : Gil-sans ; color : #004447 ; border-bottom : 2px solid #004447"><?php echo $MemberInfos["UserName"]; ?> diyor ki....</td>
                                </tr>
                                <tr>
                                    <td style="width : 600px ; height : 50px ; font-size : 22px ; font-weight : bold ; font-family : Gil-sans ; color : #004447 ; border-bottom : 2px dashed #004447"><?php echo $Comment["Comment"]; ?></td>
                                </tr>
                                <tr>
                                    <td style="height: 40px;"></td>
                                </tr>
                                <?php
                                    }
                                }else{
                                ?>
                                <tr>
                                    <td style="width: 130px;"></td>
                                    <td>Bu Resim Hakkında Herhangi Bir Yorum Bulunmamaktadır</td>
                                </tr>
                                <?php
                                }

                                ?>
                            </table>
                        </div>
                    </td>
                    <td>
                        <div style="height: 450px; padding : 15px ; overflow: auto; border: 1px solid #004447">
                            <table>
                                <?php

                                $YorumOku   = $db->prepare("SELECT * FROM Comments WHERE PhotoID = ?");
                                $YorumOku->execute([$Resim2Bilgileri["id"]]);
                                $YorumSayisi    = $YorumOku->rowCount();

                                if($YorumSayisi > 0){
                                    $Yorumlar   = $YorumOku->fetchAll();
                                    foreach($Yorumlar as $Comment){
                                        $ReadMember     = $db->prepare("SELECT * FROM members WHERE id = ?");
                                        $ReadMember->execute([$Comment["UyeID"]]);
                                        $MemberInfos    = $ReadMember->fetch();
                                ?>
                                <tr>
                                    <td class="text-muted" style="width : 600px ; height : 50px ; font-size : 22px ; font-weight : bold ; font-family : Gil-sans ; color : #004447 ; border-bottom : 2px solid #004447"><?php echo $MemberInfos["UserName"]; ?> diyor ki....</td>
                                </tr>
                                <tr>
                                    <td style="width : 600px ; height : 50px ; font-size : 22px ; font-weight : bold ; font-family : Gil-sans ; color : #004447 ; border-bottom : 2px dashed #004447"><?php echo $Comment["Comment"]; ?></td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                </tr>

                                <?php
                                    }
                                }else{
                                ?>
                                <tr>
                                    <td style="width: 80px;"></td>
                                    <td>Bu Resim Hakkında Herhangi Bir Yorum Bulunmamaktadır</td>
                                </tr>
                                <?php
                                }

                                ?>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>    


    <?php
    }else{
    ?>
    <div id="MainDiv">
        <div class="container" id="InsideDiv">
            <table id="MainTable">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td id="LogoTD"><div>HANGİSİ DAHA GÜZEL</div></td>
                                <td style="width: 200px;"><a href="AnaSayfa.php"><img src="Images/house.png" alt=""></a></td>
                                <td style="width: 200px;"><a href=""><img src="Images/info.png" alt=""></a></td>
                                <td style="width: 200px;"><a href=""><img src="Images/communicate.png" alt=""></a></td>
                                <td style="width: 200px;"><a href=""><img src="Images/user.png" alt=""></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 980px; height: 335px">
                        <img src="Images/banner2.png" alt="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="width : 450px ; height : 350px ; border : 2px solid #004447">
                                    Resim Seç.....
                                </td>
                            </tr>
                            <tr>
                                <td style="width:100px">&nbsp;</td>
                                <td><img style="margin-right:5px ; margin-bottom:5px" src="Images/likeSmall.png" alt="">0</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td style="width : 50px">&nbsp;</td>
                                <td style="width : 450px ; height : 350px ; border : 2px solid #004447">
                                    Resim Seç.....
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50px">&nbsp;</td>
                                <td><img style="margin-right:5px ; margin-bottom:5px" src="Images/likeSmall.png" alt="">0</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>   
                    <td colspan="2">
                        <table>
                            <tr>
                                <td style="width: 500px;">&nbsp;</td>                   
                                <td>
                                    <form action="ResimEkle.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="Resim1">
                                        <button type="submit" class="btn btn-success">Ekle</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php
    }

?>

</body>
</html>