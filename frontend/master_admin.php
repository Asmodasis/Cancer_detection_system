<!DOCTYPE html>
<?php
	// Initialize the session
	session_start();
	// Include config file
	require_once "config.php";
	
	 if (isset($_SESSION['email'])) {
	// logged in
	} else {
	// not logged in
	}
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title> Cancer Detection </title>
		<!--We can create a new stylesheet that will hold all the different
			styling that we want to use for specific sections of the website-->
		<link rel="stylesheet" href="../style.css">
	</head>
	
	<body>
	<div id = "main">
		<div class = "container">
			<div class = "wrapper-top">
				<div class = "wrapper-top-left-logo">
					<img src = "../UNR_Logo.png" width = "100" height = "100">
				</div>
				<div class = "wrapper-left">
					<div class = "wrapper-top-left-main-name">
						Cancer Detection
					</div>
					<div class = "wrapper-top-left-lower-name">
						using neural networks
					</div>
				</div>
				<div class = "welcome-container">
					<?php echo "Welcome, "; echo $_SESSION['name'];?>
				</div>
			</div>
		
			<div class = "display-list">
				<?php echo $content; ?>
			</div>
		</div>
	</div>

	<!------------------------------Left Side Navigation Bar--------------------------------------->
		<div id= "myNavbar" class = "navbar">
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
						<a href = "../image/index.php">Upload Image</a>
						<a href = "#"> Review Images</a>
					</div>
					<div class = "dropdown-container">
						<a href = "../image">Settings</a>
					</div>
					<div class = "logout-container">
						<a href = "../logout.php">Logout</a>
					</div>
					
		</div>
	<!--Functions to handle animations-->
	<script>
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
	<!--Javascript framework to pull data from database-->
	<script src="../Components/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>