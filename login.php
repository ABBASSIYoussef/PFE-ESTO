<?php
// index.php
require 'includes/init.php';


// IF USER MAKING LOGIN REQUEST

if(isset($_POST['nom']) && isset($_POST['prenom']) &&  isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['password']) && isset($_POST['inscription'])){
    $result = $user_obj->singUpUser($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['password_confirmation'],$_POST['telephone'],$_POST['role']);
    
  }
  if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login'])){
    $result = $user_obj->loginUser($_POST['email'],$_POST['password']);
    
    

  }
  if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login']) && stripos($_POST['email'],'@admin.com')){
    $result = $admin_obj->loginUser($_POST['email'],$_POST['password']);
    

  }
  
// IF USER ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header('Location: profile.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css_files/log.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .errorMsg{
                color: red;
                padding-top: 5px;
            }
            .footer-bottom{
                display: flex;
                align-items: center;

            }

        </style>

    </head>
    <body>
        
         <div class="top-header">
                <div class="top-header__left">
                    <p>Avez vous des questions ? <span>+212 6 70 434 988</span> ou contact@evesc.ma</p>
                </div>
                <div class="top-header__right">
                    
                    <ul class="top-header-right__items">
                        <li class="top-header-right__item"><a href="publicEvents.php"><i class="fas fa-expand"></i> Evenements</a></li>
                        <li class="top-header-right__item"><a href="contact.php"><i class="fas fa-phone-volume"></i></i> Contact</a></li>
                        <li class="top-header-right__item"><a href="faq.php"><i class="fas fa-question"></i> FAQ</a></li>

                        
                        
                    </ul>  
                    <?php if(isset($_SESSION['role'])&& $_SESSION['role']=='a' ) : ?>
                <span class="top-header-right__registration"><a href="profile.php">Profile / Evenements</a></span>
                <?php else : ?>
                <span class="top-header-right__registration"><a href="login.php">Connexion / Inscription</a></span>
                <?php endif;?>
        </div>
                
                
            </div>
            <header class="main-header">
                  <a href="index.php"  class="logo0"><img src="img_utilise/Webp.net-resizeimage (9).png"></a>
                <nav class="main-nav">
                    <ul class="main-nav__items">
                        <li class="main-nav__item"><a href="index.php">Accueil</a></li>
                        <li class="main-nav__item"><a href="publicEvents.php">Evenements</a></li>
                        <li class="main-nav__item"><a href="faq.php">Apropos</a></li>
                        
                    </ul>
                </nav>
            </header>
            <main id="main-div__wrap">
                <div class="main-div__connexion" id="connexion__top">
                    <div class="div-connexion__top">
                        <h1>Connexion</h1>
                    </div>
                    <div class="div-connexion__form">
                        <form method="POST" action="">
                            <div class="div-connexion__item div-connexion-wrap">
                                <label for="E-mail">E-mail</label>
                                <input type="text" id="E-mail" name="email" placeholder="E-mail" size="">
                            </div>
                            <div class="div-connexion__item div-connexion-wrap">
                                <label for="Password">Mot de passe</label>
                                <input type="password" id="Password" name="password" placeholder="Mot de passe">
                            </div>
                            
                            <div class="submit">
                                <input type="submit" value="CONNEXION" name="login">
                                
                            </div>
                            <div>  
                                <?php
                                    if(isset($result['errorMessage'])){
                                    echo '<p class="errorMsg">'.$result['errorMessage'].'</p>';
                                    }
                                ?>    
                            </div>
                        </form>
                    </div>
                </div>
                <div class="main-div__connexion" id="register__top">
                    <div class="div-connexion__top div-connexion-top_col">
                        <h1>Nouveau Compte ?</h1>
                    </div>
                    <div class="div-connexion__form div-connexion__formflex" >
                        <form method="POST" action="">
                            <div class="div-connexion__item form__item">
                                <label for="Prénom">Prénom</label>
                                <input type="text" id="Prénom" name="prenom" required placeholder="Prénom">
                            </div>
                            <div class="div-connexion__item form__item">
                                <label for="Nom">Nom</label>
                                <input type="text" id="Nom" name="nom" required placeholder="Nom">
                            </div>
                            <div class="div-connexion__item form__item">
                                <label for="E-mail_register">E-mail</label>
                                <input type="email" id="E-mail_register" name="email" required placeholder="E-mail">
                            </div>
                            <div class="div-connexion__item form__item">
                                <label for="Téléphone">Téléphone</label>
                                <input type="text" id="Téléphone" name="telephone" required placeholder="Téléphone">
                            </div>
                            <div class="div-connexion__item form__item">
                                <label for="password_register">Mot de passe</label>
                                <input type="password" id="password_register" name="password" required placeholder="Mot de passe">
                            </div>
                            <div class="div-connexion__item form__item">
                                <label for="password_confirmation">Confirmation de Mot de passe</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirmation de mot de passe">
                            </div>
                            <div class="submit submit__register">
                                <input type="submit" value="INSCRIPTION" name="inscription">
                                
                            </div>
                            <input type="hidden" name="role" value="u">
                            <?php
                                if(isset($result['errorMessage_enr'])){
                                echo '<p class="errorMsg">'.$result['errorMessage_enr'].'</p>';
                                }
                            ?>    
                        </form>
                    </div>
                </div>
            </main>
            <footer class="footer">
                <div class="footer-left">
                    <p>Evesc est un site web qui permet de trouver des évènements à venir. Ce site web est fait pour aider les évènements à avoir plus de visiteurs et aider les internautes à trouver des évènements plus facilement que d'habitude.</p>
                </div>
                <ul class="footer-right">
                    <li id="footer-right__sos">
                        <ul class="box box-x">
                            <li><a href="faq.php">FAQ</a></li>
                           
                            <li><a href="contact.php">Contactez nous</a></li>
                        </ul>
                    </li>
                    <li id="footer-right__nav">
                        <h2 class="li__h2">Navigation</h2>
                        <ul class="box box-y">
                            <li><a href="index.php">Accueil</a></li>
                            <li><a href="publicEvents.php">Evenements</a></li>
                            
                            <li><a href="login.php">S'inscrire</a></li>
                            <li><a href="login.php">Se connecter</a></li>
                        </ul>
                    </li>
                    <li id="footer-right__adress">
                        <ul class="box box-h">   
                        <li style="text-align:center;"><a  style="border-bottom:none;" href="http://esto.ump.ma/"><img src="img_utilise/estlogo.png"></a></li>       
                            <li class="title_adress">Ecole supérieure de technologie ESTO</li>
                            <li>BP 473</li>
                            <li>Complexe universitaire Al Qods</li>
                            <li>Oujda 60000</li>
                        </ul>
                    </li>
                </ul>
                <div class="footer-bottom"> <img style="background-color: white;" src="img_utilise/Webp.net-resizeimage (9).png"> &nbsp &nbsp All rights reserved by ©EVESC 2020</div>
                
            </footer>  
        
    </body>
</html>