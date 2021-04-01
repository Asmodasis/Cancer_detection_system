<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title> Cancer Detection </title>
		<!--We can create a new stylesheet that will hold all the different
			styling that we want to use for specific sections of the website-->
		<link rel="stylesheet" href="../styles.css">
	</head>
	
	<body>
	<div id = "main">
		<div class = "container">
			<div class = "wrapper-top">
				<div class = "wrapper-top-left-logo">
					<img src = "../UNR_Logo.png" width = "100" height = "100">
				</div>
				<div class = "wrapper-top-left-name">
					Cancer Detection
				</div>
				<div class = "wrapper-top-right-logout">
					<a href="../logout.php">Sign out</a>
				</div>
			</div>
		</div>
		<div class = "nav-bar">
			<span style="font-size:30px;cursor:pointer" 
			onclick="openMenu()">&#9776;</span>
		</div>
		<div class = "display-list">
			<section>
			<?php echo $content; ?>
			</section>
		</div>
	</div>
		<div id= "myNavbar" class = "navbar">
			<a href ="javascript:void(0)" class= "closebutton" onclick = "closeMenu()">&times;</a>
				<button class = "dropdown-button">Doctors
					<i class = "fa fa-caret-down"> </i>
				</button>
					<div class = "dropdown-container">
						<a href = "../doctor/index.php"> View Doctors</a>
						<a href = "../doctor/create.php"> Create Doctor</a>
					</div>
				<button class = "dropdown-button">Nurses
					<i class = "fa fa-caret-down"> </i>
				</button>
					<div class = "dropdown-container">
						<a href = "../nurse/index.php"> View Nurses</a>
						<a href = "../nurse/create.php"> Create Nurse</a>
					</div>
				<button class = "dropdown-button">Patients
					<i class = "fa fa-caret-down"> </i>
				</button>
					<div class = "dropdown-container">
						<a href = "../patient/index.php"> View Patients</a>
						<a href = "../patient/create.php"> Create Patient</a>
					</div>
				<button class = "dropdown-button">Upload Image
					<i class = "fa fa-caret-down"> </i>
				</button>
					<div class = "dropdown-container">
						<a href = "../image">Upload Image</a>
						<a href = "#"> Review Images</a>
					</div>
		</div>
	<!--Functions to handle animations-->
	<script>
		function openMenu() {
			document.getElementById("myNavbar").style.width = "250px";
			document.getElementById("main").style.marginLeft = "250px";
			document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
		}

		function closeMenu() {
			document.getElementById("myNavbar").style.width = "0";
			document.getElementById("main").style.marginLeft= "0";
			document.body.style.backgroundColor = "#8d9093";
			
		}
		var dropdown = document.getElementsByClassName("dropdown-button");
		var i;

		for (i = 0; i < dropdown.length; i++) {
			dropdown[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var dropdownContent = this.nextElementSibling;
			if (dropdownContent.style.display === "block") {
			dropdownContent.style.display = "none";
			} else {
			dropdownContent.style.display = "block";
			}
			});
		}

	</script>
	<script src="../Components/jquery.min.js"></script>
	</body>
</html>