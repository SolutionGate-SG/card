<?php
    if(!isset($result))
    {
        $action_page = "save-disable-detail";
        $bread = "नयाँ";
    }
    else
    {
        $action_page = "edit-disable-detail/".$this->uri->segment(2);
        $bread = "सम्पादन";
    }
    if(!empty($result->documents))
    {
        $documents      = explode("+",$result->documents);

    }
    $path           = base_url()."assets/documents/";
?>
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
                   <?php if(isset($msg)): ?>
                       <div  class="alert alert-success alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$msg;?></span></div>
                   <?php endif; ?>
                   <?php if(isset($err_msg)): ?>
                       <div  class="alert alert-danger alert-dismissible" >    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span><?=$err_msg; ?></span></div>
                   <?php endif; ?>
               </div>
           </div>
       </div>
       <div class="container-fluid ">
           <nav aria-label="breadcrumb" class="bg-shadow">
               <ol class="breadcrumb px-3 py-2">
                   <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>">गृह</a></li>
                   <li class="breadcrumb-item" style="color:black;">अपाङ्गता व्यक्ति</a></li>
                   <li class="breadcrumb-item active"><?= $bread?></li>

               </ol>
           </nav>
        </div>
   <div class="container-fluid">
       <div class="card">
           <div class="card-body">
               <?php echo form_open_multipart($action_page);?>
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group row">
                               <label class="col-sm-4 col-form-label"><span
                                       class="float-right">नाम, थर (Nepali)<span
                                       class="text-danger">&nbsp;*</span></span></label>
                               <div class="col-sm-8">
                                   <div class="input-group">
                                       <input type="text" name="nepali_name" class="form-control"  value="<?= isset($result) ? $result->nepali_name : set_value('nepali_name')?>" required/>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group row">
                               <label class="col-sm-4 col-form-label"><span
                                       class="float-right">Full Name (English)<span
                                       class="text-danger">&nbsp;*</span></span></label>
                               <div class="col-sm-8">
                                   <div class="input-group">
                                       <input type="text" name="english_name" class="form-control" required value="<?= isset($result) ? $result->english_name : set_value('english_name')?>"/>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12">
                           <div class="form-group row">
                               <label class="col-md-2 col-form-label">
                                           <span class="float-right">
                                               ठेगाना<span class="text-danger">&nbsp;*</span>
                                           </span>

                               </label>

                                   <div class="col-md-2 mb-sm-2">
                                       <select name="state" class="form-control state select2 state_selected" required id="state_selected-1">
                                             <option value="">प्रदेश</option>
                                         <?php foreach($states as $state): ?>
                                             <option value="<?= $state->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->state == $state->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($state->id==$default[0])
                                                    {
                                                        echo 'selected="selected"';
                                                    }elseif(set_value('state') == $state->id) {
                                                        echo 'selected ="selected"';
                                                    }
                                                 ?>
                                             ><?= $state->name ?></option>
                                         <?php endforeach;?>
                                        </select>
                                   </div>
                                   <div class="col-md-2 mb-sm-2">
                                       <select name="district" class="form-control district select2 district_selected" required id="district_selected-1">
                                           <option value="" >जिल्ला</option>
                                        <?php  foreach($districts as $district): ?>
                                           <option value="<?= $district->id ?>"
                                               <?php
                                                  if(isset($result) && $result->district == $district->id)
                                                  {
                                                      echo 'selected= "selected"';
                                                  }
                                                  elseif($district->name==$default[1])
                                                  {
                                                      echo 'selected="selected"';
                                                  }
                                                  elseif(set_value('district') == $district->id) {
                                                      echo 'selected ="selected"';
                                                  }
                                               ?>
                                           ><?= $district->name ?></option>
                                        <?php endforeach;?>
                                        </select>
                                   </div>
                                   <div class="col-md-2 mb-sm-2">
                                       <select name="local_body" class="form-control local-body select2 local_body_selected" required id="local_body_selected-1">
                                           <option value="">गा.वि.स./न.पा </option>
                                           <?php foreach($locals as $local): ?>
                                               <option value="<?=$local->id?>"
                                                   <?php
                                                      if(isset($result) && $result->local_body == $local->id)
                                                      {
                                                          echo 'selected= "selected"';
                                                      }
                                                      elseif($local->name==$default[2])
                                                          {
                                                              echo 'selected="selected"';
                                                          }
                                                          elseif(set_value('local_body') == $local->id) {
                                                              echo 'selected ="selected"';
                                                          }
                                                   ?>
                                               ><?= $local->name ?></option>
                                           <?php endforeach;?>
                                       </select>
                                   </div>
                                   <div class="col-md-1.5 mb-sm-1">
                                       <select name="ward" class="form-control ward-no select2 ward_selected" required id="ward_selected-1">
                                             <option value="" selected>वडा नं</option>
                                         <?php foreach($wards as $ward) : ?>
                                             <option value="<?= $ward->id ?>"
                                                 <?php
                                                    if(isset($result) && $result->ward == $ward->id)
                                                    {
                                                        echo 'selected= "selected"';
                                                    }
                                                    elseif($ward->id==$default[3])
                                                    {
                                                            echo 'selected="selected"';
                                                    }elseif(set_value('ward') == $ward->id) {
                                                        echo 'selected ="selected"';
                                                    }
                                                 ?>
                                             ><?= $ward->name ?></option>
                                         <?php endforeach;?>
                                        </select>
                                   </div>
                                   
                                   <div class="col-md-2 mb-sm-2">
                                   <input type="text" placeholder="टोल" name="tole" class="form-control "/>
                                   </div>
                               </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-4">
                           <div class="form-group row">
                               <label class="col-sm-4 col-form-label"><span
                                       class="float-right">जन्म मिति<span
                                       class="text-danger">&nbsp;*</span></span></label>
                               <div class="col-sm-8">
                                   <div class="input-group">
                                       <input type="text" id="nepaliDate4" name="nepali_birth_date" class="form-control" required value="<?= isset($result) ? $result->nepali_birth_date : set_value('nepali_birth_date')?>" placeholder="yyyy-mm-dd"/>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-2">
                           <div class="form-group row">
                               <label class="col-sm-4 col-form-label"><span
                                       class="float-right">लिङ्ग<span
                                       class="text-danger">&nbsp;*</span></span></label>
                               <div class="col-sm-8">
                                   <div class="input-group">
                                       <label>
                                           <input type="radio" name="gender" value="male" <?php if(isset($result) && $result->gender == 'male'){echo 'checked="checked"';}elseif(set_value('gender') == 'male'){echo 'checked';} ?>> पुरुष
                                       </label>
                                       <label>
                                           <input type="radio" name="gender" value="female" <?php if(isset($result) && $result->gender == 'female'){echo 'checked="checked"';}elseif(set_value('gender') == 'female'){echo 'checked';} ?>> महिला
                                       </label>
                                       <label>
                                           <input type="radio" name="gender" value="third gender" <?php if(isset($result) && $result->gender == 'third gender'){echo 'checked="checked"';}elseif(set_value('gender') == 'third gender'){echo 'checked';} ?>> तेस्रो लिङ्गी
                                       </label>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-3">
                           <div class="form-group row">
                               <label class="col-sm-4 col-form-label"><span
                                       class="float-right">उमेर<span
                                       class="text-danger">&nbsp;*</span></span></label>
                               <div class="col-sm-8">
                                   <div class="input-group">
                                       <input type="number" id="age" name="age" class="form-control" required value="<?= isset($result) ? $result->age : set_value('age')?>"/>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-3">
                           <div class="form-group row">
                               <label class="col-sm-4 col-form-label"><span
                                       class="float-right">रक्त समूह</span></label>
                               <div class="col-sm-8">
                                   <div class="input-group">
                                       <select name="blood_group" id="blood_group" class="form-control select2" >
                                           <option value="">छान्नुहोस्</option>
                                           <?php if($blood_types != FALSE): ?>
                                               <?php foreach($blood_types as $type): ?>
                                                   <?php $selected=''; if(isset($result) &&  $result->blood_group == $type->id){$selected ='selected';}elseif(set_value('blood_group') == $type->id){$selected = 'selected';} ?>
                                                   <option value="<?= $type->id ?>" <?= $selected?>><?= $type->name ?></option>
                                               <?php endforeach; ?>
                                           <?php endif; ?>
                                       </select>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="row">
                       <div class="col-md-5">
                           <div class="form-group row">
                               <label class="col-sm-4 col-form-label"><span
                                       class="float-right">जन्मदर्ता नम्बर<span
                                       class="text-danger">&nbsp;*</span></span></label>
                               <div class="col-sm-7">
                                   <div class="input-group">
                                       <input type="text" id="nepaliDate4" name="nepali_birth_cert_no" class="form-control" required value="<?= isset($result) ? $result->nepali_birth_date : set_value('nepali_birth_date')?>" placeholder=""/>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="form-group row">
                               <label class="col-sm-5 col-form-label">
                                   <span class="float-right">जन्मदर्ता जारि मिति
                                       <span class="text-danger">&nbsp;*</span>
                                    </span>
                                </label>
                               <div class="col-sm-7">
                                   <div class="input-group">
                                       <input type="text" id="nepaliDate4" name="nepali_birth_reg_no" class="form-control" required value="<?= isset($result) ? $result->nepali_birth_date : set_value('nepali_birth_date')?>" placeholder=""/>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">बाबुआमा वा संरक्षकको नाम(Nepali)<span
                                        class="text-danger">&nbsp;*</span></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nepali_father_name" class="form-control" required value="<?= isset($result) ? $result->nepali_father_name : set_value('nepali_father_name')?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">Father / Mother / Guardian Name (English)<span
                                        class="text-danger">&nbsp;*</span></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="english_father_name" class="form-control" required value="<?= isset($result) ? $result->english_father_name : set_value('english_father_name')?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">ना.प्रा.न.</span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="citizenship_no" class="form-control" value="<?= isset($result) ? $result->citizenship_no : set_value('citizenship_no')?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">ना.प्रा. जारी जिल्ला</span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <select name="citizenship_district" class="form-control district select2" required >
                                            <option value="" >जिल्ला</option>
                                            <?php  foreach($districts as $district): ?>
                                            <option value="<?= $district->id ?>"
                                                <?php
                                                   if(isset($result) && $result->citizenship_district == $district->id)
                                                   {
                                                       echo 'selected= "selected"';
                                                   }
                                                   elseif($district->name==$default[1])
                                                       {
                                                           echo 'selected="selected"';
                                                       }elseif(set_value('citizenship_district') == $district->id){echo 'selected';}
                                                ?>
                                            ><?= $district->name ?></option>
                                            <?php endforeach;?>
                                         </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">
                                    <span class="float-right">निवेदन दर्ता मिति<span
                                        class="text-danger">&nbsp;*</span></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nibedhan_reg_no" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">
                                    <span class="float-right">परिचयपत्र दर्ता मिति<span
                                        class="text-danger">&nbsp;*</span></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nibedhan_reg_no" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">
                                    <span class="float-right">पुरानो प. प. न.</span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="nibedhan_reg_no" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-3 pt-3">
                                    <h5 style="margin-left: 10px; border-bottom: 2px solid #333;" class="pb-2">
                                        अपाङ्गताको विवरण
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">प्रकृतिको आधारमा<span
                                        class="text-danger">&nbsp;*</span></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <select class="form-control select2" name="disable_type">
                                            <option value="">छान्नुहोस्</option>
                                            <?php if($disable_types != FALSE): ?>
                                                <?php foreach($disable_types as $type): ?>
                                                    <?php $selected =''; if(isset($result) && $result->disable_type == $type->id){ $selected = "selected";}elseif(set_value('disable_type') == $type->id){$selected =  'selected';} ?>
                                                    <option value="<?= $type->id ?>" <?= $selected?>> <?= $type->name ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">गम्भिरताको आधारमा<span
                                        class="text-danger">&nbsp;*</span></span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <select class="form-control select2" name="disable_severity">
                                            <option value="">छान्नुहोस्</option>
                                            <?php if($disable_severitys != FALSE): ?>
                                                <?php foreach($disable_severitys as $type): ?>
                                                    <?php $selected =''; if(isset($result) && $result->disable_severity == $type->id){ $selected = "selected";}elseif(set_value('disable_severity') == $type->id){$selected = 'selected';} ?>
                                                    <option value="<?= $type->id?>" <?= $selected?>> <?= $type->name ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><span
                                        class="float-right">फोटो</span></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" value="<?= set_value('image')?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="form-group row">
                       <div class="col-sm-3 offset-sm-9 mt-4">
                           <button type="submit" class='btn btn-block btn-submit btn-primary' name="save_disable">
                               पेश गर्नुहोस्
                           </button>
                       </div>
                   </div>
               <?php echo form_close();?>
           </div>
       </div>
   </div>

   </section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url()?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script type='text/javascript'>

</script>
