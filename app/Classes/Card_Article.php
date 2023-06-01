<?php 

namespace App\Classes;

class Card_Article
{
    private $title;
    private $text;

    private $img_src;

    private $btn_href;
    private $is_Writer;

    private $article;

    public function __construct($article)
    {
        $this->article = $article;

        $this->title = $article['title'];
        $this->text = $article['subtitle'];
        $pathImage = $article['thumnail'] == 'Default_Image.jpg' ? 'Default_Image.jpg' : $article['id'].'/'.$article['thumnail'];
        $this->img_src = base_url() .'uploads/Images/'.$pathImage;
 
        $this->btn_href = base_url('show_Article/'.$article['id']);
        $this->is_Writer =  session()->get('is_logged_in') == true && ($article['writer'] == session()->get('user_id') || session()->get('role') == 'admin');


    }

    public function getCard()
    {

        $card = '<a href="'.$this->btn_href.'"><div class="card card-article">';
        $card .= '<img class="card-img-top img-fluid" src="' . $this->img_src . '" alt="Card image cap">';
        $card .= '<div class="card-body">';
        $card .= '<h4 class="card-title">' . $this->title . '</h4>';
        $card .= '<p class="card-text">' . $this->text . '</p>';
        $card .= '<p class="card-text">' . $this->article['username'] . '</p>';


        if($this->is_Writer == true){
            
            
            
            $card .= '<a class="btn btn-primary" id="btn-modify" href="'.base_url("modify_Article/".$this->article["id"]) .'">Modify article</a>';
            
            
            
            $card .= '<button class="btn btn-danger" type="button" data-id="'.$this->article["id"].'" id="btn-delete">Delete article</button>';
        
        
        
        }


        
        $card .= '</div>';
        $card .= '</div></a>';

        return $card;
    }


}
?>
<script type="module">
    $(document).ready(function() {
        $('.card-article').css('transition', 'all .3s ease');
        $('.card-article').hover(
            function() {
                $(this).addClass('shadow-lg').css('cursor', 'pointer');
                $(this).css('transform','translateY(-10px)');
            },
            function() {
                $(this).removeClass('shadow-lg').css('transition', 'all .3s ease');
                $(this).css('transform','translateY(0px)');
            }
        );
    }
    );



    let modal = `    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>I will not close if you click outside me. Don't even try to press escape key.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Understood</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;

    $('body').append(modal);


    let deleteButtons = document.querySelectorAll('#btn-delete');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            let id = btn.dataset.id;
            let url = btn.getAttribute('href');
            let modal = document.querySelector('#staticBackdrop');

            modal.querySelector('.modal-title').textContent = 'Delete article';
            modal.querySelector('.modal-body').innerHTML = 'Are you sure you want to delete this article?';
            modal.querySelector('.modal-footer').innerHTML = '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button><a href="'+'<?=base_url()?>'+ 'ArticlesController/delete_Article/'+id+'" class="btn btn-danger">Delete</a>';
            $('#staticBackdrop').modal('show');
        });
    });


</script>