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
                <p><input type="file"  accept="image/*" name="image" id="file" onchange="loadFile(event)"  style="display: none;"></p>
                <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
                <p><img id="output" width="200" height="200"/></p>
                <button id = "modelButton"> Click here to run the model </button>
                <p id="output_text" style="margin-top:10px;"></p>
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
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js"></script>

<script>
  
  function loadFile (event) {                                // event triggered by onchange in html content

	  var image = document.getElementById('output');
	  image.src = URL.createObjectURL(event.target.files[0]);
	  document.getElementById('output_text').innerHTML = "";

  }
    console.log("Model");
  $("#modelButton").click(runModel);
  
  async function runModel(event){
	//import * as tf from '@tensorflow/tfjs-node'
        //alert("TEST Model Ran")
      	//const b = tf.tensor([1, 2, 3, 4], [2, 2]);
      	//console.log('shape: ', b.shape);
        var whatOrgan = document.getElementById('Organ').value;             // The organ selected from the drop down	[.value gives us the organ's name, instead of "organ"]
        console.log(whatOrgan);
        var img_width = 200;                                          // The size of the images
        var img_height = 200;
        
        //trialing out run on image
        //var image = document.getElementById('output');
	////image.src = URL.createObjectURL(event.target.files[0]);
                                                                      // Import the image as a tensor object
        //these tf.keras lines don't seem to work
        //var im = tf.keras.preprocessing.image.load_img(img, grayscale=False, color_mode='rgb', target_size=(img_width, img_height));
      	//var x = tf.keras.preprocessing.image.img_to_array(im);        // Convert the image to an array
        //var x = tf.expand_dims(x, axis=0);                            
        //var images = np.vstack([x]);

        var isSemantic = 0;
        var image = document.getElementById('output');
        if(isSemantic){                                               // If it is semantic, the semantic network will be run
            var file = '../'+whatOrgan+'/'+whatOrgan+'_Model_Semantic.h5';
            
            var model = tf.loadLayersModel(file);               // Load the model

            return model.predict(x);  
        }else{                     //changed folder format            // Else a normal network will be applied
          
            var file = whatOrgan+'_model/model.json';
            
            
            
            
           
           // var tensorImg = tf.browser.fromPixels(image).resizeNearestNeighbor([50, 50]).toFloat().expandDims();
            var tensorImg = tf.browser.fromPixels(image)

            var resized = tf.image.resizeBilinear(tensorImg, [50, 50]).toFloat()

            var offset = tf.scalar(255.0);
            var normalized = resized.sub(offset).div(offset);

            var batched = normalized.expandDims(0)
            
            
            let model = tf.loadLayersModel(file);               // Load the model
            //alert(model);
            model.then(function(res) {
            	//console.log(tensorImg);
           	var prediction = res.predict(batched);
           	  console.log(prediction);
                if(prediction.dataSync()[1] > 5.0e-30){            // non-cancerous
                  document.getElementById('output_text').innerHTML = "The model has indicated the image is noncancerous.";
                  //alert("The model has indicated the image is noncancerous.");
                }else{
                  document.getElementById('output_text').innerHTML = "The model has indicated the image is cancerous.";
                  //alert("The model has indicated the image is cancerous.");
                }

              //alert(prediction.dataSync()[1]);

            }, function (err) {
           	console.log(err);
           });

            

            //alert(tensorImg.print()); 
        }
        
  }
  
  //====================================================================================
  //  Required usage:
  //                INSTALL: npm install @tensorflow/tfjs
  //                SCRIPT: <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js">
  //                NPM: import * as tf from '@tensorflow/tfjs';
  //=====================================================================================
  
  </script>
  
 
 
