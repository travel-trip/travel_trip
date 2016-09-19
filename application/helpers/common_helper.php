<?php

function removeExtraspace($str) {
    $trimstr = trim($str);
    return $new_str = preg_replace('/\s+/', ' ', $trimstr);
}

function dump($array = array()) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * @method string valid_url()
 * @method validate url
 * @return true/false.
 */
function valid_url($url) {
    # call back function to validate urls	
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $this->form_validation->set_message('valid_url', 'The %s field invalid');
        return FALSE;
    }
    return TRUE;
}

/**
 * @method string valid_phone()
 * @method validate phone  number
 * @return true/false.
 */
function valid_phone($input) {
    # call back function to validate phone
    $pattern = '/^[0-9-+()\s]+$/';
    $vld = preg_match($pattern, $input) ? true : false;
    if (!$vld) {
        $this->form_validation->set_message('valid_phone', 'The %s field invalid');
        return FALSE;
    }
    return TRUE;
}

function trim_str($string, $length = 60) {
    if (!empty($string)) {
        if (mb_strlen($string, 'utf-8') > $length) {
            $stringLength = mb_strlen($string, 'utf-8');
            $string .= ' ';
            $strPos = mb_strpos($string, ' ', $length, 'utf-8');
            $strPos = (empty($strPos) ? $length : $strPos);
            $string = mb_substr($string, 0, $strPos, 'utf-8') . (($stringLength > $strPos) ? ('...') : NULL);
        }
    }
    $string = trim($string);
    return $string;
}

function getState($countryID) {
    $CI = & get_instance();
    $CI->db->select('id,name');
    $CI->db->where('states.country_id', $countryID);
    $CI->db->where('states.status', TRUE);
    $query = $CI->db->get('states');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
    return false;
}

function commonDropDownType($type) {
    if ($type == 1) {
        $table = 'tour_type_group';
    } else {
        $table = 'activities';
    }
    $CI = & get_instance();
    if ($type == 1) {
        $CI->db->select('id,group_name');
    } elseif ($type == 2) {
        $CI->db->select('id,name');
    }

    $query = $CI->db->get($table);
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
    return false;
}

function removeRow($tableName = null, $condition = null) {
    $CI = & get_instance();
    if (empty($tableName)) {
        return false;
    }
    if ($condition != null) {
        $records = $CI->db->where($condition)->delete($tableName);
        try {
            if ($records) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return 'Records Fetching Errors ' . $ex->getMessage();
        }
    }
}

function getCountries() {
    $countryOptions = array();
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->order_by('countries.name');
    $query = $CI->db->get('countries');
    if ($query->num_rows() > 0) {
        $countryList = $query->result();
        foreach ($countryList as $country) {
            $countryOptions[$country->id] = $country->name;
        }
        return $countryOptions;
    } else {
        return false;
    }
}

function getRegions() {
    $regionOptions = array();
    $CI = & get_instance();
    $CI->load->model('Region_model');
    $regions = $CI->Region_model->fields('id,loctions')->get_all();
    if (!empty($regions) && count($regions) > 1) {
        foreach ($regions as $region) {
            $regionOptions[$region->id] = $region->loctions;
        }
        return $regionOptions;
    } else {
        return false;
    }
}

function getLocation_point($searchTerm = '') {
    $CI = & get_instance();
    $countryLoctionOption = array();
    if ($searchTerm) {
        $query = $CI->db->query("SELECT countries.name, countries.id FROM countries WHERE countries.name ILIKE '%$searchTerm%' ORDER BY countries.name ASC");
    }
    if ($query->num_rows() > 0) {
        $loctions = $query->result();
        foreach ($loctions as $loction) {
            $countryLoctionOption[$loction->id] = $loction->name;
        }
    }
    return $countryLoctionOption;
}

function GetTourType() {
    $tourGroupOptions = array();
    $CI = & get_instance();
    $CI->load->model('Tour_Type_Model');
    $tour_groups = $CI->Tour_Type_Model->fields('id,name')->get_all();
    if (!empty($tour_groups)) {
        return $tour_groups;
    } else {
        return false;
    }
}

function GetTourTypeGroup() {
    $tourGroupOptions = array();
    $CI = & get_instance();
    $CI->load->model('Tour_Type_Group_Model');
    $tour_groups = $CI->Tour_Type_Group_Model->fields('id,group_name')->get_all();
    if (!empty($tour_groups)) {
        return $tour_groups;
    } else {
        return false;
    }
}

function getActivities() {
    $CI = & get_instance();
    $CI->load->model('Activity_Model');
    $tour_activity = $CI->Activity_Model->fields('id,name')->get_all();
    if (!empty($tour_activity)) {
        return $tour_activity;
    } else {
        return false;
    }
}

//function attractionCategroy() {
//    $attractionOptions = array();
//    $CI = & get_instance();
//    $CI->db->select('*');
//    $query = $CI->db->get('attraction');
//    if ($query->num_rows() > 0) {
//        $attractionList = $query->result();
//        foreach ($attractionList as $attraction) {
//            $attractionOptions[$attraction->id] = $attraction->name;
//        }
//        return $attractionOptions;
//    } else {
//        return false;
//    }
//}

function getCategroyAttraction($condition_array = array()) {
    $CI = & get_instance();
    if (!empty($condition_array)) {
        $CI->db->select('att_cat.id,att_cat.name');
        $CI->db->join('attraction attr', 'attr.attraction_cat_id = att_cat.id');
        $CI->db->group_by('att_cat.id');
        $CI->db->group_by('att_cat.name');
        
        if(array_key_exists('country_id', $condition_array)){
            $CI->db->where('attr.country_id',$condition_array['country_id']);
        }
        
        if(array_key_exists('location_id', $condition_array)){
            $CI->db->where('attr.location_id',$condition_array['location_id']);
        }
        
        $query = $CI->db->get('attraction_category att_cat');
        if ($query->num_rows() > 0) {
            $attractionList = $query->result();
            return $attractionList;
        } else {
            return false;
        }
    }
}

function returnValidData($tableName = null, $data = array()) {
    $CI = & get_instance();
    if (empty($tableName)) {
        return false;
    }
    $return = array();
    $fields = $CI->db->list_fields($tableName);
    if ($fields) {
        foreach ($fields as $index => $column) {
            if (array_key_exists($column, $data)) {
                $return[$column] = $data[$column];
            }
        }
        return $return;
    }
}

function loction_list() {
    $CI = & get_instance();
    $CI->db->select('*');
    $query = $CI->db->where('parent_id', 0)->get('loction_destination');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
    return false;
}

function ajax_loction_list($country_id = null) {
    $CI = & get_instance();
    $CI->db->select('*');
    $query = $CI->db->where('parent_id', 0)->where('country_id',$country_id)->get('loction_destination');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
    return false;
}



function getLoction($id = null, $type = null) {
    $CI = & get_instance();
    $CI->db->select('id,loction');

    if (!empty($id) && ($type == 'country')) {
        $CI->db->where('country_id', $id);
    }

    if (!empty($id) && ($type == 'location')) {
        $CI->db->where('parent_id', $id);
    }
    $query = $CI->db->get('loction_destination');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
    return false;
}

function buildLoctionMenu($id, $par = '', $sel = '') {
    $CI = & get_instance();
    $CI->db->select('id,loction');
    $CI->db->group_by('loction_destination.id,loction_destination.loction');
    $CI->db->where('loction_destination.parent_id', $id);
    $query = $CI->db->get('loction_destination');
    $ref = $query->result();

    $CI->db->select('*');
    $CI->db->where('loction_destination.id', $id);
    $query = $CI->db->get('loction_destination');
    $na = $query->result();
    $parent_name = (!empty($na->loction)) ? $na->loction : '';
    $par .= $parent_name . ' -- ';
    $option = '';
    if (!empty($ref)) {
        foreach ($ref as $item) {
            $s = '';
            if ($sel == $item->id) {
                $s = 'selected= "selected"';
            }
            $option .= "<option value='" . $item->id . "' $s >  " . $par . ' ' . $item->loction . "</option>";
            $option .= buildLoctionMenu($item->id, $par, '');
        }
    }
//    echo "<pre>";print_r($option);
    return $option;
}

function getTourTypes($id = null) {
    $tourOptions = array();
    $CI = & get_instance();
    $CI->db->select('tour_types.name as tour_name,tour_types.id as ID');
    $CI->db->join('tour_types', 'tour_types.id = tour_types_group_id.tour_type_id', '');
    $CI->db->where('tour_types_group_id.group_id', $id);
    $query = $CI->db->get('tour_types_group_id');
//    echo $CI->db->last_query();die;
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
}

function getLoctionIDByName($name = null) {
    $loctionData = array();
    $CI = & get_instance();
    $CI->db->select('id,country_id');
    $CI->db->where('loction_destination.loction', $name);
    $query = $CI->db->get('loction_destination');
    if ($query->num_rows() > 0) {
        $res = $query->row();
        $loctionData['id'] = !empty($res->id) ? $res->id : null;
        $loctionData['country_id'] = !empty($res->country_id) ? $res->country_id : null;
        return $loctionData;
    } else {
        return false;
    }
}

function getLoctionNameById($id = null) {
//    echo $id;die;
    $loctionData = array();
    $CI = & get_instance();
    $CI->db->select('loction');
    $CI->db->where('loction_destination.id', $id);
    $query = $CI->db->get('loction_destination');
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

function getCountryNameById($id = null) {
    $CI = & get_instance();
    $CI->db->select('name');
    $CI->db->where('countries.id', $id);
    $query = $CI->db->get('countries');
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

function getPackageCode($length = 5) {
    $str = "";
    $characters = array_merge(range('A', 'Z'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}

/**
 * Sets a status message (for displaying small success/error messages).
 * This is used in place of the session->flashdata functions since you
 * don't always want to have to refresh the page to show the message.
 *
 * @param string $message The message to save.
 * @param string $type The string to be included as the CSS class of the containing div.
 */
function setMessage($message = '', $type = 'info') {
    $CI = & get_instance();
    if (!empty($message)) {
        //dump($CI->session);
        if (isset($CI->session)) {
            $CI->session->set_flashdata('message', $type . '::' . $message);
        }
        $flashdata = array(
            'message_type' => $type,
            'message' => $message
        );
        $CI->session->set_userdata($flashdata);
    }
}

/**
 * Sets a status message (for displaying small success/error messages).
 * This is used in place of the session->flashdata functions since you
 * don't always want to have to refresh the page to show the message.
 *
 * @param string $message The message to save.
 * @param string $type The string to be included as the CSS class of the containing div.
 */
function customBreadcrumb($link_array = array()) {
    $CI = & get_instance();
    $CI->load->library('breadcrumbs');
    if (!empty($link_array)) {
        foreach ($link_array as $key => $link) {
            $CI->breadcrumbs->push($key, '/' . $link);
        }

        $CI->breadcrumbs->unshift('Home', '/');
    }

    return $CI->breadcrumbs->show();
}

function getIdBySlug($table_name = null, $slug = null) {
    $id = '';
    if (!empty($table_name) && !empty($slug)) {
        $CI = & get_instance();
        $CI->db->select('id');
        $CI->db->where($table_name . '.slug', $slug);
        $query = $CI->db->get($table_name);
        if ($query->num_rows() > 0) {
            $res = $query->row();
            $id = !empty($res->id) ? $res->id : null;
            return $id;
        } else {
            return false;
        }
    }

    return false;
}

function getCoveredLocations($id = null) {
    $locations = array();
    $CI = & get_instance();
    if (!empty($id)) {
        $sql = 'SELECT unnest(covered_loction) AS Locations from tour_package where id =' . $id;
        $locations = $CI->db->query($sql)->result();
        if ($locations) {
            return $locations;
        } else {
            return $locations;
        }
    }
    return $locations;
}

function GetRelatedTrips($condition_array = array()) {
//    dump($condition_array);
    $CI = & get_instance();
    $relatedPackages = array();
    if (!empty($condition_array)) {
        $CI->db->select('p.name as package_name,p.day,p.banner_image,p.primary_image,p.slug,p.package_price,c.name as country_name,c.slug as country_slug,c.id as country_id');
        $CI->db->from('tour_package p');
        $CI->db->join('countries c', 'c.id = p.country_id');

        if (!empty($condition_array) && ($condition_array['term'] == 'country')) {

            $CI->db->where('p.country_id', $condition_array['id']);
            $CI->db->where_not_in('p.id', $condition_array['package_id']);
        }

        if (!empty($condition_array) && ($condition_array['term'] == 'location')) {
            $CI->db->where('p.location_id', $condition_array['id']);
        }

        $CI->db->order_by('p.counry_weightage', 'ASC');
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            $relatedPackages = $query->result();
            return $relatedPackages;
        }
        return $relatedPackages;
    }
}

function itnararyActivities($string = null) {
    $returnArray = array();
    $activities = array();
    if (!empty($string)) {
        $new_string = preg_replace('/[^A-Za-z0-9\,\']/', '', $string);
        $returnArray = explode(',', $new_string);
        if (is_array($returnArray)) {
            foreach ($returnArray as $key => $val) {
                $activities[$key] = getActivitiesByName($val);
            }
        }
        return $activities;
    }
    $activities;
}

function itnararyMealCounter($meals = null) {
    $returnArray = array();
    $itinary_meals = array();
    if (!empty($meals)) {
        $new_string = preg_replace('/[^A-Za-z0-9\,\']/', '', $meals);
        $returnArray = explode(',', $new_string);
        if (is_array($returnArray)) {
            foreach ($returnArray as $key => $val) {
                $itinary_meals[$key] = $val;
            }
        }
        return $itinary_meals;
    }
    $itinary_meals;
}

function getActivitiesByName($id) {
    $CI = & get_instance();
    $CI->db->select('name,icon');
    $CI->db->where('activities.id', $id);
    $query = $CI->db->get('activities');
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

function getPackagesByTourTypes($tourTypeId = null, $country_id = null) {
    $CI = & get_instance();
    $relatedPackages = array();
    if (!empty($tourTypeId)) {
        $CI->db->select('p.name as package_name,p.day,p.banner_image,p.slug,p.package_price,c.name as category_name,p.tour_type_id,p.country_id,c.short_desc as category_desc');
        $CI->db->from('tour_package p');
        $CI->db->join('tour_types c', 'c.id = p.tour_type_id');

        $CI->db->where('p.tour_type_id', $tourTypeId);
        $CI->db->where('p.country_id', $country_id);

        $CI->db->order_by('p.counry_weightage', 'ASC');
        $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            $relatedPackages = $query->result();
            return $relatedPackages;
        }
        return $relatedPackages;
    }
}

function headerMenu() {
    $countries = array();
    $CI = & get_instance();
    $CI->db->select('slug,name');
    $CI->db->from('countries');
    $CI->db->where('show_home', 1);
    $CI->db->where('is_featured', 1);
    $CI->db->order_by('weightage', 'ASC');
    $query = $CI->db->get();
        if ($query->num_rows() > 0) {
            $countries = $query->result();
            return $countries;
        }
        return $countries;
}

function CapitalCityByCountry($countryId = null){
    $CI = & get_instance();
    $cityName = '';
    if(!empty($countryId)){
       $CI->db->select('city_name');
        $CI->db->where('country_id', $countryId);
        $query = $CI->db->get('capital_cities');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $cityName = $data->city_name;
            return $cityName;
        } else {
            return false;
        }
    }
    return $cityName;
}
function isUnique($tableName = null, $condition = null, $id = 0) {
    $CI = & get_instance();
    if ($tableName != null && !empty($condition)) {
        if (empty($id)) {
            $check = $CI->db->where($condition)->get($tableName)->result_array();
            try {
                if ($check) {
                    return false;
                } else {
                    return true;
                }
            } catch (Exception $ex) {
                
            }
        }
        if (!empty($id) && is_numeric($id)) {
            $check = $CI->db->where($condition)->where('id !=' . $id)->get($tableName)->result_array();
            try {
                if ($check) {
                    return false;
                } else {
                    return true;
                }
            } catch (Exception $ex) {
                
            }
        }
    }
}

function countryIdByLocation($loctionId = null){
    $countryId = '';
    $CI = & get_instance();
    if(!empty($loctionId)){
        $CI->db->select('country_id');
        $CI->db->where('id', $loctionId);
        $query = $CI->db->get('loction_destination');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $countryId = $data->country_id;
            return $countryId;
        } else {
            return $countryId;
        }
        return $countryId;
    }
    
}
