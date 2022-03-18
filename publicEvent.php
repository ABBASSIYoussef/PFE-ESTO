<?php

require 'includes/init.php';

if(!isset($_GET['id'])){
    header('location: publicEvents.php');
}
if(isset($_GET['id'])){
$event=$event_obj->listEvent($_GET['id']);

}
if(isset($_POST['comment_envoie'])){
    $comment= $comment_obj->ajouterCommentaire($_GET['id'], $_POST['nom'],$_POST['comment']);
    header('refresh:1');
}
?>
<!DOCTYPE html>
<html>
    <head>
        
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css_files/publicEvent.css">


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
        <main>
        <div id="wrap_wrap">
            <div class="public_event__conteneur">
                <div class="event_conteneur__first">
                   <?php  echo
                   ' <img class="image_conteneur__first" src ="EventsPics/'. $event['photo']. ' ">'
                    ?>
                    
                </div>
                <div class="event_conteneur__second">
                   <table cellspacing=0 class="table_conteneuse_all">
                       <tr>
                           <td id="conteneur_titre" colspan="2"><?=$event['titre'];?>        </td>
                       </tr>
                       <tr>
                            <td id="conteneur_type"><i class="fas fa-atom"></i> <?=$event['type'];?></td>
                            <td id="conteneur_ville"><i class="fas fa-map-marker-alt"></i> <?=$event['ville'];?></td>
                       </tr>
                       <tr>
                           <td id="conteneur_description" colspan="2"><?=$event['description'];?></td>
                        </tr>   
                       <tr>
                            <td id="conteneur_date" colspan="2"><?=$event['date'];?></td>
                       </tr>
                       
                   </table>
                </div>

            </div>
            <div id="all_comments">
                <div class="comments">
                        <h2 id="saying_comment">Partagez votre avis!</h2>
                        <table id="table_comment">
                            <form method="POST" action="">
                                
                                <tr class="comment_tr">
                                    <td class="comment_td">
                                        <label for="nom">Nom</label>
                                    </td>
                                    <td class="comment_td">
                                        <input type="text" name="nom" id="nom" placeholder="Votre nom" required>
                                    </td>
                                
                                </tr>
                                <tr>
                                    <td class="comment_td">
                                        <label for="comment">Commentaire</label>
                                    </td>
                                </tr>
                                <tr>    
                                    <td colspan="2" class="comment_td"><textarea name="comment" id="comment" placeholder="Votre commentaire" required></textarea></td>
                                
                                </tr>
                                <tr>
                                    <td id="button_submit_comment" colspan="2"><input type="submit" value="Envoyer" name="comment_envoie"></td>
                                </tr>
                                
                            </form>
                        </table>
                </div>
                <div id="visible_comments">
                    <?php
                            if(isset($_GET['page']) && !empty($_GET['page'])){
                                $currentPage = (int) strip_tags($_GET['page']);
                            }else{
                                $currentPage = 1;
                                
                            }
                            $parpage=4;
                            $comments = $comment_obj->displaycomments($_GET['id'],$currentPage,$parpage);
                            foreach($comments as $comment){

                                echo ' 
                                <table   class="comments_table_container" cellspacing=0 > 
                                <form method="GET" action="">
                                
                                            
                                            <tr >
                                                <td class="comment_class" id="nom_comment"><label id="saying_comment_saying">'. $comment->nom. ' a dit:</label></td>
                                                <td class="comment_class"><input type="text" readonly value="'.$comment->commentaire.'"></td>
                                            </tr>  
                                
                                </form> 
                                </table>'
                                ;} 
                                            
                        ?>
                </div>
               
            </div>
            <div>
                <nav id="pagination">
                <?php 
                    $pages=ceil($comment_obj->NbComment() / $parpage);
                ?>
                    <ul class="pagination">

                            <a <?= ($currentPage == 1) ? "" : "href=\"./publicEvent.php?id=".$_GET['id']."&page=".($currentPage - 1)."\"" ?>>Précédent</a>
                         
                        <?php for($page = 1; $page <= $pages; $page++): ?>
        
                                <a <?= ($currentPage == $page) ? "" : "href=\"./publicEvent.php?id=".$_GET['id']."&page=".$page."\"" ?> ><?= $page ?></a>
                             
                        <?php endfor ?>
                            <a <?= ($currentPage == $pages) ? "" : "href=\"./publicEvent.php?id=".$_GET['id']."&page=".($currentPage + 1)."\"" ?>>Suivant</a>
                           
                    </ul>
                </nav>

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
                            <li><a href="faq.php">Qui sommes nous</a></li>
                            
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