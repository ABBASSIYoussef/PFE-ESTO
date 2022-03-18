<?php

require 'includes/init.php';

if(isset($_SESSION['succes'])){
    echo "<script> alert('".$_SESSION['succes']."')</script>";
    unset($_SESSION['succes']);
    header("Refresh:0");

}
if($_SESSION['role']=='u'){
    header('location: profile.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css_files/events.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php  if ($_SESSION['role']=='u') : ?>
        <div id="salute">
            Bienvenue dans l'espace utilisateur!
        </div>
        <?php else : ?>
        <div id="salute">
            Bienvenue dans l'espace administrateur, voici la liste des utilisateurs inscrit : 
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
            
                $users = $admin_obj->displayUsers();
            
            
            ?>
            <table cellspacing=0>
                    
                        <th id="radius1">Id Utilisateur</th>
                        <th>Nom</th>
                         <th>Prénom</th>
                         <th>E-mail</th>
                         <th>Téléphone</th>
                        
                        <th id="radius2">Action</th>
                        
                    
                        <?php foreach($users as $user) : ?>
                             <?=    '<tr class="test" >
                                    <form action="user.php" METHOD="POST">
                                         <input type="hidden" value="'.$user->id.'" name="user_id">
                                        <td>'.$user->id.'</td>
                                        <td>'.$user->nom.'</td>


                                        <td>'.$user->prenom.'</td>


                                        <td>'.$user->email.'</td>
                                        <td>'.$user->telephone.'</td> ' 
                                        
                                        ?>
                                        
                                    <?='<td><input type="submit" name="submit" value="En savoir plus"  ></td>
                                    </form>
                                     </tr>';?>
                        <?php endforeach;?>
             </table>
        </div>
            </body>
            </html>