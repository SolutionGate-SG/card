<?php
$class = ['1'=>'purna-idcard-wrapper', '2'=>'asakta-idcard-wrapper', '3'=>'madyam-idcard-wrapper', '4'=>'samanya-idcard-wrapper'];

    $ward = Modules::run('Settings/getWard', $result->ward);
    $disable_type = Modules::run('Settings/getDisableType', $result->disable_type);
    $disable_severity = Modules::run('Settings/getDisableSeverity', $result->disable_severity);
    $genders = array('male'=>'पुरुष', 'female' => 'महिला', 'other'=>'अन्य');
    $citizenship_district = Modules::run('Settings/getDistrict', $result->citizenship_district);
    $blood_group = Modules::run('Settings/getBloodType', $result->blood_group);
    if($citizenship_district != FALSE)
    {
        $citizenship = $result->citizenship_no."/".$citizenship_district->name;
        $citizenship_eng = $result->citizenship_no."/".$citizenship_district->english_name;
    }
    else {
        $citizenship = "";
        $citizenship_eng= "";
    }
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
               </div>
           </div>
       </div>
       <div class="container-fluid ">
           <nav aria-label="breadcrumb" class="bg-shadow">
               <ol class="breadcrumb px-3 py-2">
                   <li class="breadcrumb-item ml-1"><a href="<?= base_url()?>">गृह</a></li>
                   <li class="breadcrumb-item" style="color:black;">अपाङ्गता व्यक्ति</a></li>
                   <li class="breadcrumb-item active">विवरण</li>

               </ol>
           </nav>
        </div>
   <div class="container-fluid">
       <div class="card">
           <div class="card-body">
               <div class="row">
                   <div class="col-md-12 text-right mb-3">
                       <!-- <a href="<?= base_url()?>print-disable1/<?=$result->id?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i>पहिलो पृष्ट</a>
                       <a href="<?= base_url()?>print-disable2/<?=$result->id?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i>दोस्रो पृष्ट</a> -->
                   </div>

               </div>
               <!-- Id Card Front Part -->
           	<div class="print-size-front mt-2">
           	<div class="">
           		<div class="row">
           			<div class="col">
           				<div class="<?= $class[$disable_severity->id]?> ">
           					<div class="idcard-border">
           						<div class="row">
           							<div class="col-2"><img src="<?= base_url()?>/assets/images/icons/logo.png" style="width: 80px;"></div>
           							<div class="col-8">
           								<div class="id-title">
           									<h1><?= SITE_OFFICE ?> <br> <?= SITE_PALIKA ?> </h1>
           									<p><?= SITE_ADDRESS ?> <br> <?= SITE_STATE ?></p>
           									<h2><?= $disable_severity->name ?> अपाङ्गताको परिचय-पत्र </h2>
           								</div>
           							</div>
           							<div class="col-2">
           								<div class="id-photo-frame"></div>
           							</div>
           						</div>
           						<div class="id-body">
           							<div class="row">
           								<div class="col">प. प. न. <span class="input-padder"><?=$result->pp_no?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">प. प. प्रकार: <span class="input-padder"><?= $disability_severity->group?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">नाम थर: <span class="input-padder"><?= $result->nepali_name ?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">ठेगाना: जिल्ला  <?= SITE_DISTRICT ?>, स्थानीय तह:  <?= SITE_OFFICE ?> वडा नं. <span class="input-padder"><?= $ward->name ?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">जन्म मिति/उमेर: <span class="input-padder"><?= $result->nepali_birth_date ."/". $result->age ?></span></div>
           								<div class="col">ना प्र न./जिल्ला: <span class="input-padder"><?= $citizenship ?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">लिङ्ग: <span class="input-padder"><?= $genders[$result->gender]?></span></div>
           								<div class="col">रक्त समुह: <span class="input-padder"><?= $blood_group->name ?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">अपाङ्गताको किसिम: प्रकृतिको आधारमा: <span class="input-padder"><?= $disable_type->name ?></span></div>
           								<div class="col-4">गम्भिरता: <span class="input-padder"><?= $disable_severity->name ?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">बाबुआमा वा संरक्षकको नामथर: <span class="input-padder"><?= $result->nepali_father_name ?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">परिचय-पत्र बाहकको दस्तखत:</div>
           								<div class="col">परिचय-पत्र प्रमाणित गर्ने:
           									<div class="row">
           										<div class="col">हस्ताक्षर:</div>
           									</div>
           									<div class="row">
           										<div class="col">नामथर:</div>
           									</div>
           									<div class="row">
           										<div class="col">पद:</div>
           									</div>
           									<div class="row">
           										<div class="col">मिति:</div>
           									</div>
           								</div>
           							</div>
           							<div class="row">
           								<div class="col text-center note-nepali">यो परिचय-पत्र कसैले पाएमा नजिकैको प्रहरीचौकी वा स्थानीय तहमा बुझाइदिनु होला</div>
           							</div>
           						</div>
           					</div>
           				</div>
           			</div>
           		</div>
           	</div>
           	</div>
           	<!-- Id Card Back Part -->
           	<div class="print-size-back mt-4">
           	<div class="">
           		<div class="row">
           			<div class="col">
           				<div class="<?= $class[$disable_severity->id]?>  font-eng">
           					<div class="idcard-border">
           						<div class="idcard-back">
           						<div class="row">
           							<div class="col">1) Name of Id Holder: <span class="input-padder"><?= $result->english_name ?></span></div>
           						</div>
           						<div class="row">
           							<div class="col">2) Address: District: <?= SITE_DISTRICT_ENG ?>, Local Level: <?= SITE_OFFICE_ENG_S ?> Ward No <span class="input-padder"><?=Modules::run('DisableDetails/convert_no', $ward->name);?></span></div>
           						</div>
           						<div class="row no-gutters">
           							<div class="col-5">3) Date of Birth/Age: <span class="input-padder"><?= $result->nepali_birth_date ."/". $result->age ?></span></div>
           							<div class="col no-gutters">4) Citizenship No./District: <span class="input-padder"><?= $citizenship_eng ?></span></div>
           						</div>
           						<div class="row">
           							<div class="col">5) Sex: <span class="input-padder"><?= ucfirst($result->gender)?></span></div>
           							<div class="col">5) Blood Group: <span class="input-padder"><?= $blood_group->name ?></span></div>
           						</div>
           						<div class="row">
           							<div class="col-4">7) Types of Disability:</div>
           							<div class="col-8">
           								<div class="row">
           								<div class="col">On the basis of Nature: <span class="input-padder"><?= $disable_type->english_name ?></span></div>
           							</div>
           							<div class="row">
           								<div class="col">On the basis of Severity: <span class="input-padder"><?= $disable_severity->english_name ?></span></div>
           							</div>
           							</div>
           						</div>
           						<div class="row">
           							<div class="col">8) Father's Name/Mother's Name/ Name or Guardian: <span class="input-padder"><?= $result->english_father_name ?></span></div>
           						</div>
           						<div class="row">
           							<div class="col">9) Signature of ID Card Holder:</div>
                        <div class="col">10) Approved By:</div>
           						</div>
           						<div class="row">
           							<div class="col-6 mt-2">
           								<div class="row">
           									<div class="col-6">
           										<div class="stamp-box">
           											<p>Right</p>
           											<div class="stamp-box-border"></div>
           										</div>
           									</div>
           									<div class="col-6">
           										<div class="stamp-box">
           											<p>Left</p>
           											<div class="stamp-box-border"></div>
           										</div>
           									</div>
           								</div>
           							</div>
           							<div class="col-6 mt-4">
           							<div class="row">
           								<div class="col mb-2">Signature:</div>
           							</div>
           							<div class="row">
           								<div class="col mb-2">Name:</div>
           							</div>
           							<div class="row">
           								<div class="col mb-2">Designation:</div>
           							</div>
           							<div class="row">
           								<div class="col mb-2">Date:</div>
           							</div>
           							</div>
           						</div>
           						<div class="row">
           								<div class="col text-center mt-3 note">If somebody finds this ID card, Please deposit this in the nearby police station or municipality office.</div>
           							</div>
           						</div>
           					</div>
           				</div>
           			</div>
           		</div>
           	</div>
           	</div>
           	<!-- Id Card Back Part -->
           </div>
       </div>
   </div>

   </section>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url()?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script type='text/javascript'>

</script>
