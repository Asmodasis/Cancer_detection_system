<?php
  $content = '<div class="row">
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
                        <div class="form-group">
                          <label for="exampleHealthCondition1">Health_Condition</label>
                          <input type="text" class="form-control" id="health_condition" placeholder="Enter Health Condition">
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
                $('#name').val(data['name']);
                $('#phone').val(data['phone']);
                $('#gender'+data['gender']).prop("checked", true);
                $('#health_condition').val(data['health_condition']);
				$('#doctor_id').val(data['doctor_id']);
				$('#nurse_id').val(data['nurse_id']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
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