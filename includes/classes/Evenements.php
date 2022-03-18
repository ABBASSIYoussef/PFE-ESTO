<?php

class Evenements{
    protected $db;
    protected $event_id;
    protected $user_id;
    protected $event_titre;
    protected $event_type;
    protected $event_date;
    protected $event_time;
    protected $event_photo;
    protected $event_description;
    protected $event_approved;
    protected $event_lieu;

    // constructeur connection
    function __construct($db_connection){
        $this->db = $db_connection;
    }   
    function ajouterEvent($titre, $type, $ville ,$date,$time, $photo, $description, $approved){
        try{
            $this->event_titre=trim($titre);
            $this->event_type=trim($type);
            $this->event_lieu=trim($ville);
            $this->event_date=$date.' '.$time;
            $this->event_time=trim($time);
            $this->event_photo=trim($photo);
            $this->event_description=trim($description);
            $this->event_approved=trim($approved);
            if(!empty($titre) && !empty($type) && !empty($ville) && !empty($date) && !empty($photo) && !empty($description) ){
                $sql = "INSERT INTO evenement (user_id,titre,type,ville,date,photo,description,approved) values (:user_id,:titre,:type,:ville,:date,:photo,:description,:approved)";
                $add_event_stmt = $this->db->prepare($sql);
                $add_event_stmt->bindValue(':user_id',$_SESSION['id']);
                $add_event_stmt->bindValue(':titre',strtoupper($this->event_titre));
                $add_event_stmt->bindValue(':type',$this->event_type);
                $add_event_stmt->bindValue(':ville',ucfirst($this->event_lieu));
                $add_event_stmt->bindValue(':date',$this->event_date);
                $add_event_stmt->bindValue(':photo',$this->event_photo);
                $add_event_stmt->bindValue(':description',$this->event_description);
                $add_event_stmt->bindValue(':approved',$this->event_approved);

                $add_event_stmt->execute();
                
            }
            else{
                return ['errorMessage_eventadding' =>'Veuillez remplir tout les champs'];
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function listAllEvents_admin($currentPage,$parPage){
        try{
            $premier = ($currentPage * $parPage) - $parPage;
            $sql = "SELECT * from evenement  LIMIT $premier, $parPage";
            $list_events_stsmt = $this->db->prepare($sql);
            
            $list_events_stsmt->execute();
            return $list_events_stsmt->fetchAll(PDO::FETCH_OBJ);
               
    }catch(PDOException $e){
        die($e->getMessage());
    }
    }
    function listAllEvents(){
        try{
                $sql = "SELECT * from evenement ";
                $list_events_stsmt = $this->db->prepare($sql);
                
                $list_events_stsmt->execute();
                return $list_events_stsmt->fetchAll(PDO::FETCH_OBJ);
                   
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function listEvents($id,$currentPage,$parPage){
        try{
                $premier = ($currentPage * $parPage) - $parPage;
                $sql = "SELECT * from evenement where user_id=:user_id LIMIT $premier, $parPage";
                $list_events_stsmt = $this->db->prepare($sql);
                $list_events_stsmt -> bindValue(':user_id',$_SESSION['id']);
                $list_events_stsmt->execute();
                return $list_events_stsmt->fetchAll(PDO::FETCH_OBJ);
                   
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function listPublicEvents($currentPage,$parPage,$search,$type){
        try{
            $premier = ($currentPage * $parPage) - $parPage;
            if(!empty($search)){
                $search="AND titre LIKE ".$this->db->quote("%".$search."%")."AND type LIKE".$this->db->quote($type);
                $sql="SELECT * from evenement where approved=1 ".$search." LIMIT $premier,$parPage ";
                $list_event_public_stmt=$this->db->prepare($sql);
                $list_event_public_stmt->execute();
                return $list_event_public_stmt->fetchAll(PDO::FETCH_OBJ);

            }elseif(empty($search)){
                $search="AND type LIKE".$this->db->quote($type);
                $sql="SELECT * from evenement where approved=1 ".$search." LIMIT $premier,$parPage ";
                $list_event_public_stmt=$this->db->prepare($sql);
                $list_event_public_stmt->execute();
                return $list_event_public_stmt->fetchAll(PDO::FETCH_OBJ);
            }else{
                $sql = "SELECT * from evenement where user_id=:user_id";
                $list_events_stsmt = $this->db->prepare($sql);
                $list_events_stsmt -> bindValue(':user_id',$_SESSION['id']);
                $list_events_stsmt->execute();
                return $list_events_stsmt->fetchAll(PDO::FETCH_OBJ);

            }


            
        
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function listEvents_Public($currentPage,$parPage){
        try{

            $premier = ($currentPage * $parPage) - $parPage;

            $sql="SELECT * from evenement   LIMIT $premier,$parPage ";
            $list_event_public_stmt=$this->db->prepare($sql);
            $list_event_public_stmt->execute();
            return $list_event_public_stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function listEventsPublic($currentPage,$parPage){
        try{

            $premier = ($currentPage * $parPage) - $parPage;

            $sql="SELECT * from evenement where approved=1  LIMIT $premier,$parPage ";
            $list_event_public_stmt=$this->db->prepare($sql);
            $list_event_public_stmt->execute();
            return $list_event_public_stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function listEvent($id){
        try{
            $this->event_id=$id;
            $sql="SELECT * from evenement where id=:id";
            $list_event_stsmt=$this->db->prepare($sql);
            $list_event_stsmt -> bindValue(':id',$this->event_id);
            $list_event_stsmt->execute();
            return $list_event_stsmt->fetch(PDO::FETCH_ASSOC);

        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
    
    
    function suppEvent($id){
        try{
            $this->event_id=$id;
            $sql1="DELETE from comment where event_id=:id";
            $supp_comment_stsmt = $this->db->prepare($sql1);
            $supp_comment_stsmt -> bindValue(':id',$this->event_id);
            $supp_comment_stsmt ->execute();

            $sql="DELETE from evenement WHERE id=:id ";
            $supp_event_stsmt = $this->db->prepare($sql);
            $supp_event_stsmt -> bindValue(':id',$this->event_id);
            $supp_event_stsmt ->execute();
            

        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function modifEvent($id,$titre, $type, $ville ,$photo,$date,$time,  $description,$approved){
        try{
            $this->event_id=$id;
            $this->event_titre=$titre;
            $this->event_type=$type;
            $this->event_lieu=$ville;
            $this->event_date=$date.' '.$time;
            $this->event_description=$description;
            $this->event_photo=$photo;
            $this->event_approved=$approved;

            if(!empty($photo)){
                $sql ="UPDATE evenement SET titre=:titre, type=:type, ville=:ville, date=:date, photo=:photo, description=:description, approved=:approved where id=:id" ;
                $upadte_event_stmt = $this->db->prepare($sql);
                $upadte_event_stmt -> bindValue(':id',$this->event_id);
                $upadte_event_stmt -> bindValue(':titre',strtoupper($this->event_titre));
                $upadte_event_stmt -> bindValue(':type',$this->event_type);
                $upadte_event_stmt -> bindValue(':ville',ucfirst($this->event_lieu));
                $upadte_event_stmt -> bindValue(':photo',$this->event_photo);
                $upadte_event_stmt -> bindValue(':date',$this->event_date);
                $upadte_event_stmt -> bindValue(':description',$this->event_description);
                $upadte_event_stmt -> bindValue(':approved',$this->event_approved);
                $upadte_event_stmt->execute();
            }
            else{
                $sql ="UPDATE evenement SET titre=:titre, type=:type, ville=:ville, date=:date,  description=:description, approved=:approved where id=:id" ;
                $upadte_event_stmt = $this->db->prepare($sql);
                $upadte_event_stmt -> bindValue(':id',$this->event_id);
                $upadte_event_stmt -> bindValue(':titre',strtoupper($this->event_titre));
                $upadte_event_stmt -> bindValue(':type',$this->event_type);
                $upadte_event_stmt -> bindValue(':ville',ucfirst($this->event_lieu));
                
                $upadte_event_stmt -> bindValue(':date',$this->event_date);
                $upadte_event_stmt -> bindValue(':description',$this->event_description);
                $upadte_event_stmt -> bindValue(':approved',$this->event_approved);
                $upadte_event_stmt->execute();

            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function nbEvent_admin(){
        try{
            $sql='SELECT count(*) from evenement ';
            $query = $this->db->prepare($sql);
            
            $query->execute();
            $result = $query->fetch();
            $nbevents = (int) $result['count(*)'];
            return $nbevents;

        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function nbEvent_user($id){
        try{
            $sql='SELECT count(*) from evenement where user_id=:user_id';
            $query = $this->db->prepare($sql);
            $query -> bindValue(':user_id',$id);
            $query->execute();
            $result = $query->fetch();
            $nbevents = (int) $result['count(*)'];
            return $nbevents;

        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
    function nbEvent(){
        try{
            $sql='SELECT count(*) from evenement where approved=1';
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            $nbevents = (int) $result['count(*)'];
            return $nbevents;

        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
        function NbreEvent($search,$type){
            try{
                if(!empty($search)){
                    $search="AND titre LIKE ".$this->db->quote("%".$search."%")."AND type LIKE".$this->db->quote($type);
                    $sql="SELECT count(*) from evenement where approved=1 ".$search;
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $result = $query->fetch();
                    $nbevents = (int) $result['count(*)'];
                    $_SESSION['filter_on']=$_POST;

                    return $nbevents;
    
                }elseif(empty($search)){
                    $search="AND type LIKE".$this->db->quote($type);
                    $sql="SELECT count(*) from evenement where approved=1 ".$search;
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $result = $query->fetch();
                    $nbevents = (int) $result['count(*)'];
                    return $nbevents;
                }elseif(empty($search) && empty($type)){
                    $sql='SELECT count(*) from evenement where approved=1';
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $result = $query->fetch();
                    $nbevents = (int) $result['count(*)'];
                    return $nbevents;
                }
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }


    
    }















?>