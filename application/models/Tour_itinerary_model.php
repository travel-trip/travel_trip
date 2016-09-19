<?php

class Tour_itinerary_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
        $this->has_one['package'] = array('foreign_model'=>'TourPackage_model','foreign_table'=>'tour_package','foreign_key'=>'id');
    }
    
    public $table = "tour_Itinerary";
    public $primary_key = "id";
    
    

}

