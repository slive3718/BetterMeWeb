<form action="<?= base_url().'mentor/do_AddMotivationalPost'?>" method="POST">
    <center>
        <table style="margin-top:80px;">
            <tr>
                <td>
                    <label>Thread</label>
                    <tr>
                        <td><input
                            type="text"
                            name="post_type"
                            value="<?php if ($post_type){
                                            echo $post_type;
                                          }?>"></td>
                    </tr>
                    <tr>

                        <td>
                            <label>userId</label>
                            <input
                                type="text"
                                name="user_id"
                                value="<?php  if ($this->session->userdata['id']) {
                                          echo $this->session->userdata['id'];
                                     }?>"></td>
                    </tr>
                    <td>
                        <label>Thread Title</label>
                        <tr>
                            <tr>
                                <td><input type="text" name="title" placeholder="Title"></td>
                            </tr>
                            <tr>
                                <td><input type="date" name="date_range"></td>
                            </tr>

                            <tr>
                                <td>
                                    <textarea name="content" id="" cols="100" rows="10" placeholder="Motivation"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td><input type="submit" name="submit" id="">
                                    <input type="reset" name="reset"></td>
                            </tr>
                        </table>

                    </form>

                  