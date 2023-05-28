<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
    <style>
        .thumnail{
            width: 40%;
            height: 400px;
            object-fit: cover;
        }
    </style>
    <div class="container">
            <?php
                $is_Writer = session()->get('is_logged_in') == true && ($article['writer'] == session()->get('user_id') || session()->get('role') == 'admin');
            if($is_Writer): ?>
            <a class="btn btn-primary" id="btn-modify" href="<?= base_url('modify_Article/'.$article['id']) ?>">Modify article</a>
            <a class="btn btn-danger" href="<?= base_url('ArticlesController/delete_Article/'.$article['id']) ?>">Delete article</a>
            <?php endif; ?>



        <div class="card">
            <div class="card-body">
            <h1><?= $article['title']?></h1>
            <h2 class="text-muted"><?= $article['subtitle']?></h2>
            <?php  $pathImage = $article['thumnail'] == 'Default_Image.jpg' ? 'Default_Image.jpg' : $article['id'].'/'.$article['thumnail']; ?>
            
            <img src="<?=base_url() .'uploads/Images/'.$pathImage?>" alt="" class="img-fluid thumnail" height="200px">
            <p><?= $article['content']?></p>

            </div>
        </div>
        <h6>Writer:</h6>
        <p><?php echo $writer['username'];?></p>
    </div>

<?= $this->endSection() ?>