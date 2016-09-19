<?php

/**
 * @package    CI
 * @subpackage Controller
 * @author     Jeevan<jeevan@tisindiasupport.com>
 * @description  Handle all type of ajax requerst with response.
 */
Class AjaxController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Activity_Model');
        $this->load->model('Activity_Category_Model');
        $this->load->model('frontend/Country_model');
        $this->load->model('Tour_Type_Model');
        $this->load->model('Tour_Type_Group_Model');
        $this->load->model('Attraction_Model');
        $this->load->model('frontend/Home_model');
        $this->load->model('Attraction_Category_Model');
        $this->load->model('Loction_model');
        $this->load->model('TourPackage_model');
    }

    /**
     * @method  getAssociatedState
     * @description  It used to list of all associative state based on country id.
     * @param int id
     * @return all category list html dropdown format
     * */
    function getAssociatedState() {
        $id = $this->input->post('country_id');
        if (!empty($id)) {
            $stateList = getState($id);
            if ($stateList) {
                $stateDropdown = '<div class="form-group">';
                $stateDropdown.='<label class="col-sm-2 control-label">Sub Category</label>';
                $stateDropdown.='<div class="col-sm-6">';
                $stateDropdown.='<div class="btn-group bootstrap-select form-control">';
                $stateDropdown.='<select name="state_id" id="" class="selectpicker form-control sub_cat">';
                if ($stateList && count($stateList) > 0) {
                    $stateDropdown.='<option value="">Select</option>';
                    foreach ($stateList as $key => $state) {
                        $stateDropdown.='<option value="' . $state->id . '">' . $state->name . '</option>';
                    }
                }
                $stateDropdown.='</select>';
                $stateDropdown.='</div>';
                $stateDropdown.='</div>';
                echo $stateDropdown;
                exit();
            }
        }
    }
    
    /**
     * @method  getAssociatedCoveredLocations
     * @description  It used to list of all associative state based on country id.
     * @param int id
     * @return all category list html dropdown format
     * */
    function getAssociatedCoveredLocations() {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $responseArray = array();
        if (!empty($id)) {
            $loctionList = getLoction($id,$type);
            $loctionList2 = getLoction($id,$type);
            if ($loctionList) {
                $stateDropdown = '<section>';
                $stateDropdown.='<label class="label"><strong>Covered Location/City</strong></label>';
                $stateDropdown.='<select name="covered_loction[]" class="form-control select2-select" multiple data-placeholder="Select Location" id="covered_loction">';
                if ($loctionList && count($loctionList) > 0) {
                    $stateDropdown.='<option value="">Select</option>';
                    foreach ($loctionList as $key => $value) {
                        $stateDropdown.='<option value="' . $value->id . '">' . $value->loction . '</option>';
                    }
                }
                $stateDropdown.='</select>';
                $stateDropdown.='</section>';
              
                
                $locDropdown = '<section>';
                $locDropdown .= '<label class="label">Parent Loction</label>';
                $locDropdown .= '<label class="select">';
                $locDropdown .='<select name="location_id" class="" id="location_id" type = "location">';
//                dump($ajaxLoctionList);die;
                    $locDropdown.='<option value="">Select</option>';
                    foreach ($loctionList2 as $key => $loc) {
                        $locDropdown.='<option value="' . $loc->id . '">' . $loc->loction . '</option>';
                    }
                        
                $locDropdown.='</select>';
                $locDropdown.='</label>';
                $locDropdown.='</section>';
                
//                echo $stateDropdown;exit();
//                  echo $stateDropdown;exit();
                $responseArray['html1'] = $stateDropdown;
                $responseArray['html2'] = $locDropdown;
                echo json_encode($responseArray);exit();
        }else{
                $responseArray['html1'] = '';
                $responseArray['html2'] = '<section><label class="label">Parent Loction</label><label class="select"><select name="location_id" class="" id="location_id" type = "location"><option value="">Select</option></select></label></section>';
                echo json_encode($responseArray);exit();
        }
    }
   }
    

    function get_location_point() {
        $searchTerm = !empty($_GET['term']) ? $_GET['term'] : null;
        $LoctionPoint = getLocation_point($searchTerm);
        if (!empty($LoctionPoint)) {
            $json = json_encode($LoctionPoint, true);
            echo $json;
            die;
        }
    }

    function deleteCommonAttribute() {
        $responseArray = array();
        $id = $this->input->post('id');
        $model = $this->input->post('deleteModel');
        $message = $this->input->post('successMsg');

        if ($id != "") {
            try {
                $del = $this->$model->force_delete($id);
                    if($del){
                        $responseArray['response'] = 'true';
                        $responseArray['message'] = 'Succesfully Deleted';
                    }else{
                        $responseArray['response'] = 'false';
                        $responseArray['message'] = 'Something Went Wrong! Please Try again';
                    }
            } catch (Exception $e) {
                $responseArray['response'] = 'false';
                $responseArray['message'] = 'Something Went Wrong! Please Try again';
            }
        }
        echo json_encode($responseArray);die;
    }

    function GetNextMonthRangeRow() {
        $base_url = $this->input->post('base_url');
        $monthRange = $this->config->item('month_list');
        $seldurationFrom = '<select name="best_time_from[]"  title="Select"><option value="">Select</option>';

        if (count($monthRange) > 0) {
            foreach ($monthRange as $key => $value) {
                $seldurationFrom.='<option value="' . $key . '">' . $value . '</option>';
            }
        }
        $seldurationFrom.='</select>';

        $seldurationTo = '<select name="best_time_to[]"  title="Select"><option value="">Select</option>';

        if (count($monthRange) > 0) {
            foreach ($monthRange as $key => $value) {
                $seldurationTo.='<option value="' . $key . '">' . $value . '</option>';
            }
        }
        $seldurationTo.='</select>';

        $fldrow = '';
        $fldrow.='<div class="add_more_content clearfix"><div class="col-lg-2 padding-10"><section><label class = "label">Month From</label><label class = "select">' . $seldurationFrom . '</div></section>';
        $fldrow.='<div class="col-lg-2 padding-10"><section><label class = "label">Month To</label><label class = "select">' . $seldurationTo . '</div></section>';
        $fldrow.='<div class="col-lg-4 padding-10"><section><label class = "label">Short Decription</label><label class="textarea"><textarea name="description[]" rows="2"></textarea></label></section></div>';
        $fldrow.='<div class = "col-lg-9"><a href = "" id = "remove_row" class = "delete-row"><img src=' . $base_url . 'assets/admin/img/minus.png alt="remove"></a><a href = "" class = "add_more_month package-best" class = "delete-row"><img src=' . $base_url . 'assets/admin/img/plus.png alt="add"></a></div>';
        $fldrow.='</div>';
        echo $fldrow;
        exit();
    }
    
    

    /**
     * @method  getDropDown
     * @description  It used to list of all associative state based on country id.
     * @param int id
     * @return all category list html dropdown format
     * */
    function getDropDownType() {
        $type = $this->input->post('type');
        if (!empty($type)) {

            $dropDownType = commonDropDownType($type);

            if ($dropDownType) {
                $stateDropdown = '<div class="form-group">';
                $stateDropdown.='<label class="col-sm-2 control-label">Sub Category</label>';
                $stateDropdown.='<div class="col-sm-6">';
                $stateDropdown.='<div class="btn-group bootstrap-select form-control">';
                $stateDropdown.='<select name="" id="" class="selectpicker form-control sub_cat">';
                if ($dropDownType && count($dropDownType) > 0) {
                    $stateDropdown.='<option value="">Select</option>';
                    foreach ($dropDownType as $key => $state) {
                        if ($type == 1) {
                            $stateDropdown.='<option value="' . $state->id . '">' . $state->group_name . '</option>';
                        } else {
                            $stateDropdown.='<option value="' . $state->id . '">' . $state->name . '</option>';
                        }
                    }
                }
                $stateDropdown.='</select>';
                $stateDropdown.='</div>';
                $stateDropdown.='</div>';
                echo $stateDropdown;
                exit();
            }
        }
    }

    /**
     * @method  getAssociatedTourTypes
     * @description  It used to list of all associative state based on country id.
     * @param int id
     * @return all category list html dropdown format
     * */
    function getAssociatedTourTypes() {
        $groupId = $this->input->post('groupId');

        if (!empty($groupId)) {
            $stateList = getTourTypes($groupId);
            if ($stateList) {
                $stateDropdown = '<div class="form-group">';
                $stateDropdown.='<label class="col-sm-2 control-label">Tour Type</label>';
                $stateDropdown.='<div class="col-sm-6">';
                $stateDropdown.='<div class="btn-group bootstrap-select form-control">';
                $stateDropdown.='<select name="tour_type_id" id="" class="selectpicker form-control sub_cat">';
                if ($stateList && count($stateList) > 0) {
                    $stateDropdown.='<option value="">Select</option>';
                    foreach ($stateList as $key => $state) {
//                        dump($state);die;
                        $stateDropdown.='<option value="' . $state->ID . '">' . $state->tour_name . '</option>';
                    }
                }
                $stateDropdown.='</select>';
                $stateDropdown.='</div>';
                $stateDropdown.='</div>';
                echo $stateDropdown;
                exit();
            }
        }
    }

    function delete_tour_images() {
        $image_name = $this->input->post('name');
        if ($this->input->is_ajax_request()) {
            $name = trim($image_name);
            $absolut_image_path = FCPATH . 'uploads/tour_package/' . $name;
            if (file_exists($absolut_image_path)) {
                $res = unlink($absolut_image_path);
                if ($res) {
                    echo 'true';
                    die;
                } else {
                    echo 'false';
                    die;
                }
            }
        }
    }
    
     function delete_attraction_img() {
        $image_name = $this->input->post('name');
        if ($this->input->is_ajax_request()) {
            $name = trim($image_name);
            $absolut_image_path = FCPATH . 'images/attraction/'.$name;
            if (file_exists($absolut_image_path)) {
                $res = unlink($absolut_image_path);
                if ($res) {
                    echo 'true';die;
                } else {
                    echo 'false';die;
                }
            }
        }
    }
    
    function getHotePriceRow(){
        
        $base_url = $this->input->post('base_url');
        $hotel_type = $this->config->item('hotel_type');
        $sel_hotel_types = '<select name="hotel_type[]">';
        
        if(!empty($hotel_type)){
            $sel_hotel_types.='<option value="">Select Hotel Type</option>';
            foreach ($hotel_type as $key=> $value){
                $sel_hotel_types.='<option value="' . $key.'">' . $value. '</option>';
            }
        }
        $sel_hotel_types.= '</select>';
        
        $hotel_priceHtml = '';
        $hotel_priceHtml.= '<div class="add-hotel-price">
                                <div class="col-lg-4 padding-10">
                                    <section>
                                        <label class="">Hotel</label>
                                        <label class="select">'.$sel_hotel_types.'</label>
                                    </section>
                                </div>

                            <div class="col-lg-4 padding-10">
                                <section>
                                    <label class="">Price</label>
                                    <label class="input">
                                        <input type="text" placeholder="Price" name="hotel_price[]" required=""  data-parsley-type = "number"> 
                                    </label>
                                </section>
                            </div>
                            <a class="remove_hotel_price" href="javascript:void(0)"><img src = "'.$base_url.'/assets/admin/img/minus.png" alt = "remove"/></a>
                        </div>';
        echo $hotel_priceHtml;
        exit();
    }

    function getTourItineryRow() {
        $row_num = $this->input->post('row_num');
        $transports = $this->config->item('transport');
        $meal = $this->config->item('meal');
        $activities = getActivities();

        $sel_activities = '<select name = "itinery_activities['.$row_num.'][]" class="form-control select2-select iteinary_activiy" multiple data-placeholder="Select Activities" id = "abc' . $row_num . '">';
        if (count($activities) > 0) {
            foreach ($activities as $value) {
                $sel_activities.='<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        }
        $sel_activities.='</select>';
        
        $food = '';
        if(!empty($meal)){
            foreach($meal as $key => $value){
                $food.= '<label class="checkbox ">';
                $food.= '<input type="checkbox" value='.$key.' name="food['.$row_num.'][]"><i></i>'.$value.'';
                $food.= ' </label>';
                 } 
                 
            }
                 
        $itineryHtml = '';
        $itineryHtml .= '<div class="add_iteinary"><a class="remove_itinerary" href="javascript:void(0)"><img src="'.base_url().'assets/admin/img/remove.png"></a><div class="row"><div class="col-lg-2 padding-10">
                            <section>
                                <label class="label">Day Title</label>
                                <label class="input"> 
                                    <input type="text" placeholder="Name" name="day_title['.$row_num.']" required="">
                                </label>
                            </section> 
                            </div><div class="col-lg-2 padding-10">
                                <section>
                                    <label class="input"> 
                                        <label class="label">Location</label>
                                        <input type="text" placeholder="Loction" name="loction['.$row_num.']" required="">
                                    </label>
                                </section> 
                            </div><div class="col-lg-2 padding-10">
                            <section>
                                <label class="label">Activities</label>' . $sel_activities . '
                            </section>
                        </div><div class="col-sm-3">
                            <section>
                                <div class="inline-group food-section">'.$food.'
                                </div>
                            </section>
                            </div><div class="col-sm-2 padding-10">
                                <section>
                                    <label class="label">Transport</label>
                                    <label class="select">
                                        <select name="transport[]">
                                            <option value="Provided">Provided</option>
                                            <option value="Not Provided">Not Provided</option>
                                        </select>
                                    </label>    
                                </section>
                            </div>
                            </div>';
                               $itineryHtml .= '<div class="row">

                               <div class="col-lg-3">
                                   <section>
                                       <label>Description</label>
                                       <label class="textarea"> 										
                                           <textarea name ="itinery_desc[]" id=""></textarea>
                                       </label>
                                   </section>
                               </div>

                            <div class="col-sm-6 padding-10">
                                <section>
                                    <div class="inline-group">
                                        <label class="radio ">
                                            <input type="radio" value="StayHotel"  data-check-id="transport'.$row_num.'" name="night_plan_same_day['.$row_num.']" class ="inner_night_plan2"><i></i>Stay Hotel(Same Place)
                                        </label>
                                        <label class="radio ">
                                            <input type="radio" value="Travelling" data-check-id="transport'.$row_num.'" name="night_plan_same_day['.$row_num.']" class ="inner_night_plan2"><i></i>Travelling(Transfer Next City)
                                        </label>	

                                    </div>
                                </section>
                            </div>

                            <div class="col-sm-2">
                                <section style="display: none;" id="transport'.$row_num.'">
                                    <div class="">
                                        <label class="checkbox ">
                                            <input type="checkbox" value="1" id="check'.$row_num.'" name="next_day_stay_hotel['.$row_num.']"><i></i>Stay Hotel	
                                        </label>
                                    </div>
                                </section>
                            </div>

                            </div>';

                                $itineryHtml .= '<div class="row">
                                <div class="col-sm-6">
                                    <label class="label">Image</label>
                                    <label class="input input-file"><span class="button">
                                            <input type="file" value="" onchange="this.parentNode.nextSibling.value = this.value" name="iteniry_image[]">Browse</span><input type="text" value="" placeholder="Include some files" readonly="">
                                        <p>Image Size should be 400*400</p>
                                    </label>
                                </div>
                                <div class="col-lg-3">
                                    <section>
                                        <div class="inline-group">
                                            <label class="checkbox ">
                                                <input type="checkbox" value="1" name="sightseeing[]"><i></i>Sightseeing	
                                            </label>
                                        </div>
                                    </section>
                                </div>
                            </div>';
                            

        echo $itineryHtml;
        exit();
    }
    
    
    function getAttractionByCategory(){
        
        $responsArray = array();
        $id = $this->input->post('id');
        $commonId = $this->input->post('commonId');
        $by = $this->input->post('by');
        
        $AttractionList = $this->Attraction_Model->getAttractionByCategory($id,$commonId,$by);
        $counter = 0;
        $attraction_counter = 1;
        $img = '';
        $categoryHtml = '';
        if(!empty($AttractionList)){
            foreach ($AttractionList as $attraction) {
                $imageSrc = FCPATH . 'images/attraction/' . trim($attraction->primary_image);
                if (empty($attraction->primary_image)) {
                    $img = base_url() . 'uploads/loction/no-preview1.png';
                } else {
                    if (file_exists($imageSrc)) {
                        $img = base_url() . 'images/attraction/' . $attraction->primary_image;
                    } else {
                        $img = base_url() . 'uploads/loction/no-preview1.png';
                    }
                }

                if ($counter % 4 == 0 || $counter == 0) {
                    $active = ($counter == 0) ? 'active' : '';
                    if ($counter > 0) {
                        $categoryHtml .= '</div></div>';
                    }
                    $categoryHtml .= '<div class="item ' . $active . '"><div class="row">';
                }
                $categoryHtml .= '<div class="col-sm-3 col-xs-6 carousel-width">
                            <div class="col-item">
                                <figure>
                                    <a href = "'.base_url('home/attraction/'.$attraction->slug).'"><img src="'.$img.'" target = "_blank" class="img-responsive custom-attraction-img" alt="a" /></a>
                                    <div class="milan-deatils">
                                        <div class="diamond"><a href = "'.base_url('home/attraction/'.$attraction->slug).'" target = "_blank"><h2>'.$attraction_counter.'</h2></a></div>
                                        <a href = "'.base_url('home/attraction/'.$attraction->slug).'" target = "_blank"><h3><span>"'.$attraction->name.'"</span></h3></a>
                                    </div>
                                </figure>
                            </div>
                        </div>';
                ?>
            <?php
                $counter++;
                $attraction_counter++;
            }
            $responsArray['response'] = 'true';
            $responsArray['html'] = $categoryHtml;
        }else{
            $responsArray['response'] = 'false';
            $responsArray['html'] = '<div class="no-records">No Records Found.</div>';
        }
        echo json_encode($responsArray);die;
    }
    
    function getPackagesByDestination() {
        $country_id = $this->input->post('country-id');

        $packageHtml = '';
        $destinationPackages = $this->Home_model->getPackageByDestination(array('limit'=> 8,'show_home'=>true),$country_id);
//        dump($destinationPackages);die;
        if (!empty($destinationPackages)) {
             $packageHtml = '<div class="col-lg-12">
                                <div class="row">
                                <div class="paxkges-area">';
            foreach ($destinationPackages as $packages) {
                $imageSrc = FCPATH . 'uploads/tour_itinerary/' . trim($packages->primary_image);
                if (file_exists($imageSrc)) {
                    $image_path = base_url() . 'uploads/tour_itinerary/' . $packages->primary_image;
                } else {
                    $image_path = base_url() . 'uploads/loction/no-preview3.png';
                }

                if (empty($packages->primary_image)) {
                    $image_path = base_url() . 'uploads/loction/no-preview3.png';
                }
               
                $packageHtml .= '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                    <div class="packges-destination-box">
                        <figure>
                            <a href="'.base_url('home/package/'.$packages->slug).'" target = "_blank"><img src="'.$image_path.'" alt="pakckges" class = "home-package"></a>
                            <figcaption>
                                <h3>'.$packages->package_name.'</h3>
                            </figcaption>
                            <div class="packges-details cf">
                                <ul>
                                    <li>
                                        <h4>'.$packages->day.'</h4>
                                        <h5>Day</h5>
                                    </li>
                                    <li>
                                        <span>From</span>
                                        <h6><img src="'.  base_url().'/assets/front/images/packges-price-icone.png" align="price icone">'.$packages->package_price.'</h6>
                                    </li>
                                </ul>
                            </div>
                        </figure>
                    </div>
                </div>';
            }
            $packageHtml .= '</div></div></div>';
            echo $packageHtml;die;
        }else{
            echo '<div class = "no-records">Packages Not Available.</div>';die;
        }
//        echo $packageHtml = 'false';die;
    }

}
?>
                                                
                
        
    

    
