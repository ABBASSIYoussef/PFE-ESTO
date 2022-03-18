<?php
// index.php
require 'includes/init.php';

// IF USER MAKING LOGIN REQUEST


?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css_files/faq.css">
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


            <main id="main_faq">
                <h2>Faq - Questions fréquentes</h2>
                

                <button class="btn_drop">Qui êtes-vous?</button>
                <div class="panel">
                <p>EVESC est un site web permettant de trouver les évènements à venir. Ce site web est fait pour aider les évènements à avoir plus de visiteurs et aider les internautes à trouver des évènements plus facilement que d'habitude.</p>
                </div>

                <button class="btn_drop">D'où viennent ces évènements?</button>
                <div class="panel">
                <p>Ces événements sont publiés par leurs organisateurs ou par les personnes qui les représentent.</p>
                </div>

                <button class="btn_drop">Puis-je publier dans votre site?</button>
                <div class="panel">
                <p>Oui. Pour faire, il suffit de se diriger vers la page <a href="login.php">d'inscription</a> puis se connecter pour postuler son événement dans la plateform utilisateur.</p>
                </div>

                <button class="btn_drop">Comment vous contactez?</button>
                <div class="panel">
                <p>C'est très simple. Suffit de nous envoyer un mail à<span id="span_mail"> contact@evesc.ma</span> ou passer par le <a href="contact.php">formulaire de contact.</a> </p>
                </div>

            </main>

            <!--Script -->
            <script>
           
                var acc = document.getElementsByClassName("btn_drop");
                var i;

                for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                    } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                    } 
                        });
                }
            </script>
            <!-- Script -->
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