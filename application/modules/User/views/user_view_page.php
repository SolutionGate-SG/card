<section class="content ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg'))): ?>
                    <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('msg');?></span></div>
                <?php endif; ?>
                <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                    <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$this->session->flashdata('err_msg');?></span></div>
                <?php endif; ?>
            </div>
        </div>
    </div>



        <div class="container-fluid ">
            <nav aria-label="breadcrumb" class="bg-shadow">
                <ol class="breadcrumb px-3 py-2">
                    <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>dashboard">गृह</a></li>


                    <li class="breadcrumb-item">प्रयोगकर्ता</li>

                    <li class="breadcrumb-item active">विवरण</li>

                </ol>
            </nav>
        </div>

    <div class="container-fluid ">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="pull-right" style="margin-bottom:8px;">
                            <a href="<?= base_url()?>register" class="btn btn-success btn-lg">नयाँ</a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>नाम</th>
                            <th>फोन नं</th>
                            <th>ईमेल</th>
                            <th>फाँट</th>
                            <th>वार्ड</th>
                            <th>युजर मोड</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($users !=FALSE):?>
                            <?php
                                $i = 1;
                                foreach ($users as $user) :
                                    if($user->is_muncipality == 1)
                                    {
                                        $depart = Modules::run('Settings/getDepartment',$user->department);
                                        $department = $depart->name;
                                    }
                                    else {
                                        $department = "-";
                                    }
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $user->name?></td>
                                <td><?= $user->phone?></td>
                                <td><?= $user->email?></td>
                                <td><?= $department?></td>
                                <td><?= $user->ward?></td>
                                <td><?= $user->mode ?></td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        <?php else: ?>
                            <tbody>
                                <tr>
                                    <td colspan=7>डेटावेसमा डेटा छैन</td>
                                </tr>
                            </tbody>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

</section>
</div>
<script>

</script>
