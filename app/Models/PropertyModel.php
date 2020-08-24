<?php 

namespace App\Models;

use CodeIgniter\Model;

/**
 * 
 * PropertyModel
 * =============
 * 
 * date: 06/07/2020
 * author: Denis Ristic
 * db: cms
 * tables: property_type
 * 
 */

class PropertyModel extends Model{

    // Database Holder
    protected $db;

    // Table Holders
    protected $prop_type_table;

    // Constructor
    public function __construct(){

        // Do Some Connection
        $this->db = \Config\Database::connect();

    }

    // Add Property Type To Database
    public function add_prop($table_name, $prop_type){ 
        // Select Table
        $this->prop_type_table = $this->db->table($table_name);
        // Action
        return $this->prop_type_table->insert([
            'type' => $prop_type
        ]); 
    }

    // Get All Property
    public function get_props($table_name){
        // Select Table
        $this->prop_type_table = $this->db->table($table_name);
        // Action
        return $this->prop_type_table->get()->getResult();
    }

    // Remove Property
    public function remove_prop($table_name, $prop_ID){
        // Select Table
        $this->prop_type_table = $this->db->table($table_name);
        // Action
        return $this->prop_type_table->delete(['ID' => $prop_ID ]);
    }

    // Save Property To Database
    // And return ID to current proccess
    public function save_property($post_req, $user_ID){
        // In request we get important data
        // property_title
        // property_type
        // property_rent
        // property_location
        // property_price
        // property_size
        // property_description
        // THINGS WE MISSED
        // property_images
        // property_owner
        // property_custom
        // property

        $post_req['property_custom'] = false;
        $post_req['property_owner'] = $user_ID;
        $post_req['property_image'] = 'none';
        $post_req['property_doc'] = date("Y-m-d h-i", time());

        // Convert custom to csv
        if(@$post_req['custom']):
            foreach($post_req['custom'] as $cus){
                $post_req['property_custom'] .= ($cus . ',');
            }
        endif;

        // Remove last , and property_custom is ready
        // OLD # $post_req['property_custom'] = rtrim($post_req['property_custom'], ',');
        if(@$post_req['custom']):
            $post_req['property_custom'] = json_encode($post_req['custom']);
        endif;

        // Remove unwanted Data
        unset($post_req['article_proposed']);
        unset($post_req['custom']);

        // Select Table
        $this->prop_type_table = $this->db->table('property');

        $ret_data = $this->prop_type_table->insert($post_req);

        return $ret_data->connID->insert_id;
    }

    // Save Image to Database
    public function save_image($image_prop){
        // Image prop must have:
        // owner -> article_id
        // path  -> full path
        // title -> some default name
        // date  -> date
        $this->prop_type_table = $this->db->table("property_images");

        $ret_data = $this->prop_type_table->insert($image_prop);

        return $ret_data->connID->insert_id;
    }

    // Update article image
    // First image is important
    public function update_article_featured($prop_ID, $image_URL){
        // Connect to real table
        $this->prop_type_table = $this->db->table("property");
        // Update property table
        $this->prop_type_table->set("property_image", $image_URL);
        $this->prop_type_table->where("property_ID", $prop_ID);

        return $this->prop_type_table->update();
    }
    // Get All props
    public function all_props(){
        // Select Table
        $this->prop_type_table = $this->db->table('property');
        // Return all props
        return $this->prop_type_table->get()->getResult();
    }
    // Get All props
    public function first_five_props(){
        // Select Table
        $this->prop_type_table = $this->db->table('property');
        // Return all props
        $this->prop_type_table->orderBy('property_ID', 'desc');
        return $this->prop_type_table->get(5)->getResult();
    }

    // List properties
    public function list_props($offset, $limit = 50){
        // Select Table
        $this->user_table = $this->db->table('property');

        $this->user_table->orderBy('property_premium', 'DESC');
        $this->user_table->orderBy('property_id', 'DESC');
        
        return $this->user_table->get($limit, $offset)->getResult();
    }

    // List properties
    public function list_my_props($user_ID){
        // Select Table
        $this->user_table = $this->db->table('property');
        $this->user_table->orderBy('property_ID', 'DESC');
        return $this->user_table->getWhere(['property_owner' => $user_ID])->getResult();
    }
    // Remove User 
    public function remove_property($prop_ID){
        if($prop_ID){

            // Select Table
            $this->user_table = $this->db->table('property');
            // Delete User
            return $this->user_table->delete(['property_ID' => $prop_ID]);

        } else {
            return false;
        }
    }
    // Count images
    public function all_images(){
        // Select Table
        $this->prop_type_table = $this->db->table('property_images');
        // All images
        return $this->prop_type_table->get()->getResult();
    }
    // Get all Locations we have in database..
    // this is important fun... 
    public function get_locations(){
        // Select Table
        $this->prop_type_table = $this->db->table('property');
        // Select Coloumnh
        $this->prop_type_table->select('property_location');
        // Select Distinct
        $this->prop_type_table->distinct();
        // Order
        $this->prop_type_table->orderBy('property_location', 'ASC');
        // Return Result
        return $this->prop_type_table->get()->getResult();
    }
    // Search for data using
    // query
    // ====================
    //
    // Search Use intel system
    // converting get array to mysql
    // query.... 
    //
    // In the future just add your query to the
    // array... 
    //
    public function search($search_type, $offset, $limit = 50){
        // Select Table
        $this->prop_type_table = $this->db->table('property');
        // Create Empty Search String
        $search_string = array();
        // Custom Advnaced Search
        $advanced_search = array();
        $is_advanced = false;
        $search_key = false;
        // Go trough all params
        // we have 
        if(!empty($search_type)){
            foreach( $search_type as $type => $value ){
                // First We need to control
                // property Type
                switch($type){
                    case 'property_type' : {
                        if(!is_numeric($value)){ return false; }
                        $search_string[$type] = $value;
                    } break;
                    case 'property_rent' : {
                        if(!is_numeric($value)){ return false; }
                        $search_string[$type] = $value;
                    }break;
                    case 'property_location' : {
                        if(!is_string($value)){ return false; }
                        $search_string[$type] = htmlentities($value, ENT_COMPAT, 'utf-8');
                    }break;
                    case 'prop_price_min' : {
                        //if(!is_numeric($value)){ return false; }
                        if($value){
                            die("ima");
                            $search_string['property_price >'] = $value;
                        }
                    }break;
                    case 'prop_price_max' : {
                        //if(!is_numeric($value)){ return false; }
                        if($value){
                            $search_string['property_price <'] = $value;
                        }
                    }break;
                    case 'prop_size_min' : {
                        //if(!is_numeric($value)){ return false; }
                        if($value){
                            $search_string['property_size >'] = $value;
                        }
                    }break;
                    case 'prop_size_max' : {
                        //if(!is_numeric($value)){ return false; }
                        if($value){
                            $search_string['property_size <'] = $value;
                        }
                    }break;
                    case 's' : {
                        $search_data = $search_type['s'];
                        $search_key = true;
                    } break;
                    case 'custom': {
                        // Prepare Custom Array
                        $is_advanced = true;
                        $advanced_search = json_encode($search_type['custom']);
                    }break;
                    case 'property_prec_location' : {
                        if($value){
                            $search_string['property_prec_location'] = $value;
                        }
                    }
                }
            }
        } else { 
            return false; 
        }

        // Databse use where AND statement
        if($search_string){
            $this->prop_type_table->where($search_string);
        }
        if($is_advanced){
            $this->prop_type_table->where("JSON_CONTAINS(property_custom, '".$advanced_search."', '$')");
        }
        if($search_key){
            $this->prop_type_table->like('property_title', $search_data);
        }
        $this->prop_type_table->orderBy('property_premium', 'DESC');
        $this->prop_type_table->orderBy('property_id', 'DESC');
        // Return Data
        $first_data = $this->prop_type_table->get($limit, $offset)->getResult();

        return $first_data;
    }

    // Return Article using article
    // ID... 
    public function ret_article($article_ID){
        // SetTable
        $this->prop_type_table = $this->db->table('property');
        // Lets do some query
        $this->prop_type_table->select("*");
        $this->prop_type_table->where("property_ID", $article_ID);

        return $this->prop_type_table->get()->getResult();
    }

    public function convert_to_prop($prop_ID){
        // SetTable
        $this->prop_type_table = $this->db->table('property_type');

        return $this->prop_type_table->getWhere(['ID' => $prop_ID])->getResult();
    }
    public function convert_to_rent($prop_ID){
        // SetTable
        $this->prop_type_table = $this->db->table('rent_type');

        return $this->prop_type_table->getWhere(['ID' => $prop_ID])->getResult();
    }

    // Mark Article like finished
    // =======
    // After Some time user or system will
    // make article as finished and it will not
    // be in search or any other list.. 
    public function make_article_done($article_ID, $user_ID){
        // Set Table
        $this->prop_type_table = $this->db->table('property');
        // Do job
        $this->prop_type_table->set('property_status', 0);
        $this->prop_type_table->where('property_ID', $article_ID);
        $this->prop_type_table->where('property_owner', $user_ID);
        return $this->prop_type_table->update();
    }
    // Delete all images when articles are
    // deleted.... 
    public function delete_images($property_ID){
        // Create Table
        $this->prop_type_table = $this->db->table('property_images');
        // Get all Images Paths
        $images = $this->prop_type_table->get()->getResult();
        $image_folder = $images[0]->image_owner;

        $folder_name = "article-" . $image_folder;
        $folder_path = ROOTPATH . "public/uploads/";

        unlink($folder_path . $folder_name . '/index.php');

        foreach($images as $img){
            unlink( $folder_path . $folder_name . '/' . $img->image_title );
        }

        rmdir($folder_path . $folder_name);

        // End with deleting from database.....
        $this->prop_type_table->where('image_owner', $property_ID);
        return $this->prop_type_table->delete();
    }

}