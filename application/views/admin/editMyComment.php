                
                <?php 
                if (isset($myComments)){
                    foreach ($myComments as $myComment){
                        $comment_id = $myComment['comment_id'];
                        $community_id = $myComment['community_id'];
                        $comment_user_id = $myComment['comment_user_id'];
                        $comment_date = $myComment['comment_date'];
                        $comment_content = $myComment['comment_content'];
                  
                    }
                ?>
                
                
                <form method="POST" action="<?= base_url().'admin/updateMyComment/',$comment_id?>">
                        <div>
                            <div     class="bg-light p-2 " >
                            
                            <div class="d-flex flex-row align-items-start">
                  
                           <input type="text" name="comment_id" value="<?= $comment_id?>" hidden>
                           <input type="text" name="community_id" value="<?= $community_id?>" hidden>
                        
                                <textarea class="form-control ml-5 mr-5 shadow-none textarea" wrap="hard" rows="10" cols="10" name="community_comment" >
                                <?php if (isset($comment_content)){ echo $comment_content;}?></textarea>
                            
                            
                                            </div>
                                            <div class="d-flex justify-content-center">
                            <div> 
                       
                            <input type="submit" class="btn btn-primary btn-xs fas fa-save  fa-xs " value="Save">
                            <a class="btn btn-danger btn-xs fas fa-window-close  fa-xs" href="<?= base_url().'admin/view_this_community_post/',$community_id?>">Cancel</a></div></div>
                                            </div>

                                            </form>

                <?php }?>
