<?php

require 'includes/init.php';

if( $_SESSION['role']=='u' && isset($_POST['update'] ) ){
    

    $result = $user_obj->updateUser($_SESSION['id'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['password_new'],$_POST['telephone'],$_SESSION['role']);
    
    
    
    
    
    
    header("Refresh:0");
}
elseif( $_SESSION['role']=='a' && isset($_POST['update'] ) ){
    

    $result = $admin_obj->updateUser($_SESSION['id'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['password'],$_POST['password_new'],$_POST['telephone'],$_SESSION['role']);
    header("Refresh:0");
}
elseif(!isset($_SESSION['id'])){
    header("location:  login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css_files/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php  if ($_SESSION['role']=='u') : ?>
        <div id="salute">
            Bienvenue dans l'espace utilisateur, voici votre profil!
        </div>
        <?php else : ?>
        <div id="salute">
            Bienvenue dans l'espace administrateur, voici votre profil!
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
           
            
        <form action="" method="POST">
                <table class="tableur">
               
                    <tr>
                       
                        <td class="label" id="first_radius">  
                            <label for="nom">Nom   :</label>
                        </td>
                        <td>
                            <input type="text" name="nom" id="nom" value="<?php echo $_SESSION['nom'];?>">
                        </td >             
                        
                    </tr>
                    <tr>
                        
                        <td class="label">
                            <label for="prenom">Prénom   :</label>
                        </td>
                        <td>
                            <input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION['prenom'];?>">
                        </td>
                       
                    </tr>
                    <tr>
                        
                            <td class="label">
                                <label for="telephone">Téléphone   :</label>
                            </td>
                            <td>
                                <input type="text" name="telephone" id="telephone" value="<?php echo $_SESSION['telephone'];?>">
                            </td>
                        
                    </tr>
                    <tr>
                        
                            <td class="label">
                                <label for="email">E-mail   :</label>
                            </td>
                            <td>
                                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email'];?>">
                            </td>
                        
                    </tr>
                    <tr>
                        
                            <td class="label">
                                <label for="password">Mot de passe actuel   :</label>
                            </td>
                            <td>
                                <input type="password" name="password" id="password"  placeholder="Mot de passe actuel">
                            </td>
                        
                    </tr>
                    <tr>
                       
                            <td class="label"  id="last_radius">
                                <label for="password_new">Nouveau mot de passe   :</label>
                            </td>
                            <td>
                                <input type="password" name="password_new" id="password_new" placeholder="Nouveau mot de passe" >
                            </td>
                       
                    </tr>
                    <tr>
                        <td colspan="2" ><input type="submit" value="Modifier" name="update"></td>
                    </tr>
                   
                </table>
                </form>
            
                    
               
            
            
        </div>
        
       

    </body>
</html>