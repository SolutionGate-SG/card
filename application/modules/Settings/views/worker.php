<?php
if(isset($result))
{
    $action_page = base_url()."add-worker/".$result->id;
}
else
{
    $action_page = base_url()."add-worker";
}

?>
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg')))
                {?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>


                <?php } ?>
                <?php if(!empty($this->session->flashdata('err_msg')))
                {?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>

                <?php } ?>
            </div>
        </div>
    </div>



    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2">
                <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


                <li class="breadcrumb-item active">सेटिंग्स</li>

                <li class="breadcrumb-item active">कर्मचारी</li>

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
                <?php echo form_open($action_page)?>
                <div class="col-12 col-md-6 offset-md-3" >
                    <div class="form-group">
                        <label>नाम</label>
                        <input type="text" name="name" class="form-control " value="<?php if(isset($result->name)){ echo $result->name;}?>" required>
                    </div>
                    <div class="form-group">
                        <label>फाँट</label>
                        <select name="department_id" class="select2 form-control" required>
                            <option value=''>छान्नुहोस्</option>
                            <?php foreach($departments as $depart): ?>
                            <option value='<?= $depart->id ?>'
                                <?php if(isset($result->department_id) && $result->department_id==$depart->id){echo'selected="selected"';} ?>
                            ><?= $depart->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>पद</label>
                        <select name="post_id" class="select2 form-control" required>
                            <option value=''>छान्नुहोस्</option>
                            <?php foreach($posts as $post): ?>
                            <option value='<?= $post->id ?>'
                                <?php if(isset($result->post_id) && $result->post_id==$post->id){echo'selected="selected"';} ?>
                            ><?= $post->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="सेभ गर्नुहोस्" >
                    </div>
                </div>

                <!-- /.box-body -->

                <div class="box-footer">

                </div>

                <?php echo form_close();?>
            </div>
            <hr/>
            <?php if(!empty($workers)){?>
            <div class="box box-primary"  style="margin-left: 10px">
                <div class="box-header with-border">
                    <center><h4 class="box-title">कर्मचारीहरु</h4></center>
                </div>
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>क्र.स.</th>
                        <th>कर्मचारीको नाम</th>
                        <th>फाँट</th>
                        <th>पद</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($workers as $worker){
                        $depart = Modules::run('Settings/getDepartment',$worker->department_id);
                        $post = Modules::run('Settings/getPost',$worker->post_id);
                    ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$worker->name?></td>
                            <td><?=$depart->name?></td>
                            <td><?=$post->name?></td>
                            <td>
                                <a href="<?=base_url()?>add-worker/<?=$worker->id?>">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>&nbsp;&nbsp;
                                <a href="<?=base_url()?>delete-worker/<?=$worker->id?>">
                                    
                                <i class="fa fa-trash-o text-danger" aria-hidden="true" onclick="return confirm('के तपाई निश्चित हुनु हुन्छ?')"></i>
                                </a>&nbsp;&nbsp;
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
<!--<script src="--><?//=base_url()?><!--assets/js/popper.min.js"></script>-->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url()?>assets/calendar/nepali.datepicker.v2.1.min.js"></script>
<!--<script src="--><?//=base_url()?><!--assets/js/admin.js"></script>-->

<script src="<?= base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/calendar/js/nepalidate.js"></script>

<script src="<?=base_url()?>assets/js/frontend.js"></script>
</body>
</html>
