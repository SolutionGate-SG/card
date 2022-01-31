<?php
    if(isset($post))
    {
        $search = array();
        if(!empty($post['pp_no']))
        {
            $search['pp_no'] = $post['pp_no'];
        }
        if(!empty($post['ward']))
        {
            $search['ward'] = $post['ward'];
        }
        if(!empty($post['disable_type']))
        {
            $search['disable_type'] = $post['disable_type'];
        }
        if(!empty($post['disable_severity']))
        {
            $search['disable_severity'] = $post['disable_severity'];
        }
        $results = $this->Mdl_disable_detail->getByCols($search);
    }
    else {
        $results = $this->Mdl_disable_detail->getAll();
    }

?>
<table border='1'>
    <thead>
        <th style='margin:center;'>क्र.स.</th>
        <th style='margin:center;'>नाम</th>
        <th style='margin:center;'>जन्म मिति (उमेर)</th>
        <th style='margin:center;'>लिङ्ग</th>
        <th style='margin:center;'>ठेगाना</th>
        <th style='margin:center;'>रक्त समूह</th>
        <th style='margin:center;'>अपाङ्गताको प्रकृति</th>
        <th style='margin:center;'>अपाङ्गताको गम्भिरता</th>
    </thead>
    <tbody>
    <?php
    $genders      = array('male'=>'पुरुष', 'female'=>'महिला', 'other' => 'अन्य');
    if($results !=FALSE):
        $i = 1;
        foreach($results as $result):
            $local = Modules::run('Settings/getLocal', $result->local_body);
            $ward  = Modules::run('Settings/getWard', $result->ward);
            $blood_group  = Modules::run('Settings/getBloodType', $result->blood_group);
            $disable_type = Modules::run('Settings/getDisableType', $result->disable_type);
            $disable_severity = Modules::run('Settings/getDisableSeverity', $result->disable_severity);
    ?>
    <tr>
        <td><?= $i ?></td>
        <td><?= $result->nepali_name ?></td>
        <td><?= $result->nepali_birth_date." (".$result->age.")"?></td>
        <td><?= $genders[$result->gender] ?></td>
        <td><?= $local->name ?> वडा नं <?= $ward->name ?></td>
        <td><?= $blood_group->name ?></td>
        <td><?= $disable_type->name ?></td>
        <td><?= $disable_severity->name ?></td>
    </tr>
    <?php
        $i++;
        endforeach;
    endif;
    ?>
    </tbody>
</table>
