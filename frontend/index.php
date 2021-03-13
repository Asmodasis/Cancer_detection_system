<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="2021 UNR Senior Project Website for Group 14"
    />
    <title>Group 14</title>
    <style>
      input[type="text"] {
        padding: 10px;
        margin: 10px 0;
        box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
        border-radius: 25px;
      }
      input[type="password"] {
        padding: 10px;
        margin: 10px 0;
        box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
        border-radius: 25px;
      }
    </style>
  </head>
  <body>
    <form class="input" action="test.php" method="post">
      Username:
      <input type="text" name="Username" placeholder="Username" />
      <br />
      Password:
      <input type="password" name="Password" placeholder="Password" /><br />
      <input type="radio" name="job" value="doctor" />Doctor
      <input type="radio" name="job" value="nurse" />Nurse
      <input type="radio" name="job" value="admin" />Admin
      <br />
      <input type="submit" />
    </form>
  </body>
</html>
