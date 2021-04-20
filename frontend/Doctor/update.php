<?php

  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Update Doctor</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
					  
                        <div class="form-element">
                          <label for="exampleInputName1">Name: </label>
							<div id="doctor-name">Name:</div>
                        </div>
						
						
                        <div class="form-element">
                          <label for="exampleInputPhone1">Phone: </label>
							<div id="doctor-phone">Phone:</div>
                        </div>
						
						<div class="form-element">
                          <label for="exampleInputName1">Email: </label>
							<div id="doctor-email">Name:</div>
                        </div>
						
						<div class="form-element">
                          <label for="exampleInputName1">Password: </label>
							<input name = "password" type = "password" class ="form-control" id = "password" placeholder = "Enter Password">
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
                        <div class="form-element">
                          <label for="exampleInputPhone1">Specialist: </label>
							<div id="doctor-specialist">Phone:</div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateDoctor()" value="Update"></input>
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
        url: "../api/doctor/read_single.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
				$("#doctor-name").html('<input name = "name" type = "text" class ="form-control" id = "name" value="'+data[user].name+'">');
				$("#doctor-phone").html('<input name = "phone" type = "text" class = "form-control" id = "phone" value="'+data[user].phone+'">');
				$("#doctor-specialist").html('<input name = "specialist" type = "text" class ="form-control" id ="specialist" value="'+data[user].specialist+'">');
				$("#doctor-email").html('<input name = "email" type = "text" class ="form-control" id = "email" value="'+data[user].email+'">');
				$("#doctor-password").html('<input name = "password" type = "password" class ="form-control" id = "password" value="'+data[user].password+'">');
            }
        }
    });
  });
 </script>
<script>
    function UpdateDoctor(){
        $.ajax(
        {
            type: "POST",
            url: '../api/doctor/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                email: $("#email").val(),        
                password: $("#password").val(),
                phone: $("#phone").val(),
                gender: $("input[name='gender']:checked").val(),
                specialist: $("#specialist").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Doctor!");
                    window.location.href = '/cancer_detection_system/frontend/Doctor/index.php';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>