<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 10px;
      
    }

    .grid img {
        width: 100%;
        height: 300px;

        object-fit: cover;
    }

    
</style>
    <?php use App\Classes\Card_Article; ?>
    






    <div class="container-fluid">
    <div class='grid'>
        
    <?php 
    $count = count($articles);

    foreach($articles as $article): 
    ?>
        <div class="col-lg-12">
            <?php
                $user = new UsersModel();
                $writer = $user->find($article['writer']);
                $article['username'] = $writer['username'];
                $card = new Card_Article($article);
                echo $card->getCard();
            ?>
        </div>
    <?php endforeach; ?>
    </div>
    


<script type="module">


</script>
<?= $this->endSection() ?>