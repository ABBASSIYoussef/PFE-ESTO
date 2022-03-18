<?php

require 'includes/init.php';

if(isset($_SESSION['succes']))
    echo "<script> alert('".$_SESSION['succes']."')</script>";
    unset($_SESSION['succes']);

if(!isset($_SESSION['id'])){
    header("location:  login.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css_files/events.css">
    <style>
                .pagination{
                    text-align: center;
                    margin-bottom: 25px;
                }
                .pagination  a{
                    text-decoration: none;
                    
                    padding: 15px;
                    background-color: #071d39;
                    color: white;
                    border-radius: 5px;
                    
                }
                .pagination a:hover{
                    background-color:#ff5722;
                    transition: 0.5s;
                }

        </style>
 

    </head>
    <body>
        <?php  if ($_SESSION['role']=='u') : ?>
        <div id="salute">
            Bienvenue dans l'espace utilisateur, voici la liste de vos evenements soumis :
        </div>
        <?php else : ?>
        <div id="salute">
            Bienvenue dans l'espace administrateur, voici la liste des evenements soumis :
        </div>
        <?php endif;?> 
        <div class="buttons">
        <button onClick="location.href='index.php'">Accueil</button>
        <button onClick="location.href='profile.php';">Mon Profil</button>
            <?php  if ($_SESSION['role']=='u') : ?>
                <button onClick="location.href='addEvent.php';">Ajouter un evenement</a></button>
            <?php endif;?>    
            <?php  if ($_SESSION['role']=='a') : ?>
                <button onClick="location.href='Events.php';">Evenements</a></button>
            <?php else : ?>
                <button onClick="location.href='Events.php';">Mes Evenements</a></button>
            <?php endif;?>
            
            <?php  if ($_SESSION['role']=='a') : ?>
            <button onClick="location.href='users.php';">Utilisateurs</a></button>
            <?php endif;?>
            <button onClick="location.href='logout.php';">Se deconnecter</a></button>
            
        </div>
        <div class="container">
        <?php 
           
            
            ?>
            <table cellspacing=0>
                    
                        <th id="radius1">Titre</th>
                        <th>Type</th>
                         <th>Ville</th>
                         <th>Date</th>
                         <th>Photo</th>
                        <th >Statut</th>
                        <th id="radius2">Action</th>
                        
                        
                        <?php
                        
                        if(isset($_GET['page']) && !empty($_GET['page'])){
                            $currentPage = (int) strip_tags($_GET['page']);
                        }else{
                            $currentPage = 1;
                        }
                        $parpage=8;
                        if($_SESSION['role']=='u'){
                            $events = $event_obj->listEvents($_SESSION['id'],$currentPage,$parpage);
                        }elseif( $_SESSION['role']=='a'){
                            $events=$event_obj->listAllEvents_admin($currentPage,$parpage);
                           
                        }
                        
                        
                        foreach($events as $event) : ?>
                             <?=    '<tr class="test" >
                                    <form action="event.php" METHOD="POST">
                                        <input type="hidden" name="id" value="'.$event->id.'">
                                        <td>'.$event->titre.'</td>


                                        <td>'.$event->type.'</td>


                                        <td>'.$event->ville.'</td>
                                        <td>'.$event->date.'</td>



                                        <td><img class="image_event" src ="EventsPics/'. $event->photo. ' " ></td>' ?>
                                        <?php if($event->approved) : ?>
                                        <?= '<td id="approved">Approuvé</td>' ?>
                                        <?php else : ?>
                                        <?='<td id="non_approved">Non approuvé</td>'?>
                                        <?php endif; ?>
                                 <?='<td><input type="submit" name="submit" value="En savoir plus"  ></td>
                                    </form>
                                     </tr>';?>
                        <?php endforeach;?>
             </table>
        </div>
        <div>
                <nav>
                <?php 
                    if($_SESSION['role']=='u')
                    $pages=ceil($event_obj->nbEvent_user($_SESSION['id']) / $parpage);
                    elseif($_SESSION['role']=='a')
                    $pages=ceil($event_obj->nbEvent_admin() / $parpage);
                            

                ?>
                    <ul class="pagination">

                            <a <?= ($currentPage == 1) ? "" : "href=\"./events.php?page=".($currentPage - 1)."\"" ?>>Précédent</a>
                         
                        <?php for($page = 1; $page <= $pages; $page++): ?>
        
                                <a <?= ($currentPage == $page) ? "" : "href=\"./events.php?page=".$page."\"" ?> ><?= $page ?></a>
                             
                        <?php endfor ?>
                            <a <?= ($currentPage == $pages) ? "" : "href=\"./events.php?page=".($currentPage + 1)."\"" ?>>Suivant</a>
                    </ul>
                </nav>

                    </div>

    </body>
</html>     