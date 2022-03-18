<?php

require 'includes/init.php';


if($_SESSION['role']=='a'){
    header('location: profile.php');
}
if(isset($_POST['ajout'])){ 

if (isset($_FILES["photo"]) && $_FILES["photo"]["error"]==0) {
    //allowed file types
    $allowed = ["JPG"=>"image/JPG","jpg"=>"image/jpg",
    "jpeg"=>"image/jpeg", "png"=>"image/png"];
    $filename=$_FILES["photo"]["name"];
    $filetype=$_FILES["photo"]["type"];
    $filesize=$_FILES["photo"]["size"];

        //verify file extension 
        $extension=pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($extension, $allowed)) {die("Error: Veuillez choisir un format valide.");}

        //verify file size 5MB maximum
        $maxsize=5 * 1024 * 1024;
        if($filesize > $maxsize){die("Error : la taille de la photo limite est atteinte ". $maxsize);}
if (in_array($filetype, $allowed)) {
        if (file_exists("EventsPics/". $filename)) {

        return ['errorMessage'=>"{$filename} ce fichier existe déjà"];

        }else{

        $filename=$_POST['titre'] .$_SESSION['id']. "." . $extension;
        move_uploaded_file($_FILES["photo"]["tmp_name"],"EventsPics/".$filename);
        if($_SESSION['role']=='u'){
            $result = $event_obj->ajouterEvent($_POST['titre'],$_POST['type'],$_POST['ville'],$_POST['date'],$_POST['time'],$filename,$_POST['description'],$_POST['approved']);
        }
        

        }

    }else{
        echo "Error: Il y'a eu un problème au téléchargement du fichier, veuillez réssayez plus tard."; }
}else{
    echo "Error: " . $_FILES["photo"]["error"];
}
$_SESSION['succes']='Votre événement a été soumis avec succès!';
header('location: events.php');



}
if(!isset($_SESSION['id'])){
    header("location:  login.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css_files/addEvent.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/970aece39a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="salute">
            Bienvenue dans l'espace utilisateur, voici l'espace d'ajout d'evenements
        </div>
        <div class="buttons">
        <button onClick="location.href='index.php'">Accueil</button>
        <button onClick="location.href='profile.php';">Mon Profil</button>
            <button onClick="location.href='addEvent.php';">Ajouter un evenement</a></button>
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
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                
                    <tr>
                        
                            <td class="label" id="first_radius">  
                                <label for="Titre">Titre: </label>
                            </td>
                            <td>
                                <input type="text" name="titre" id="Titre" placeholder="Titre de l'évènement" required>
                            </td >             
                        
                    </tr>
                    <tr>
                       
                            <td class="label" >
                                <label for="type">Type: </label></td>
                            <td>
                                <select name="type" id="type" required>
                                    <option value="Scientifique">Scientifique</option>
                                    <option value="Culturelle">Culturelle</option>
                                </select>
                            </td>
                        
                    </tr>
                    <tr>
                        
                            <td class="label">
                                <label for="ville">Lieu </label>
                            </td>
                            <td >
                                <input type="text" name="ville" id="ville" placeholder="Lieu de l'évènement" required>
                            </td>
                        
                    </tr>
                    <tr>
                        
                            <td class="label">
                                <label for="date">Date: </label>
                            </td>
                            <td>
                                <input type="date" name="date" id="date" required>
                                <input type="time" name="time" id="time" required>
                                
                            </td>
                        
                    </tr>
                    <tr>
                        
                        <td class="label">
                            <label for="photo">Photo: </label>
                        </td>
                        <td>
                                <input type="file" name="photo" id="photo" required>
                        </td>
                        
                    </tr>
                    <tr>
                        
                            <td  class="label" id="last_radius">
                                <label for="description">Description:</label>
                            </td>
                        <td>
                            <textarea name="description" id="description" cols="40" rows="10" placeholder="Description de l'évènement" required></textarea>
                            </td>
                       
                    </tr>
                    <tr >
                        
                        <td colspan="2">

                            <input type="submit" value="Soumettre Evenement" name="ajout">
                        </td>
                    </tr>
                    <input type="hidden" name="approved" value="false">
                    <?php
                                if(isset($result['errorMessage_eventadding'])){
                                echo '<p class="errorMsg">'.$result['errorMessage_eventadding'].'</p>';
                                }
                            ?>   
                            </table> 
            </form>
                            
        </div>
    </body>
</html>     