<?php
if (isset($_POST['hm'])) {
  header("Location:home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <title>Archive</title>
</head>

<body>

  <div class="container">
    <div class="split left">
      <div class="centered">

        <center>
          <h1>Archived List</h1>
        </center>

      </div>
    </div>

    <div class="split right">
      <div class="centered">

        <form method="POST" action="home.php"> <input type="submit" name="hm" id="hm" class="btn btn-primary"
            value="Home" />
        </form>

      </div>
    </div>
  </div>



  <div class="table-responsive">

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Note Title</th>
          <th>Note</th>

        </tr>
      </thead>
      <tbody>
        <?php
        include "config.php";
        $sql = "SELECT id, title, note from archive";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["title"] . "</td><td>" . $row["note"] . "</td></tr>";
          }
        } else {
          echo "0 result";
        }
        ?>
      </tbody>
    </table>

  </div>


</body>

</html>