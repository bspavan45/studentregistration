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
  <form class="reg-form" action="<?php echo URLROOT;?>/courses/register" method="post">
<?php elseif($data['type'] == 'update'):?>
  <form class="reg-form" action="<?php echo URLROOT;?>/courses/update/<?php echo $data['course_id'];?>" method="post">
<?php endif; ?>
  <div class="form-group row">
    <label for="cname" class="col-sm-2 col-form-label">Course Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control  <?php echo (!empty($data['cname_err'])) ? 'is-invalid' : ''; ?>" id="cname" name="cname" placeholder="course title" value="<?php echo $data['cname']; ?>">
      <span class="invalid-feedback"><?php echo $data['cname_err']; ?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="cdesc" class="col-sm-2 col-form-label">Course Description</label>
    <div class="col-sm-10">
      <textarea class="form-control  <?php echo (!empty($data['cdes_err'])) ? 'is-invalid' : ''; ?>" id="cdesc" name="cdesc" rows = "5" cols = "50" placeholder="Describe the course details here" ><?php echo $data['cdes']; ?></textarea>
      <span class="invalid-feedback"><?php echo $data['cdes_err']; ?></span>
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