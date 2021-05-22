<?php require APPROOT. '/views/inc/header.php'?>

<h5>Students registered for the courses</h5>
<table class="table" name="course_details">
  <thead class="thead-dark text-center">
    <tr>
      <th scope="col">STUDENT_NAME</th>
      <th scope="col">COURSE_NAME</th>
    </tr>
  </thead>
  <?php if(!empty($data)): ?>
  <tbody>
  <?php foreach($data as $key=>$value): ?>
    <tr class="text-center">
      <td><?php echo $value->first_name . ' ' .$value->last_name;?></td>
      <td><?php echo $value->course_name;?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <?php else: ?>
    <tbody>
    <tr>
      <td colspan="2"><p class="text-center">Student has not been registered to any course yet</p></td>
    </tr>
  </tbody>
    <?php endif; ?>
</table>
</div>

<?php require APPROOT. '/views/inc/footer.php'?>