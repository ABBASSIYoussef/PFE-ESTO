<?php

require 'includes/init.php';
if(isset($_POST['supprimer'])){
    $resultat=$admin_obj->deleteUser($_POST['id']);
    $_SESSION['succes']='suppression dutilisateur avec succes'; 
    header('location: users.php');
}
if($_SESSION['role']=='a'){
    
    $resultat=$admin_obj->displayUser($_POST['user_id']);

}else{
    if($_SESSION['role']=='u'){
        header('location: profile.php');
    }
}
if(isset($_POST['modifier'])){
    $resultat=$admin_obj->update_User($_POST['id'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['new_password'],$_POST['telephone']);
    $_SESSION['succes']='modification du profile avec succes'; 
    header('location: users.php');
}


if(!isset($_SESSION['id'])){
    header("location:  login.php");
}

if(isset($_POST['retour'])){
    header("location: users.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
   
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css_files/event.css">
        <script src="test.js"></script>
       <style>
           .label{
               width: 40%;
           }
       </style> 
        
    </head>
    <body>
    <div id="salute">Vous avez sélectionné l'utilisateur : <span class=""></span></div>  
    <div class="conteneur_global">
    
    <div class="container">
         
        <form action="" method="POST" >
        
            <table class="tableau_event">
                <tr> 
                    <td class="label">
                        <label for="Id">ID Utilisateur  :</label>
                    </td> 
                    <td > 
                        <input type="text" name="id" id="Id" value="<?= $resultat['id'];?>" readonly>
                          
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        <label for="nom">Nom  :</label>
                    </td>
                    <td>
                      <input type="text" name="nom" id="nom" value="<?= $resultat['nom'];?>">
                    </td>
                <tr>
                <tr>
                    <td class="label">
                        <label for="prenom">Prénom  :</label>
                    </td>
                    <td>
                      <input type="text" name="prenom" id="prenom" value="<?= $resultat['prenom'];?>">
                    </td>
                <tr>
                <tr>
                    <td class="label">
                        <label for="email">E-mail  :</label>
                    </td>
                    <td>
                      <input type="text" name="email" id="email" value="<?= $resultat['email'];?>">
                    </td>
                <tr>
                <tr>
                    <td class="label">
                        <label for="telephone">Téléphone  :</label>
                    </td>
                    <td>
                      <input type="text" name="telephone" id="telephone" value="<?= $resultat['telephone'];?>">
                    </td>
                <tr>
                <tr>
                    <td class="label">
                        <label for="mdp">Nouveau mot de passe  :</label>
                    </td>
                    <td>
                      <input type="text" name="new_password" id="mdp" placeholder="Tapez le nouveau mot de passe">
                    </td>
                <tr>
                    <td>
                        <input type="submit" value="Retour" name="retour" >
                    </td>
                    <td>
                        <input type="submit" value="Modifier" name="modifier">
                    </td>
                    
                    
                </tr>
                <tr>
                    <td></td>
                    <td >
                    
                        <input type="submit" value="Supprimer" name="supprimer">
                        
                    </td>
                    
                </tr>
                
                
            </table>
        </div>
     </form>
    </div>
</div>


    </body>
</html>

