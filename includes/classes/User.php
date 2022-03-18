<?php

class User{
    protected $db;
    protected $user_id;
    protected $user_nom;
    protected $user_prenom;
    protected $user_email;
    protected $user_pass;
    protected $hash_pass;
    protected $user_telephone;
    protected $user_role;

    // constructeur connection
    function __construct($db_connection){
        $this->db = $db_connection;
    }
    // SING UP USER
    function singUpUser($nom, $prenom,  $email, $password, $confirm_pass, $telephone, $role){
        try{
            $this->user_nom = trim($nom);
            $this->user_prenom = trim($prenom);
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $this->user_telephone = trim($telephone);
            $this->user_role = trim($role);
            if(!empty($this->user_nom) && !empty($this->user_prenom) && !empty($this->user_email) && !empty($this->user_pass) &&!empty($this->user_telephone)){
                if (filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) {
                    $check_email = $this->db->prepare("SELECT * FROM user WHERE email = ?");
                    $check_email->execute([$this->user_email]);
                    if($check_email->rowCount()>0){
                        return ['errorMessage_enr' =>'Ce email est déjà associé à un compte. Veuillez en réssayer avec un autre'];
                    }
                    else{
                        if($confirm_pass==$this->user_pass){
                        $this->hash_pass = password_hash($this->user_pass, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO user (nom, prenom, email, password, telephone, role) values(:nom, :prenom, :email, :password, :telephone,:role)";
                        $sign_up_stmt = $this->db->prepare($sql);

                        $sign_up_stmt->bindValue(':nom',$this->user_nom);
                        $sign_up_stmt->bindValue(':prenom',$this->user_prenom);
                        $sign_up_stmt->bindValue(':email',$this->user_email);
                        $sign_up_stmt->bindValue(':password',$this->hash_pass);
                        $sign_up_stmt->bindValue(':telephone',$this->user_telephone);
                        $sign_up_stmt->bindValue(':role',$this->user_role);

                        $sign_up_stmt->execute();}else{
                            return ['errorMessage_enr' =>'Les mots de passes ne sont pas identiques.'];
                        }
                        
                    }
                }
                else{
                    return ['errorMessage_enr'=>'Email invalid'];
                }
            }
            else{
                return['errorMessage_enr'=>'Veuillez entrer tout les champs requis'];
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function loginUser($email, $password){
        try{
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $find_email = $this->db->prepare("SELECT * FROM user WHERE email = ?");
            $find_email->execute([$this->user_email]);
            

            if($find_email->rowCount() === 1){
                $row = $find_email->fetch(PDO::FETCH_ASSOC);
                $match_pass = password_verify($this->user_pass, $row['password']);
                if($match_pass){
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
    function updateUser($id,$nom, $prenom,  $email, $password,$new_password, $telephone,$role ){
        try{
            $this->user_id=trim($id);
            $this->user_nom = trim($nom);
            $this->user_prenom = trim($prenom);
            $this->user_email = trim($email);
            $this->user_pass = trim($password);
            $this->user_role=trim($role);
            
            
            $this->user_telephone = trim($telephone);
            if(!empty($this->user_pass) && !empty($new_password)){
                $find_user= $this->db->prepare("select * from user where email=:email");
                $find_user->bindValue(':email',$_SESSION['email']);
                $find_user->execute();
                $row=$find_user->fetch(PDO::FETCH_ASSOC);
                $match_pass=password_verify($this->user_pass,$row['password']);
                if($match_pass){
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
                $sql= "UPDATE user SET nom=:nom, prenom=:prenom, email=:email, telephone=:telephone WHERE id=:id ";
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
    function getUserName($id){
        try{
            $this->user_id=$id;
            $sql="SELECT * from user where id=:id";
            $list_event_stsmt=$this->db->prepare($sql);
            $list_event_stsmt -> bindValue(':id',$this->user_id);
            $list_event_stsmt->execute();
            return $list_event_stsmt->fetch(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function deleteUser($id){
        try{
            $this->user_id=$id;
            $this->event_id=$id;
            $sql2="DELETE from evenement WHERE user_id=:id ";
            $supp_event_stsmt = $this->db->prepare($sql2);
            $supp_event_stsmt -> bindValue(':id',$this->event_id);
            $supp_event_stsmt ->execute();


            $sql="DELETE from user where id=:id";

            $delete_user_stmt=$this->db->prepare($sql);
            $delete_user_stmt->bindValue(':id',$this->user_id);
            $delete_user_stmt->execute();
            
            

            
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    
}
?>            