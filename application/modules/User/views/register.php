
    <section class=" ">

        <div class="container-fluid">
            <div class="row">

            </div>
        </div><div class="container">
        <div class="page-wrapper mb-5 pt-5">
            <main class="main-wrapper my-5">
                <div class="container-fluid my-5">

                    <div class="col-12">
                        <?php if(!empty($this->session->flashdata('msg'))): ?>
                            <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                        <?php endif; ?>
                        <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                            <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="offset-md-4 col-md-4 my-3">
                            <div class="card ">

                                <div class="card-body">
                                    <h5 class="card-title" style="text-align:center;">Register</h5>

                                    <div class="login-form-wrap">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo form_open('register');?>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="name" class="form-control" placeholder="Full Name" required id="id_name" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required id="id_phone" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="email" name="email" class="form-control" placeholder="Email" required id="id_email" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="address" class="form-control" placeholder="Address" required id="id_address" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <select name="mode" id="id_mode" class="form-control" required>
                                                                <option value="">Mode</option>
                                                                <option value="superadmin">Super Admin</option>
                                                                <!-- <option value="administrator">Admin</option> -->
                                                                <option value="user">User</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="username" class="form-control" placeholder="Username" required id="id_username" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="password" name="password" class="form-control" placeholder="Password" required id="id_password" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="input-group input-group-sm">
                                                            <input type="password" name="repassword" class="form-control" placeholder="Retype password" required id="id_repassword" />
                                                            <span id="right" class="fa fa-check" style="display:none;color:green;"></span>
                                                            <span id="wrong" class="fa fa-times" style="display:none;color:red;"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mt-2">
                                                        <button class="btn btn-success btn-sm btn-block" name="submit"
                                                                type="submit">
                                                            Sign Up
                                                        </button>

                                                    </div>
                                                </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>

    </div>
    </div>
    </main>
    </div>
    </div>

    </section>
</div>
<script type="text/javascript">
    var JQ = jQuery.noConflict();
    JQ(document).ready(function(){
        JQ(document).on("input","#id_repassword",function(){
            var password = JQ("#id_password").val();
            var confirm  = JQ("#id_repassword").val();
            if(password!=confirm)
            {
                JQ("#wrong").show();
                JQ("#right").hide();
            }
            else
            {
                JQ("#right").show();
                JQ("#wrong").hide();
            }
        });

        JQ(document).on('click','input[name="is_muncipality"]',function(){
            if(JQ(this).val()==1)
            {
                JQ(".department_div").show();
                 JQ("#ward_div").hide();
            }
            else {
                JQ(".department_div").hide();
                JQ("#ward_div").show();
            }
        });
    });

</script>
