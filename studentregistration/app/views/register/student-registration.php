<?php require APPROOT. '/views/inc/header.php'?>
<div class="card card-body bg-light mt-5">
<h3><p class="text-center"><?php echo $data['title'];?></p></h3>
<?php if(!empty($data['return_status']) && $data['return_status'] == 'success'):?>
    <div class="alert alert-success" role="alert">
        <?php echo $data['return_message'];?>
    </div>
<?php elseif($data['return_status'] == 'error'):?>
  <div class="alert alert-danger" role="alert">
    <?php echo $data['return_message'];?>
  </div>
<?php endif; ?>
<?php if($data['type'] == 'register'):?>
<form class="reg-form" action="<?php echo URLROOT;?>/students/register" method="post">
<?php elseif($data['type'] == 'update'):?>
<form class="reg-form" action="<?php echo URLROOT;?>/students/update/<?php echo $data['student_id'];?>" method="post">
<?php endif; ?>
  <div class="form-group row">
    <label for="fName" class="col-sm-2 col-form-label">First Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : ''; ?>" id="fName" name="fName" placeholder="First Name" value="<?php echo $data['fname']; ?>">
      <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="lName" class="col-sm-2 col-form-label">Last Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control  <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : ''; ?>" id="lName" name="lName" placeholder="Last Name" value="<?php echo $data['lname']; ?>">
        <span class="invalid-feedback"><?php echo $data['lname_err']; ?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="dob" class="col-sm-2 col-form-label">DOB</label>
    <div class="col-sm-10">
      <input type="date" class="form-control <?php echo (!empty($data['dob_err'])) ? 'is-invalid' : ''; ?>" id="dob" name="dob" placeholder="YYYY-MM-DD" value="<?php echo $data['dob']; ?>">
      <span class="invalid-feedback"><?php echo $data['dob_err']; ?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="cNUm" class="col-sm-2 col-form-label">Contact Number</label>
    <div class="col-sm-10">
      <input type="number" class="form-control  <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" id="cNUm" name="cNUm" placeholder="Contact number" value="<?php echo $data['phone']; ?>">
      <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
    </div>
  </div>
 
  <div class="form-group row">
    <div class="col-sm-10">
      <?php if($data['type'] == 'register'):?>
      <button type="submit" class="btn btn-primary">Register</button>
      <?php elseif($data['type'] == 'update'):?>
      <button type="submit" class="btn btn-primary">Update</button>
      <?php endif; ?>
    </div>
  </div>
</form>
</div>

<?php require APPROOT. '/views/inc/footer.php'?>