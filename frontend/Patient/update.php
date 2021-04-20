<?php
  $content = '
  <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Update Patient</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
				
                    <form role="form">
                      <div class="box-body">
					  
                        <div class="form-element">
                          <label for="exampleInputName1">Name: </label>
							<div id="patient-name">Name:</div>
                        </div>
						
                        <div class="form-element">
                          <label for="exampleInputPhone">Phone: </label>
							<div id="patient-phone">Name:</div>
                        </div>
						
                        <div class="form-element">
                            <label for="exampleInputName1">Gender</label>
                            <div class="radio">
                                <label>
                                <input type="radio" name="gender" id="gender0" value="0" checked="">
                                Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="gender" id="gender1" value="1">
                                Female
                                </label>
                            </div>
                        </div>
						
                        <div class="form-note">
                          <label for="exampleHealthCondition">Health Condition</label>
							<div id="patient-health">Name:</div>
                        </div>
						
						<div class="form-element">
                          <label for="exampleDoctorID1">Doctor Name</label>
							<select id = "doctor_id">
							</select>
                        </div>
						
						<div class="form-element">
                          <label for="exampleNurseID1">Nurse Name</label>
							<select id = "nurse_id">
							</select>
                        </div>
						
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdatePatient()" value="Update"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
              
  include('../master_admin.php');
?>

 <script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/patient/read_single.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
				$("#patient-name").html('<input name = "name" type = "text" class ="form-control" id ="name" value="'+data[user].name+'">');
				$("#patient-phone").html('<input name = "name" type = "text" class ="form-control" id ="phone" value="'+data[user].phone+'">');
				$("#patient-health").html('<input name = "name" type = "text" class ="form-control" id ="health_condition" value="'+data[user].health_condition+'">');
            }
        }
    });
  });
 </script>
 
 <script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/doctor/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
				response +=
				'<option selected = <?php echo $_GET['doctor_id']; ?> value="'+data[user].id+'">'+data[user].id+'-'+data[user].name+'</option>';
            }$(response).appendTo($("#doctor_id"));
        }
    });
  });
 </script>

 <script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/nurse/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
				response +=
				'<option selected = <?php echo $_GET['nurse_id']; ?> value="'+data[user].id+'">'+data[user].id+'-'+data[user].name+'</option>';
            }$(response).appendTo($("#nurse_id"));
        }
    });
  });
 </script>

<script>
    function UpdatePatient(){
        $.ajax(
        {
            type: "POST",
            url: '../api/patient/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                phone: $("#phone").val(),
                gender: $("input[name='gender']:checked").val(),
                health_condition: $("#health_condition").val(),
				doctor_id: $("#doctor_id").val(),
				nurse_id: $("#nurse_id").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Patient!");
                    window.location.href = '/cancer_detection_system/frontend/Patient/index.php';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>