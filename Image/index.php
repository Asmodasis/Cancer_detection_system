<?php
  $create_patient = false;
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Upload Image</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
				  <label for = "Patient">Choose a Patient</label>
				  
				  
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
  include('../master_admin.php');
?>
<!-- page script -->
<script>
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