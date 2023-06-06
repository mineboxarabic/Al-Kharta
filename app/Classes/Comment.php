<?php 

namespace App\Classes;
use App\Models\UsersModel;

class Comment
{

    private $id;
    private $article_id;
    private $user_id;
    private $user;
    private $text;

    private $img;


    private $created_at;
    private $updated_at;

    private $isLogged;

    public function __construct($Comment)
    {
        $this->id = $Comment['id'];
        $this->article_id = $Comment['article'];
        $this->user_id = $Comment['user'];
        $this->user = new \UsersModel();
        $this->user->where('id', $this->user_id)->first();

        $this->img = $this->user->getPhoto($this->user_id);

        $this->text = $Comment['comment'];

        $this->created_at = $Comment['created_at'];
        $this->updated_at = $Comment['updated_at'];

        $this->isLogged = $Comment['is_logged'];    
    }

    public function getComment()
    {
        $comment = '<div class="card card-comment p-2" id="Comment_Card"> ';
        $comment .= '<div class="card-header p-0">';
        $comment .= '<div class="p-0 d-flex justify-content-between">';

        $comment .= '<div class="p-0 d-flex align-items-center justify-content-start">';
        $comment .= '<img class="card-img-top me-2 align-start profile_pic float-start img-thumbnail" src="' . $this->img . '" alt="Card image cap"> ';
        $comment .= '<a href="#" class="text-center">' . $this->user->getUserName($this->user_id) . '</a>';
        $comment .= '</div>';

        if($this->isLogged == true && $this->user_id == session()->get('user_id')){
            $comment .= '<div class="p-0 d-flex align-items-center justify-content-end">';
            $comment .= '<button type="button" id="edit_Comment" class="btn btn-primary me-2">Edit</button>';
            $comment .= '<button type="button" id="delete_Comment" href="#" class="btn btn-danger">Delete</button>';
            $comment .= '</div>';
        }

        $comment .= '<div class=" d-flex flex-column">';
        $comment .= '<p class="card-text fw-lighter">Commnted at: ' . $this->created_at . '</p>';
        $comment .= '<p class="card-text fw-lighter">Edited at: ' . $this->updated_at . '</p>';
        $comment .= '</div>';



        $comment .= '</div>';
        $comment .= '</div>';
        $comment .= '<div class="card-body">';

        $comment .= '<div class="d-flex justify-content-start">';


        $comment .= '<p id="comment-text" data-id="'.$this->id.'" class="card-title">' . $this->text . '</p>';

        $comment .= '</div>';
        $comment .= '</div>';
        $comment .= '</div>';


        return $comment;
    }

}
?>



<style>
    .profile_pic{
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    
    

</style>

<script type="module">

    $(document).ready(function(){
        $('#Comment_Card').hide().slideDown(1000).fadeIn(1000);
    });








    
   /* $('#edit_Comment').click(function(){

        $('#edit_Comment').hide();


        $('#comment-text').click(function(){
            let textAreaOfComment = document.createElement('textarea');


            let id = $(this).data('id');

            textAreaOfComment.setAttribute('id', 'comment');
            textAreaOfComment.setAttribute('name', 'comment');
            textAreaOfComment.setAttribute('class', 'form-control');
            textAreaOfComment.setAttribute('cols', '100');
            textAreaOfComment.setAttribute('rows', '3');
            textAreaOfComment.setAttribute('required', 'required');
            textAreaOfComment.innerHTML = comment;

            //Change style of text area to match the comment
            textAreaOfComment.style.backgroundColor = 'white';
            textAreaOfComment.style.color = 'black';
            textAreaOfComment.style.border = '1px solid black';
            textAreaOfComment.style.borderRadius = '5px';
            textAreaOfComment.style.padding = '5px';
            //No outline
            textAreaOfComment.style.outline = 'none';
            //remove black outline on focus
            textAreaOfComment.style.boxShadow = 'none';



            
            var form = '<form id="form_Edit_Comment" action="/Comments/edit" method="post">';
            form += textAreaOfComment.outerHTML;
            form += '<input type="submit" class="btn btn-primary" value="Submit">';
            form += '</form>';


        $('#comment_1').append(form);

        $('#form_Edit_Comment').submit(function(e){
            e.preventDefault();
            var comment = $('#comment').val();
            var comment_id = 1;

            $.ajax({
                url: '/CommentController/edit_Comment/' + comment_id,
                type: 'post',
                data: {
                    comment: comment,
                },
                success: function(response){

                    $(this).replaceWith(response);

                }
            });
        });

        });*/

        //On Click on any #edit_Comment button console.log('edit_Comment');
        let edit_Comment = document.querySelectorAll('#edit_Comment');
        edit_Comment.forEach(function(edit_Comment){
            $(edit_Comment).click(function(){
            
                let comment = $(this).parent().parent().parent().parent().find('#comment-text').text();
             
                let comment_id = $(this).parent().parent().parent().parent().find('#comment-text').data('id');
   
                let comment_card = $(this).parent().parent().parent().parent();
                
                $(comment_card).find('#comment-text').hide();
                $(comment_card).find('#edit_Comment').hide();
                $(comment_card).find('#delete_Comment').hide();


                //add a form 
                $(comment_card).find('#comment-text').after('<form id="form_Edit_Comment" action="/Comments/edit" method="post"></form>');
                //$(comment_card).find('#comment-text').after('<textarea id="comment" name="comment" class="form-control" cols="100" rows="3" required="required">' + comment + '</textarea>');
                $(comment_card).find('#form_Edit_Comment').append('<textarea id="comment" name="comment" class="form-control" cols="100" rows="3" required="required">' + comment + '</textarea>');
                
                
                $(comment_card).find('#form_Edit_Comment').append('<input type="submit" id="submit_Comment" class="btn btn-primary" value="Submit">');
                $(comment_card).find('#submit_Comment').after('<button type="button" id="cancel_Comment" class="btn btn-danger">Cancel</button>');


                $(comment_card).find('#comment').focus();
                $(comment_card).find('#comment').select();


                $('#form_Edit_Comment').submit(function(e){
                    e.preventDefault();
                    
                    //var comment_id = $(this).parent().parent().parent().parent().find('#comment-text').data('id');
                    let commentOfForm = $(this).find('#comment').val();
                    //console.log(commentOfForm);
                    $.ajax({
                        url: '<?=base_url() . 'CommentController/edit_Comment/'?>' + comment_id,
                        type: 'POST',
                        data: {
                            comment: commentOfForm,
                        },
                        success: function(response){
                           
                            //Replace the card with the new comment
                            $(comment_card).replaceWith(response);
                            Toastify({
                            text: "Comment Edited!",
                            className: "info",
                            style: {
                                //Green Gradient
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            }
                            }).showToast();
                        },
                        error: function(response){
                            console.log('The Comment Error is:' , comment);
                        }
                    });
                });
                
            });
        });

        let delete_Comment = document.querySelectorAll('#delete_Comment');
        delete_Comment.forEach(function(delete_Comment){
            $(delete_Comment).click(function(){
                let comment_id = $(this).parent().parent().parent().parent().find('#comment-text').data('id');
                let comment_card = $(this).parent().parent().parent().parent();
                $.ajax({
                    url: '<?=base_url() . 'CommentController/delete_Comment/'?>' + comment_id,
                    type: 'POST',
                    success: function(response){
                        $(comment_card).hide();
                        Toastify({
                        text: "Comment Deleted!",
                        className: "info",
                        style: {
                            background: "linear-gradient(to right, #ff416c, #ff4b2b)",
                        }
                        }).showToast();
                    },
                    error: function(response){
                        console.log('The Comment Error is:' , comment);
                    }
                });
            });
        });










</script>