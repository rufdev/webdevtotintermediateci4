<!-- MASTER PAGE -->
<?= $this->extend('item/layout/main') ?>

<!-- CONTENT -->
<?= $this->section('content') ?>

<!-- container -->
<div class="container">
<h2>ADD NEW ITEM</h2>
<a class="btn btn-primary" href="<?=base_url()?>item/index" role="button">BACK</a>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<form action="<?=base_url()?>item/add" method="post" >
  <div class="form-group row">
    <label for="name" class="col-4 col-form-label"></label> 
    <div class="col-8">
    <?php if(isset($validation)): ?>
        <div class="alert alert-danger" role="alert">
        <?=$validation->listErrors();?>
        </div>
    
    <?php endif; ?>
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-4 col-form-label">Name</label> 
    <div class="col-8">
      <input id="name" name="name" value="<?=set_value('name')?>" placeholder="Enter Item Name" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="price" class="col-4 col-form-label">Price</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">PHP</div>
        </div> 
        <input id="price" name="price" value="<?=set_value('price')?>" placeholder="0" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-4 col-form-label">Description</label> 
    <div class="col-8">
      <textarea id="description" name="description" cols="40" rows="5" class="form-control"><?=set_value('description')?></textarea>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>


</div>
<!-- ./container -->

<?= $this->endSection('content') ?>