<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <?php 
        $randomClass = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];

     foreach($tags as $tag):
        $random = rand(0,7);

    ?>
    <form action="<?= base_url('ArticlesController/show_Filtered_Articles')?>">
    <button type="submit" class="btn btn-<?= $randomClass[$random]?> "><i class="<?= $tag['logo'] ?>"></i>  <?= $tag['name'] ?></button>
    <input type="text" value="<?=$tag['id']?>" name="category">

</form>

    <?php endforeach; ?>

        <a href="<?= base_url('show_Article/1')?>" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>  show article 1</a>
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>
        </div>
        <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <a href="<?= base_url() . 'a'?>" class="btn btn-primary waves-effect waves-light w-100">Go somewhere</a>
                            </div>
                        </div>
                    </div>
    </div>
</div>

<?= $this->endSection() ?>