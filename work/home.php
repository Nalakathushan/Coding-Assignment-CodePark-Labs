<?php


include "config.php"; // Using database connection file here
session_start();
/*if (isset($_SESSION['email'])) {
} else {
  header("Location:login.php");
}*/
if (isset($_POST['archive'])) {

  $id = $_POST['ids'];

  $insert_query  = "SELECT title,note FROM tbl_sample WHERE id= '{$id}'";
  $display_query = mysqli_query($con, $insert_query);

  while ($row = mysqli_fetch_assoc($display_query)) {

    $db_title = $row['title'];
    $db_note  = $row['note'];

    $insert_second_query  = "INSERT INTO archive(title,note) VALUES('{$db_title}','{$db_note}')";
    $display_second_query = mysqli_query($con, $insert_second_query);

    $delete_query         = "DELETE FROM tbl_sample WHERE id = '{$id}'";
    $display_delete_query = mysqli_query($con, $delete_query);

    if ($display_second_query) {

      echo "<script>alert('Record archived successfully');</script>";
    } else {
      echo "<script>alert('Record archived unsuccessfully');<script>";
    }
  }
}
if (isset($_POST['arch'])) {
  header("Location:archive.php");
}
if (isset($_POST['lgt'])) {
  header("Location:login.php");
}


mysqli_close($con); // Close connection
?>

<!DOCTYPE html>
<html>

<head>
  <title>PHP Test</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>

  </style>
</head>

<body>
  <div class="container">
    <br />

    <center>
      <h3 class="xbootstrap"> Note Manager </h3>
    </center>
    <form method="POST" action="#">
      <input type="submit" name="arch" id="arch" class="btn btn-primary" value="Archive List" />
      <input type="submit" name="lgt" id="lgt" class="btn btn-primary" value="logout" />

    </form>
    <br />
    <div align="right" style="margin-bottom:5px;">
      <button type="button" name="add_button" id="add_button" class="btn btn-success btn-xl">Add Note</button>

    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Note Title</th>
            <th>Note</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Archive</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</body>

</html>

<div id="apicrudModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" id="api_crud_form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Date</h4>

        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>User</label>
            <?php echo '  <input type="text" name="user" id="title" class="form-control" value="' . $_SESSION['email'] . '" /> ' ?>
          </div>
          <div class="form-group">
            <label>Enter Your Note Title</label>
            <input type="text" name="title" id="title" class="form-control" />
          </div>
          <div class="form-group">
            <label>Enter Your Note</label>
            <input type="text" name="note" id="note" class="form-control" />
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="hidden_id" id="hidden_id" />
          <input type="hidden" name="action" id="action" value="insert" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() { //ajax script for do actions

  fetch_data();

  function fetch_data() {
    $.ajax({
      url: "fetch.php",
      success: function(data) {
        $('tbody').html(data);
      }
    })
  }

  $('#add_button').click(function() {
    $('#action').val('insert');
    $('#button_action').val('Insert');
    $('.modal-title').text('Add Data');
    $('#apicrudModal').modal('show');
  });

  $('#api_crud_form').on('submit', function(event) {
    event.preventDefault();
    if ($('#first_name').val() == '') {
      alert("Enter First Name");
    } else if ($('#last_name').val() == '') {
      alert("Enter Last Name");
    } else {
      var form_data = $(this).serialize();
      $.ajax({
        url: "action.php",
        method: "POST",
        data: form_data,
        success: function(data) {
          fetch_data();
          $('#api_crud_form')[0].reset();
          $('#apicrudModal').modal('hide');
          if (data == 'insert') {
            alert("Data Inserted");
          }
          if (data == 'update') {
            alert("Data Updated");
          }
        }
      });
    }
  });

  $(document).on('click', '.edit', function() {
    var id = $(this).attr('id');
    var action = 'fetch_single';
    $.ajax({
      url: "action.php",
      method: "POST",
      data: {
        id: id,
        action: action
      },
      dataType: "json",
      success: function(data) {
        $('#hidden_id').val(id);
        $('#first_name').val(data.first_name);
        $('#last_name').val(data.last_name);
        $('#action').val('update');
        $('#button_action').val('Update');
        $('.modal-title').text('Edit Data');
        $('#apicrudModal').modal('show');
      }
    })
  });

  $(document).on('click', '.delete', function() {
    var id = $(this).attr("id");
    var action = 'delete';
    if (confirm("Are you sure you want to remove this data")) {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          id: id,
          action: action
        },
        success: function(data) {
          fetch_data();
          alert("Data Deleted");
        }
      });
    }
  });

});
</script>