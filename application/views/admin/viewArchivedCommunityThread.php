



<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"></th>
      <th scope="col">Thread Title</th>
      <th scope="col">Thread Starter</th>
      <th scope="col">Thread Date</th>
      <th scope="col">Thread Content</th>
      <th scope="col">Thread Image</th>
      <th scope="col">Option</th>
    </tr>
  </thead>
  <tbody>
   

<?php

$warning_message="Warning This Post contains information against our rules and standard";
$under_review_message="Warning This Post is under review by the admin";
$archive_message="This post is unavailable or deleted due to contents againt our rules and standard";
if (isset($community_posts)){
$a=0;
    foreach($community_posts as $field){

      $a++;
            $threadTitle = $field['thread_title'];
            $threadContent = $field['thread_content'];
            $threadDate = $field['thread_date'];
            $threadStarter = $field['username'];
            $threadImage = $field['thread_image_name'];
            $threadId = $field['community_id'];

           
?>
          

 <tr>
   
<th scope="row"><?= $a?></th>
      <td><?= $threadTitle ?></td>
      <td><?=$threadStarter?></td>
      <td><?= $threadDate ?></td>
      <td><?= $threadContent ?></td>
      <td><?= $threadImage ?></td>
      <td>
      <button type="button" class="btn btn-primary btn-xs" data-toggle="dropdown" aria-haspopup="true" >
    <span class=" fas fa-cog"></span>
  </button>
  <div class="dropdown-menu">
  
    <a class="dropdown-item" href="<?=base_url().'admin/restoreCommunityThread/',$threadId?>">Restore</a>
    </tr>
   








<?php

    }
}

?>  </tbody>
</table>