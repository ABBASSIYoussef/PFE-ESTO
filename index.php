<?php

require 'includes/init.php';
if(isset($_POST['news_letter'])){
    $result=$newsLetter_obj->ajouterNewsLetter($_POST['email']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css_files/index.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
                
           
        </header>
        <main id="main">
            <div class="main__banner">
                <h1 class="main-banner_titre">Decouvrez les évènements du moment!</h1>
                <a href="#contenu__container"><button type="button" >En savoir plus</button></a>
            </div>
            <div class="gradient"></div>
            <section id="contenu">
                <h1 class="contenu__title">Chez nous, vous trouverez des évènements :</h1>
                <div class="contenu__container" id="contenu__container">
                    <article class="contenu__type" onClick="location.href='publicEvents.php'">
                        <h2 class="contenu__titre">Scientifique</h2>
                        <ul class="contenu__items">
                            <div class="contenu-scientific__img"></div>
                            <li class="contenu__item">Congrès</li>
                            <li class="contenu__item">Soutenance</li>
                            <li class="contenu__item">Concours</li>
                            <li class="contenu__item">Séminaire etc..</li> 
                        </ul>                
                    </article>
                    <article class="contenu__type" onClick="location.href='publicEvents.php'">
                        <h2 class="contenu__titre">Culturel</h2>
                        <ul class="contenu__items">
                            <div class="contenu-culturel__img"></div>
                            <li class="contenu__item">Manifestation artistique</li>
                            <li class="contenu_item">Manifestation Culturel etc..</li>
                        </ul>
                    
                    </article>  
                </div>             
            </section>
            <section >
                <form id="news-letter" action="" method="POST">
                    <div class="news-letter__text">
                        <h3 class="news-letter-text__title">Inscrivez-vous à la newsletter gratuite</h1>
                        <p class="news-letter-text__desc">Vous serez alertés en amont des meilleurs evenements, spectacles, congrès et autres!</p>
                    </div>
                    <div class="news-letter__form">
                        
                            <input  type="email" placeholder="Adresse Email" name="email" required value='<?php if(isset($result['errorMessage'])){echo  $result['errorMessage'];}?>'>
                            
                            <input type="submit" value="S'inscrire" name="news_letter" >
                         
                    
                    </div>
              </form>
            </section>
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