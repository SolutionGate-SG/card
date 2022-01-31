<section class="content" id="disable_list_page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(!empty($this->session->flashdata('msg'))): ?>
                <div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
                        aria-label="close"><img alt="cross" class="close_btn_"
                            src="<?=base_url()?>assets/images/cross.png"></a><span><?=$this->session->flashdata('msg');?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($this->session->flashdata('err_msg'))): ?>
                <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert"
                        aria-label="close"><img alt="cross" class="close_btn_"
                            src="<?=base_url()?>assets/images/cross.png"></a><span><?=$this->session->flashdata('err_msg');?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <nav aria-label="breadcrumb" class="bg-shadow">
            <ol class="breadcrumb px-3 py-2 bread-list">
                <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>">गृह</a></li>
                <li class="breadcrumb-item">अपाङ्गता व्यक्ति</a></li>
                <li class="breadcrumb-item active">सुची</li>

            </ol>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php echo form_open(base_url().'disable-details-list'); ?>
                <div class="row form_box">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label"><span class="label_txt">पुरा नाम</span></label>

                                <div class="input-group">
                                    <input type="text" class="form-control" name="p_name" id='p_name'
                                        value="<?= isset($this_name) ? $this_name : ''?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label"><span class="label_txt">प.प.नं.</span></label>

                                <div class="input-group">
                                    <input type="number" class="form-control" name="pp_no" id='pp_no'
                                        value="<?= isset($this_pp_no) ? $this_pp_no : ''?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label"><span class="label_txt">वडा</span></label>

                                <div class="input-group">
                                    <select class="select2 form-control" name="ward" id='ward'>
                                        <option value="">छान्नुहोस्</option>
                                        <?php foreach($wards as $ward): ?>
                                        <?php $selected =''; if(isset($this_ward) && $this_ward->id == $ward->id){ $selected = 'selected';} ?>
                                        <option value="<?=$ward->id?>" <?= $selected?>><?= $ward->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label"><span class="label_txt">अपाङ्गताको
                                        प्रकृति</span></label>

                                <div class="input-group">
                                    <select class="select2 form-control" name="disable_type" id='disable_type'>
                                        <option value="">छान्नुहोस्</option>
                                        <?php foreach($disable_types as $type): ?>
                                        <?php $selected =''; if(isset($this_disable_type) && ($this_disable_type->id == $type->id)){ $selected = 'selected';} ?>
                                        <option value="<?=$type->id?>" <?= $selected?>><?= $type->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label"><span class="label_txt">अपाङ्गताको
                                        गम्भीरता</span></label>

                                <div class="input-group">
                                    <select class="select2 form-control" name="disable_severity" id='disable_severity'>
                                        <option value="">छान्नुहोस्</option>
                                        <?php foreach($disable_severitys as $type): ?>
                                        <?php $selected =''; if(isset($this_disable_severity) && $this_disable_severity->id == $type->id){ $selected = 'selected';} ?>
                                        <option value="<?=$type->id?>" <?= $selected ?>><?= $type->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label"><span class="label_txt">निवेदन दर्त मिति <span
                                            class="text-danger">&nbsp;*</span></span></label>

                                <div class="input-group date_input">
                                    <input type="text" id="nepaliDate4" name="nepali_birth_date" class="form-control"
                                        required
                                        value="<?= isset($result) ? $result->nepali_birth_date : set_value('nepali_birth_date')?>"
                                        placeholder="yyyy-mm-dd" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 mb-3">
                        <button type="submit" class="btn btn-info dl_btn" name="search"><img alt="cross"
                                class="close_btn_" src="<?=base_url()?>assets/images/search.png">
                            खोज्नुहोस</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-9 border-line">
                            <h4 class="">अपाङ्गता व्यक्तिको सुची</h4>
                        </div>

                        <div class="col-md-3 row mb-3 top_bottom">
                            <?php echo form_open(base_url().'convert-to-Excel/disable_export_page/Disable_Details_Report', 'target="_blank"');?>
                            <input type="hidden" name="pp_no" id='p_pp_no'
                                value="<?= isset($this_pp_no) ? $this_pp_no : ''?>">
                            <input type="hidden" name="disable_type" id='p_disable_type'
                                value="<?= isset($this_disable_type) ? $this_disable_type->id : ''?>">
                            <input type="hidden" name="disable_severity" id='p_disable_severity'
                                value="<?= isset($this_disable_severity) ? $this_disable_severity->id : ''?>">
                            <input type="hidden" name="ward" id='p_ward'
                                value="<?= isset($this_ward) ? $this_ward : ''?>">
                            <button type="submit" name="button" class="btn btn-secondary mr-2"><img alt="cross"
                                    class="close_btn_" src="<?=base_url()?>assets/images/export.png"> Export</button>
                            <?php echo form_close(); ?>
                            <?php echo form_open(base_url().'print-preview'); ?>
                            <button type="submit" name="print" class="btn print_btn"><img alt="cross" class="close_btn_"
                                    src="<?=base_url()?>assets/images/print.png">
                                प्रिन्ट गर्नुहोस्</button>
                        </div>
                    </div>

                </div>
                <table id="table1" class="table table-striped table-bordered text-center">
                    <thead>
                        <th></th>
                        <th>क्र.स.</th>
                        <th>नाम</th>
                        <th>जन्म मिति (उमेर)</th>
                        <th>लिङ्ग</th>
                        <th>ठेगाना</th>
                        <th>रक्त समूह</th>
                        <th>अपाङ्गताको प्रकृति</th>
                        <th>अपाङ्गताको गम्भिरता</th>
                        <th></th>
                    </thead>
                    <tbody id='result_body'>
                        <?php if ($disable_details != FALSE): ?>
                        <?php $i = 1; foreach($disable_details as $detail): ?>
                        <?php
                            $local = Modules::run('Settings/getLocal', $detail->local_body);
                            $ward  = Modules::run('Settings/getWard', $detail->ward);
                            $blood_group  = Modules::run('Settings/getBloodType', $detail->blood_group);
                            $genders      = array('male'=>'पुरुष', 'female'=>'महिला', 'other' => 'अन्य');
                            $disable_type = Modules::run('Settings/getDisableType', $detail->disable_type);
                            $disable_severity = Modules::run('Settings/getDisableSeverity', $detail->disable_severity);
                            ?>
                        <tr>
                            <td> <input type='checkbox' class="print" name='ids[]' value="<?= $detail->id?>"> </td>
                            <td><?= $i ?></td>
                            <td><?= $detail->nepali_name ?></td>
                            <td><?= $detail->nepali_birth_date." (".$detail->age.")"?></td>
                            <td><?= $genders[$detail->gender] ?></td>
                            <td><?= $local->name ?> वडा नं <?= $ward->name ?></td>
                            <td><?= $blood_group->name ?></td>
                            <td><?= $disable_type->name ?></td>
                            <td><?= $disable_severity->name ?></td>
                            <td>
                                <a href="<?= base_url()?>disable-details/<?= $detail->id?>"><i
                                        class="fa fa-eye"></i></a>
                                <a href="<?= base_url()?>edit-disable-detail/<?= $detail->id?>"><i
                                        class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                        <?php else:?>
                        <tr>
                            <td colspan="8"><span class="text-danger">डेटाबेशमा डेटा भेटिएन</span></td>
                        </tr>
                        <?php endif;?>

                    </tbody>
                    <?php echo form_close(); ?>
                </table>
            </div>
        </div>
    </div>

</section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- <script src="<?= base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?= base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<script type='text/javascript'>
jQuery(document).ready(function() {
    jQuery(document).on('click', '.print', function() {
        var checked = jQuery('.print:checked').length;
        if (checked > 2) {
            alert('कृपया २ वोटा मात्र छान्नुहोला |');
            jQuery(this).prop("checked", false);
        }
    });
    jQuery(document).on('input', '#pp_no', function() {
        jQuery('#p_pp_no').val(jQuery(this).val());
    });
    jQuery(document).on('change', "#disable_type", function() {
        jQuery("#p_disable_type").val(jQuery(this).val());
    });
    jQuery(document).on('change', "#disable_severity", function() {
        jQuery("#p_disable_severity").val(jQuery(this).val());
    });
    jQuery(document).on('change', "#ward", function() {
        jQuery("#p_ward").val(jQuery(this).val());
    });
});
</script>