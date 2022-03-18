<?php

class Admin extends User{
    function loginUser($email, $password){
        try{
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $find_email = $this->db->prepare("SELECT * FROM admin WHERE email = ?");
            $find_email->execute([$this->user_email]);
            

            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);
                $match_pass = $row['password'];
                if($match_pass==$this->user_pass){
                    $_SESSION = [
                        'id' => $row['id'],
                        'email' => $row['email'],
                        'nom' => $row['nom'],
                        'prenom' =>$row['prenom'],
                        'telephone' =>$row['telephone'],
                        'role'=>$row['role']
                        
                    ];
                    header('Location: profile.php');
                }
                else{
                    return ['errorMessage' => 'Mot de passe invalide'];
                }
                
            }
            else{
                return ['errorMessage' => 'Adresse email non valide'];
            }

        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    function updateUser($id,$nom, $prenom,  $email, $password,$new_password, $telephone, $role ){
        try{
            $this->user_id=trim($id);
            $this->user_nom = trim($nom);
            $this->user_prenom = trim($prenom);
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $this->user_role=trim($role);
            
            
            $this->user_telephone = trim($telephone);
            if(!empty($this->user_pass) && !empty($new_password)){
                $find_user= $this->db->prepare("select * from admin where email=:email");
                $find_user->bindValue(':email',$_SESSION['email']);
                $find_user->execute();
                $row=$find_user->fetch(PDO::FETCH_ASSOC);
                $match_pass=$row['password'];   
                if($match_pass==$password){
                    $this->user_pass=$new_password;
                    $sql= "UPDATE admin SET nom=:nom, prenom=:prenom, email=:email, password=:password, telephone=:telephone WHERE id=:id ";
                    $sign_up_stmt = $this->db->prepare($sql);
                    $sign_up_stmt->bindValue(':nom',$this->user_nom);
                    $sign_up_stmt->bindValue(':prenom',$this->user_prenom);
                    $sign_up_stmt->bindValue(':email',$this->user_email);
                    $sign_up_stmt->bindValue(':password',$this->user_pass);
                    $sign_up_stmt->bindValue(':telephone',$this->user_telephone);
                    $sign_up_stmt->bindValue(':id',$this->user_id);

                $sign_up_stmt->execute();
                $_SESSION = [
                    'id' => $this->user_id,
                    'email' => $this->user_email,
                    'nom' => $this->user_nom,
                    'prenom' =>$this->user_prenom,
                    'telephone' =>$this->user_telephone,
                    'role' => $this->user_role];
                    echo "<script>alert('Succès')</script>";
                }
                else{
                    echo "<script>alert('Mot de passe actuel incorrect')</script>";
                }
                

            }elseif(empty($this->user_pass) && empty($new_password)){
                $sql= "UPDATE admin SET nom=:nom, prenom=:prenom, email=:email, telephone=:telephone WHERE id=:id ";
                $sign_up_stmt = $this->db->prepare($sql);
                $sign_up_stmt->bindValue(':nom',$this->user_nom);
                $sign_up_stmt->bindValue(':prenom',$this->user_prenom);
                $sign_up_stmt->bindValue(':email',$this->user_email);
                $sign_up_stmt->bindValue(':telephone',$this->user_telephone);
                $sign_up_stmt->bindValue(':id',$this->user_id);
                $sign_up_stmt->execute();
               
                $_SESSION = [
                    'id' => $this->user_id,
                    'email' => $this->user_email,
                    'nom' => $this->user_nom,
                    'prenom' =>$this->user_prenom,
                    'telephone' =>$this->user_telephone,
                    'role' => $this->user_role];
                    echo "<script>alert('Succès')</script>";
            }
            else{
                echo "<script>alert('Entrez les mots de passes')</script>";
               
            }
                
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function displayUsers(){

        try{
            $sql = "SELECT * from user ";
            $list_events_stsmt = $this->db->prepare($sql);
            
            $list_events_stsmt->execute();
            
            return $list_events_stsmt->fetchAll(PDO::FETCH_OBJ);


        }
        catch(PDOException $e){
            die($e->getMessage());
        }



    }
    function displayUser($id){
        
            try{
                $this->user_id=$id;
                $sql="SELECT * from user where id=:id";
                $list_user_stsmt=$this->db->prepare($sql);
                $list_user_stsmt -> bindValue(':id',$this->user_id);
                $list_user_stsmt->execute();
                return $list_user_stsmt->fetch(PDO::FETCH_ASSOC);
    
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        
    }
    function update_User($id,$nom, $prenom,  $email, $new_password, $telephone ){
        try{
            $this->user_id=trim($id);
            $this->user_nom = trim($nom);
            $this->user_prenom = trim($prenom);
            $this->user_email = trim($email);
            $this->user_pass = trim($new_password);
            $this->user_telephone = trim($telephone);

            if(!empty($this->user_pass) ){
                $find_user= $this->db->prepare("select * from user where email=:email");
                $find_user->bindValue(':email',$email);
                $find_user->execute();
                $row=$find_user->fetch(PDO::FETCH_ASSOC);
                
                    $this->user_pass=password_hash($new_password,PASSWORD_DEFAULT);
                    $sql= "UPDATE user SET nom=:nom, prenom=:prenom, email=:email, password=:password, telephone=:telephone WHERE id=:id ";
                    $sign_up_stmt = $this->db->prepare($sql);
                    $sign_up_stmt->bindValue(':nom',$this->user_nom);
                    $sign_up_stmt->bindValue(':prenom',$this->user_prenom);
                    $sign_up_stmt->bindValue(':email',$this->user_email);
                    $sign_up_stmt->bindValue(':password',$this->user_pass);
                    $sign_up_stmt->bindValue(':telephone',$this->user_telephone);
                    $sign_up_stmt->bindValue(':id',$this->user_id);

                $sign_up_stmt->execute();
                
                

            }if(empty($new_password)){
                $sql= "UPDATE user SET nom=:nom, prenom=:prenom, email=:email, telephone=:telephone WHERE id=:id ";
                $sign_up_stmt = $this->db->prepare($sql);
                $sign_up_stmt->bindValue(':nom',$this->user_nom);
                $sign_up_stmt->bindValue(':prenom',$this->user_prenom);
                $sign_up_stmt->bindValue(':email',$this->user_email);
                $sign_up_stmt->bindValue(':telephone',$this->user_telephone);
                $sign_up_stmt->bindValue(':id',$this->user_id);
                $sign_up_stmt->execute();
               
                


            }
            
                
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }


}