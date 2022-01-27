<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisableDetails extends MX_Controller {
    private $_curr_session = array();
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_disable_detail');

        $this->load->model('Settings/Mdl_state');
        $this->load->model('Settings/Mdl_district');
        $this->load->model('Settings/Mdl_local_body');
        $this->load->model('Settings/Mdl_ward');
        $this->load->model('Settings/Mdl_state');
        $this->load->model('Settings/Mdl_session');
        $this->load->model('Settings/Mdl_worker');
        $this->load->model('Settings/Mdl_blood_type');
        $this->load->model('Settings/Mdl_disable_type');
        $this->load->model('Settings/Mdl_disable_severity');

        $this->load->helper('functions_helper');
        $this->_curr_session = Modules::run('Settings/getCurrentSession');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------Global Use ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function save_disable_details()
    {
        Modules::run('User/is_logged_in');

        $id = $this->uri->segment(2);
        $t_data = $this->Mdl_disable_detail->getById($id);
        if($t_data != FALSE)
        {
            $result = $t_data;
        }

        if(isset($_POST['save_disable']))
        {
            $this->form_validation->set_rules('nepali_name', 'नाम, थर (Nepali)','required');
            $this->form_validation->set_rules('english_name', 'Full Name (English)','required');
            $this->form_validation->set_rules('state', 'प्रदेश','required');
            $this->form_validation->set_rules('district', 'जिल्ला','required');
            $this->form_validation->set_rules('local_body','स्थानीय तह','required');
            $this->form_validation->set_rules('ward','वडा','required');
            $this->form_validation->set_rules('nepali_birth_date', 'जन्म मिति','required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('age', 'उमेर', 'required');
            $this->form_validation->set_rules('blood_group', 'रक्त समूह', '');
            $this->form_validation->set_rules('nepali_father_name', 'बुबाआमा वा संरक्षकको नाम', 'required');
            $this->form_validation->set_rules('english_father_name', 'Father / Mother / Guardian Name', 'required');
            $this->form_validation->set_rules('disable_type', 'अपाङ्गताको प्रकृति', 'required');
            $this->form_validation->set_rules('disable_severity', 'अपाङ्गताको गम्भिरता', 'required');
            $this->form_validation->set_rules('image', 'फोटो', '');

            if ($this->form_validation->run(this) == FALSE)
            {
                $send['err_msg']    = validation_errors();

            } else {
                unset($_POST['save_disable']);
                $path = 'assets/documents/';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                $file = "";
                $doc_type = "";

                if (!empty($_FILES['image']['name']))
                {
                    $temp_path = $_FILES['image']['tmp_name'];
                    $source = $_FILES['image']['name'];
                    $ext = pathinfo($source, PATHINFO_EXTENSION);
                    $file_name = md5(uniqid() . time()) . "." . $ext;
                    $destination = $path . $file_name;
                    move_uploaded_file($temp_path, $destination);

                    if(isset($result) && !empty($result->image))
                    {
                        unlink($path.$result->image);
                        $_POST['image'] = $file_name;
                    }
                    elseif(!isset($result))
                    {
                        $_POST['image'] = $file_name;
                    }
                }
                $_POST['user_id']    = $this->session->userdata('id');
                if(!isset($result))
                {
                    $pp_no               = $this->Mdl_disable_detail->getMaxPPNo();
                    $_POST['pp_no']      = $pp_no == FALSE ? 1 : $pp_no + 1;
                    $_POST['created_at'] = date('Y-m-d H:i:s');
                    if($id = $this->Mdl_disable_detail->save($this->input->post()))
                    {
                        $this->session->set_flashdata('msg', 'डाटा थप गर्न सफल !');
                        redirect(base_url().'save-disable-detail');
                    }
                }else {
                    $_POST['modified_at'] = date('Y-m-d H:i:s');
                    if($this->Mdl_disable_detail->update($result->id, $this->input->post()))
                    {
                        $this->session->set_flashdata('msg','डाटा सम्पादन गर्न सफल !');
                        redirect(base_url().'disable-details/'.$result->id);
                    }
                }
            }
        }
        if(isset($result))
        {
            $send['result'] = $this->Mdl_disable_detail->getById($id);
        }

        $send['default']    = getDefault();
        $send['states']     = $this->Mdl_state->getAll();
        $send['districts']  = $this->Mdl_district->getAll();
        $send['locals']     = $this->Mdl_local_body->getAll();
        $send['wards']      = $this->Mdl_ward->getAll();
        $send['blood_types'] = $this->Mdl_blood_type->getAll();
        $send['disable_types'] = $this->Mdl_disable_type->getAll();
        $send['disable_severitys'] = $this->Mdl_disable_severity->getAll();
        $header['title']    = 'कानेपोखरी गाउँपालिका | Save Disable Detail';
        $this->load->view('User/header', $header);
        $this->load->view('disable_form_page',$send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function disable_details_list()
    {
        Modules::run('User/is_logged_in');
        if(isset($_POST['search']))
        {
            $search = array();
            if (!empty($_POST['p_name'])) {
                $p_name = $_POST['p_name'];
                $query = "(LOWER(nepali_name) LIKE '%" . $p_name . "' OR LOWER(nepali_name) LIKE '%" . $p_name . "%' OR LOWER(nepali_name) LIKE '" . $p_name . "%'";
                $query .= " OR LOWER(english_name) LIKE '%" . $p_name . "' OR LOWER(english_name) LIKE '%" . $p_name . "%' OR LOWER(english_name) LIKE '" . $p_name . "%')";
                if (!empty($_POST['pp_no'])) {
                    $send['this_pp_no'] = $_POST['pp_no'];
                    $query .= " AND `pp_no`='".$_POST['pp_no']."'";
                }
                if (!empty($_POST['ward'])) {
                    $send['this_ward'] = Modules::run('Settings/getWard', $_POST['ward']);
                    $query .= " AND `ward`='".$_POST['ward']."'";
                }
                if (!empty($_POST['disable_type'])) {
                    $send['this_disable_type'] = Modules::run('Settings/getDisableType', $_POST['disable_type']);
                    $query .= " AND `disable_type`='".$_POST['disable_type']."'";
                }
                if (!empty($_POST['disable_severity'])) {
                    $send['this_disable_severity'] = Modules::run('Settings/getDisableType', $_POST['disable_severity']);
                    $query .= " AND `disable_severity`='".$_POST['disable_severity']."'";
                }
                $query .= " ORDER BY id ASC";
                $details = $this->Mdl_disable_detail->getByCustom($query);
                // echo '<pre>';print_r($details);exit;
                $send['this_name'] = $p_name;
            } else {
                if (!empty($_POST['pp_no'])) {
                    $search['pp_no'] = $_POST['pp_no'];
                    $send['this_pp_no'] = $_POST['pp_no'];
                }
                if (!empty($_POST['ward'])) {
                    $search['ward'] = $_POST['ward'];
                    $send['this_ward'] = Modules::run('Settings/getWard', $_POST['ward']);
                }
                if (!empty($_POST['disable_type'])) {
                    $search['disable_type'] = $_POST['disable_type'];
                    $send['this_disable_type'] = Modules::run('Settings/getDisableType', $_POST['disable_type']);
                }
                if (!empty($_POST['disable_severity'])) {
                    $search['disable_severity'] = $_POST['disable_severity'];
                    $send['this_disable_severity'] = Modules::run('Settings/getDisableType', $_POST['disable_severity']);
                }
                $details = $this->Mdl_disable_detail->getByCols($search);
            }
        } else {
            $details = $this->Mdl_disable_detail->getAll();
        }
        $send['disable_details'] = $details;

        $send['wards'] = $this->Mdl_ward->getAll();
        $send['disable_types']      = $this->Mdl_disable_type->getAll();
        $send['disable_severitys']  = $this->Mdl_disable_severity->getAll();
        $header['title']    = 'कानेपोखरी गाउँपालिका | Disable Details List';
        $this->load->view('User/header', $header);
        $this->load->view('disable_list_page',$send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function disable_detail()
    {
        Modules::run('User/is_logged_in');
        $id = $this->uri->segment(2);
        $t_data = $this->Mdl_disable_detail->getById($id);
        if($t_data == FALSE)
        {
            $this->session->set_flashdata('err_msg', 'अपाङ्गताको विवरण भेटिएन !');
            redirect('disable-details-list');
        }
        $send['result']     = $t_data;
        $header['title']    = 'कानेपोखरी गाउँपालिका | View Disable Detail';
        $this->load->view('User/header', $header);
        $this->load->view('disable_detail_page',$send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function disable_detail_print1()
    {
        Modules::run('User/is_logged_in');
        $ids = $_GET['ids'];
        if(empty($ids))
        {
            $this->session->set_flashdata('err_msg', 'प्रिन्ट गर्ने विवरण छान्नुहोस् !');
            redirect('disable-details-list');
        }
        $send['ids_selected'] = $ids;
        $header['title']    = 'कानेपोखरी गाउँपालिका | PRINT';
        $this->load->view('User/header1', $header);
        $this->load->view('disable_print_page1',$send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function convertNos($nos){
        $n = '';
          switch($nos){
            case "०": $n = 0; break;
            case "१": $n = 1; break;
            case "२": $n= 2; break;
            case "३": $n = 3; break;
            case "४": $n = 4; break;
            case "५": $n = 5; break;
            case "६": $n = 6; break;
            case "७": $n = 7; break;
            case "८": $n = 8; break;
            case "९": $n = 9; break;
            case "0": $n = "०"; break;
            case "1": $n = "१"; break;
            case "2": $n = "२"; break;
            case "3": $n = "३"; break;
            case "4": $n = "४"; break;
            case "5": $n = "५"; break;
            case "6": $n = "६"; break;
            case "7": $n = "७"; break;
            case "8": $n = "८"; break;
            case "9": $n = "९"; break;
           }
       return $n;
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function convert_no($number)
    {
        $number = trim($number);
        $str_num = preg_split('//u', ("". $number), -1); // not explode('', ("". $num))

        // For each item in your exploded string, retrieve the Nepali equivalent or vice versa.
        $out = '';
        $out_arr = array_map('convertNos', $str_num);
        $out = implode('', $out_arr);
        return $out;
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function disable_detail_print2()
    {
        Modules::run('User/is_logged_in');
        $ids = $_GET['ids'];
        if(empty($ids))
        {
            $this->session->set_flashdata('err_msg', 'प्रिन्ट गर्ने विवरण छान्नुहोस् !');
            redirect('disable-details-list');
        }
        $send['ids_selected'] = $ids;
        $header['title']    = 'कानेपोखरी गाउँपालिका | PRINT';
        $this->load->view('User/header1', $header);
        $this->load->view('disable_print_page2',$send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_preview()
    {
        Modules::run('User/is_logged_in');
        if(isset($_POST['print']))
        {
            if(empty($_POST['ids']))
            {
                $this->session->set_flashdata('err_msg', 'प्रिन्ट गर्ने विवरण छान्नुहोस् !');
                redirect('disable-details-list');
            }
            $ids = $_POST['ids'];
        }
        $send['ids'] = $_POST['ids'];
        $this->load->view('User/header', $header);
        $this->load->view('print_preview_page',$send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function convertPageExcel() // content must be in html table arranged
    {
        if (!empty($this->uri->segment(2)) && !empty($this->uri->segment(3))) {
            if(!empty($_POST['pp_no']) || !empty($_POST['disable_type']) || !empty($_POST['disable_severity']) || !empty($_POST['ward']))
            {
                $send['post'] = $this->input->post();
            }
            $content = $this->load->view($this->uri->segment(2), $send , TRUE);
            if (!empty($content)) {
                $filename = $this->uri->segment(3) . '_' . time() . '.xls';
                header('Content-disposition: attachment; filename="' . $filename . '"');
//        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8");
                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-type:   application/x-msexcel; charset=utf-8");
                header('Content-Transfer-Encoding: binary');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                echo $content;
                die();
            }
        }
        echo '';
        die();
    }
}
