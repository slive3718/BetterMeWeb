
  <center>
                    <?php if ($this->session->flashdata('msgsuccess')){
                      echo ' <div class="btn success"> '. $this->session->flashdata('msgsuccess') .' <div class="btn success"> ';
                    } ?>
             
               
                    <?php if ($this->session->flashdata('msgwarn')){
                          ?>    <div class="btn success"> <?php echo ' <div class="btn btn-warning">'. $this->session->flashdata('msgsuccess');
                        echo $this->session->flashdata('msgwarn');
                        ?>    </div> <?php    }?>
                </div>
                    </center>
                    <?php $post_type="DietPlan";

?><br>
         <button style="" class="btn btn-sm btn-success"onclick="document.location='<?= base_url().'mentor/addDietPlan/'.$post_type?>'">Add Diet Plan</button>
                    <div class="table-responsive">     
 <table class="table thead-dark" >
   <thead class="thead-dark ">
          <th scope="col"> Title </th>
          <th scope="col"> Post Content</th>
          <th scope="col"> Date Posted </th>
          <th scope="col"> Image </th>
          <th scope="col" colspan="2"> Option</th>
   </thead>
        
<?php

if (isset($rows)) {
    foreach ($rows as $row) {
        $image_name=$row['post_image_name'];
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_content = $row['post_content'];
        $date_posted = $row['date_posted'];
        $routine_count = $row['routine_count'];
        $routine_format = $row['routine_format'];
        $post_user_id = $row['post_user_id'];
        $post_type = $row['post_type'];
        $image_id = $row['image_id'];
        $activity_type = $row['activity_type'];

        $current_id=$this->session->userdata('id');
        if ($post_user_id==$current_id) {
            ?>


        
<center>
<tbody >
          <tr>
            <td class="font-weight-bold"> <?=$post_title ?></td>
            <td><?php if (strlen($post_content)>50) {
                $firstdesc=substr($post_content, 0, 150);
                echo $firstdesc.'<a href="'.base_url('mentor/viewFullDiet/'.$post_id).'">...see more </a>';
            } else {
                echo $post_content;
            } ?>
                                        </td>
            <td><?= $date_posted ?></td>
            <td>
          
            <img style="width:100px;height:100px;"class="img-thumbnail" src="<?=base_url().'uploads/images/'.$image_name?>">

            </td>
            <td> <a href="<?= base_url().'mentor/edit_Diet/'.$post_id?>" class="btn  btn-sm btn-primary">Edit</a>    </td>
            <td> <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?=$post_id?>">Delete</button>
          </td>
            
          </tr>
        </tbody>



<!-- Modal -->
<div class="modal fade" id="exampleModal<?=$post_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='<?= base_url().'mentor/archive_post/'.$post_id?>'">Confirm</button>
      </div>
    </div>
  </div>
</div>
    



  </div>

  
</div>

</div>


    <?php
        }
    }
}
?>
</table>

 </div>
    <!-- <div class="card border-danger" style="width: 18rem;"> <img
    class="card-img-top" src="..." alt="Card image cap"> <div class="card-body"> <h5
    class="card-title">Card title</h5> <p class="card-text">Some quick example text
    to build on the card title and make up the bulk of the card's content.</p> <a
    href="#" class="btn btn-primary">Go somewhere</a> </div> </div> -->

    <script></script>
