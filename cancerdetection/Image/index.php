<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Upload Image</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <label for="Organ">Choose an Organ</label>
                    <select name="Organ" id="Organ">
                      <option value="Breast">Breast</option>
                      <option value="Lung">Lung</option>
                    </select>
                  </div>
				 <div class="box-body">
					<form action="upload.php" method="post" enctype="multipart/form-data">
					Select image to upload:
					<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
					<input type="submit" value="Upload Image" name="submit">
					</form>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>';
  include('../master.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/patient/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].name+"</td>"+
				"<td>"+data[user].phone+"</td>"+
                "<td>"+((data[user].gender == 0)? "Male": "Female")+"</td>"+
                "<td>"+data[user].health_condition+"</td>"+
				"<td>"+data[user].doctor_id+"</td>"+
				"<td>"+data[user].nurse_id+"</td>"+
                "</tr>";
            }
            $(response).appendTo($("#patients"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Are you sure you want to delete the patient record?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/patient/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed Patient!");
                    window.location.href = '/medibed/patient';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
  var loadFile = function(event) {                                // event triggered by onchange in html content
	  var image = document.getElementById('output');
	  image.src = URL.createObjectURL(event.target.files[0]);
    //history.pushState(curOrgan, 'cancerdetection', URL);
    
    
      $.ajax({
        type: "POST",
        url: "index.php",
        data: { param: text}
      }).done(function( o ) {
        // do something
        var curOrgan = document.getElementById('Organ');
        //$(content) = $(content) + '<div>'+curOrgan+'</div>';
        $(content).replaceWith($(content) + '<div>'+curOrgan+'</div>');
        //alert($(content).filter('#Organ').html())
      });
      
  };
  
</script>