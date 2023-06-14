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
            <div id="content">
                <?= $article['content']?>
            </div>

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
        //On load document
        $(document).ready(function(){
       
   
            let content = <?= json_encode($article['content'])?>;
            //turn the content into html and put it into an array
            let contentArray = $.parseHTML(content);
            console.log(contentArray);

            //<<< What isfff this ? \\\ tafsdfffhisafe is sef shitsdfastt suuuuuuuuuffdsafesafawfuuuuuuuuuuuuuu >>>
            for(let i = 0 ; i < contentArray.length ; i++){ 
                let rgex = /<<<.*>>>/;
                let element = contentArray[i];
                //check if the text of the element is a rgex
                //<<< small text \\\ Long text >>>
                console.log(rgex.test(element.textContent) || rgex.test(element.outerText));

                if(rgex.test(element.textContent) || rgex.test(element.outerText) || rgex.test(element.innerText)){
                    //if the element has children
                    let text = element.textContent.replace(/<<<|>>>/g,'');
                    //take the small text and the long text
                    let smallText = text.split('\\\\')[0];
                    let longText = text.split('\\\\')[1];

                    if(element.children.length > 0){
                      let html = element.innerHTML;
                      html = html.replace(/&lt;&lt;&lt;/g,'');
                      console.log(html);
                        smallText = html.split('\\\\')[0];
                        longText = html.split('\\\\')[1];

                        //create a div with d-flex 
                        let divSmall = $('<div></div>');
                        divSmall.addClass('d-flex');

                        let div = $('<div></div>');
                        div.addClass('d-flex');


                   
    
                        divSmall.html(smallText);
                        div.html(longText);
                        smallText = divSmall;
                        longText = div;
                        
                    }
                    
                    
                    //create the button
                    //creation of the div
                    let div = $('<div></div>');
                    div.addClass('d-flex');
                    div.addClass('flex-column');
                    //copy the style of the element
                    div.css('font-size',element.style.fontSize);
                    div.css('font-weight',element.style.fontWeight);
                    div.css('font-style',element.style.fontStyle);
                    div.css('text-decoration',element.style.textDecoration);
                    div.css('color',element.style.color);
                    div.css('text-align',element.style.textAlign);
                    div.css('margin',element.style.margin);


                    $(element).after(div);
                    contentArray.splice(contentArray.indexOf(element)+1,0,div[0])
                    element.textContent = '';
                    if(typeof(smallText) == 'string'){
                        let p = $('<p></p>');
                        p.addClass('cursor-pointer');
                        p.css('cursor','pointer');
                        p.text(smallText);
                        smallText = p;
                    }
                    if(typeof(longText) == 'string'){
                        let p = $('<p></p>');
                        p.addClass('d-none');
                        p.text(longText);
                        longText = p;
                    }

                    div.append(smallText);
                    //add cursor pointer to the small text
                    div.children().first().addClass('cursor-pointer');
                    div.append(longText);
                    //add the click event to the small text
                    div.children().first().on('click',function(){
                        $(this).next().animate({
                            height: 'toggle'
                        });
                        $(this).next().toggleClass('d-none');

                    })
                }
               
            }

            //replace html in the content div with the new content
            console.log(contentArray);
            $('#content').html(contentArray);
            console.log('done');


        });




    </script>

<?= $this->endSection() ?>