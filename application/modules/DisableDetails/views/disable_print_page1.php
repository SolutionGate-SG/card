<?php
    $class = ['1'=>'purna-idcard-wrapper', '2'=>'asakta-idcard-wrapper', '3'=>'madyam-idcard-wrapper', '4'=>'samanya-idcard-wrapper'];

    $ids = explode("-", $ids_selected);
    $i = 0;
     $approved_by = Modules::run('Settings/getPramanitGarne', $_GET['approved_by']);
    foreach($ids as $id):
        $result = $this->Mdl_disable_detail->getById($id);
        if($result != FALSE):
            $ward = Modules::run('Settings/getWard', $result->ward);
            $disable_type = Modules::run('Settings/getDisableType', $result->disable_type);
            $disable_severity = Modules::run('Settings/getDisableSeverity', $result->disable_severity);
            $genders = array('male'=>'पुरुष', 'female' => 'महिला', 'other'=>'अन्य');
            $citizenship_district = Modules::run('Settings/getDistrict', $result->citizenship_district);
            $blood_group = Modules::run('Settings/getBloodType', $result->blood_group);
            if($citizenship_district != FALSE)
            {
                $citizenship = $result->citizenship_no."/".$citizenship_district->name;
            }
            else {
                $citizenship = "";
            }
    ?>
<!-- Id Card Front Part -->
 <div class="print-size-front mt-2 mb-4">
 <div class="">
     <div class="row">
         <div class="col">
             <div class="<?= $class[$disable_severity->id]?>">
                 <div class="idcard-border">
                     <div class="row">
                         <div class="col-2"><img src="<?= base_url()?>/assets/images/icons/logo.png" style="width: 80px;"></div>
                         <div class="col-8">
                             <div class="id-title">
                                 <h1><?= SITE_OFFICE ?> <br> <?= SITE_PALIKA ?></h1>
                                 <p><?= SITE_ADDRESS ?> <br><?= SITE_STATE ?></p>
                                 <h2><?= $disable_severity->name?> अपाङ्गताको परिचय-पत्र </h2>
                             </div>
                         </div>
                         <div class="col-2">
                             <div class="id-photo-frame"></div>
                         </div>
                     </div>
                     <div class="id-body">
                         <div class="row">
                             <div class="col">प. प. न. <span class="input-padder"><?= $result->pp_no ?></span></div>
                         </div>
                         <div class="row">
                             <div class="col">प. प. प्रकार: <span class="input-padder"><?= $disable_severity->group?></span></div>
                         </div>
                         <div class="row">
                             <div class="col">नाम थर: <span class="input-padder"><b style="font-size: 14px;"><?= $result->nepali_name ?></b></span></div>
                         </div>
                         <div class="row">
                             <div class="col">ठेगाना: जिल्ला: <?= SITE_DISTRICT ?>, स्थानीय तह: <?= SITE_OFFICE ?> वडा नं <span class="input-padder"><?= $ward->name ?></span></div>
                         </div>
                         <div class="row">
                             <div class="col">जन्म मिती/उमेर: <span class="input-padder"><?= $result->nepali_birth_date ."/". $result->age ?></span></div>
                             <div class="col">ना. प्र. न./जिल्ला: <span class="input-padder"><?= $citizenship ?></span></div>
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
                                     <div class="col">नामथर: <?= $approved_by->name ?></div>
                                 </div>
                                 <div class="row">
                                     <div class="col">पद: <?= $approved_by->post?></div>
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
<?php
    $i++;
    endif;
endforeach;
 ?>
