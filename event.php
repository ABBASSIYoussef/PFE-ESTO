<?php

require 'includes/init.php';

if(!isset($_SESSION['id'])){
    header("location:  login.php");
}
if(isset($_POST['id'])){
    $event=$event_obj->listEvent($_POST['id']);
    $user=$user_obj->getUserName($event['user_id']);

}

if(isset($_POST['supprimer'])){
    $event=$event_obj->suppEvent($_POST['id']);
    $_SESSION['succes']="Evenement supprimé avec succes";
    header("location: events.php");
}
if(isset($_POST['modifier'])){
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"]==0) {
        //allowed file types
        $allowed = ["JPG"=>"image/JPG","jpg"=>"image/jpg",
        "jpeg"=>"image/jpeg", "png"=>"image/png"];
        $filename=$_FILES["photo"]["name"];
        $filetype=$_FILES["photo"]["type"];
        $filesize=$_FILES["photo"]["size"];
    
            //verify file extension 
            $extension=pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($extension, $allowed)) {die("Error: Please select a valid file format.");}
    
            //verify file size 5MB maximum
            $maxsize=5 * 1024 * 1024;
            if($filesize > $maxsize){die("Error : file size is larger than the allowed limit ". $maxsize);}
    if (in_array($filetype, $allowed)) {
            if (file_exists("EventsPics/". $filename)) {
    
            return ['errorMessage'=>"{$filename} already exists"];
    
            }else{
    
            $filename=$_POST['titre'] .$_SESSION['id']. "." . $extension;
            move_uploaded_file($_FILES["photo"]["tmp_name"],"EventsPics/".$filename);
            if($_SESSION['role']=='u'){
            $result=$event_obj->modifEvent($_POST['id'],$_POST['titre'],$_POST['type'],$_POST['ville'],$filename,$_POST['date'],$_POST['time'],$_POST['description'],false);
            }elseif($_SESSION['role']=='a'){
                
                $result=$event_obj->modifEvent($_POST['id'],$_POST['titre'],$_POST['type'],$_POST['ville'],$filename,$_POST['date'],$_POST['time'],$_POST['description'],$_POST['approved']);
            }
            }
    
        }else{
            echo "Error: There was a problem uploading your file. Please try again."; }
    }else{
        if($_SESSION['role']=='u'){
        $result=$event_obj->modifEvent($_POST['id'],$_POST['titre'],$_POST['type'],$_POST['ville'],$_POST['photo'],$_POST['date'],$_POST['time'],$_POST['description'],false);
    }
        elseif($_SESSION['role']=='a'){
            
            $result=$event_obj->modifEvent($_POST['id'],$_POST['titre'],$_POST['type'],$_POST['ville'],$_POST['photo'],$_POST['date'],$_POST['time'],$_POST['description'],$_POST['approved']);
        }
    }
    $_SESSION['succes']="Evenement modifié avec succes";
    header("location: events.php");
}
if(isset($_POST['retour'])){
    header("location: events.php");
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
        
        
    </head>
    <body>
    <div id="salute">Vous avez séléctionner l'évènement : <span class=""></span></div>  
    <div class="conteneur_global">
    <div class="img_container"> <?php echo' <img src ="EventsPics/'. $event['photo']. ' ">'?></div>
    <div class="container">
         
        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tableau_event">
                <tr>
                    <td class="label" >
                        <label for="user">Publié par  :</label>
                    </td>           
                    <td >    
                        <input type="text" name="user" id="user" readonly value="<?=$user['nom'].' '.$user['prenom'];?>">
                        <input type="hidden" value="<?php echo $event['id']?>" name="id">
                    </td>
                </tr>
                <tr> 
                    <td class="label">
                        <label for="titre">Titre  :</label>
                    </td> 
                    <td > 
                        <input type="text" name="titre" id="titre" value="<?=$event['titre'];?>">
                          
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        <label for="type">Type  :</label>
                    </td>
                    <td >
                    <select name="type" id="type"  >
                            <?php if($event['type']==Scientifique) : ?>
                                <option value="Scientifique" <?='selected'?> >Scientifique</option>
                                            <option value="Culturelle" >Culturelle</option>
                                <?php else : ?>
                                <option value="Scientifique"  >Scientifique</option>
                                            <option value="Culturelle" <?='selected'?>>Culturelle</option>
                            <?php endif; ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        <label for="ville">Ville  :</label>
                    </td>
                    <td>
                        <input type="text" name="ville" id="ville" value="<?=$event['ville'];?>">
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        <label for="date">Date  :</label>
                    </td>
                    <td>
                        <input type="date" name="date" id="date" value="<?=date("Y-m-d", strtotime($event['date']));?>">
                        <input type="time" name="time" id="time" value="<?=date("h:i:s", strtotime($event['date']));?>">
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        <label for="photo" >Image  :</label>
                    </td>
                    <td>
                        <input type="file" name="photo" id="photo"> 
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        <label for="description">Description  :</label>
                    </td>
                    <td>
                        <textarea name="description" id="description" cols="30" rows="5" ><?=$event['description']?></textarea>
                    </td>
                </tr>
                <?php if($_SESSION['role']=='a'): ?>
                <tr>
                    <td class="label">
                        <label for="approved">Approuvé :</label>
                    </td>
                    <td class="label_radio">
                        <label class="radio_class" for="approved">Oui</label>
                        <input type="radio" name="approved" id="approved" value=1>
                        
                        
                        <label  class="radio_class" for="non_approved">Non</label>
                        <input type="radio" name="approved" id="non_approved" value=0>
                        
                    </td>
                </tr>
                <?php endif;?>
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

