<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getCountries(){
        $query = $this->db->select('id,sortname,name')->from(TABLE_PRE.'countries')->get();
        return $query->result();
    }

    public function getStatesByCountry($country){
        $this->db->where('country_id',$country);
        $query = $this->db->select('*')->from(TABLE_PRE.'states')->get();
        return $query->result();
    }

    public function getCitiesByState($state){
        $this->db->where('state_id',$state);
        $query = $this->db->select('*')->from(TABLE_PRE.'cities')->get();
        return $query->result();
    }

}