
<?php

if (isset($rows)){

    foreach ($rows as $row){
        $community_post_title=$row['thread_title'];
        $community_post_content=$row['thread_content'];
        $community_post_user=$row['thread_user_id'];
        $community_post_date=$row['thread_date'];
        $community_post_image=$row['thread_image_name'];
        $community_post_id=$row['community_id'];

?>


<form action="<?=base_url().'admin/add_community_comment/'.$community_post_id?>" method="POST">
 
<div class="container mt-5 border border-primary">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="d-flex flex-column comment-section" id="myGroup">
                <div class="bg-white p-2">
                    <div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                        <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">Marry Andrews</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                    </div>
                    <div class="mt-2">
                        <p class="comment-text"><?php echo $community_post_content ?></p>
                    </div>
                </div>
                    
                
                <!--fetch COMMENT -->

                <?php if (isset($comments)){
                    foreach($comments as $comment){

                                $user_comments=$comment['comment_content'];
                                $user_comments_post_id=$comment['community_id'];
                                $user_comments_date=$comment['comment_date'];
                                $comment_user_id=$comment['comment_user_id'];
                            
                                if ($community_post_id==$user_comments_post_id){
                                    ?>
                        <div>
                            <div     class="bg-light p-2 " >
                            <div class="d-flex flex-row align-items-start">
                                <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                                <textarea class="form-control ml-1 shadow-none textarea" name="community_comment" readonly><?=  $user_comments?></textarea>
                            
                            
                                            </div>
                                            </div>
                                    <?php
                                }
                        ?>
                  

<?php
                    }
                } ?>
                   


                    <!-- comment -->

                <div class="bg-white p-2">
                    <div class="d-flex flex-row fs-12">
                        <div class="like p-2 cursor"><i class="fa fa-thumbs-o-up"></i><span class="ml-1"><a href="<?= base_url().'admin/post_like/'.$community_post_id?>">Like</a></span></div>
                        <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" aria-controls="collapse-1" href="#collapse-1"><i class="fa fa-commenting-o"></i><span class="ml-1">Comment</span></div>
                        <div class="like p-2 cursor action-collapse" data-toggle="collapse" aria-expanded="true" aria-controls="collapse-2" href="#collapse-2"><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
                    </div>
                </div>
                <div id="collapse-1" class="bg-light p-2 collapse" data-parent="#myGroup">
                    <div class="d-flex flex-row align-items-start">
                        <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                        <textarea class="form-control ml-1 shadow-none textarea" name="community_comment"></textarea>
                    
                    
                    </div>
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button><button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button></div>
                </div>
                <div id="collapse-2" class="bg-light p-2 collapse" data-parent="#myGroup">
                    <div class="d-flex flex-row align-items-start"><i class="fa fa-facebook border p-3 rounded mr-1"></i><i class="fa fa-twitter border p-3 rounded mr-1"></i><i class="fa fa-linkedin border p-3 rounded mr-1"></i><i class="fa fa-instagram border p-3 rounded mr-1"></i><i class="fa fa-dribbble border p-3 rounded mr-1"></i> <i class="fa fa-pinterest-p border p-3 rounded mr-1"></i> </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>




<?php
    }
}
?>