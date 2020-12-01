<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Patient</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter Name">
                        </div>
						<div class="form-group">
                          <label for="exampleInputName1">Phone</label>
                          <input type="text" class="form-control" id="phone" placeholder="Enter Phone">
                        </div>
						<div class="form-group">
                            <label for="exampleInputName1">Gender</label>
                            <div class="radio">
                                <label>
                                <input type="radio" name="gender" id="optionsRadios1" value="0" checked="">
                                Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="gender" id="optionsRadios2" value="1">
                                Female
                                </label>
                            </div>
						</div>
						<div class="form-group">
                          <label for="exampleHealthCondition1">Health condition</label>
                          <input type="text" class="form-control" id="hal" placeholder="Enter Health Condition">
                        </div>
                        <div class="form-group">
                          <label for="exampleDoctorID1">Doctor ID</label>
                          <input type="text" class="form-control" id="doctor_id" placeholder="Enter Doctor ID">
                        </div>
                        <div class="form-group">
                          <label for="exampleNurseID1">Nurse ID</label>
                          <input type="text" class="form-control" id="nurse_id" placeholder="Enter Nurse ID">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddPatient()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
  function AddPatient(){

        $.ajax(
        {
            type: "POST",
            url: '../api/patient/create.php',
            dataType: 'json',
            data: {
                name: $("#name").val(),
				phone: $("#phone").val(),
				gender: $("input[name='gender']:checked").val(),
				health_conditon: $("#health_conditon").val(),
                doctor_id: $("#doctor_id").val(),
				nurse_id: $("#nurse_id").val(),
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Patient!");
                    window.location.href = '/medibed/patient';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>