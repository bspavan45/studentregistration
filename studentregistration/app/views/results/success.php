<?php require APPROOT. '/views/inc/header.php'?>


<div class="card card-body bg-light mt-5 col-md-6">
<div class="alert alert-success" role="alert">
<h4><?php echo $data['message'];?></h4>
</div>
<a class="btn btn-primary btn-success" href="<?php echo URLROOT;?>" role="button">Home Page</a>
</div>

<?php require APPROOT. '/views/inc/footer.php'?>