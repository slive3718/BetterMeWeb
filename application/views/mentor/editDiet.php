<?php
if ($posts){
    
    foreach($posts as $post){
     $post_user_id=$post['post_user_id'];
     $post_title=$post['post_title'];
     $post_content=$post['post_content'];
     $post_type=$post['post_type'];
     $post_id=$post['post_id'];

    }
}
?>
<form action="<?= base_url().'mentor/update_dietPlan'?>" method="POST" enctype="multipart/form-data">
    <center>
        <table style="margin-top:80px;">
            <tr>
                <td>
                    <label>Thread</label>
                    <tr>
                        <td><input
                            type="text"
                            name="post_type"
                            value="<?php if (isset($post_type)){
                                            echo $post_type;
                                          }?>" disabled></td>
                    </tr>
                    <tr>
                    
                                <td> <label hidden>userId</label>
                                 <input class="form-control" type="text" name="post_user_id" value=<?php if (isset($post_user_id)){
                                     echo $post_user_id;
                                 } ?> disabled hidden>
                            </tr>
                            
                            <td>
                            <label>Thread Title</label>
                            <tr>
                            <tr>
                                <td><input class="form-control" type="text" name="post_title" placeholder="Title" value="<?php if (isset($post_title)){
                                     echo $post_title;
                                 } ?>"></td>
                            </tr>
                            <tr>
                                <td><label hidden>PostId</label><input class="form-control" type="text" name="post_id" value="<?php if (isset($post_id)){
                                    echo $post_id; 
                                } ?>" readonly hidden></td>
                            </tr>
                          <tr><td> Content</td></tr>
                            <tr>
                                <td>
                                    <textarea class="form-control" name="post_content" id="" cols="100" rows="10"  placeholder="Motivation"><?php if (isset($post_content)){
                                     echo $post_content;
                                 } ?></textarea>
                                </td>
                            </tr>
                            
                            <tr><td>     
                                    <input class="btn" type="file" name="userfile" size="20" oninput="pic.src=window.URL.createObjectURL(this.files[0])"/>
                                    <img class="" id="pic" style="width:150px;height:150px"/>
                                    </td></tr>  
                                    
                            <tr>
                                <td><input class="btn btn-success" type="submit" name="submit" id="">
                                    <input class="btn btn-primary"  type="reset" name="reset"></td>
                            </tr>
                        </table>
                    </form>
                    