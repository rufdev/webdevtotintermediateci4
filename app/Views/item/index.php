<!-- MASTER PAGE -->
<?= $this->extend('item/layout/main') ?>

<!-- CONTENT -->
<?= $this->section('content') ?>

<div class="container">

<h2>Welcome to my Item View Index</h2>
<a class="btn btn-primary" href="<?=base_url()?>item/add" role="button">Add New Item</a>
<table class="table">
    <thead>
        <tr><th>ID</th><th>NAME</th><th>PRICE</th><th>ACTION</th><tr>
    </thead>
    <tbody>
    <?php foreach($items as $item): ?>
        <tr>
            <td><?=$item->id?></td>
            <td><?=$item->name?></td>
            <td><?=$item->price?></td>
            <td>
                <a class="btn btn-primary" href="<?=base_url()?>item/view/<?=$item->id?>" role="button">View</a>
                <a class="btn btn-warning" href="<?=base_url()?>item/edit/<?=$item->id?>" role="button">Edit</a>
                <a class="btn btn-danger" href="<?=base_url()?>item/delete/<?=$item->id?>" role="button">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>

<?= $this->endSection('content') ?>