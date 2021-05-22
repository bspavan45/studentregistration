<?php require APPROOT. '/views/inc/header.php'?>


<div class="card card-body bg-light mt-5 col-md-6">
<div class="alert alert-danger" role="alert">
<h5 class="text-center"><?php echo $data['message'];?></h5>
</div>
<a class="btn btn-primary btn-success" href="<?php echo URLROOT;?>" role="button">Home Page</a>
</div>

<?php require APPROOT. '/views/inc/footer.php'?>