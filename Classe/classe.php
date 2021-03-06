<?php
/**
 * Created by IntelliJ IDEA.
 * User: riccardosibani
 * Date: 29/09/15
 * Time: 14:55
 */
class Classe{
    public $id;
    public $class;
    public $user_id;
    public $deleted = false;
    function __construct($input = false){
        if (is_array($input)) {
            foreach ($input as $key => $val) {
                // Note the $key instead of key.
                // This will give the value in $key instead of 'key' itself
                $this->$key = $val;
            }
        }
    }
    function withClassAndUser($class, $user_id){
        $this->class = $class;
        $this->user_id = $user_id;
    }
    function withDelete($class, $user_id, $delete){
        $this->withClassAndUser($class, $user_id);
        $this->deleted = $delete;
    }
    function getId(){
        return $this->id;
    }
    function setId($id){
        $this->id = $id;
    }
    function getClass(){
        return $this->class;
    }
    function setClass($class){
        $this->class = $class;
    }
    function getUserId(){
        return $this->user_id;
    }
    function setUserId($user_id){
        $this->user_id = $user_id;
    }
    function getDeleted(){
        return $this->deleted;
    }
    function setDelete(){
        $this->deleted = true;
    }
    public static function getClasses(){
        //clear the result
        $classes = array();

        //Get the connection
        $connection = Database::getConnection();

        $query = 'SELECT  * FROM class WHERE   deleted = false ORDER BY class ASC';

        //Run the query
        $result_obj = $connection->query($query);
        try{
            //I COULD USE A FOR AND IT WOULD BE BETTER
            //BUT IT DOESN'T WORK AND I HAVE NO TIME TO
            //FIND THE PROBLEM :)
            $i=0;
            while($result = $result_obj->fetch_array(MYSQLI_ASSOC)){
                $classes[$i] =  new Classe($result);
                $i++;
            }
            //Pass back the results
            return $classes;
        }
        catch(Exception $e){
            $_SESSION['message'] = $e->getMessage(); //Not properly good for safety
        }
    }



    public static function getNameByUserId($class_id){
        //clear the result
        $connection = Database::getConnection();
        $query = "SELECT class FROM class WHERE id=".$class_id;
        //echo $query;
        $result_obj = $connection->query($query);
        try{
            //I COULD USE A FOR AND IT WOULD BE BETTER
            //BUT IT DOESN'T WORK AND I HAVE NO TIME TO
            //FIND THE PROBLEM :)
            //SHOULD BE ONLY ONE ELEMENT FOR SURE
            $i=0;
            while($result = $result_obj->fetch_array(MYSQLI_ASSOC)){
                $className = new Classe($result);
                $i++;
            }
            //pass back the result
            return $className->getClass();
        } catch(Exception $e){
            $_SESSION['message'] = $e->getMessage(); //Not properly good for safety
        }
    }



    public static function getNameById($class_id){
        //clear the result
        $className = '';
        $connection = Database::getConnection();
        $query = "SELECT class FROM class WHERE id=".$class_id;
        //echo $query;
        $result_obj = $connection->query($query);
        try{
            //I COULD USE A FOR AND IT WOULD BE BETTER
            //BUT IT DOESN'T WORK AND I HAVE NO TIME TO
            //FIND THE PROBLEM :)
            //SHOULD BE ONLY ONE ELEMENT FOR SURE
            $i=0;
            while($result = $result_obj->fetch_array(MYSQLI_ASSOC)){
                $className = $result;
                $i++;
            }
            //pass back the result
            return $result['class'];
        } catch(Exception $e){
            $_SESSION['message'] = $e->getMessage(); //Not properly good for safety
        }
    }
}
