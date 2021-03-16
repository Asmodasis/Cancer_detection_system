<html>
  <body>
    Name:
    <?php echo $_POST["email"]; ?><br />
    Password:
    <?php echo $_POST["password"]; ?><br />
    Job:
    <?php $job = $_POST["job"];
    echo $job; 
    if ($job == 'admin')
    {
      header("Location: doctor/index.php");
      exit();
    }
    else if ($job == 'doctor')
    {
      header("Location: doctor/index.php");
      exit();
    }
    else if ($job == 'nurse')
    {
      header("Location: nurse/index.php");
      exit();
    }?>
    <body>
      <html></html>
    </body>
  </body>
</html>
