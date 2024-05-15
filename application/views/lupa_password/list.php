<?php
?><br><br><br><br><br><br><br><?php
echo validation_errors('<div class="alert alert-success">','</div>');
      //notif gagal login
      if($this->session->flashdata('warning')){
        echo '<div class="alert alert-warning">';
        echo $this->session->flashdata('warning');
        echo '</div>';
      } 
      //notif logout
      if($this->session->flashdata('success')){
        echo '<div class="alert alert-success">';
        echo $this->session->flashdata('succes');
        echo '</div>';
      }   
echo form_open(base_url('lupa_password'));
?>
<br>
<div class="main">
        <div class="container">
                
                    <div class="row">
                      <div class="col-md-4"> </div>
                        <div class="col-md-4"> 
                            <div class="form-style-2">
                                <body>
                                    <center>
                                      <h2 style="font-family: Cambria, Times New Roman,serif;">Masukan Email Terdaftar</h2><br>
                                      <input name="email" placeholder="Email" type="email" required /><br>
                                      <button type="submit" name="submit" class="btn">Cek</button><br><br>
                                    </center>
                                </body>
                            </div>  
                          </div>
                        <div class="col-md-4"></div>   
                      </div>
                   <!--  <div class="col-md-3"></div>  -->
                </div>
            </div>
        </div>
<br><br>

<?php echo form_close()?>


