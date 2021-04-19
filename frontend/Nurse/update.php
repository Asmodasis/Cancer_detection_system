<?php

  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Update Nurse</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
					  
                        <div class="form-element">
                          <label for="exampleInputName1">Name: </label>
							<div id="nurse-name">Name:</div>
                        </div>
						
                        <div class="form-element">
                          <label for="exampleInputName1">Email: </label>
							<div id="nurse-email">Email:</div>
                        </div>
						
                        <div class="form-element">
                          <label for="exampleInputName1">Phone: </label>
							<div id="nurse-phone">Name:</div>
                        </div>
						
						<div class="form-element">
                          <label for="exampleInputName1">Password: </label>
							<input name = "password" type = "password" class ="form-control" id = "password" placeholder = "Enter Password">
                        </div>
						
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateNurse()" value="Update"></input>
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
        url: "../api/nurse/read_single.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
				$("#nurse-name").html('<input name = "name" type = "text" class ="form-control" id = "name" value="'+data[user].name+'">');
				$("#nurse-phone").html('<input name = "phone" type = "text" class = "form-control" id = "phone" value="'+data[user].phone+'">');
				$("#nurse-email").html('<input name = "email" type = "text" class ="form-control" id = "email" value="'+data[user].email+'">');
				$("#nurse-password").html('<input name = "password" type = "password" class ="form-control" id = "password" value="'+data[user].password+'">');
            }
        }
    });
  });
 </script>
<script>
    function UpdateNurse(){
        $.ajax(
        {
            type: "POST",
            url: '../api/nurse/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                email: $("#email").val(),        
                password: $("#password").val(),
                phone: $("#phone").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Nurse!");
                    window.location.href = '/cancer_detection_system/frontend/Doctor/index.php';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>