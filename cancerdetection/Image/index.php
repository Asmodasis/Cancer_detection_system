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
                  <!-- /.box-body -->
                </div>
                <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
                <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
                <p><img id="output" width="200" /></p>
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
 
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js">
  /*====================================================================================
    Required usage:
                  npm install @tensorflow/tfjs
  =====================================================================================*/
  var loadFile = function(event) {                                // event triggered by onchange in html content
	  var image = document.getElementById('output');
	  image.src = URL.createObjectURL(event.target.files[0]);

    var curOrgan = document.getElementById('Organ');


    /*
      $.ajax({
        url: "../../interface/driver.py",
        success: function(curOrgan,FALSE,image){
          if(driver(curOrgan,FALSE,image)){
            alert(curOrgan + "Model executed and has indicated a positive result for Cancer.")
          }else{
            alert(curOrgan + "Model executed and has not indicate a positive result for Cancer.")
          }
        }
      

      });
      

    $command = escapeshellcmd('python ../../interface/driver.py');
    $output = shell_exec($command);
    if($output){
            alert(curOrgan + "Model executed and has indicated a positive result for Cancer.")
          }else{
            alert(curOrgan + "Model executed and has not indicate a positive result for Cancer.")
          }
        }
        */
  };
</script>