<?php
    $class = ['1'=>'purna-idcard-wrapper', '2'=>'asakta-idcard-wrapper', '3'=>'madyam-idcard-wrapper', '4'=>'samanya-idcard-wrapper'];
$approved_by = Modules::run('Settings/getPramanitGarne', $_GET['approved_by']);
    $ids = explode("-", $ids_selected);
    $i = 0;
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
                $citizenship_eng = $result->citizenship_no."/".$citizenship_district->english_name;
            }
            else {
                $citizenship = "";
                $citizenship_eng= "";
            }
    ?>

<!-- Id Card Back Part -->
<div class="print-size-back mt-2 mb-4">
<div class="">
    <div class="row">
        <div class="col">
            <div class="<?= $class[$disable_severity->id]?> font-eng">
                <div class="idcard-border">
                    <div class="idcard-back">
                    <div class="row">
                        <div class="col">1) Name of Id Holder: <span class="input-padder"><b><?= $result->english_name ?></b></span></div>
                    </div>
                    <div class="row">
                        <div class="col">2) Address: District: <?= SITE_DISTRICT_ENG ?>, Local Level:  <?= SITE_OFFICE_ENG_S ?> Ward No <span class="input-padder"><?=Modules::run('DisableDetails/convert_no', $ward->name);?></span></div>
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
                                    <div class="col mb-2">Name: <?= $approved_by->english_name?></div>
                                </div>
                                <div class="row">
                                    <div class="col mb-2">Designation: <?= $approved_by->english_post ?></div>
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
<?php
    $i++;
    endif;
endforeach;
 ?>
