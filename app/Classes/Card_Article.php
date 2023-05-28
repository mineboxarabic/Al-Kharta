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

        $card = '<a href="'.$this->btn_href.'"><div class="card">';
        $card .= '<img class="card-img-top img-fluid" src="' . $this->img_src . '" alt="Card image cap">';
        $card .= '<div class="card-body">';
        $card .= '<h4 class="card-title">' . $this->title . '</h4>';
        $card .= '<p class="card-text">' . $this->text . '</p>';
        $card .= '<p class="card-text">' . $this->article['username'] . '</p>';


        if($this->is_Writer == true){
            
            
            
            $card .= '<a class="btn btn-primary" id="btn-modify" href="'.base_url("modify_Article/".$this->article["id"]) .'">Modify article</a>';
            
            
            
            $card .= '<a class="btn btn-danger" href="'.base_url("ArticlesController/delete_Article/".$this->article["id"]).'">Delete article</a>';
        
        
        
        }


        
        $card .= '</div>';
        $card .= '</div></a>';

        return $card;
    }


}
?>
<script type="module">
    $(document).ready(function() {
        $('.card').css('transition', 'all .3s ease');
        $('.card').hover(
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
</script>