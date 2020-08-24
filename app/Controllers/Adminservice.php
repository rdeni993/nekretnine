<?php namespace App\Controllers;

use CodeIgniter\Controller;

/**
 * 
 * Admin Service
 * =============
 * 
 * This Controller is used for
 * replace service...
 * 
 */

class Adminservice extends Controller{

    public function index(){ return redirect()->to(site_url('admin/property?error=4e')); }

    // Service: add_property to database
    // Request from admin/property
    // Response to admin/property
    public function add_property(){

        if( $this->request->getPost('prop_submited') ){

            // We need Property Model
            $prop_model = model('PropertyModel');

            // Set Input Data
            $prop_type  = $this->request->getPost('prop_type');
            $table_name = $this->request->getPost('db_table');
            $return_uri = $this->request->getPost('db_uri_back');

            // Using This Method Add object to database
            if( $prop_model->add_prop( $table_name, $prop_type ) ){

                return redirect()->to(site_url( $return_uri . '?success=1e'));
            
            } else {
            
                return  redirect()->to(site_url( $return_uri . '?error=4e'));
            
            }

        } else {
            return  redirect()->to(site_url( $return_uri . '?error=1e'));
        }
    }

    // Service: remove_property from database
    // Request from admin/remove_prop
    // Response json
    public function remove_property(){
        if( $this->request->getPost('prop_delete') ){
            
            // We need Property Model
            $prop_model = model('PropertyModel');

            $prop_id  = $this->request->getPost('prop_delete');
            $db_table = $this->request->getPost('db_table');

            if( $prop_model->remove_prop( $db_table, $prop_id ) ){

                echo json_encode(['error' => false, 'desc' => "Property Successfully Removed from Database"]);

            } else {

                echo json_encode(['error' => true, 'desc' => "Something is wrong with request"]);
                
            }

        } else {
            echo json_encode(['error' => true, 'desc' => "Something is wrong with request"]);
        }
    }

    // Service: add article to database
    // Request from home/add_article
    // Response to home/add_article
    public function add_article(){
        // Set Classic var without
        // any image
        $property_images = false;
        // Return View Value
        $view_value = false;

        if( $this->request->getPost('article_proposed') ){

            // Load Model
            $prop_model = model("PropertyModel");
            $session = session();
            $prop_owner = $session->get('logged_data');
            $error = 0;

            // Take ID of Article
            $some_data = $prop_model->save_property($this->request->getPost(), $prop_owner->user_ID);

            // Lets Do some thing about images
            if(!empty($_FILES['property_images']['name'][0]) && $some_data){
                // Now we can proceed save images
                // to database..
                $var_images = $this->request->getFiles();
                // Create FOLDER 
                $folder_name = "article-" . $some_data;
                $folder_path = ROOTPATH . "public/uploads/";

                // Counter
                $first_image = true;

                if( mkdir( $folder_path . $folder_name ) ){
                    $fp = fopen( $folder_path . $folder_name . "/index.php", "w" );
                }


                echo "<pre>";
                // Now put images
                foreach( $var_images['property_images'] as $image ){
                    
                    if( $image->getName() ){
                        
                    // Create New Name for image
                    $new_name = $image->getRandomName();


                    // Move it there
                    if( @$image->move( $folder_path . $folder_name, $new_name ) ){

                        $conf = [
                            'image_owner' => $some_data,
                            'image_title' => $new_name,
                            'image_path'  => base_url() . '/public/uploads/' . $folder_name . '/' . $new_name,
                            'image_date'  => date('Y-m-d', time())
                        ];

                        $f_image = $prop_model->save_image($conf);

                        if( $f_image && $first_image ){
                            if( $prop_model->update_article_featured($some_data, base_url() . '/public/uploads/' . $folder_name . '/' . $new_name) ){
                                $error = 0;
                            }
                            $error = 0;
                        }else{
                            $error = 1;
                        }

    
                    }
                
                    }
                
                }

            }

        }else{
            die("Nepravilan pristup stranici....");
        }

        if(!$error){
            return redirect()->to(site_url('user?e_m=200'));
        } else {
            return redirect()->to(site_url('user?e_m=403'));
        }

    }

    // Service: register_user
    // Request POST
    // Response error or success
    public function register_user(){
        if( $this->request->getPost("user_form_submited") ){
            // Save POST to var
            $post_req = $this->request->getPost();
            // Load Model
            $user_model = model("UserModel");

            $user_reg = $user_model->register($post_req);

            if($user_reg){
                // One important thing is
                // User Account will be blocked until
                // user activate it using emaill.......
                $user_ID = $user_reg->connID->insert_id;
                $hash = $user_model->generate_activation($user_ID);
                if( $hash ){
                    // Send Email With Data
                    if( $user_model->generate_email($post_req, $hash) ){
                        return redirect()->to(site_url('user/register?success=true'));
                    } else {
                        return redirect()->to(site_url('user/register?error=true'));
                    }
                } else {
                    return redirect()->to(site_url('user/register?error=true'));
                }
            }else{
                return redirect()->to(site_url('user/register?error=true'));
            }
        }else{
            die("Nepravilan pristup stranici");
        }
    }

    // Servise: delete_user
    // Request: AJAX/POST
    // Response: JSON
    public function remove_user(){
        if( $this->request->getPost('user_ID') ){
            // Set model
            $user_model = model('UserModel');
            if( $user_model->remove_user($this->request->getPost('user_ID')) ){
                echo json_encode(['response' => true]);
            } else {
                echo json_encode(['response' => false]);
            }
        } else {
            echo json_encode(['response' => false]);
        }
    }

    // Servise: delete_property
    // Request: AJAX/POST
    // Response: JSON
    public function remove_prop(){
        if( $this->request->getPost('prop_ID') ){
            // Set model
            $user_model = model('PropertyModel');
            if( $user_model->remove_property($this->request->getPost('prop_ID')) ){
                if(@$user_model->delete_images($this->request->getPost('prop_ID')))
                    echo json_encode(['response' => true]);
                else 
                    echo json_decode(['response'=> true]);
            } else {
                echo json_encode(['response' => false]);
            }
        } else {
            echo json_encode(['response' => false]);
        }
    }

    // Service: get user by id
    // Request: AJAX/POST
    // Response: JSON
    public function get_user(){
        if( $this->request->getPost('user_ID') ){   
            $user_mo = model('UserModel');
            $user_ID = $this->request->getPost('user_ID');
            echo json_encode([ 'response' => true, 'data' => $user_mo->get_user($user_ID) ]);
        } else {
            echo json_encode([ 'response' => false ]);
        }
    }

    // Service: user login
    // Request POST
    // Response User Profile Model
    public function login_user(){
        /** Select User Table */
        $user_model = model('UserModel');
        /** Get User by email */
        if( $this->request->getPost('user_email') ){
            /** Get User Profile */
            $user_profile = $user_model->get_user_by_email( $this->request->getPost('user_email') );
            if( $user_profile ){
                /** Now we have user model!! */
                /** Check is password good */
                if( password_verify($this->request->getPost('user_password'), $user_profile->user_password) ){
                    /** Set Session */
                    $session = session();
                    /** Create Session */
                    $session->set('logged_in', true);
                    $session->set('logged_data', $user_profile);
                    $user_model->last_update($user_profile->user_ID);
                    return redirect()->to(site_url('user'));
                } else {
                    return redirect()->to(site_url('user/login?errorl=1'));
                }

            } else {
                return redirect()->to(site_url('user/login?errorl=2'));
            }
        } else {
            return redirect()->to(site_url('user/login?errorl=1'));
        }
    }

    // Service: Mark article as finished
    // Request: JSON/GET Article Id
    // Response: JSON
    public function mark_article_as_finished(){
        if( $this->request->getGet('article_ID') ){
            // Instantiate model
            $prop_model = model('PropertyModel');
            // Do action
            if( $prop_model->make_article_done($this->request->getGet('article_ID'),$this->request->getGet('user_ID')) ){
                echo json_encode(['response' => true]);
            } else {
                echo json_encode(['response' => false]);
            }
        } else {
            echo json_encode(['response' => false]);
        }
    }

    // Service: Change Password
    // Request: POST
    // Response: BOOLEAN
    public function change_password(){
        // Load user model
        $user_model = model('UserModel');
        // Load Session
        $session = session();
        // User Data
        $userdata = $session->get('logged_data');
        // POST DATA
        $post_req = $this->request->getPost();
        // Now we have some data
        // first check is old password good... remember 
        // we have stored on in session
        if( password_verify($post_req['user_old_password'], $userdata->user_password) ){
            if( $user_model->change_password($post_req['user_password'], $post_req['user_email']) ){

                $mail_content = view('email/change_password', ['new_pass' => $post_req['user_password']]);
                $mail_head = "Content-Type:text/html; charset='UTF-8'\r\nFrom:info@nekretnine.me";
                if(mail($post_req['user_email'], 'Promjena lozinke', $mail_content, $mail_head)){
                    return redirect()->to(site_url('user/logout'));
                }

            } else {
                echo "Lozinka nije promjenjena";
            }
        } else {
            echo "Stara lozinka nije dobra";
        }

    }

    // Service Change Your profile
    // data... 
    public function change_my_data(){
        // Only accessibile trough post form
        if( $this->request->getPost() ){
            // There is few data only we can change... 
            // Name, e-mail, telephone and address
            $user_model = model("UserModel");
            // Get Session
            $session = session();
            $userdata = $session->get('logged_data');
            if( $user_model->change_profile($this->request->getPost(), $userdata->user_ID) ){
                return redirect()->to(site_url('user?e_m=201'));
            } else {
                return redirect()->to(site_url('user?e_m=405'));
            }
        } else {
            return redirect()->to(site_url('user?e_m=404'));
        }
    }

    // Service for retrieving json profile
    public function jsonprop(){
        if($this->request->getPost('prop_ID')){
            // Get value
            $myVal = $this->request->getPost('prop_ID');
            $prop_model = model('PropertyModel');
            // Get some Data
            $data = $prop_model->ret_article($myVal);

            echo json_encode(["response" => true, "data" => $data ]);

        } else {
            echo json_encode(["response" => false]);
        }
    }

    // Service Report Profile
    public function report_profile($property_ID, $property_title){
        if($property_ID){
            $report_model = model("ReportModel");
            $session = session();
            $userdata = $session->get('logged_data');
            if($userdata->user_activate == 0){
                return redirect()->to(site_url('article/alert/' . $property_ID . '/' . $property_title ));
            } else {
                $user_ID = $userdata->user_ID;
                echo $user_ID;
                echo "<br>" . $property_ID;
                if($report_model->create_report($userdata->user_ID, $property_ID)){
                    return redirect()->to(site_url('article/alert/' . $property_ID . '/' . $property_title ));
                } else {
                    die("Do not trying to hack this...");
                }
            }
        } else die("Do not trying to hack this!!!!");
    }

    // Service End Up Report
    public function endup_report(){
        if($this->request->getGet('report_ID')){
            // Load Report
            $rep_model = model("ReportModel");
            if($rep_model->endup_report($this->request->getGet('report_ID'))){
                echo json_encode(['response' => true]);
            } else {
                echo json_encode(['response' => false]);
            }
        } else {
            echo json_encode(['response' => false]);
        }
    }
    
    // Discover User With his all 
    // proeprties.... 
    public function discover_user(){
        if($this->request->getPost('user_ID')){

            // Tables
            $user_model     = model("UserModel");
            $property_model = model("PropertyModel");
            // Extract User ID
            $user_ID = $this->request->getPost('user_ID');

            // Get User
            $user_data = $user_model->discover_user($user_ID);
            $user_property = $property_model->list_my_props($user_data[0]->user_ID);

            echo json_encode([
                'response' => true,
                'userdata' => $user_data,
                'props'    => $user_property
            ]);

        } else {
            echo json_encode([ 'response' => false, 'message' => 'Wrong Attempt' ]);
        }
    }

    /** GDPR */
    public function gdpr(){
        if(setcookie('gdpr_stmt_add', 'OK', (time() + (3600 * 30)), '/')){
            echo json_encode(['response' => true]);
        } else {
            echo json_encode(['response' => false]);
        }
    }

}