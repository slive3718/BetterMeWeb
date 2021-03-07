<?php $post_type="motivational";
?>
<button onclick="document.location='<?= base_url().'admin/addMotivationalPosts/'.$post_type?>'">Add Motivational Posts</button>


<?php
if (isset($posts)) {
    foreach ($posts as $post) {
        $title = $post['post_title'];
        $content=$post['post_content'];
        $dateCreated = $post['date_posted'];
        $post_user_id= $post['post_user_id'];
        $post_id=$post['post_id']; ?>


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

<table border=1>
            <tr> <td colspan="2"><?=$post_type ?></td></tr>
            <tr> <td colspan="2"><?=$dateCreated ?></td></tr>
            <tr> <td colspan="2"><?=$title ?></td></tr>
            <tr> <td colspan="2"><?=$content ?></td></tr>
            <tr colspan="2"> <td ><button onclick="document.location='<?= base_url().'admin/editPosts/'.$post_id?>'">Edit Post</button>
            </td>
            <td >  <button onclick="document.location='<?= base_url().'admin/confirmMessage/'.$post_id ?>'">Delete Post</button></td>
            </tr>
         
          
</table>




<?php
    }
}?>


<script>

</script>
