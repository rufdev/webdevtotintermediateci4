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


<form action="<?=base_url()?>item/delete/<?=$item->id?>" method="post" >
  <div class="form-group row">
    <label for="name" class="col-4 col-form-label">ID</label> 
    <div class="col-8">
      <input value="<?=$item->id?>" type="text" class="form-control" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-4 col-form-label" readonly>Name</label> 
    <div class="col-8">
      <input id="name" name="name" value="<?=$item->name?>" type="text" class="form-control" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="price" class="col-4 col-form-label">Price</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">PHP</div>
        </div> 
        <input id="price" name="price" readonly value="<?=$item->price?>" type="text" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-4 col-form-label">Description</label> 
    <div class="col-8">
      <textarea id="description" readonly name="description" cols="40" rows="5" class="form-control"><?=$item->description?></textarea>
    </div>
  </div> 
  


<div class="form-group row">
    <div class="offset-4 col-8">
    Are you sure you want to delete this record? 
      <button name="submit" type="submit" class="btn btn-primary"> Yes</button>
    </div>
  </div>

  </form>


</div>
<!-- ./container -->

<?= $this->endSection('content') ?>