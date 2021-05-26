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
    <div style="width:%100 ; height:auto ; background-color: #004447">
        <div class="container" style="width:100% ; height:auto ; background-color: #F9F4D7">
            <div style="height:30px"></div>
            <h1 style="color : #004447 ; font-family:Gil-Sans"><a href="OnurKaplan.php"><img style="margin-bottom : 5px" src="Images/left-arrow.png" alt=""></a>GÖNDERİLER</h1>
            <hr>
            <table style="width:100%">
    
    <?php

    try {
        $db = new PDO("mysql:host=localhost;dbname=OnurKaplan;charset=utf8" , "root" , "");
    } catch (Exception $error) {
        echo "Baglantı Hatası.<br/>";
        echo "Hata : " . $error->getMessage();
        die();
    }

    $FotoSiniri     = 3;
    $FotoBaslangic  = 1;

    $ReadPhoto  = $db->prepare("SELECT * FROM Images");
    $ReadPhoto->execute([]);
    $Photos     = $ReadPhoto->fetchAll();

    foreach($Photos as $Value){
    ?>
        <tr>
            <td style="width:350px; height:250px">
                <table style="width:350px; height:250px">
                    <tr>
                        <td align="center"><img style="width:350px ; height:250px" src="Resimler/<?php echo $Value["ImageName"]; ?>" alt=""></td>
                    </tr>
                    <tr>
                        <td style="width:350px; height:70px">
                            <table style="width:350px; height:40px">
                                <tr>
                                    <td style="width:300px; height:40px ; padding-left : 30px"><?php echo $Value["BegeniSayisi"]; ?></td>
                                    <td style="width:25px; height:40px"><a href="FotoBegen.php?ID=<?php echo $Value["id"]; ?>"><img src="Images/likeSmall.png" alt=""></a></td>
                                    <td style="width:25px; height:40px"><img id="YorumYap" style="cursor:pointer" src="Images/comments.png" alt=""></td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="3">
                                        <form action="YorumYap.php?ID=<?php echo $Value["id"] ?>" method="post">
                                            <input name="Yorum" id="YorumAlani" type="textarea" placeholder="Yorum Yap" style="width:350px ; height:60px ; resizable:none ; border : 2px solid #004447 ; border-radius : 15px ; padding:5px ; outline: none;">
                                            <button type="submit" class="btn btn-success">Yorum yap</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr></tr>
                </table>
            </td>
            <td style="width:100px">&nbsp;</td>
            <td style="width:600px; height:350px">
                <div style="width:600px; height:350px ; overflow:auto ; border:3px solid #004447 ; padding:10px ; border-radius:15px">
                <table style="width:600px; height:350px">
                    <tr>
                        <td style="width:600px; height:30px"><h1>YORUMLAR</h1><hr></td>
                    </tr>
                    <?php
                    $YorumOku   = $db->prepare("SELECT * FROM Comments WHERE PhotoID = ?");
                    $YorumOku->execute([$Value["id"]]);
                    $YorumSayisi    = $YorumOku->rowCount();

                    if($YorumSayisi > 0){
                        $Yorumlar   = $YorumOku->fetchAll();
                        foreach($Yorumlar as $Comment){
                            $ReadMember     = $db->prepare("SELECT * FROM members WHERE id = ?");
                            $ReadMember->execute([$Comment["UyeID"]]);
                            $MemberInfos    = $ReadMember->fetch();
                    ?>
                    <tr>
                        <td class="text-muted" style="width : 600px ; height : 50px ; font-size : 22px ; font-weight : bold ; font-family : Gil-sans ; color : #004447 ; border-bottom : 2px solid #004447"><?php echo $MemberInfos["UserName"]; ?> Diyor ki....</td>
                    </tr>
                    <tr>
                        <td style="width : 600px ; height : 120px ; font-size : 22px ; font-weight : bold ; font-family : Gil-sans ; color : #004447 ; border-bottom : 2px double #004447"><?php echo $Comment["Comment"]; ?></td>
                    </tr>
                    <tr>
                        <td style="height:45px">&nbsp;</td>
                    </tr>
                    <?php
                        }
                    }else{
                    ?>

                    <tr><td>Fotoğraf Hakkında Herhangi Bir Yorum Yapılmamış...</td></tr>
    
                    <?php
                    }

                    ?>
                </table>
                </div>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    <?php
    }
    ?>
            </table>
        </div>
    </div>

</body>
</html>
