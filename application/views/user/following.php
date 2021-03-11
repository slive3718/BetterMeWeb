
<script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/myProfile.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<main>
        <div id="device-bar-2">
            <!-- <button></button>
            <button></button>
            <button></button> -->
        </div>
        <header>
            <div class="tb"> 
                <div>   <a href="<?= base_url().'user/homepage/'?>">Better Me</a></div>
                <div class="td" id="search-form">
                    <form method="get" action="#">
                        <input type="text" placeholder="Better Me Search">
                        <button type="submit"><i class="material-icons">search</i></button>
                    </form>
                </div> 
                <?php foreach ($user_info as $val){
                  
            $id=$this->session->userdata('id');
            $username=$val->username;
            $firstName=$val->first_name;
            $middleName=$val->middle_name;
            $lastName=$val->last_name;
            $email=$val->email;
            $dob=$val->dob;
            $pic_status=$val->user_picture_status;
            $sex=$val->sex;

                 ?>
                <div class="td" id="f-name-l"><span><?=(isset($firstName) && !empty($firstName))?$firstName:$username?></span></div>
                <div class="td" id="i-links">
                    <div class="tb">
                        <div class="td" id="m-td">
                            <div class="tb">
                                <span class="td"><i class="fa fa-user"></i></span>
                                <span class="td"><i class="fa fa-envelope"></i></span>
                                <span class="td m-active"><i class="fa fa-bell"></i></span>
                            </div>
                        </div>
                        <div class="td">
                            <a href="#" id="p-link">
                           <?php  if (isset($pic_status)){ ?>
                                    <img src="<?=base_url().'./uploads/profilepic/profile'.$id?>.jpg" class="avatar img-circle img-thumbnail" style="height:35px;width:35px"  alt="profile pic">
                            <?php }else{
                                ?>
                                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" style="height:35px;width:35px"  alt="profile pic">
                                <?php
                            }?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div id="profile-upper">
            <div id="profile-banner-image">
                <img src="https://imagizer.imageshack.com/img921/9628/VIaL8H.jpg" alt="Banner image">
            </div>
            <div id="profile-d">
                <div id="profile-pic" class="card Regular shadow">
                <?php
                if (isset($pic_status)){ ?>
                     <img src="<?=base_url().'./uploads/profilepic/profile'.$id?>.jpg" class="avatar img-circle img-thumbnail" style="height:225px;width:225px"  alt="avatar">
               <?php }else{
                   ?>
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" style="height:225px;width:225px"  alt="avatar">
                   <?php
               }?>
                </div>
                <div id="u-name"><?= Ucfirst($firstName),' ',Ucfirst($lastName)?></div>
                <div class="tb" id="m-btns">
                    <div class="td">
                        <div class="m-btn"><i class="material-icons">Change Timeline Piture</i><span></span></div>
                    </div>
                </div>
                <div id="edit-profile"><i class="material-icons">camera_alt</i></div>
            </div>
            <div id="black-grd"></div>
        </div>
        <div id="main-content">
            <div class="tb ">
                <div class="td" id="l-col">                   
                   
                   
                <div class="m-mrg card Regular shadow" id="composer"  style='right:20px'>
                        <div id="c-tabs-cvr">
                            <div class="tb" id="c-tabs">
                                <div class="td"><h3>People that will inspire you</h3></div>
                            </div>
                                <table class="table" >
                               
                                <?php $a=0;
                                 if (isset($val->getAllusersToFollow) && !empty($val->getAllusersToFollow)){
                                    foreach ($val->getAllusersToFollow as $user) 
                                    if ($a++ < 5)
                                    {
                                                foreach($val->getFollowtbl as $folloStat){
                                                        if ($folloStat->following_id == $user->userId){
                                                            // echo $user->userId,$folloStat->subscribe;
                                                           $subs=$folloStat->following_id;
                                                           $status = $folloStat->subscribe;
                                                        }
                                                }
                                        ?>
                                        <tr>
                                        <td class=""><?=(isset($user->first_name,$user->last_name) && !empty($user->first_name)&& !empty($user->last_name))?Ucfirst($user->first_name):Ucfirst($user->username),' ',ucfirst($user->last_name),' ',(isset($user->account_type)&&($user->account_type)=='M')?'<a class="text-primary">(Mentor)</a>':''?></td>
                                        <td class=""> <!-- --> <?php if (isset($subs) && $subs==$user->userId && $status=='1'){
                                        ?><a data-session-id="<?= $user->userId ?>" class="button-unfollow"><span id ="button-unfollow" class="fa fa-check btn btn-danger btn-sm"></span></a> <?php
                                        }else{
                                            ?> <a data-session-id="<?= $user->userId ?>" class="button-follow"><span class="fa fa-plus btn btn-success btn-sm"></span></a> <?php
                                        }?>
                                         <!-- --> <a href="<?=base_url().'user/visit_profile/'.$user->userId?>" class="button-visit"><span class="fa fa-user btn-primary btn-sm"></span></a></td>
                                        </tr>
                                        <?php
                                    }
                                }?>
                                 </table>
                             
                            </div>
                        </div>
         
            </div>
        </div>
        <?php           
                } 
                
          ?>
        </div>
        <div id="device-bar-2"><i class=""></i></div>
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!--  -->
    <script type="text/javascript">
$(document).ready(function () {
$('.button-unfollow').on('click',function(){
    var userId=$(this).data("session-id");
    let href = $(this).attr('href-url');
    $.post("<?= base_url() ?>user/follow_user_Jquery/",{"userId":userId},function (response){
                        if(response=="success"){
                            $('#button-unfollow').toggleClass('fa fa-plus btn btn-success btn-sm');
                            location.reload();
                        }
                    });

});
    });
    $(document).ready(function () {
$('.button-follow').on('click',function(){

    var userId=$(this).data("session-id");
    let href = $(this).attr('href-url');
    $.post("<?= base_url() ?>user/follow_user_Jquery/",{"userId":userId},function (response){
                        if(response=="success"){
                            $('#button-unfollow').toggleClass('fa fa-check btn btn-danger btn-sm');
                            location.reload();
                        }
                    });

});
    });
    </script>