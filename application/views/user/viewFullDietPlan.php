<?php $post_type="DietPlan";

?>
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


<?php
if (isset($rows)) {
    foreach($rows as $row){

        $post_id = $row->post_id;
    $post_title = $row->post_title;
    $post_content = $row->post_content;
    $date_posted = $row->date_posted;
    $routine_count = $row->routine_count;
    $routine_format = $row->routine_format;
    $post_user_id = $row->post_user_id;
    $post_type = $row->post_type;

    $type_of_diet = $row->type_of_diet;

      $current_user=$this->session->userdata('id');
   
?>

<center>
    <?php
            if ($this->session->flashdata('msgsuccess')) {
                echo $this->session->flashdata('msgsuccess');
            }

        if ($this->session->flashdata('msgwarn')) {
            echo $this->session->flashdata('msgwarn');
        }
        if ($this->session->flashdata('msgerror')) {
            echo $this->session->flashdata('msgerror');
        } ?>

<div class="" >
    <div class="card" style="width: 50rem; max-width: 100%; ">
		<?php foreach ($row->images as $images) {
			?>
			<img class="" src="<?= base_url() . 'uploads/posts/' . $images->image_name ?>"
				 alt="Card image cap" style="">
		<?php } ?>
  <div class="card-body">
    <h5 class="card-title"><?= $post_title ?></h5>
    <p class="card-text"><?php if(isset($post_content)){
        echo $post_content;
    }
    
    if($post_user_id==$current_user){
      
?>
 
                <div class="mr-5 d-flex justify-content-end">
                <a href="<?= base_url().'user/edit_Diet/'.$post_id?>" class="btn  btn-sm btn-primary">Edit</a>
          <!-- Button trigger modal -->
                   <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
                    Delete
              </button>  
              </div>
              <div class="d-flex">
                <div class="mr-3">
          
                <a href="<?=base_url().'user/post_like/'.$post_user_id.'/'.$current_user?>">Like</a></div> <div><a href=""> Comment </a></div>
                
                </div>
                
</p>
    

    <?php } ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-primary" onclick="<?= base_url().'user/editPosts/'.$post_id?>">Confirm</button>
      </div>
    </div>
  </div>
</div>
    



  </div>

  
</div>

</div>



    <?php
}  
}?>

    <!-- <div class="card border-danger" style="width: 18rem;"> <img
    class="card-img-top" src="..." alt="Card image cap"> <div class="card-body"> <h5
    class="card-title">Card title</h5> <p class="card-text">Some quick example text
    to build on the card title and make up the bulk of the card's content.</p> <a
    href="#" class="btn btn-primary">Go somewhere</a> </div> </div> -->

    <script></script>
