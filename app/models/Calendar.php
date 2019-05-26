<?php

require_once('DB.class.php');
class Calendar {

    protected $db;
    public function __construct() {
//        $this->db=new DB\SQL(
//            'mysql:host=localhost;port=3306;dbname=dev2',
//            'devuser123',
//            'devuser123'
//        );
        $this->db=DB::getConnection('dev2');
    }

    public function addAppoint($title,$details,$category_id,$name_product,$name_product_category,$first_name,$last_name,$email,
                               $phone,$city,$zip_code,$date_appointment,$is_confirmed,$isScheduled,$disable){
        $this->db->exec("INSERT INTO APPOINTMENT (TITLE,NAME_PRODUCT,NAME_PRODUCT_CATEGORIE,idPRODUCT_CATEGORIE,DETAILS,FIRSTNAME,LASTNAME,EMAIL,PHONE,CITY,ZIP_CODE,
                          DATE_APPOINTMENT,isCONFIRMED,isSCHEDULED,DISABLE,idUSER,idENTITY)
                          VALUES ('$title','PRODUCT NAME','$category_id','$category_id','$details','$first_name','$last_name','$email',1234,'CITY1','1234','2019-02-23',0,0,0,0,1)");
        return true;
    }

    public function addSlot($idAPPOINTMENT,$duration,$start){
        $query="INSERT INTO SLOT_APPOINTMENT(START_DATE,DURATION,idAPPOINTMENT)
                          VALUES ('$start','$duration',$idAPPOINTMENT)";
        $this->db->exec($query);
        $result=$this->db->lastInsertId();
        return $result;
    }

    public function updateSlot($duration,$start,$end,$idSlot){
        $query="UPDATE SLOT_APPOINTMENT SET START_DATE='$start',DURATION='$duration',END_DATE='$end' WHERE idSLOT_APPOINTMENT=$idSlot";
        $result=$this->db->exec($query);
        return $result;
    }

    public function fetch_slot(){
        $query="SELECT * FROM SLOT_APPOINTMENT LEFT JOIN APPOINTMENT ON APPOINTMENT.idAPPOINTMENT = SLOT_APPOINTMENT.idAPPOINTMENT 
                LEFT JOIN CATEGORIE_APPOINTMENT ON APPOINTMENT.idPRODUCT_CATEGORIE = CATEGORIE_APPOINTMENT.idCATEGORIE_APPOINTMENT 
                LEFT JOIN COLOR_CATEGORIE ON CATEGORIE_APPOINTMENT.idCATEGORIE_APPOINTMENT=COLOR_CATEGORIE.idCATEGORIE_APPOINTMENT
                LEFT JOIN COLOR ON COLOR.idCOLOR=COLOR_CATEGORIE.idCOLOR";
        $result=$this->db->exec($query);
        return $result;
    }

    public function getAppointment($slot_id){
        $slot=$this->db->exec("SELECT idAPPOINTMENT FROM SLOT_APPOINTMENT WHERE idSLOT_APPOINTMENT = $slot_id");
        $idAPPOINTMENT=$slot[0]['idAPPOINTMENT'];
        $slots=$this->db->exec("SELECT * FROM SLOT_APPOINTMENT LEFT JOIN APPOINTMENT ON APPOINTMENT.idAPPOINTMENT = SLOT_APPOINTMENT.idAPPOINTMENT WHERE SLOT_APPOINTMENT.idAPPOINTMENT = $idAPPOINTMENT");
        return $slots;
    }

    public function acceptAppointment($idAPPOINTMENT){
        $query="UPDATE APPOINTMENT SET isCONFIRMED = 1 WHERE idAPPOINTMENT=$idAPPOINTMENT";
        $this->db->exec($query);
    }

    public function acceptSlot($idSlot){
        $query="UPDATE SLOT_APPOINTMENT SET isCONFIRMED = 1 WHERE 	idSLOT_APPOINTMENT=$idSlot";
        $this->db->exec($query);
    }

    public function get_notScheduled()
    {
        return $this->db->exec('SELECT * FROM APPOINTMENT  LEFT JOIN CATEGORIE_APPOINTMENT ON APPOINTMENT.idPRODUCT_CATEGORIE=CATEGORIE_APPOINTMENT.idCATEGORIE_APPOINTMENT LEFT JOIN COLOR_CATEGORIE ON APPOINTMENT.idPRODUCT_CATEGORIE=COLOR_CATEGORIE.idCATEGORIE_APPOINTMENT LEFT JOIN COLOR on COLOR_CATEGORIE.idCOLOR=COLOR.idCOLOR where APPOINTMENT.isSCHEDULED=0');
    }

    public function get_event_categories(){
        return $this->db->exec('SELECT * FROM CATEGORIE_APPOINTMENT  LEFT JOIN COLOR_CATEGORIE ON CATEGORIE_APPOINTMENT.idCATEGORIE_APPOINTMENT=COLOR_CATEGORIE.idCATEGORIE_APPOINTMENT LEFT JOIN COLOR on COLOR_CATEGORIE.idCOLOR=COLOR.idCOLOR');
    }


    public function get_Scheduled()
    {
        return $this->db->exec('SELECT * FROM APPOINTMENT  left join COLOR_CATEGORIE ON APPOINTMENT.idPRODUCT_CATEGORIE=COLOR_CATEGORIE.idCOLOR_CATEGORIE where isSCHEDULED=1');
    }

    public function delete_item($id)
    {
        if($this->db->exec('DELETE  FROM APPOINTMENT where idAPPOINTMENT='.$id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update_schedule($event_id,$event_start)
    {
        if($this->db->exec("update APPOINTMENT set isSCHEDULED=1, START_APPOINTMENT='$event_start', END_APPOINTMENT='$event_start'  where idAPPOINTMENT=".$event_id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete_event($event_id)
    {
        if($this->db->exec("update APPOINTMENT set isSCHEDULED=0 where idAPPOINTMENT=".$event_id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function approve_event($event_id,$event_start)
    {
        if($this->db->exec("update APPOINTMENT set  isCONFIRMED =1, isSCHEDULED=1, START_APPOINTMENT='$event_start' , END_APPOINTMENT='$event_start' where idAPPOINTMENT=".$event_id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function update_confirmation($event_id,$event_start)
    {
        if($this->db->exec("update APPOINTMENT set  isCONFIRMED =0 , START_APPOINTMENT='$event_start', END_APPOINTMENT='$event_start' where idAPPOINTMENT=".$event_id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_event($event_id)
    {
        return $this->db->exec('SELECT * FROM APPOINTMENT  where idAPPOINTMENT='.$event_id.' limit 1');
    }

}