<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * 
 * Method For User Control
 * 
 */
class User extends Model{

    // Database Holder
    protected $db;

    // Table Holders
    protected $user_table;

    // Constructor
    public function __construct(){

        // Do Some Connection
        $this->db = \Config\Database::connect();

    }

    // List Users
    public function all_users($offset = 0, $limit = 50){
        // Select Table
        $this->user_table = $this->db->table('users');
        return $this->user_table->get($limit, $offset)->getResult();
    }
    // List Users
    public function all_users_inv($offset = 0, $limit = 50){
        // Select Table
        $this->user_table = $this->db->table('users');
        $this->user_table->orderBy('user_ID', 'DESC');
        return $this->user_table->get($limit, $offset)->getResult();
    }

    // Register new User to database
    public function register($post_req){
        if(empty($post_req)){
            return false;
        }elseif( $this->get_user_by_email($post_req["user_email"]) ){
            return false;
        }else{
            // Do some Dirty Work
            // From Form we get:
            // user_name
            // user_password
            // user_email
            // user_avatar

            // We need to set up
            // user_password .>hash
            // user_doc
            // user_active
            // user_role
            $config = [
                "user_name"         => $post_req["user_name"],
                "user_email"        => $post_req["user_email"],
                "user_avatar"       => $post_req["user_avatar"],
                "user_doc"          => date("Y-m-d", time()),
                "user_last_update"  => date("Y-m-d", time()),
                "user_role"         => "user",
                "user_activate"     => 0,
                "user_password"     => password_hash($post_req['user_password'], PASSWORD_DEFAULT)
            ];

            // Select Database
            $this->user_table = $this->db->table('users');

            $res_return = $this->user_table->insert($config);

            return $res_return;
        }
    }
    // Remove User 
    public function remove_user($user_ID){
        if($user_ID && $user_ID != 1){
            // Select Table
            $this->user_table = $this->db->table('users');
            // Delete User
            $prop = $this->db->table('property');
            $prop->where('property_owner', $user_ID);
            $prop->delete();
            return $this->user_table->delete(['user_ID' => $user_ID]);

        } else {
            return false;
        }
    }
    // Get User
    public function get_user($user_ID){
        // Select Table
        $this->user_table = $this->db->table('users');
        // Get Result
        $data = $this->user_table->getWhere(["user_ID" => $user_ID])->getResult();
        return $data[0];
    }
    // Notice user about his e-mail
    // activation
    public function generate_activation($user_ID){
        // Select Table
        $this->user_table = $this->db->table('activator');
        // Generate Hash
        $act_hash = sha1( $user_ID . time() );

        // Now let do activation key
        $data = [
            'activator_hash' => $act_hash,
            'activator_user' => $user_ID,
            'activator_date' => time()
        ];

        if($this->user_table->insert($data)){
            return $act_hash;
        } else {
            return false;
        }
    }
    // Generate email
    public function generate_email($user_email, $user_hash){
        echo "<pre>";
        //print_r($user_email);
        //print_r($user_hash);
        $email_content = view('email/activation', 
        [
            'hash' => $user_hash,
            'email'=> $user_email['user_email'] 
        ]);
        $mail_head = "Content-Type:text/html; charset='UTF-8'\r\nFrom:info@nekretnine.me";
        
        if(mail($user_email['user_email'], 'Activation E-mail', $email_content, $mail_head)){
            return true;
        } else {
            return false;
        }
    }
    // Return User profile using hash
    public function get_user_by_hash($hash){
        // Select Table
        $this->user_table = $this->db->table('activator');

        // Select USer ID Using Hash
        $result = $this->user_table->getWhere(['activator_hash' => $hash]);

        return $result->getResult();
    }

    // Get User
    public function get_user_by_email($user_ID){
        // Select Table
        $this->user_table = $this->db->table('users');
        // Get Result
        $data = $this->user_table->getWhere(["user_email" => $user_ID])->getResult();
        if(empty($data)){
            return false;
        } else {
            return $data[0];
        }
    }

    // Activate User
    public function activate_user($user_ID){
        // Select Table
        $this->user_table = $this->db->table('users');
        // Set Activate to TRUE
        $this->user_table->set('user_activate', 1);
        $this->user_table->where('user_ID', $user_ID);
        return $this->user_table->update();
    }

    // Change Password
    public function change_password($new_password, $email){
        // Select Table
        $this->user_table = $this->db->table('users');
        // Prepare
        $this->user_table->set('user_password', password_hash($new_password, PASSWORD_DEFAULT));
        $this->user_table->where('user_email', $email);
        return $this->user_table->update();
    }
    // Change Profile Data
    public function change_profile($post_req, $user_ID){
        $session = session();
        $userdata = $session->get('logged_data');
        // Select Table
        $this->user_table = $this->db->table('users');

        $this->user_table->set('user_name', $post_req['user_name']);
        $this->user_table->set('user_mobile', $post_req['user_mobile']);
        $this->user_table->set('user_address', $post_req['user_address']);

        $this->user_table->where('user_ID', $user_ID);

        return $this->user_table->update();

    }

    // Get My Images
    public function list_my_imgs($prop_ID){
        // Select Table
        $this->user_table = $this->db->table('property_images');
        // Return Images For this Prop
        return $this->user_table->getWhere(['image_owner' => $prop_ID])->getResult();
    }

    // Update last login
    public function last_update($user_ID){
        $this->user_table = $this->db->table('users');
        $this->user_table->set('user_last_update', date("Y-m-d h:i", time()));
        $this->user_table->where('user_ID', $user_ID);
        return $this->user_table->update();
    }

    //
    public function discover_user($user_ID){
        // Select Table
        $this->user_table = $this->db->table('users');
        // Select
        $this->user_table->select("
            users.user_ID,
            users.user_name,
            users.user_email,
            users.user_activate,
            users.user_last_update
        ");
        //$this->user_table->join('property', 'users.user_ID = property.property_owner');
        $this->user_table->where('user_ID', $user_ID);
        $this->user_table->orWhere('user_email', $user_ID);
        // Get User
        return $this->user_table->get()->getResult();
    }

}