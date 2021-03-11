<script type="text/javascript" src="<?=base_url()?>/assets/js/myProfile.js"></script>
<link
    rel="stylesheet"
    type="text/css"
    href="<?=base_url()?>/assets/css/myProfile.css">
<link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous">
<link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
<script
    src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="node_modules/font-awesome-animation.min.css">

<main>
    <div id="device-bar-2">
        <!-- <button></button> <button></button> <button></button> --> HELLO
    </div>
    <div class="tb card">
        <?php 
            
            foreach($followedUsersDatas as $val){
                // print_r($val->followingUsers);\
                foreach($val->followingUsers as $users){
                    $userId=$users->user_id;
                    $firstName=$users->first_name;
                    $lastName=$users->last_name;
                    $content=$users->content;
                    ?> 
                    
                    <div class="post card Regular shadow">
                            <div class="tb">
                                <a href="#" class="td p-p-pic"><?php
                if (isset($pic_status)){ ?>
                     <img src="<?=base_url().'./uploads/profilepic/profile'.$userId?>.jpg" class="" style="height:50px;width:50px"  alt="profile pic">
               <?php }else{
                   ?>
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" style="height:50px;width:50px"  alt="profile pic">
                   <?php
               }?></a>
                        <div class="td p-r-hdr">
                            <div class="p-u-info">
                                <a href="#"><?= Ucfirst($firstName)," ",Ucfirst($lastName)?></a> shared a post <a href="#">Himalaya Singh</a> 
                            </div>
                            <div class="p-dt">
                                <i class="fa fa-calendar"></i>
                                <span>Date</span>
                            </div>

                        </div>
                        <div class="dropdown dropleft">
                        <a class=" btn-m fa fa-cogs" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Remove</a>
                            <a class="dropdown-item" href="#">Edit</a>
                        </div>
                        
                        </div>
                            </div>
                            <label class="tb " readonly><center><?=$content?></center></label>
                            <div class="d-flex justify-content-center">
                           
                            <a href="#" class="">
                                <div class="container" >
                            <div class="row">
                            <?php 
                             $numOfCols = 3;
                             $rowCount = 0;
                             $bootstrapColWidth = 4 / $numOfCols;
                             if(isset($val->getAllProfilePost) && !empty($val->getAllProfilePost)){
                                // echo'<pre>'; print_r($val->getAllProfilePost);
                                foreach ($val->getAllProfilePost as $post){
                                 $content=$post->content;
                                // print_r(count($val->getAllProfilePost));
                                // exit;
                               
                                    $image_name=$post->image_name;
                                    $images=explode('/',$image_name);
                                        foreach ($images as $name) {
                                            if(strpos($name,'/')!==false){
                                            $extension = explode('.',$name);
                                            }else{
                                                $extension=$name;
                                            }
                                            // print_r($extension[1]);
                                            // exit;
                                            // echo $name; ?>
                                <div class="col-md-<?=$bootstrapColWidth;?> " >
                                <div class="thumbnail">
                                  
                                <?php if(isset($extension) && !empty($extension)){
                                    if($extension[1]=="JPG"||$extension[1]=="PNG"||$extension[1]=="JPEG"||$extension[1]=="GIF"||
                                $extension[1]=="jpg"||$extension[1]=="png"||$extension[1]=="jpeg"||$extension[1]=="gif"
                                 ){ ?>
                                <img src="<?=base_url().'./uploads/posts/'.$name?>" style="width:200px;height:200px;"> 
                                <?php }else{
                                    ?>
                                    <div>
                                    
                                    <video width="400" controls>
                                    <source src="<?=base_url().'./uploads/posts/'.$name?>" type="video/mp4">
                                    </video>
                                    </div>
                                    <?php
                                }}?>
                                </div>
                                </div>
                                <?php
                                       $rowCount++;
                                            if ($rowCount % $numOfCols == 0) {
                                                echo '</div><div class="row">'; 
                                        }}}}
                            ?>
                             </div> 
                             </div>
                        </div>
                            </a>
                            <div>
                                <div class="p-acts">
                                    <div class="p-act like"><i class="fa fa-thumbs-up"></i><span>25</span></div>
                                    <div class="p-act comment btn-click"><i class="fa fa-comment"></i><span>1</span></div>
                                </div>
                            </div>
                        </div>
                    
                    <?php
                }

            } 
?>
    </div>

</script>