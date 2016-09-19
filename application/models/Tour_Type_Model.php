<?php

class Tour_Type_Model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->has_many['tour_packages'] = array('foreign_model'=>'TourPackage_model','foreign_table'=>'tour_package','foreign_key'=>'tour_type_id','local_key'=> 'id');
        $this->has_one['group'] = array('foreign_model'=>'Tour_Type_Group_Model','foreign_table'=>'tour_type_group','foreign_key'=>'id','local_key'=> 'group_id');
    }

    public $before_create = array('timestamps');
    public $table = "tour_types";
    public $primary_key = "id";
    public $rules = array(
        'insert' => array(
            'name' => array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'),
        )
    );

    function timestamps($state) {
        $state['created_at'] = $state['updated_at'] = date('Y-m-d H:i:s');
        return $state;
    }
    
    
    public function addTourGroup($data,$tour_typeID) {
        if (!empty($data)) {
            $validData = array();
            $validData['group_id'] = $tour_typeID;
            if (!empty($data) && is_array($data)) {
                $i = 0;
                foreach ($data as $value) {
                    $validData['tour_type_id'] = $value;
                    $insertQuery = $this->db->insert('tour_types_group_id', $validData);
                    if ($insertQuery) {
                        $i++;
                    }
                }
                if ($i > 0) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
	 * @Methode		-: insertProductImages()
	 * @Description	-: Thsi function used for insert product images
	 * @Created on	-: 21-06-2016
	 * @Return 		-: true/false
	 * 
	 */ 
	public function insertProductImages($id,$images=array()){
		try{
			$productImages = (!empty($images)) ? implode(',',$images) : NULL;
			$insertedData = array(
								'product_id'=>$id,
								'images'=>$productImages,
							);
			try{
				$delete = $this->db->where('product_id',$id)->delete('product_images');
				$insertImg = $this->db->insert('product_images',$insertedData);
				if($insertImg){
					return true;
				}
			}catch(Exception $ex){
				log_message('error','Product Images not inserted'.$x->getMessage());
			}
		}catch(Exception $ex){
			log_message('error ',' Product Images not added '.$x->getMessage());
			return false;
		}
	}

}
