<?php

class comment{



    protected $comment_nom;
    protected $comment_message;
    protected $event_comment_id;



    function __construct($db_connection){
        $this->db = $db_connection;
    }

    function ajouterCommentaire($id, $nom,$comment){
        try{
        if(!empty($nom)&&!empty($comment)){
        $this->comment_nom=trim($nom);
        $this->comment_message=trim($comment);
        $this->event_comment_id=trim($id);


        $sql="INSERT INTO comment(event_id,nom,commentaire) values(:event_id,:nom,:commentaire)";
        $newsletter_stmt = $this->db->prepare($sql);
        $newsletter_stmt->bindValue(':event_id',$this->event_comment_id);
        $newsletter_stmt->bindValue(':nom',$this->comment_nom);
        $newsletter_stmt->bindValue(':commentaire',$this->comment_message);
        $newsletter_stmt->execute();

        }
    }catch(PDOException $e){
        die($e->getMessage());
    }
    }
    function displaycomments($id,$currentPage,$parPage){
        try{
            $premier = ($currentPage * $parPage) - $parPage;
            $this->event_comment_id=trim($id);
            $sql="SELECT *  from comment where event_id=:event_id LIMIT $premier,$parPage";
            $display_comment_stmt=$this->db->prepare($sql);
            $display_comment_stmt->bindValue(':event_id',$this->event_comment_id);
            $display_comment_stmt->execute();
            return $display_comment_stmt->fetchAll(PDO::FETCH_OBJ);

        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function nbComment(){
        try{
            $sql='SELECT count(*) from comment where event_id=:event_id ';
            $query = $this->db->prepare($sql);
            $query->bindValue(':event_id',$this->event_comment_id);
            $query->execute();
            $result = $query->fetch();
            $nbComments = (int) $result['count(*)'];
            return $nbComments;

        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
    
    
}
?>