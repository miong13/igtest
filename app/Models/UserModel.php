<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    // protected $table      = 'users';
    // protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    // protected $allowedFields = ['name', 'email'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    // ...

    public function user_data($uuid){
    	// $db = \Config\Database::connect();
    	// return 'user data model';
     	$query = "select * from `user_details` where `uuid` = '" . $uuid . "'";
        $result = $this->db->query($query);
        if($result->resultID->num_rows > 0){
            return $result->getResult();
        }else{
            return false;
        }
        // print_r($this->db->query($query)->result_array());
        //return array('result' => $db->query($query)->result_array());
    }

    public function full_name($user_data){
        $first_name = 'Unknown';
        $last_name = 'Unknown';
        if(!empty($user_data)){
            foreach($user_data as $udata){
                // print_r($udata);
                if($udata->meta == 'first_name'){
                    $first_name = $udata->value;
                }
                if($udata->meta == 'last_name'){
                    $last_name = $udata->value;
                }
            }
        }

        return $first_name.' '.$last_name;
    }

    public function getUserLevel($ulevel){
        switch($ulevel){
            case '1': 
                $level = 'admin';
                break;
            case '2':
                $level = 'user';
                break;
            case '3':
                $level = 'tester';
                break;
        }

        return $level;
    }

    public function quiz_signup($array){
        $fname = $array['fname'];
        $midin = $array['midin'];
        $lname = $array['lname'];
        // print_r($array);
        $result = $this->checkRegisteredName($fname, $midin, $lname);
        // return $result->getResult();
        // $result->getResult()
        if($result->resultID->num_rows > 0){
            //already exists
            $res['id'] = $result->getResult()[0]->rtid;
            $res['status'] = 'return';
            return $res;
            // return false;
        }else{
            //insert
            $insert = "insert into `registered_testers` set `uuid` = '0', `fname`='".$fname."', `midin` = '".$midin."', `lname`='".$lname."', `date_registered` = '".date('Y-m-d H:i:s')."'";
            $this->db->query($insert);
            // return true;
            $res['id'] = $this->db->insertID();
            $res['status'] = 'new';
            return $res;
        }
        // echo $result->numRows;
        // print_r($result->resultID->num_rows);
    }

    private function checkRegisteredName($fname, $midin,$lname){
        $query = 'select * from `registered_testers` where `fname` = "'.$fname.'" and `midin` = "'.$midin.'" and `lname` = "'.$lname.'" ';
        // echo $query;
        return $this->db->query($query);
    }

    public function sign_in($email, $passw){
        $session = session();
        $query = 'select * from `users` where `email` = "'.$email.'"';
        $result = $this->db->query($query);
        if($result->resultID->num_rows > 0){
            $res['uuid'] = $result->getResult()[0]->user_id;
            $res['ulevel'] = $result->getResult()[0]->ulevel;
            $res['pword'] = $result->getResult()[0]->pword;
            $full_name = $result->getResult()[0]->full_name;
            if($result->getResult()[0]->is_active == '1'){
                if(password_verify($passw, $res['pword'])){
                    $session->set('uuid', $res['uuid']);
                    $session->set('ulevel', $res['ulevel']);
                    $res['result'] = 'logged in';
                    // $res['result'] = $full_name;
                }else{
                    $res['result'] = 'error';
                }
            }else{
                $res['result'] = 'inactive';
            }

        }else{
            $res['result'] = 'error';
        }
        return $res['result'];
    }

    // public function testerFirstName($uuid){
    //     $query = 'select * from `registered_testers` where `rtid` = "'.$uuid.'"';
    //     $result = $this->db->query($query);
    //     if($result->resultID->num_rows > 0){
    //         return $result->getResult()[0]->fname;
    //     }else{
    //         return 'Tester';
    //     }
    // }

    public function getFullName($uuid){
        $query = 'select * from `users` where `user_id` = "'.$uuid.'"';
        $result = $this->db->query($query);
        if($result->resultID->num_rows > 0){
            // return $result->getResult()[0]->fname.' '.$result->getResult()[0]->midin.'. '.$result->getResult()[0]->lname;
            return $result->getResult()[0]->full_name;
        }else{
            return 'Tester';
        }
    }

    public function is_logged_in(){

    }

    
	public function userActivity(){
        $sql = "insert into `quiz_activity` set     
        `uuid`,
        `tid`,
        `date_added` = '".date('Y-m-d H:i:s')."'
        ";
		$this->db->query($sql);
	}

    public function getEmployeeFullName($id, $format = 1){
        $query = 'select * from `employee` where `eid` = "'.$id.'"';
        $result = $this->db->query($query);
        if($result->resultID->num_rows > 0){
            switch($format){
                case 1:
                    return $result->getResult()[0]->lname.', '.$result->getResult()[0]->fname.' '.$result->getResult()[0]->mname;
                case 2:
                    return $result->getResult()[0]->fname.' '.$result->getResult()[0]->mname.' '.$result->getResult()[0]->lname;
                case 3:
                    return $result->getResult()[0]->lname.', '.$result->getResult()[0]->fname;
                case 4: 
                    return $result->getResult()[0]->lname.', '.$result->getResult()[0]->fname.' '.substr($result->getResult()[0]->mname, 0, 1).'.';
                case 5: 
                    return $result->getResult()[0]->fname.' '.substr($result->getResult()[0]->mname, 0, 1).'. '.$result->getResult()[0]->lname;
            }
        }else{
            return 'Unknown';
        }
    }

    //display lists of users in a table output
    public function listUsersTable(){
        $query = 'select * from `users`';
        $result = $this->db->query($query);
        // print_r($result);
        $html = '<table cellpadding="10px">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td><strong>FULLNAME</strong></td>';
        $html .= '<td><strong>EMAIL</strong></td>';
        $html .= '<td><strong>PHONE</strong></td>';
        $html .= '<td><strong>PASSWORD</strong></td>';
        $html .= '<td><strong>ACTION</strong></td>';
        $html .= '</tr>';        
        $html .= '</thead>';
        if($result->resultID->num_rows > 0){
            // $html =
            // print_r($result->getResult());
            foreach($result->getResult() as $record){
                $html .= '<tr>';
                $html .= '<td>'.$record->full_name.'</td>';
                $html .= '<td>'.$record->email.'</td>';
                $html .= '<td>'.$record->phone.'</td>';
                $html .= '<td>'.$record->pword.'</td>';
                $html .= '<td>
                                <button class="btn btn-success btnUserEdit" data-id="'.$record->user_id.'" 
                                data-fname=\''.$record->full_name.'\'
                                data-email=\''.$record->email.'\'
                                data-phone=\''.$record->phone.'\'
                                >EDIT/UPDATE</button>
                                <button class="btn btn-danger btnUserDelete" data-id="'.$record->user_id.'" >DELETE</button>
                          </td>';
                $html .= '</tr>';
            }
        }else{
            $html .= '<tr><td colspan="4">No Record found! / There should be an error. Atleast 1 record should be found!</td></td>';
        }

        $html .= '</table>';
        return $html;
    }

    //check if email exists
    public function emailExists($email){
        $query = "select * from `users` where `email` = '".$email."'";
        $result = $this->db->query($query);
        if($result->resultID->num_rows > 0){
            return true;
        }
        return false;
    }

    //add new users
    public function addNewUser($f, $t, $e, $p){
        if($this->emailExists($e)){
            return 'Email Already Exists!';
        }else{
            $query = "insert into `users` set 
            `full_name` = '".$f."',
            `phone` = '".$t."',
            `email` = '".$e."',
            `is_active` = '1',
            `pword` = '".password_hash($p, PASSWORD_BCRYPT)."',
            `date_added` = '".date('Y-m-d H:i:s')."'
            ";
   
            $this->db->query($query);       
            return 'A new user has been added!';
        }
    }

    //update users
    public function updateUser($id, $f, $t, $e, $p){
        // if($this->emailExists($e)){
        //     return 'Email Already Exists!';
        // }else{
            //
            // $query = "update `users` set 
            // `full_name` = '".$f."',
            // `phone` = '".$t."',
            // `email` = '".$e."',
            // `pword` = '".password_hash($p, PASSWORD_BCRYPT)."',
            // `date_added` = '".date('Y-m-d H:i:s')."'
            // where `user_id` = '".$id."'
            // ";
            $query = "update `users` set 
            `full_name` = '".$f."',
            `phone` = '".$t."',
            `email` = '".$e."',
            `date_added` = '".date('Y-m-d H:i:s')."'
            where `user_id` = '".$id."'
            ";
            $this->db->query($query);       
            return 'Record has been updated!';
        // }
    }

    //delete users
    public function deleteUser($id){
        if($id != 1){
            $query = "delete from `users`
            where `user_id` = '".$id."'
            ";
            $this->db->query($query);       
            return 'Record has been deleted!';
        }else{
            return 'This record cannot be deleted!';
        }

    }

    public function apiListEmployee(){
        $sql = "select * from `users`";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function apiEmployeeByEmail($email){
        $sql = "select * from `users` where `email` = '".$email."'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    //add new users
    public function addNewUserWPhoto($f, $t, $e, $p){
        if($this->emailExists($e)){
            return 'Email Already Exists!';
        }else{
            $query = "insert into `users` set 
            `full_name` = '".$f."',
            `email` = '".$e."',
            `is_active` = '1',
            `pword` = '".password_hash($p, PASSWORD_BCRYPT)."',
            `photo` = '".$t."',
            `date_added` = '".date('Y-m-d H:i:s')."'
            ";
            $this->db->query($query);       
            return 'A new user has been added!';
        }
    }

    //update users
    public function updateUserWPhoto($id, $f, $t, $e, $p){
        $sqlpass = "";
        if(!empty($p)){
            $sqlpass = "`pword` = '".password_hash($p, PASSWORD_BCRYPT)."',";
        }
        if($this->emailExists($e)){
            $sql = "select `user_id` from `users` where `email` = '".$e."'";
            $r = $this->db->query($sql);
            if($r->resultID->num_rows > 0){
                $q_id = $r->getResult()[0]->user_id;
                if($q_id == $id){
                    $query = "update `users` set 
                    `full_name` = '".$f."',
                    `photo` = '".$t."',
                    `email` = '".$e."',
                    ".$sqlpass."
                    `date_added` = '".date('Y-m-d H:i:s')."'
                    where `user_id` = '".$id."'
                    ";
                    $this->db->query($query);       
                    return 'Record has been updated!';                    
                }else{
                    return 'Email Already Exists!';     
                }
            }else{
                $query = "update `users` set 
                `full_name` = '".$f."',
                `photo` = '".$t."',
                `email` = '".$e."',
                ".$sqlpass."
                `date_added` = '".date('Y-m-d H:i:s')."'
                where `user_id` = '".$id."'
                ";
                $this->db->query($query);       
                return 'Record has been updated!';                
            }
        //     return 'Email Already Exists!';
        }else{
            $query = "update `users` set 
            `full_name` = '".$f."',
            `photo` = '".$t."',
            `email` = '".$e."',
            ".$sqlpass."
            `date_added` = '".date('Y-m-d H:i:s')."'
            where `user_id` = '".$id."'
            ";
            $this->db->query($query);       
            return 'Record has been updated!';
        }
    }

    //sign-in API
    public function sign_in_api($email, $passw){
        $session = session();
        $query = 'select * from `users` where `email` = "'.$email.'"';
        $result = $this->db->query($query);
        if($result->resultID->num_rows > 0){
            $result_pword = $result->getResult()[0]->pword;
            if($result->getResult()[0]->is_active == '1'){
                if(password_verify($passw, $result_pword)){
                    // $session->set('uuid', $res['uuid']);
                    // $session->set('ulevel', $res['ulevel']);
                    // $res['result'] = 'logged in';
                    $res['err'] = 'success';
                    $res['uuid'] = $result->getResult()[0]->user_id;
                    $res['ulevel'] = $result->getResult()[0]->ulevel;
                    $res['full_name'] = $result->getResult()[0]->full_name;
                    $res['photo'] = $result->getResult()[0]->photo;
                    $res['email'] = $result->getResult()[0]->email;
                    $res['result'] = $res;
                    // $res['result'] = $full_name;
                }else{
                    $res['err'] = 'error';
                    $res['result'] = $res;
                    // $res['result'] = 'error';
                }
            }else{
                // $res['result'] = 'inactive';
                $res['err'] = 'inactive';
                $res['result'] = $res;
            }

        }else{
            // $res['result'] = 'error';
            $res['err'] = 'error';
            $res['result'] = $res;
        }
        return $res['result'];
    }

}