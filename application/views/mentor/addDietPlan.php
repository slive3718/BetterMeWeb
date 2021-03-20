<form action="<?= base_url().'mentor/temp_add'?>" method="POST"  enctype="multipart/form-data">
    <center>

           
        <table style="margin-top:80px;">
            <tr>
                <td>
                   
                    <tr>
                        <td> <label>Thread</label><input  class="form-control"
                            type="text"
                            name="post_type"
                            value="Diet_Plan" readonly></td>
                    </tr>
                    <tr>

                        <td>
                            <label hidden>userId</label>
                            <input  class="form-control"
                                type="text"
                                name="user_id"
                                value="<?php  if ($this->session->userdata['id']) {
                                          echo $this->session->userdata['id'];
                                     }?>" readonly hidden></td>
                    </tr>
                    <td>
                      
                    
                            <tr>
                                <td>  <label>Diet Title</label><input  class="form-control" type="text" name="post_title" placeholder="Title"></td>
                            </tr>
                            
                         
                            <tr>
                                <!-- <td><input type="date" name="date_range"></td> -->
                            </tr>
                            
                            <tr>
                               <td><label hidden>Diet Plan </label><select  class="form-control" name="routine_format" hidden>
                                   <option name="routine_format" value="Day">Day</option>
                                   <option name="routine_format" value="Month">Month</option>
                                   <option name="routine_format" value="Year">Year</option>
                               </select>
                               <input  class="form-control" type="text" name="routine_count" placeholder="number of year|month|day|" hidden>
                               
                                </td>
                                </tr>
                            
                            <tr>
                                <td> <label>Types of Diet </label>
                                <select name="type_of_diet">
                                <option value=""></option>

                                <option name="type_of_diet" value="Intermittent Fasting">Intermittent Fasting</option>
                                <option name="type_of_diet" value="Zone Diet">Zone Diet</option>
                                <option name="type_of_diet" value="Paleo Diet">Paleo Diet</option>
                                    <option name="type_of_diet" value="Paleo Diet">Paleo Diet</option>
                                    <option name="type_of_diet" value="Blood Type Diet">Blood Type Diet</option>
                                    <option name="type_of_diet" value="Vegan Diet">Vegan Diet</option>
                                    <option name="type_of_diet" value="South Beach Diet">South Beach Diet</option>
                                    <option name="type_of_diet" value="Mediterranean Diet">Mediterranean Diet</option>
                                    <option name="type_of_diet" value="Food Diet">Raw Food Diet</option>
                                   
                                </select>
                            
                            <tr>
                                <td>
                                    <textarea name="post_content"  class="form-control" id="" cols="100" rows="10" placeholder="Diet Content" id="post_content"></textarea>
                                </td>
                            </tr>
                                        <tr><td>     
                                    <input type="file" name="userfile" size="20" oninput="pic.src=window.URL.createObjectURL(this.files[0])"/>
                                    <img id="pic" style="width:150px;height:150px"/>
                                    </td></tr>  
                                    
                                    <tr>

                                <td><input type="submit" name="submit" id="">
                                    <input type="reset" name="reset"></td>
                                    
                            </tr>
                            
                        </table>

                    </form>
            


