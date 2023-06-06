<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
    <?php 
    use \App\Classes\Comment;
    ?>
    <style>
        .thumnail{
            width: 40%;
            height: 400px;
            object-fit: cover;
        }
    </style>
    <?php $article['lang'] == 'ar' ? $dir = 'rtl' : $dir = 'ltr'; ?>
    <div class="container" dir="<?= $dir?>">
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


        <!--//* Start of comments -->
            <?php if(session()->get('is_logged_in')): ?>

                <!--//!Add comment Logged In-->
                    <form id="add_Comment_Form" action="<?= base_url('CommentController/add_Comment/'.$article['id']) ?>" method="post">
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add comment</button>
                    </form>
                <!--//!Add comment-->



            <?php else: ?>
                <!--//!Add comment Not Logged In-->
                    <form id="add_Comment_Form" action="<?= base_url('CommentController/add_Comment/'.$article['id']) ?>" method="post">
                        <div class="form-group">
                            <label for="Username">Username:</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add comment</button>
                    </form>
                <!--//!Add comment Not Logged In-->

            <?php endif; ?>

        <!--//* End of comments -->

        <h3>Comments</h3>

        <div class="d-flex flex-column" id="comment_Section">

                <?php 
                foreach($comments as $comment):
                    $Comment = new Comment($comment);
                    echo $Comment->getComment();
                ?>
                <?php endforeach; ?>

        </div>




    </div>



    <script type="module">

        $('#add_Comment_Form').on('submit',function(e){
            e.preventDefault();
            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(data){
                    //Append the data as the first child of the comment_Section
                    
                    $('#comment_Section').prepend(data);
                    //Add animation to the comment
                    $('#comment_Section').children().first().addClass('animate__animated animate__fadeInDown');
                    //Clear the comment textarea
                    $('#comment').val('');
                }
            });
        })

    </script>

<?= $this->endSection() ?>