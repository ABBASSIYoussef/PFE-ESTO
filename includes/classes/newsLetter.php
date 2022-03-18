<?php

class newsLetter{
    protected $user_email;
    function __construct($db_connection){
        $this->db = $db_connection;
    }

    function ajouterNewsLetter($email){
        try{
        $this->user_email=trim($email);
        $check_email = $this->db->prepare("SELECT * FROM newsletter WHERE email = ?");
        $check_email->execute([$this->user_email]);
        if($check_email->rowCount()>0){
            return ['errorMessage' =>'Email déjà abonné!'];
        }else{
            $sql="INSERT INTO newsletter(email) values(:email)";
            $newsletter_stmt = $this->db->prepare($sql);
            $newsletter_stmt->bindValue(':email',$this->user_email);
            $newsletter_stmt->execute();
        }
    }  catch(PDOException $e){
        die($e->getMessage());
    }

        

    }

}


?>