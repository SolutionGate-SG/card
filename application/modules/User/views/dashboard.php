<section class="content">
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
        <div class="container-fluid font-kalimati">
            <div class="row">
                <div class="col-12">

                    <div class="dainik-prashasan mt-3">

                        <div class="row">
                            <div class="col-lg-3 col-6 mb-4">
                                <!-- small box -->
                                <div class="small-box bg-alt-aqua">
                                    <a href="<?= base_url()?>save-disable-detail">
                                        <div class="inner text-center ">
                                            <h5>अपाङ्गता थप्नुहोस</h5>
                                        </div>
                                    </a>
                                    <a href="<?= base_url()?>save-disable-detail" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6 mb-4">
                                <!-- small box -->
                                <div class="small-box bg-alt-yellow">
                                    <a href="<?= base_url()?>disable-details-list">
                                        <div class="inner text-center ">
                                            <h5>अपाङ्गता व्यक्ति हेर्नुहोस</h5>
                                        </div>
                                    </a>
                                    <a href="<?= base_url()?>disable-details-list" class="small-box-footer">अगाडी बढ्नुहोस <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
