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
                <p><input type="file"  accept="image/*" name="image" id="file"   onchange="loadFile(event)" style="display: none;"></p>
                <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
                <p><img id="output" width="200" /></p>
                <button onClick="runModel()"> Click here to run the model </button>
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
 
  /*====================================================================================
    Required usage:
                  npm install @tensorflow/tfjs
  =====================================================================================*/
  var loadFile = function(event) {                                // event triggered by onchange in html content

	  var image = document.getElementById('output');
	  image.src = URL.createObjectURL(event.target.files[0]);

  }
</script>


<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js">

  var runModel = function(){
    alert("TEST Model Ran")

    var whatOrgan = document.getElementById('Organ');             // The organ selected from the drop down
    
    var img_width = 200;                                          // The size of the images
    var img_height = 200;
                                                                  // Import the image as a tensor object
    var im = await tf.keras.preprocessing.image.load_img(img,, grayscale=False, color_mode='rgb', target_size=(img_width, img_height));
    var x = tf.keras.preprocessing.image.img_to_array(im);        // Convert the image to an array
    //var x = tf.expand_dims(x, axis=0);                            

    //var images = np.vstack([x]);

    var isSemantic = FALSE;

    if(isSemantic){                                               // If it is semantic, the semantic network will be run
        var file = '../'+whatOrgan+'/'+whatOrgan+'_Model_Semantic.h5';
        
        var model = await tf.loadLayersModel(file);               // Load the model

        return model.predict(x);  
    }else{                                                         // Else a normal network will be applied
        var file = '../'+whatOrgan+'/'+whatOrgan+'_Model.h5';
        
        var model = await tf.loadLayersModel(file);               // Load the model

        alert(model.predict(x)); 
    }
  }
</script>