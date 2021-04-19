<?php

	$content = '
				<div class="header">
					<h3 id="name_fill">Patient List</h3>
				</div>
				
				<div class="single-patient">
					<div class = "patient-element">
						<div>Phone:&nbsp;</div>
						<div id ="phone"></div>
					</div>
					<div class = "patient-element">
						<div>Gender:&nbsp;</div>
						<div id ="gender"></div>
					</div>
					<div class = "patient-element">
						<div>Health Condition:&nbsp;</div>
						<div id ="health_condition"></div>
					</div>
					<div class = "patient-element">
						<div>Doctor Name:&nbsp;</div>
						<div id ="doctor-name"></div>
					</div>
					<div class = "patient-element">
						<div>Nurse Name:&nbsp;</div>
						<div id ="nurse-name"></div>
					</div>
				</div>
				<div>Images:&nbsp;</div>
					
				<div id ="images"></div>

				<div class = "action-menu">
					<div id = "action-links"></div>
				</div>';
						
	  include('../master_admin.php');

?>
<!-------------------------------- page script ---------------------------------------->
<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/patient/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
				for(var user in data){
                $("#name_fill").text(data[user].name);
                $('#phone').text(data[user].phone);
					if(data[user].gender == 0){
						$("#gender").text("Male");
					} 
					else {
						$("#gender").text("Female");
					}
                $('#health_condition').text(data[user].health_condition);}
				
            },
			
            error: function (result) {
                console.log(result);
            },
        });
    });
</script>

<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/image/read.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
				var response = "";
				for(var user in data){
					response +=	'<div class = "patient-images">'+
								'<div class = "patient-image">'+
								'<img src ="'+data[user].url+'" width = "200" height = "200">'+"</div>"+
								'<div class = "patient-image-information">'+
								"<b>"+'Uploaded:&nbsp;'+"</b>"+data[user].created+"<br>"+
								"<b>"+'Classification:&nbsp;'+"</b>";
								if(data[user].cancerous == 1){
									response += 'Cancerous';
								} else {
									response += 'Non-Cancerous';
								}
								response += "<br>"+"<b>"+'Note:&nbsp;'+"</b>"+data[user].note+"</div>"+"</div>";
				} $(response).appendTo($("#images"));
            },			
            error: function (result) {
                console.log(result);
            },
        });
    });	
</script>

<img src = "UNR_logo.png" alt = "Avatar" class = "avatar" width = "250" height = "250">
<script>

    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/doctor/read_single.php?id=<?php echo $_GET['doctor_id']; ?>",
            dataType: 'json',
            success: function(data) {
				for(var user in data){
					$("#doctor-name").text(data[user].name);
				}
            },			
            error: function (result) {
                console.log(result);
            },
        });
    });	
</script>

<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/nurse/read_single.php?id=<?php echo $_GET['nurse_id']; ?>",
            dataType: 'json',
            success: function(data) {
				for(var user in data){
					$("#nurse-name").text(data[user].name);
				}
            },
			
            error: function (result) {
                console.log(result);
            },
        });
    });	
</script>

<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/patient/read_single.php?id=<?php echo $_GET['id']; ?>",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
				"<td><a href='update.php?id="+data[user].id+"&doctor_id="+data[user].doctor_id+"&nurse_id="+data[user].nurse_id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].id+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#action-links"));
			
        }
    });
  });
 </script>
<script>
	
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
                    window.location.href = '/cancer_detection_system/frontend/Patient/index.php';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>