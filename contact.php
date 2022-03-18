<?php
// index.php

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css_files/log.css">
        <link rel="stylesheet" href="css_files/contact.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            
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
            <main id="contact_wrap">
                <div id="map">
                    
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3282.2186238065115!2d-1.8995964844068538!3d34.64918129348275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd787cbd8186f0b7%3A0x5226a42c88c53d39!2s%C3%89cole%20Sup%C3%A9rieure%20de%20Technologie%20d&#39;Oujda!5e0!3m2!1sfr!2sma!4v1618788344987!5m2!1sfr!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div id="form_contact">
                    <h1 id="map_saying">CONTACTEZ NOUS</h1>
                    <form action="mailto:contact@evesc.com">
                        <table>
                        <tr>
                            <td><label for="nom">Nom <span>*</span></label></td>
                            <td><label for="prenom">Prénom <span>*</span></label></td>
                        
                        </tr>
                        <tr>
                            <td><input type="text" name="nom" id="nom" placeholder="Votre nom" required></td>
                            <td><input type="text" name="prenom" id="prenom" placeholder="Votre prénom" required></td>
                        
                        </tr>
                        <tr>
                        <td><label for="email">E-mail <span>*</span></label></td>
                       
                        <td><label for="telephone">Téléphone </label></td>
                        </tr>
                        <tr>
                        
                        <td><input type="text" name="email" id="email" placeholder="Votre adresse e-mail" required></td>
                        <td><input type="text" name="telephone" id="telephone" placeholder="Votre téléphone"></td>
                        </tr>
                        <tr>
                        <td><label for="sujet">Sujet <span>*</span></label></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="text" name="sujet" id="sujet" placeholder="Sujet de votre demande" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="message">Votre Message <span>*</span></label></td>
                            
                        </tr>
                        <tr >
                            <td colspan="2">
                                <textarea name="message" id="message" cols="30" rows="5" placeholder="Votre message" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Envoyer" name="envoyer"></td>
                        </tr>
                        </table>
                    </form>
                
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
    
