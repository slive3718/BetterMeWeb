<?php

if (isset($rows)){
$current_user = $this->session->userdata('id');
    foreach ($rows as $row){
        $community_post_title=$row['thread_title'];
        
        $community_post_content=$row['thread_content'];
        $community_post_user=$row['thread_user_id'];
        $community_post_date=$row['thread_date'];
        $community_post_image=$row['thread_image_name'];
        $community_post_id=$row['community_id'];
        $post_user_name=$row['username'];
        $pic_status=$row['user_picture_status'];
?>

<form
    action="<?=base_url().'user/add_community_comment/'.$community_post_id?>"
    method="POST">

    <div class="container mt-5 border border-primary">

        <div class="d-flex justify-content-center row">

            <div class="col-md-8">
                <div class="d-flex flex-column comment-section" id="myGroup">
                  
                    <div class="bg-white p-2">
                        
                        <?php if (isset($pic_status) ){
                                    ?>
                        <img
                            class="rounded-circle"
                            src="<?=base_url().'./uploads/profilepic/profile'.$community_post_user?>.jpg"
                            width="40"
                            height="40px">
                     <?php
                                } else{
                                ?>
                                
                        <img class="fa fa-user">
                        <?php }?>  <b class="bg-light"> <?= $community_post_title?>   </b>
                        <div class="d-flex flex-column justify-content-start ml-2">
                            
                            <span class="d-block font-weight-bold name"><?=$post_user_name?></span>
                            <span class="date text-black-50">
                                Shared
                                <?= $community_post_date ?></span></div>
                        <div class="d-flex flex-row-reverse">
                            <div class="btn-group">

                                <button
                                    type="button"
                                    class="btn btn-primary btn-xs dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="fas fa-cog"></span>
                                </button>
                                <div class="dropdown-menu">
                                    <?php if ($community_post_user==$current_user){

                                    ?>
                                    <a
                                        class="dropdown-item"
                                        href="<?= base_url().'user/editMyCommunityThread/',$community_post_id?>">Edit</a>
                                <?php }?>

                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="mt-2">
                        <p class="comment-text"><?php echo $community_post_content ?></p>
                    </div>
                </div>

                <!--fetch COMMENT -->

                <?php if (isset($comments)){
                    foreach($comments as $comment){
                        $comment_id=$comment['comment_id'];
                                $user_comments=$comment['comment_content'];
                                $user_comments_post_id=$comment['community_id'];
                                $user_comments_date=$comment['comment_date'];
                                $comment_user_id=$comment['comment_user_id'];
                                $comment_user_name=$comment['username'];
                                $comment_date=$comment['comment_date'];
                                if ($community_post_id==$user_comments_post_id){
                                    ?>
                <div>
                    <div class="bg-light p-2 ">
                        <div class="d-flex justify-content-between">
                            <div>
                                <?=  $comment_user_name ?>
                            </div>
                            <div>
                                <?= $comment_date ?>
                            </div>
                            <div>
                                <?php if($comment_user_id==$current_user){
                            ?>
                                <a
                                    class="btn btn-primary btn-xs fas fa-edit  fa-xs "
                                    href="<?= base_url().'user/editMyComment/',$comment_id?>"></a>
                                <a
                                    class="btn btn-danger btn-xs fas fa-trash-alt  fa-xs"  data-toggle="modal"  data-target="#exampleModal<?=$comment_id?>"
                                   ></a><?php
                            }?>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?=$comment_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a type="button" class="btn btn-primary"  href="<?= base_url().'user/deleteMyComment/',$comment_id.'/'.$community_post_id?>
        ">Confirm</a>
      </div>
    </div>
  </div>
</div>

                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-start">
                            <?php if (isset($pic_status) ){
                                    ?>
                            <img
                                class="rounded-circle"
                                src="<?=base_url().'./uploads/profilepic/profile'.$comment_user_id?>.jpg"
                                width="40"
                                height="40px">
                        <?php
                                } else{
                                ?>
                            <img class="fa fa-user">
                            <?php }?>

                            <textarea
                                class="form-control ml-1 shadow-none textarea" wrap="hard" rows="8" cols="8"
                                name="community_comment"
                                readonly="readonly"><?=  $user_comments?></textarea>

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
                            <div class="like p-2 cursor">
                                <i class="fa fa-thumbs-o-up"></i>
                                <span class="ml-1">
                                    Like</span></div>

                            <div
                                class="like p-2 cursor action-collapse"
                                data-toggle="collapse"
                                aria-expanded="true"
                                aria-controls="collapse-1"
                                href="#collapse-1">
                                <i class="fa fa-commenting-o"></i>
                                <span class="ml-1">Comment</span></div>
                            <div
                                class="like p-2 cursor action-collapse"
                                data-toggle="collapse"
                                aria-expanded="true"
                                aria-controls="collapse-2"
                                href="#collapse-2">
                                <i class="fa fa-share"></i>
                                <span class="ml-1">Share</span></div>
                        </div>
                    </div>
                    <div id="collapse-1" class="bg-light p-2 collapse" data-parent="#myGroup">
                        <div class="d-flex flex-row align-items-start">
                            <?php if (isset($pic_status) ){
                                    ?>
                            <img
                                class="rounded-circle"
                                src="<?=base_url().'./uploads/profilepic/profile'.$current_user?>.jpg"
                                width="40"
                                height="40px">
                        <?php
                                } else{
                                ?>
                            <img class="fa fa-user">
                            <?php }?>
                            <textarea
                                class="form-control ml-1 shadow-none textarea" wrap="hard" rows="8" cols="8"
                                name="community_comment"></textarea>

                        </div>
                        <div class="mt-2 text-right">
                            <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
                            <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Cancel</button>
                        </div>
                    </div>
                    <div id="collapse-2" class="bg-light p-2 collapse" data-parent="#myGroup">
                        <div class="d-flex flex-row align-items-start">
                            <i class="fa fa-facebook border p-3 rounded mr-1"></i>
                            <i class="fa fa-twitter border p-3 rounded mr-1"></i>
                            <i class="fa fa-linkedin border p-3 rounded mr-1"></i>
                            <i class="fa fa-instagram border p-3 rounded mr-1"></i>
                            <i class="fa fa-dribbble border p-3 rounded mr-1"></i>
                            <i class="fa fa-pinterest-p border p-3 rounded mr-1"></i>
                        </div>
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
