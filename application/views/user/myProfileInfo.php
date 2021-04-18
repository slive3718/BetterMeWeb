<body style='overflow-x:hidden;' xmlns="http://www.w3.org/1999/html">

<?php 

if ($myInfo){
    foreach($myInfo as $info){
            $id=$this->session->userdata('id');
            $username=$info['username'];
            $firstName=$info['first_name'];
            $middleName=$info['middle_name'];
            $lastName=$info['last_name'];
            $email=$info['email'];
            $dob=$info['dob'];
            $sex=$info['sex'];
            
            $city=$info['city'];
            $province=$info['province'];
            $contact=$info['contact'];
            $weight=$info['weight'];
            $height=$info['height'];
            $account_type=$info['account_type'];
            $pic_status=$info['user_picture_status'];


		if(isset($dob)){
			$dateOfBirth = $dob;
			$today = date("Y-m-d");
			$diff = date_diff(date_create($dateOfBirth), date_create($today));
			$age = $diff->format('%y');
		}

?>
  


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        
    </style>

    <?php if($this->session->flashdata('msgsuccess')){
        echo "<center><p class='btn btn-success btn-sm'>".$this->session->flashdata('msgsuccess')."</center>";
    }?>
      <?php if($this->session->flashdata('msgwarn')){
        echo "<center><p class='btn btn-warning btn-sm'>".$this->session->flashdata('msgwarn')."</center>";
    }?>
    <hr>
    <div class="container">
        <div class="row">
      		<div class="col-sm-10"><h2><strong><?php if($lastName && $firstName){ echo ucfirst($lastName)." ". ucfirst($firstName);} ?></strong></h2></div>
        	<div class="col-sm-2"><a href="<?= base_url().'user/editMyProfile'?>" class="pull-right"><img title="Update Profile" class="img-circle img-responsive" src="<?=base_url().'./assets/images/update-profile-icon.png'?>" ></a></div>
        </div>
        <div class="row">
      		<div class="col-sm-3"><!--left col-->
                  
    
          <div class="text-center">


          
              <?php
                if (isset($pic_status) && !empty($pic_status)){ ?>
                     <img src="<?=base_url().'./uploads/profilepic/profile'.$id?>.jpg" class="avatar img-circle img-thumbnail" style="height:225px;width:225px">
               <?php }else{
                   ?>
                    <img src="https://www.linkpicture.com/q/avatarprofile.png" class="avatar img-circle img-thumbnail" style="height:225px;width:225px">
                   <?php
               }
              
               if ($account_type=="A") {
                   ?>
           
               <button class="btn btn-warning" style="width:120px" readonly>Admin</button>
               <?php
               }
               ?>

          
          </div></hr><br>
    
                   
         
            </div><!--/col-3-->
        	<div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Personal Information</a></li>
                    <li><a data-toggle="tab" href="#account">Account Information</a></li>
                  </ul>
    
                  
              <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                      <form class="form" action="<?=base_url('admin/update_myaccount/'.$id)?>" method="post" id="registrationForm">
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="fname"><h4>First name</h4></label>
                                  <input type="text" class="form-control" name="fname" readonly id="fname" value="<?php if($firstName){echo $firstName;}?>" placeholder="First Name">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                <label for="contact_no"><h4>Contact Number</h4></label>
                                  <input type="text" class="form-control" name="contact_no" readonly id="contact_no" value="<?php if($contact){echo $contact;}?>" placeholder="Contact Number" title="enter your last name if any.">
                              </div>
                          </div>
              
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="mname"><h4>Middle Name</h4></label>
                                  <input type="text" class="form-control" name="mname" readonly id="middle_name" value="<?php if($middleName){ echo $middleName; } else {echo "";}?>" placeholder="Middle Name" title="enter your phone number if any.">
                              </div>
                          </div>
                              <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="phone"><h4>Age</h4></label>
                                  <input type="text" class="form-control" name="phone"  readonly id="phone" readonly value="<?php if(isset($age)){ echo $age; } else {echo "";}?>" placeholder="Your Age">
                              </div>
                          </div>
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="lname"><h4>Last Name</h4></label>
                                  <input type="text" class="form-control" name="lname" readonly id="last_name" value="<?php if($lastName){ echo $lastName; } else {echo "";}?>" placeholder="Last Name"  >
                              </div>
                          </div>
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="dob"><h4>Date Of Birth</h4></label>
                                  <input type="date" class="form-control" name="dob" readonly id="dob" required value="<?php if(date($dob)){ echo date($dob); } else {echo "";}?>" placeholder="Birth Date" title="if its wrong change here">
                              </div>
                          </div>
                          
                          
              
                          <div class="form-group">
                              <div class="col-xs-6">
                                 <label><h4>Sex</h4></label>
                                 <?php 
                                if (!strcmp('', $sex)) {
                                    echo '
                                        <select name ="sex" class="form-control"  disabled style="height:30px" >
                                        <option value="" selected disabled> Choose here</option>
                                        <option value="Male" > Male </option>
                                        <option value="Female" > Female </option>

                                      
                                    </select>
                                
                                    ';
                                }
                                    if (!strcmp('Male', $sex)) {
                                        echo ' 
                                        <select name ="sex" class="form-control" readonly disabled style="height:30px" >
                                            <option  value="Male" selected> Male </option>
                                            <option value="Female" > Female </option>
    
                                          
                                        </select>
                                    
                                        ';
                                    }
                                        elseif (!strcmp('Female',$sex)) 
                                        {
                                        echo ' <select name ="sex" class="form-control" readonly disabled style="height:30px" >
                                               
                                                <option value="Male" > Male </option>
                                                <option value="Female" selected> Female </option>
        
                                              
                                            </select>
                                        
                                            ';
                                }
                                ?>
                               </div>
                          </div>
                          
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="email"><h4>Email</h4></label>
                                  <input type="email" class="form-control" name="email" readonly id="email" value="<?php if($email){echo $email;}?>" placeholder="you@email.com" title="enter your email.">
                              </div>
                          </div>
                      
                       
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                         
                          </div>
                      </div>
                      
                 
                 
                  

                  </div>
                  <div class="tab-pane" id="account">
                		
                   	
                      <hr>
                    
                      <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="first_name"><h4>Username</h4></label>
                                  <input type="text" class="form-control" name="uname" readonly id="dor"  value="<?php if ($username){echo $username;}?>">
                              </div>
                          </div>
                          <div class="form-group">
                          
                              
                              
                              <div class="col-xs-6">
                                  <label for="pword"><h4>Password</h4></label>
                                  <input type="password" class="form-control" readonly name="pword" id="pword"  value="">
                              </div>
                          </div>
                          <div class="form-group">
                      
                          <div class="col-xs-6">
                                  <label for="cpword"><h4>Confirm Password</h4></label>
                                  <input type="password" class="form-control" readonly name="cpword" id="cpword"  value="">
                              </div>
                          </div>
                       
      
                  	</form>
                  </div>
                   
                  </div><!--/tab-pane-->
              </div><!--/tab-content-->
    
            </div><!--/col-9-->
        </div><!--/row-->
                                                          
<?php
   }
    
}
