<?php
if(isset($result))
{
    $action_page = base_url()."add_disable_type/".$result->id;
}
else
{
    $action_page = base_url()."add_disable_type";
}

?>
<section class="content" id="disabled_type">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg')))
                {?>
                <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
                        aria-label="close"><img alt="cross" class="close_btn_"
                            src="<?=base_url()?>assets/images/cross.png"></a><span><?=$this->session->flashdata('msg');?></span>
                </div>


                <?php } ?>
                <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
                <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
                        aria-label="close"><img alt="cross" class="close_btn_"
                            src="<?=base_url()?>assets/images/cross.png"></a><span><?=$this->session->flashdata('err_msg');?></span>
                </div>

                <?php } ?>
            </div>
        </div>
    </div>



    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2 bread-list">
                <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


                <li class="breadcrumb-item">सेटिंग्स</li>

                <li class="breadcrumb-item active">अपाङ्गको प्रकृतिको किसिम</li>

            </ol>
        </nav>
    </div>




    <div class="container-fluid ">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="offset-lg-1 col-lg-10">

                    </div>
                </div>
                <?php echo form_open($action_page); ?>
                <div class="col-12 col-md-6 offset-md-3 shade_box">
                    <div class="form-group">
                        <label class="label_txt">अपाङ्गको प्रकृति (नेपाली)</label>
                        <input type="text" name="name" class="form-control "
                            value="<?php if(isset($result->name)){ echo $result->name;}?>" required>
                    </div>
                    <div class="form-group">
                        <label class="label_txt">अपाङ्गको प्रकृति (English)</label>
                        <input type="text" name="english_name" class="form-control "
                            value="<?php if(isset($result->english_name)){ echo $result->english_name;}?>" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn_round" value="सेभ गर्नुहोस्">
                    </div>
                </div>

                <!-- /.box-body -->

                <div class="box-footer">

                </div>

                <?php echo form_close();?>
            </div>
            <hr />
            <?php if(!empty($disables)){?>
            <div class="box box-primary" style="margin-left: 10px">
                <div class="box-header with-border">
                    <center>
                        <h4 class="box-title">अपाङ्गको प्रकृतिको किसिम</h4>
                    </center>
                </div>
                <table id="table1" class="table table_style">
                    <thead>
                        <tr>
                            <th>क्र.स.</th>
                            <th>किसिम (नेपाली)</th>
                            <th>किसिम (English)</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i = 1;
                    foreach ($disables as $disable){
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$disable->name?></td>
                            <td><?=$disable->english_name?></td>
                            <td>
                                <a href="<?=base_url()?>add_disable_type/<?=$disable->id?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>&nbsp;&nbsp;
                                <a href="<?=base_url()?>disable-type/<?=$disable->id?>">
                                    <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++;}?>
                    </tbody>
                </table>

                <?php }?>
            </div>

        </div>
    </div>
    </div>

</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!--<script src="-->
<?//=base_url()?>
<!--assets/js/popper.min.js"></script>-->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url()?>assets/calendar/nepali.datepicker.v2.1.min.js"></script>
<!--<script src="-->
<?//=base_url()?>
<!--assets/js/admin.js"></script>-->

<script src="<?= base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/calendar/js/nepalidate.js"></script>

<script src="<?=base_url()?>assets/js/frontend.js"></script>


</body>

</html>