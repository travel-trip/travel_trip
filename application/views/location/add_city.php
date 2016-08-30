<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add state</title>
        <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
	
</head>
<body>

<div id="container">
    <?php
    echo validation_errors();
    $countries = getCountries();
    $attributes = array('class' => 'state', 'id' => 'country-form');
    echo form_open(base_url('city/addCity'), $attributes);?>
    <label>Country</label>
    <select name="country_id" class="" id="country">
        <option value="">Select County</option>
        <?php foreach ($countries as $key => $country) { ?>
            <option value="<?= $key; ?>"><?= !empty($country) ? $country : NULL; ?></option>
        <?php } ?>
    </select>
    <label>State</label>
    <select name="state_id" class="" id="state">
        <option value="">Select State</option>
    </select>
    <label>City</label>
    <input type="text" name = "city_name" class=""/>
    <label>Latitude</label>
    <input type="text" name = "latitude" class=""/><br/>
    <label>Longtitude</label><br/>
    <input type="text" name = "longtitude" class=""/><br/>
    
    <input type="checkbox" name = "is_capital" class=""/>Is Capital<br/>
    
    <input type="submit" value="Submit"/>
     <?php echo form_close();?>

</div>
    
</body>
</html>

<script type="text/javascript">
    
    var baseUrl = '<?php echo base_url();?>';

    $(document).ready(function () {
        $('#country').on('change', function (e) {
            e.preventDefault();
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: baseUrl + "ajaxController/getAssociatedState",
                data: {country_id: id},
                beforeSend: function () {
                    $("#state").prop('disabled', true);
                },
            }).done(function (res) {
                $("#state").html(res);
                $("#state").prop('disabled', false);
            });
        });
    });
</script>