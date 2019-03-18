<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<?php include "home_header.php"; ?>

<body>
<a data-toggle="modal" href="#myModal" class="btn btn-primary">Launch modal</a>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
          Content for the dialog / modal goes here.
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
          <a href="#" class="btn btn-primary">Save changes</a>
        </div>
      </div>
    </div>
</div>
</body>

<?php include "home_footer.php"; ?>
</html>