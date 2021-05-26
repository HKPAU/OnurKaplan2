<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/HaberSitesi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body id="SingIN">
    <div style="background-color: #F9F4D7;">
        <table id="SignINFirstTable">
            <tr style="width: 100%; background-color: #F9F4D7; height: 100px;">
                <td id="OzluSozSignIN">İşitme Engeli Demek Haber Okuma Engeli Demek Değildir</td>
                <td id="SignINForm">
                    <form action="GirisYapSonuc.php" method="post">
                        <input type="text" name="Username" placeholder="Kullanıcı Adı">
                        <input type="password" name="Password" placeholder="Şifre">
                        <button style="margin-bottom: 8px; height: 40px; font-size: 18px; font-weight: bold;" class="btn btn-success" type="submit">Giriş Yap</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>
    <div style="height: 20px;"></div>
    <div>
        <table id="LogoAndRegistry">
            <tr>
                <td><img style="width: 650px; height: 650px;" src="Images/banner2.png" alt=""></td>
                <td>
                    <form id="RegisterForm" action="KayitOl.php" method="post">
                        <table>
                            <tr>
                                <td style="color: #F9F4D7 ; font-size: 28px; font-weight: bold; font-family: Georgia, 'Times New Roman', Times, serif; border-bottom: 1px solid #F9F4D7;" colspan="3">KAYIT OL</td>
                            </tr>
                            <tr>
                                <td style="height: 30px;" colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 180px; height: 45px; color: #F9F4D7; font-size: 20px; font-weight: bold;">Kullanıcı Adı</td>
                                <td style="width: 20px; height: 45px; color: #F9F4D7;">:</td>
                                <td><input type="text" name="Username"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 180px; height: 45px; color: #F9F4D7; font-size: 20px; font-weight: bold;">Şifre</td>
                                <td style="width: 20px; height: 45px; color: #F9F4D7;">:</td>
                                <td><input type="password" name="Password"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 180px; height: 45px; color: #F9F4D7; font-size: 20px; font-weight: bold;">Şifre Tekrar</td>
                                <td style="width: 20px; height: 45px; color: #F9F4D7;">:</td>
                                <td><input type="password" name="PasswordTekrar"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 180px; height: 45px; color: #F9F4D7; font-size: 20px; font-weight: bold;">E-Mail Adresi</td>
                                <td style="width: 20px; height: 45px; color: #F9F4D7;">:</td>
                                <td><input type="text" name="EMail"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 180px; height: 45px; color: #F9F4D7; font-size: 20px; font-weight: bold;">Cinsiyet</td>
                                <td style="width: 20px; height: 45px; color: #F9F4D7;">:</td>
                                <td><select name="Cinsiyet" id="">
                                    <option value="0">Lütfen Cinsiyetinizi Belirtiniz</option>
                                    <option value="Erkek">Erkek</option>
                                    <option value="Kadın">Kadın</option>
                                </select></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 180px; height: 45px; color: #F9F4D7; font-size: 20px; font-weight: bold;">Güvenlik Sorusu</td>
                                <td style="width: 20px; height: 45px; color: #F9F4D7;">:</td>
                                <td><select name="SecurityQuestion" id="">
                                    <option value="0">Lütfen Bir Güvenlik Sorusu Seçiniz</option>
                                    <option value="1">Futbol Takımınız</option>
                                    <option value="2">Annenizin Kızlık Soyadı</option>
                                    <option value="3">Babanızın Mesleği</option>
                                    <option value="4">İlk Evcil Hayvanınızın Adı</option>
                                    <option value="5">Liseyi Okuduğunuz İl</option>
                                </select></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 180px; height: 45px; color: #F9F4D7; font-size: 20px; font-weight: bold;">Güvenlik Cevabı</td>
                                <td style="width: 20px; height: 45px; color: #F9F4D7;">:</td>
                                <td><input type="password" name="SecurityAnswer"></td>
                            </tr>
                            <tr>
                                <td style="height: 30px;" colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" colspan="3"><button id="RegisterButton">Kayıt Ol</button></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>
    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
