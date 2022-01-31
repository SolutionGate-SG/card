<style>

</style>


<section class="loginwrap ">
    <div class="container">
        <div class="page-wrapper">

            <main class="main-wrapper">
                <div class="container-fluid">


                    <div class="col-12">
                        <?php if(!empty($this->session->flashdata('msg')))
                        {?>
                        <div class="alert alert-success alert-dismissible"> <a href="#" class="close"
                                data-dismiss="alert"
                                aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>


                        <?php } ?>
                        <?php if(!empty($this->session->flashdata('err_msg')))
                        {?>
                        <div class="alert alert-danger alert-dismissible"> <a href="#" class="close"
                                data-dismiss="alert"
                                aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span>
                        </div>

                        <?php } ?>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center align-items-center" style="height:100vh">
                            <div class="col-md-5">
                                <div class="login-header row">
                                    <div class="log-text col-md-7">
                                        <h4>Welcome Back !</h4>
                                        <p>Sign in to continue.</p>
                                    </div>
                                    <div class="log-img col-md-5">
                                        <img src="https://www.creativefabrica.com/wp-content/uploads/2019/05/Flag-of-Nepal-by-ingoFonts-1-580x386.png"
                                            alt="flag of nepal">
                                    </div>
                                </div>
                                <div class="card login-wrapper row">
                                    <div class="loginlogo">
                                        <img src="<?= base_url()?>assets/dist/images/nepal_logo.png">
                                    </div>
                                    <div class="card-body">
                                        <!-- <h5 class="card-title">Sign in</h5> -->
                                        <?php echo form_open("login"); ?>
                                        <div class="form-group ">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="username" class="form-control"
                                                    placeholder="Username" required id="id_username" />
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="input-group input-group-sm">
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Password" required id="id_password" />

                                            </div>
                                            <input class="mt-3" type="checkbox" id="id_show" onclick="myFunction()">
                                            Show Password
                                            <!-- <p><a href="#">Forgert Password?</a></p> -->
                                        </div>


                                        <div class="form-group mt-2">
                                            <button class="btn btn-success btn-sm btn-block" name="submit"
                                                type="submit">
                                                <em class=""></em> Login
                                            </button>
                                            <!-- <div class="mt-2 text-center">
                                        <a class="text-decoration-none text-success"
                                        href="/users/send_password_reset_email/">Forgot
                                            password?</a>
                                    </div> -->
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
<script>
function myFunction() {
    if (document.getElementById('id_show').checked === true) {
        document.getElementById('id_password').type = 'text';
    } else {
        document.getElementById('id_password').type = 'password';
    }

}
</script>