<?php
namespace App\Classes;

class Articles_Grid{

    private $articles;
    private $current_Page;
    private $articles_Per_Page;
    private $total_Articles;
    private $total_Pages;
    private $start;
    private $end;

    public function __construct($articles, $current_Page = 1){
        $this->articles = $articles;
        $this->current_Page = $current_Page;
        $this->articles_Per_Page = 6;
        $this->total_Articles = count($articles);
        $this->total_Pages = ceil($this->total_Articles / $this->articles_Per_Page);
        $this->start = ($this->current_Page - 1) * $this->articles_Per_Page;
        $this->end = min($this->start + $this->articles_Per_Page, $this->total_Articles);
    }

    public function getArticles() {
        $html = '';
        $html .= '<div class="grid_container" data-current-page="' . $this->current_Page . '">';
        for($i = $this->start; $i < $this->end; $i++) {
            $html .= $this->getArticle($this->articles[$i]);
        }

        if($this->current_Page > 1){
            $html .= '<button class="btn btn-primary load-articles" data-page="' . ($this->current_Page - 1) . '">Go left</button>';
        }

        if($this->current_Page < $this->total_Pages){
            $html .= '<button class="btn btn-primary load-articles" data-page="' . ($this->current_Page + 1) . '">Go right</button>';
        }

        $html .= '</div>';
        return $html;
    }

    public function getArticle($article){
        $Card_Article = new Card_Article($article);
        $html = '<div class="col-lg-12">';
        $html .= $Card_Article->getCard();
        $html .= '</div>';
        return $html;
    }

}
?>
<style>
    .grid_container{
        width: 80%;
        margin: 0 auto;
        border : 1px solid black;
        padding: 10px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 10px;
    }

    .grid_container img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }
</style>


<script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>
<script type="module">
    $(document).ready(function() {
        $(".load-articles").click(function() {
            var page = $(this).data("page");
            $.ajax({
                url: "<?= base_url() . 'ArticlesController/get_Article_with_Similar_Text_DATA/t'?>", // URL of the PHP file that generates the new Articles_Grid
                type: "post",
                data: {
                    page: page
                },
                success: function(response) {
                    $(".grid_container").html(response);
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script>