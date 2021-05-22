<?php require APPROOT. '/views/inc/header.php'?>
<div class="container">
<h2>Detials of the registered students and registered courses</h2>
</div>
<div class="container">
<h5>Registered Students</h5>
<table class="table" name="student_info">
  <thead class="thead-dark text-center">
    <tr>
      <th scope="col">FIRST_NAME</th>
      <th scope="col">LAST_NAME</th>
      <th scope="col">DOB</th>
      <th scope="col">PHONE</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  
<?php if(!empty($data['students_info'])): ?>
  <?php foreach($data['students_info'] as $key=>$value): ?>
    <tr class="text-center">
      <td><?php echo $value->first_name;?></td>
      <td><?php echo $value->last_name;?></td>
      <td><?php echo $value->dob;?></td>
      <td><?php echo $value->contact_number;?></td>
      <th><a class="btn btn-primary btn-success" href="<?php echo URLROOT; ?>/students/update/<?php echo $value->student_id;?>" role="button">Edit</a></th>
      <th><a class="btn btn-primary btn-danger" href="<?php echo URLROOT; ?>/students/delete/<?php echo $value->student_id;?>" role="button">Delete</a></th>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <?php else: ?>
    <tbody>
    <tr>
    <td colspan="6"><p class="text-center">No Data to display</p></td>
      </tr>
  </tbody>
    <?php endif; ?>
</table>
</div>

<div class="container">
<h5>Course Information</h5>
<table class="table" name="course_info">
  <thead class="thead-dark text-center">
    <tr>
      <th scope="col">COURSE_NAME</th>
      <th scope="col">COURSE_DESCRIPTION</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($data['courses'])): ?>
  <?php foreach($data['courses'] as $key=>$value): ?>
    <tr class="text-center">
      <td><?php echo $value->course_name;?></td>
      <td><?php echo $value->course_description;?></td>
      <th><a class="btn btn-primary btn-success" href="<?php echo URLROOT; ?>/courses/update/<?php echo $value->course_id;?>" role="button">Edit</a></th>
      <th><a class="btn btn-primary btn-danger" href="<?php echo URLROOT; ?>/courses/delete/<?php echo $value->course_id;?>" role="button">Delete</a></th>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <?php else: ?>
    <tbody>
    <tr>
    <td colspan="4"><p class="text-center">No Data to display</p></td>
      </tr>
  </tbody>
    <?php endif; ?>
</table>
</div>

<?php require APPROOT. '/views/inc/footer.php'?>