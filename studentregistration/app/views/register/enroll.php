<?php require APPROOT . '/views/inc/header.php'?>

<div class="card card-body bg-light mt-5">
<form class="subscribe-form" action="<?php echo URLROOT; ?>/subscription/enroll" method="post">
<p class="text-center"> Student subscription to Course </p>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="students">Student: </label>
  </div>
  <select class="custom-select" id="students" name="students" required>
    <?php if (!empty($data['students_info'])): ?>
    <?php foreach ($data['students_info'] as $key => $value): ?>
        <option value="<?php echo $value->student_id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
    <?php endforeach;?>
    <?php endif;?>
  </select>
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="courses">Course: </label>
  </div>
  <select data-toggle="tooltip" data-placement="top" title="Select more than one courses for a student" class="custom-select" id="courses" name="courses[]" multiple required>
    <?php if (!empty($data['courses'])): ?>
    <?php foreach ($data['courses'] as $key => $value): ?>
        <option value="<?php echo $value->course_id; ?>"><?php echo $value->course_name; ?></option>
    <?php endforeach;?>
    <?php endif;?>
  </select>
</div>
<p class="text-info">Select one or more courses for each student</p>
<div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Enroll</button>
    </div>
</div>
</form>
</div>

<?php require APPROOT . '/views/inc/footer.php'?>