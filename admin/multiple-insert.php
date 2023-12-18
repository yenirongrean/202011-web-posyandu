<?php
//session_start();
include('koneksi.php');
if(isset($_POST['city_name']))
{
    $city_name = $_POST['city_name'];
    $stmt = $con->prepare("select * from pincodes where city_id='$city_name'");
    $stmt->execute();
    $pin_details = $stmt->fetch(PDO::FETCH_ASSOC);
//fetch the value into an array
    if($pin_details==''){
        $output['pincode_error'] = '<font color="#ff0000" style="font-size: 20px;">Data not available</font>';
    }
    else{
        $output['pincode'] = $pin_details['pin_code'];
    }
    echo json_encode($output);
    exit;
}
?>
<html>
<head>
<title>ajax example</title>
<link rel="stylesheet" href="bootstrap.css" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap-theme.css" crossorigin="anonymous">
<style>
.container{
    width:50%;
    height:30%;
    padding:20px;
}
</style>
</head>
<body>
<div class="container">
<h3 align="center"><u>FETCH VALUE FROM DATABASE USING AJAX</u></h3>
<br/><br/><br/>
    <form class="form-horizontal" action="#">
        <div id="newuser"></div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="state">City*:</label>
<?php
$stmt1 = $koneksi->prepare("select * from city order by id ASC");
$stmt1->execute();
$city_details = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>
                    <div class="col-sm-10">
                      <select class="form-control" name="city" id="city" required="">
                        <option value="0">--Please Select--</option> 
                        <?php
                        foreach($city_details as $city)
                        {
                            echo '<option value="'.$city['id'].'">'.$city['city_name'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                     
              </div>
              <br/>
              <div id="error_div"></div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="city">Pincode*:</label>
                    <div class="col-sm-10">
                        <input type="text" name="pincode" id="pin" class="form-control">
                    </div>
               </div>
        </form>
    </div>
<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>
<script>
//insert Data
$('#city').change(function(){
    var city = $('#city').val();
    //alert(city);
    //send request to the ajax
$.ajax({
        url: 'valueajax.php',
        type: 'post',
        data: {
            'city_name': city
        },
        dataType: 'json',
    })
    .done(function(data){
        if(data.pincode_error){
                $('#pin').val('');  
                $('#error_div').html(data.pincode_error);
            }
            else{
                $('#pin').val(data.pincode);
            }
        })
        .fail(function(data,xhr,textStatus,errorThrown){
            alert(errorThrown);
    });
});
</script>
</body>
</html>