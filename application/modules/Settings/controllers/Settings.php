<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Settings extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_office');
        $this->load->model('Mdl_state');
        $this->load->model('Mdl_district');
        $this->load->model('Mdl_local_body');
        $this->load->model('Mdl_ward');
        $this->load->model('Mdl_disable_type');
        $this->load->model('Mdl_disable_severity');
        $this->load->model('Mdl_session');
        $this->load->model('Mdl_post');
        $this->load->model('Mdl_worker');
        $this->load->model('Mdl_blood_type');
        $this->load->model('Mdl_pramanit_garne');

        $this->load->helper("functions_helper");


    }
    /*----------------------------------------------------------------------*/
    /*|             Gloabal USE                   */
    /*----------------------------------------------------------------------*/
    public function getWardPostByIdJSON($worker_id='')
    {
        if(isset($_GET['worker_id']))
        {
            $worker_id = $_GET['worker_id'];
        }
        if(!empty($worker_id))
        {
            $this_worker = $this->Mdl_ward_worker->getById($worker_id);
            if($this_worker != FALSE)
            {
                $this_post = $this->Mdl_post->getById($this_worker->post_id);
                if(isset($worker_id))
                {
                    echo json_encode($this_post);exit;
                }
                else {
                    return $this_post;
                }
            }
        }
        if(isset($worker_id))
        {
            echo '0';exit;
        }
        else {
            return FALSE;
        }
    }
    /*----------------------------------------------------------------------*/
    /*----------------------------------------------------------------------*/

    /*----------------------------------------------------------------------*/
    /*|Settings for Office                                                  */
    /*----------------------------------------------------------------------*/
    public function add_office()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_office->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','कार्यालयको नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_office->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("office");
        }
        $data['states']  = $this->Mdl_state->getAll();
        $data['districts']  = $this->Mdl_district->getAll();
        $data['locals']  = $this->Mdl_local_body->getAll();
        $data['wards']  = $this->Mdl_ward->getAll();
        $data['offices'] = $this->Mdl_office->getAll();
        $data1['title'] = "Settings | Office";
        $this->load->view("User/header",$data1);
        $this->load->view("office",$data);


    }

    public function view_office()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['states']  = $this->Mdl_state->getAll();
        $data['districts']  = $this->Mdl_district->getAll();
        $data['locals']  = $this->Mdl_local_body->getAll();
        $data['wards']  = $this->Mdl_ward->getAll();
        $data['offices'] = $this->Mdl_office->getAll();
        $data1['title']  = "Settings | Office";
        $this->load->view("User/header",$data1);
        $this->load->view("office",$data);


    }
    public function delete_office()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_office->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("office");
        }
    }
   public function getOffice($id)
   {
       return $this->Mdl_office->getById($id);
   }

   public function addOfficeJSON()
   {
       $save['name']    = $_POST['office'];
       $save['address'] = $_POST['address'];
       $save['sambodhan'] = $_POST['sambodhan'];
       $res = [];
       if($id = $this->Mdl_office->save($save))
       {
           $res['msg'] = "TRUE";
           $offices = $this->Mdl_office->getAll();
           $html = '<option value="">छान्नुहोस्</option>';
           foreach($offices as $office):
               $html .= '<option value="'.$office->id.'" >'.$office->name.'</option>';
           endforeach;
           $res['html'] = $html;
           $res['insert_id'] = $id;
           echo json_encode($res);
           die();
       }
       else {
           $res['msg'] = "FALSE";
           echo json_encode($res);
           die();
       }
   }
    /*----------------------------------------------------------------------*/
    /*|Settings for State                                                 */
    /*----------------------------------------------------------------------*/
    public function add_state()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_state->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','प्रदेशको नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_state->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("state");
        }
        $data['states'] = $this->Mdl_state->getAll();
        $data1['title'] = "Settings | State";
        $this->load->view("User/header",$data1);
        $this->load->view("state",$data);


    }

    public function view_state()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['states'] = $this->Mdl_state->getAll();
        $data1['title']  = "Settings | State";
        $this->load->view("User/header",$data1);
        $this->load->view("state",$data);


    }
    public function delete_state()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_state->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("state");
        }
    }
    public function getState($id)
    {
        return $this->Mdl_state->getById($id);
    }
    /*--------------------------------------------------------------------------------------
    |   Settings for District
    |---------------------------------------------------------------------------------------*/
    public function add_district()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_district->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','जिल्लाको नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_district->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("district");
        }
        $data['districts'] = $this->Mdl_district->getAll();
        $data1['title'] = "Settings | District";
        $this->load->view("User/header",$data1);
        $this->load->view("district",$data);


    }

    public function view_district()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['districts'] = $this->Mdl_district->getAll();
        $data1['title']  = "Settings | District";
        $this->load->view("User/header",$data1);
        $this->load->view("district",$data);


    }
    public function delete_district()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_district->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("district");
        }
    }
    public function getDistrict($id)
    {
        return $this->Mdl_district->getById($id);
    }

    public function getdistrictHTML()
    {
        $res= array();
        $state = $_POST['state'];
        $id    = $_POST['id'];
        $html='';
        $result = $this->Mdl_district->getAllByState($state);
        $html .="<option value=''>जिल्ला</option>";
        foreach($result as $data):
         $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
        endforeach;
        $res['html']= $html;
        echo json_encode($res);
    }
    /*--------------------------------------------------------------------------------------
    |   Settings for Local Body
    |---------------------------------------------------------------------------------------*/
    public function add_local()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_local_body->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','गा.वि.स./न.पा. को नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_local_body->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("local");
        }
        $data['locals'] = $this->Mdl_local_body->getAll();
        $data1['title'] = "Settings | Local Body";
        $this->load->view("User/header",$data1);
        $this->load->view("local_body",$data);


    }

    public function view_local()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['locals']     = $this->Mdl_local_body->getAll();
        $data1['title']     = "Settings | Local Body";
        $this->load->view("User/header",$data1);
        $this->load->view("local_body",$data);


    }
    public function delete_local()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_local_body->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("local");
        }
    }
    public function getLocal($id)
    {
        return $this->Mdl_local_body->getById($id);
    }
    public function getlocalbodyHTML()
    {
        $res= array();
        $district = $_POST['district'];
        $id    = $_POST['id'];
        $html='';
        $result = $this->Mdl_local_body->getAllByDistrict($district);
        $html .="<option value=''>गा.वि.स./न.पा </option>";
        foreach($result as $data):
         $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
        endforeach;

        $res['html']= $html;
        echo json_encode($res);
    }
    /*--------------------------------------------------------------------------------------
    |   Settings for Ward
    |---------------------------------------------------------------------------------------*/
    public function add_ward()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_ward->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','वडा नं.','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_ward->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("ward");
        }
        $data['wards'] = $this->Mdl_ward->getAll();
        $data1['title'] = "Settings | Ward No.";
        $this->load->view("User/header",$data1);
        $this->load->view("ward",$data);


    }

    public function view_ward()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['wards']     = $this->Mdl_ward->getAll();
        $data1['title']     = "Settings | Ward No.";
        $this->load->view("User/header",$data1);
        $this->load->view("ward",$data);


    }
    public function delete_ward()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_ward->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("ward");
        }
    }
    public function getWard($id)
    {
        return $this->Mdl_ward->getById($id);
    }

    /*--------------------------------------------------------------------------------------
   |   Settings for Disable Nature Type
   |---------------------------------------------------------------------------------------*/
   public function add_disable_type()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
        if(!empty($this->uri->segment(2)))
       {
           $id = $this->uri->segment(2);
           $data['result'] = $this->Mdl_disable_type->getById($id);
       }
       else
       {
           $id = 0;
       }
       $user = Modules::run("User/getUser");
       if(isset($_POST['submit']))
       {
           unset($data['result']);
           unset($_POST['submit']);
           $this->form_validation->set_rules('name','अपाङ्ग','required');
           if ($this->form_validation->run() == FALSE)
           {
               $this->session->set_flashdata('msg', validation_errors());
               redirect("disable-type");
           }
           if($this->Mdl_disable_type->save_data($this->input->post(),$id))
           {
               if($id != 0)
               {
                   $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
               }
               else
               {
                   $this->session->set_flashdata('msg', 'थप गर्न सफल');
               }
           }
           else
           {
               $this->session->set_flashdata('err_msg', 'समस्या आयो');
           }
           redirect("disable-type");
       }
       $data['disables'] = $this->Mdl_disable_type->getAll();
       $data1['title'] = "Settings | अपाङ्गको किसिम";
       $this->load->view("User/header",$data1);
       $this->load->view("disable_type",$data);


   }

   public function view_disable_type()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       $data['disables']     = $this->Mdl_disable_type->getAll();
       $data1['title'] = "Settings | अपाङ्गको किसिम";
       $this->load->view("User/header",$data1);
       $this->load->view("disable_type",$data);


   }
   public function delete_disable_type()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       if(!empty($this->uri->segment(2)))
       {
           $id = $this->uri->segment(2);
           if($this->Mdl_disable_type->delete($id))
           {
               $this->session->set_flashdata('msg', 'हटाउन सफल');
           }
           else
           {
               $this->session->set_flashdata('err_msg', 'समस्या आयो');
           }
           redirect("disable-type");
       }
   }
   public function getDisableType($id)
   {
       return $this->Mdl_disable_type->getById($id);
   }
   /*--------------------------------------------------------------------------------------
  |   Settings for Disable severity Type
  |---------------------------------------------------------------------------------------*/
  public function add_disable_severity()
  {
      if(Modules::run("User/is_logged_in") === FALSE)
      {
          redirect("login");
      }
       if(!empty($this->uri->segment(2)))
      {
          $id = $this->uri->segment(2);
          $data['result'] = $this->Mdl_disable_severity->getById($id);
      }
      else
      {
          $id = 0;
      }
      $user = Modules::run("User/getUser");
      if(isset($_POST['submit']))
      {
          unset($data['result']);
          unset($_POST['submit']);
          $this->form_validation->set_rules('name','अपाङ्ग','required');
          if ($this->form_validation->run() == FALSE)
          {
              $this->session->set_flashdata('msg', validation_errors());
              redirect("disable-severity");
          }
          if($this->Mdl_disable_severity->save_data($this->input->post(),$id))
          {
              if($id != 0)
              {
                  $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
              }
              else
              {
                  $this->session->set_flashdata('msg', 'थप गर्न सफल');
              }
          }
          else
          {
              $this->session->set_flashdata('err_msg', 'समस्या आयो');
          }
          redirect("disable-severity");
      }
      $data['disables'] = $this->Mdl_disable_severity->getAll();
      $data1['title'] = "Settings | अपाङ्गको गम्भिरता";
      $this->load->view("User/header",$data1);
      $this->load->view("disable_severity_page",$data);


  }

  public function view_disable_severity()
  {
      if(Modules::run("User/is_logged_in") === FALSE)
      {
          redirect("login");
      }
      $data['disables']     = $this->Mdl_disable_severity->getAll();
      $data1['title'] = "Settings | अपाङ्गको गम्भिरता";
      $this->load->view("User/header",$data1);
      $this->load->view("disable_severity_page",$data);


  }
  public function delete_disable_severity()
  {
      if(Modules::run("User/is_logged_in") === FALSE)
      {
          redirect("login");
      }
      if(!empty($this->uri->segment(2)))
      {
          $id = $this->uri->segment(2);
          if($this->Mdl_disable_severity->delete($id))
          {
              $this->session->set_flashdata('msg', 'हटाउन सफल');
          }
          else
          {
              $this->session->set_flashdata('err_msg', 'समस्या आयो');
          }
          redirect("disable-severity");
      }
  }
  public function getDisableSeverity($id)
  {
      return $this->Mdl_disable_severity->getById($id);
  }
  /*|-------------------------------------------------------------------------------------
      |   Settings for SessionYear
      |---------------------------------------------------------------------------------------*/
       public function add_session()
       {
           if(Modules::run("User/is_logged_in") === FALSE)
           {
               redirect("login");
           }
           if(!empty($this->uri->segment(2)))
           {
               $id = $this->uri->segment(2);
               $data['result'] = $this->Mdl_session->getById($id);
           }
           else
           {
               $id = 0;
           }
           $user = Modules::run("User/getUser");
           if(isset($_POST['submit']))
           {
               unset($data['result']);
               unset($_POST['submit']);
               $this->form_validation->set_rules('name','आर्थिक वर्ष','required');
               if ($this->form_validation->run() == FALSE)
               {
                   $this->session->set_flashdata('msg', validation_errors());
                   redirect("session");
               }
               if($this->Mdl_session->save_data($this->input->post(),$id))
               {
                   if($id != 0)
                   {
                       $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                   }
                   else
                   {
                       $this->session->set_flashdata('msg', 'थप गर्न सफल');
                   }
               }
               else
               {
                   $this->session->set_flashdata('err_msg', 'समस्या आयो');
               }
               redirect("session");
           }
           $data['current_session'] = $this->Mdl_session->getCurrentSession();
           $data['sessions'] = $this->Mdl_session->getAll();
           $data1['title']     = "Settings | आर्थिक वर्ष";
           $this->load->view("User/header",$data1);
           $this->load->view("session",$data);


       }

       public function view_session()
       {
           if(Modules::run("User/is_logged_in") === FALSE)
           {
               redirect("login");
           }
           $data['current_session'] = $this->Mdl_session->getCurrentSession();
           $data['sessions'] = $this->Mdl_session->getAll();
           $data1['title'] = "Settings | आर्थिक वर्ष";
           $this->load->view("User/header",$data1);
           $this->load->view("session",$data);


       }
       public function delete_session()
       {
           if(Modules::run("User/is_logged_in") === FALSE)
           {
               redirect("login");
           }
           if(!empty($this->uri->segment(2)))
           {
               $id = $this->uri->segment(2);
               if($this->Mdl_session->delete($id))
               {
                   $this->session->set_flashdata('msg', 'हटाउन सफल');
               }
               else
               {
                   $this->session->set_flashdata('err_msg', 'समस्या आयो');
               }
               redirect("session");
           }
       }
       public function getSession($id)
       {
           return $this->Mdl_session->getById($id);
       }

       public function getCurrentSession()
       {
           return $this->Mdl_session->getCurrentSession();
       }

       public function update_current_session()
       {
           if(Modules::run("User/is_logged_in") === FALSE)
           {
               redirect("login");
           }
           if(isset($_POST['submit']))
           {
               $this->form_validation->set_rules('session_id',"आर्थिक वर्ष",'required');
               if ($this->form_validation->run() == FALSE)
               {
                   $this->session->set_flashdata('err_msg', validation_errors());
                   redirect("session");
               }
               else
               {
                   $current_session     = $this->Mdl_session->getCurrentSession();
                   $old['is_current']   = 0;
                   $this->Mdl_session->update($current_session->id,$old);
                   $session_id          = $this->input->post('session_id');
                   $new['is_current']   = 1;
                   if($this->Mdl_session->update($session_id,$new))
                   {
                       $this->session->set_flashdata('msg','आर्थिक वर्ष अपडेट गर्न सफल |');
                       redirect(base_url().'session');
                   }
               }
           }
        }
 /*|-------------------------------------------------------------------------------------
     |   Settings for  Karmachari Post
     |---------------------------------------------------------------------------------------*/
      public function add_post()
      {
          if(Modules::run("User/is_logged_in") === FALSE)
          {
              redirect("login");
          }
          if(!empty($this->uri->segment(2)))
          {
              $id = $this->uri->segment(2);
              $data['result'] = $this->Mdl_post->getById($id);
          }
          else
          {
              $id = 0;
          }
          $user = Modules::run("User/getUser");
          if(isset($_POST['submit']))
          {
              unset($data['result']);
              unset($_POST['submit']);
              $this->form_validation->set_rules('name','पद','required');
              if ($this->form_validation->run() == FALSE)
              {
                  $this->session->set_flashdata('msg', validation_errors());
                  redirect("post");
              }
              if($this->Mdl_post->save_data($this->input->post(),$id))
              {
                  if($id != 0)
                  {
                      $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                  }
                  else
                  {
                      $this->session->set_flashdata('msg', 'थप गर्न सफल');
                  }
              }
              else
              {
                  $this->session->set_flashdata('err_msg', 'समस्या आयो');
              }
              redirect("post");
          }
          $data['posts'] = $this->Mdl_post->getAll();
          $data1['title']     = "Settings | पद";
          $this->load->view("User/header",$data1);
          $this->load->view("post",$data);


      }

      public function view_post()
      {
          if(Modules::run("User/is_logged_in") === FALSE)
          {
              redirect("login");
          }
          $data['posts'] = $this->Mdl_post->getAll();
          $data1['title'] = "Settings | पद";
          $this->load->view("User/header",$data1);
          $this->load->view("post",$data);


      }
      public function getPost($id)
      {
          return $this->Mdl_post->getById($id);
      }
  /*|-------------------------------------------------------------------------------------
    |   Settings for Worker
    |---------------------------------------------------------------------------------------*/
     public function add_worker()
     {
         if(Modules::run("User/is_logged_in") === FALSE)
         {
             redirect("login");
         }
         if(!empty($this->uri->segment(2)))
         {
             $id = $this->uri->segment(2);
             $data['result'] = $this->Mdl_worker->getById($id);
         }
         else
         {
             $id = 0;
         }
         $user = Modules::run("User/getUser");
         if(isset($_POST['submit']))
         {
             unset($data['result']);
             unset($_POST['submit']);
             $this->form_validation->set_rules('name','कर्मचारी','required');
             $this->form_validation->set_rules('department_id','फाँट','required');
             $this->form_validation->set_rules('post_id','पद','required');
             if ($this->form_validation->run() == FALSE)
             {
                 $this->session->set_flashdata('msg', validation_errors());
                 redirect("worker");
             }
             if($this->Mdl_worker->save_data($this->input->post(),$id))
             {
                 if($id != 0)
                 {
                     $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                 }
                 else
                 {
                     $this->session->set_flashdata('msg', 'थप गर्न सफल');
                 }
             }
             else
             {
                 $this->session->set_flashdata('err_msg', 'समस्या आयो');
             }
             redirect("worker");
         }
         $data['departments'] = $this->Mdl_department->getAll();
         $data['posts']       = $this->Mdl_post->getAll();
         $data['workers'] = $this->Mdl_service->getAll();
         $data1['title']     = "Settings | कर्मचारी";
         $this->load->view("User/header",$data1);
         $this->load->view("worker",$data);


     }

     public function view_worker()
     {
         if(Modules::run("User/is_logged_in") === FALSE)
         {
             redirect("login");
         }
         $data['posts']       = $this->Mdl_post->getAll();
         $data['workers'] = $this->Mdl_worker->getAll();
         $data1['title'] = "Settings | कर्मचारी";
         $this->load->view("User/header",$data1);
         $this->load->view("worker",$data);


     }
     public function delete_worker()
     {
         if(Modules::run("User/is_logged_in") === FALSE)
         {
             redirect("login");
         }
         if(!empty($this->uri->segment(2)))
         {
             $id = $this->uri->segment(2);
             if($this->Mdl_worker->delete($id))
             {
                 $this->session->set_flashdata('msg', 'हटाउन सफल');
             }
             else
             {
                 $this->session->set_flashdata('err_msg', 'समस्या आयो');
             }
             redirect("worker");
         }
     }
     public function getWorker($id)
     {
         return $this->Mdl_worker->getById($id);
     }
     /*|-------------------------------------------------------------------------------------
       |   Settings for Blood Type
       |---------------------------------------------------------------------------------------*/
        public function add_blood_type()
        {
            if(Modules::run("User/is_logged_in") === FALSE)
            {
                redirect("login");
            }
            if(!empty($this->uri->segment(2)))
            {
                $id = $this->uri->segment(2);
                $data['result'] = $this->Mdl_blood_type->getById($id);
            }
            else
            {
                $id = 0;
            }
            $user = Modules::run("User/getUser");
            if(isset($_POST['submit']))
            {
                unset($data['result']);
                unset($_POST['submit']);
                $this->form_validation->set_rules('name','रक्त समूह','required');
                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('msg', validation_errors());
                    redirect("blood-type");
                }
                if($this->Mdl_blood_type->save_data($this->input->post(),$id))
                {
                    if($id != 0)
                    {
                        $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                    }
                    else
                    {
                        $this->session->set_flashdata('msg', 'थप गर्न सफल');
                    }
                }
                else
                {
                    $this->session->set_flashdata('err_msg', 'समस्या आयो');
                }
                redirect("blood-type");
            }
            $data1['title']     = "Settings | रक्त समूह";
            $this->load->view("User/header",$data1);
            $this->load->view("blood_type_page",$data);


        }

        public function view_blood_type()
        {
            if(Modules::run("User/is_logged_in") === FALSE)
            {
                redirect("login");
            }
            $data['blood_types'] = $this->Mdl_blood_type->getAll();
            $data1['title'] = "Settings | रक्त समूह";
            $this->load->view("User/header",$data1);
            $this->load->view("blood_type_page",$data);


        }
        public function delete_blood_type()
        {
            if(Modules::run("User/is_logged_in") === FALSE)
            {
                redirect("login");
            }
            if(!empty($this->uri->segment(2)))
            {
                $id = $this->uri->segment(2);
                if($this->Mdl_blood_type->delete($id))
                {
                    $this->session->set_flashdata('msg', 'हटाउन सफल');
                }
                else
                {
                    $this->session->set_flashdata('err_msg', 'समस्या आयो');
                }
                redirect("blood-type");
            }
        }
        public function getBloodType($id)
        {
            return $this->Mdl_blood_type->getById($id);
        }
    /*|-------------------------------------------------------------------------------------
       |   Settings for Pramanit Garne
       |---------------------------------------------------------------------------------------*/
    public function add_pramanit_garne()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_pramanit_garne->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','प्रमाणित गर्नेको नाम','required');
            $this->form_validation->set_rules('post','प्रमाणित गर्नेको पद','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
                redirect("pramanit-garne");
            }
            if($this->Mdl_pramanit_garne->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("pramanit-garne");
        }
        $data1['title']     = "Settings | प्रमाणित गर्ने";
        $data['persons'] = $this->Mdl_pramanit_garne->getAll();
        $this->load->view("User/header",$data1);
        $this->load->view("pramanit_garne_form",$data);


    }

    public function view_pramanit_garne()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['persons'] = $this->Mdl_pramanit_garne->getAll();
        $data1['title'] = "Settings | प्रमाणित गर्ने";
        $this->load->view("User/header",$data1);
        $this->load->view("pramanit_garne_form",$data);


    }
    public function delete_pramanit_garne()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_pramanit_garne->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("pramanit-garne");
        }
    }
    public function getPramanitGarne($id)
    {
        return $this->Mdl_pramanit_garne->getById($id);
    }
}
