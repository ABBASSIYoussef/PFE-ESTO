<?php

require 'includes/init.php';

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
            </nav>
        </header>

        <section id="form_chercher">
            <form method="GET" action="">
                <input type="text" name="recherche" placeholder="Tapez ici ce que vous voulez cherchez" class="input_text_search">
                <select name="type_event" >
                    <option value="Scientifique">Scientifique</option>
                    <option value="Culturelle">Culturelle</option>
                </select>
                <input type="submit" value="Chercher" name="chercher">
            </form>
        </section>
        <section>
                <div class="events_container">
                   
                    <?php
                        if(isset($_GET['page']) && !empty($_GET['page'])){
                            $currentPage = (int) strip_tags($_GET['page']);
                        }else{
                            $currentPage = 1;
                        }
                        $parpage=8;
                        if(isset($_GET['chercher'])){
                        $events = $event_obj->listPublicEvents($currentPage,$parpage,$_GET['recherche'],$_GET['type_event']);
                        }else{
                            $events = $event_obj->listEventsPublic($currentPage,$parpage);

                        }
                        
                        foreach($events as $event){
                             echo '  <table   class="table_events_container" cellspacing=0>
                                        <form method="GET" action="publicEvent.php">
                                        <tr>
                                            <td ><img class="table_event__images" src ="EventsPics/'. $event->photo. ' ">  </td>
                                        </tr>  
                                        <tr>
                                            <td class="event_title">'.$event->titre.'</td>
                                            <input type="hidden" value="'.$event->id.'" name="id">
                                        </tr>  
                                        <tr>
                                        <td class="event_place"><i class="fas fa-map-marker-alt"></i> '.$event->ville.'</td>
                                        
                                        </tr>
                                        <tr >
                                            <td class="event_date" ><i class="fas fa-clock"></i> '.$event->date.'</td>     
                                        </tr>   
                                        <tr>
                                            <td ><button class="button_evenement" type="submit" name="submit">En savoir Plus</button></td>
                                            
                                        </tr>   
                                        
                                        </form>                
                             
                             
                             </table>';} 
                        
                                        
                    ?>
                </div>
                <div>
                <nav>
                <?php 
                    if(isset($_GET['chercher'])){
                    $pages=ceil($event_obj->NbreEvent($_GET['recherche'],$_GET['type_event']) / $parpage);
                    
                   
                    
                   
                ?>
                    <ul class="pagination">

                            <a <?= ($currentPage == 1) ? "" : "href=\"./publicEvents.php?page=".($currentPage - 1)."&recherche=".$_GET['recherche']."&type_event=".$_GET['type_event']."&chercher=".$_GET['chercher']."\"" ?>>Précédent</a>
                         
                        <?php for($page = 1; $page <= $pages; $page++): ?>
        
                                <a <?= ($currentPage == $page) ? "" : "href=\"./publicEvents.php?page=".$page."&recherche=".$_GET['recherche']."&type_event=".$_GET['type_event']."&chercher=".$_GET['chercher']."\"" ?> ><?= $page ?></a>
                             
                        <?php endfor ?>
                            <a <?= ($currentPage == $pages) ? "" : "href=\"./publicEvents.php?page=".($currentPage + 1)."&recherche=".$_GET['recherche']."&type_event=".$_GET['type_event']."&chercher=".$_GET['chercher']."\"" ?>>Suivant</a>
                    </ul>
                </nav>
                            <?php } 
                            else{
                                $pages=ceil($event_obj->nbEvent()/$parpage);
                                ?>
                                <ul class="pagination">

                            <a <?= ($currentPage == 1) ? "" : "href=\"./publicEvents.php?page=".($currentPage - 1)."\"" ?>>Précédente</a>
                         
                        <?php for($page = 1; $page <= $pages; $page++): ?>
        
                                <a <?= ($currentPage == $page) ? "" : "href=\"./publicEvents.php?page=".$page."\"" ?> ><?= $page ?></a>
                             
                        <?php endfor ?>
                            <a <?= ($currentPage == $pages) ? "" : "href=\"./publicEvents.php?page=".($currentPage + 1)."\"" ?>>Suivante</a>
                    </ul>

                            <?php }
                            
                             ?>
                    </div>

            </section>  
        
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