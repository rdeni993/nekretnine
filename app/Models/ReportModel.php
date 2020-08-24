<?php namespace App\Models;

use CodeIgniter\Model;

class Report extends Model{

    // DatabaseConnection Holder
    protected $database = false;
    // Table
    protected $report_table = false;
    // Construct Model
    public function __construct(){
        $this->database = \Config\Database::connect();
        $this->report_table = $this->database->table('reports');
    }
    // Create Report
    public function create_report($user_id, $property_id){
        return $this->report_table->insert([
            "report_article" => $property_id,
            "report_owner" => $user_id,
            "report_status" => 1,
            "report_doc" => date("Y-m-d h:i", time())
        ]);
    }
    // Get All Reports
    public function get_all(){
        $this->report_table->select("
        reports.report_ID, 
        users.user_name, 
        property.property_title, 
        property.property_description,
        property.property_owner,
        property.property_ID
        ");
        $this->report_table->join("users", "reports.report_owner = users.user_ID");
        $this->report_table->join("property", "reports.report_article = property.property_ID");
        $this->report_table->where("report_status", 0);

        return $this->report_table->get()->getResult();
    }
    // Get All Active Joined
    public function get_active_joined(){
        $this->report_table->select("
        reports.report_ID, 
        users.user_name, 
        property.property_title, 
        property.property_description,
        property.property_owner,
        property.property_ID
        ");
        $this->report_table->join("users", "reports.report_owner = users.user_ID");
        $this->report_table->join("property", "reports.report_article = property.property_ID");
        $this->report_table->where("report_status", 1);

        return $this->report_table->get()->getResult();
    }
    public function endup_report($report_ID){
        $this->report_table->set("report_status", 0);
        $this->report_table->where("report_ID", $report_ID);
        return $this->report_table->update();
    }

}