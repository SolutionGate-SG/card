<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_user');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function index()
    {
        if($this->is_logged_in() === FALSE)
        {
            redirect('login');
        }
        $data['title'] = "Dashboard";
        $this->load->view('header',$data);
        $this->load->view('dashboard');
        $this->load->view('footer');
    }

    /*-----------------------------------Login--------------------------------------------------*/
   public function login()
    {
        if(isset($_POST['submit']))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user =$this->Mdl_user->check_login($username);
            if($user)
            {
                if(password_verify($password, $user->password))
                {
                    $this_ward = Modules::run('Settings/getWard',$user->ward);
                    $user_data = array(
                        'id'        => $user->id,
                        'username'  => $user->username,
                        'mode'      => $user->mode,
                        'phone'     => $user->phone,
                        'email'     => $user->email,
                        'address'   => $user->address,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('msg', 'Login Successfull');
                    redirect('index');
                }
                else
                {
                    $this->session->set_flashdata('err_msg', 'Username and Password mismatched');
                    redirect('login');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Username not found');
                redirect('login');

            }
        }
        $data['title'] = "Login";
        $this->load->view("userheader",$data);
        $this->load->view('login');
        $this->load->view("footer");
    }
    /*-----------------------------------Check Login--------------------------------------------------*/
    public function is_logged_in()
    {
        $user_data = ['id','username','mode','logged_in'];
        if($this->session->userdata('logged_in') != TRUE)
        {
            $this->session->unset_userdata($user_data);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    /*-----------------------------------Log Out--------------------------------------------------*/
     public function logout()
    {
        $user_data = ['id','username','mode','email','ward','phone','address','logged_in'];
        $this->session->unset_userdata($user_data);
        redirect('login');
    }
    /*-----------------------------------Register and Change Password--------------------------------------------------*/
    public function register()
    {
       if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('name','Full Name','required');
            $this->form_validation->set_rules('repassword','Re-Password','required');
            $this->form_validation->set_rules('phone','Phone Number','required');

            $this->form_validation->set_rules('mode','User Mode','required');
            if ($this->form_validation->run() == FALSE)
             {
                 $this->session->set_flashdata('err_msg', validation_errors());
                 redirect('register');

             }
             else
             {
                 if($this->input->post('password')!= $this->input->post('repassword'))
                {
                    $this->session->set_flashdata('err_msg', 'Password Mismatched');
                    redirect('register');
                }
                $data['name']        = $this->input->post('name');
                $data['username']    = $this->input->post('username');
                $data['password']    = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                $data['address']     = $this->input->post('address');
                 $data['phone']      = $this->input->post('phone');
                 $data['email']      = $this->input->post('email');
                 $data['mode']       = $this->input->post('mode');
                $data['created_at']  = date('Y-m-d H:i:sa');
                if ($this->Mdl_user->save($data))
                {
                    $this->session->set_flashdata('msg', 'Registered Succesfull');
                    redirect('register');
                }


            }
        }
        $header['title'] = 'Register';
        $this->load->view('userheader',$header);
        $this->load->view('register',$send);
        $this->load->view('footer');
    }
    /*-----------------------------------Change Password----------------------------------------------------------------*/
    public function change_password()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('old_password','Old Password','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('confirm','Re-Password','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg',validation_errors());
            }
            else
            {
                if($_POST['password']!= $_POST['confirm'])
                {
//                    echo alertBox("Password Mismatched","change_password");
                    $this->session->set_flashdata('err_msg', 'Password Mismatched');
                    redirect('change-password');
                }
                $old_password       = password_hash($this->input->post('old_password'), PASSWORD_BCRYPT);
                $data['password']   = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                $user = $this->getUser();
                if ($user)
                {
                    if (password_verify($this->input->post('old_password'),$user->password))
                    {
                        $this->Mdl_user->update($user->id,$data);
                        $user_data = array(
                            'id'        => $user->id,
                            'username'  => $user->username,
                            'mode'      => $user->mode,
                            'ward_no'   => $user->ward,
                            'phone'     => $user->phone,
                            'email'     => $user->email,
                            'address'   => $user->address,
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($user_data);
                        $this->session->set_flashdata('msg', 'Password Changed Successfully');
                        redirect('change-password');
                    }
                    else
                    {
                        $this->session->set_flashdata('err_msg', 'Old Password did not match');
                        redirect('change-password');
                    }
                }
                else
                {
                    $this->session->set_flashdata('err_msg', 'User not found');
                    redirect('change-password');
                }
            }
        }
        $header['title'] = 'User | Change Password';
        $this->load->view('header',$header);
        $this->load->view('change_password');
        $this->load->view('footer');
    }
    /*----------------------------------- All User View----------------------------------------------------------------*/
    public function user_view()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("logout");
        }
        $usermode = $this->session->userdata('mode');
        if($usermode != "superadmin")
        {
            redirect('index');
        }
        $send['users']      = $this->Mdl_user->getAll();
        $header['title']    = 'Users';
        $this->load->view('header',$header);
        $this->load->view('user_view_page',$send);
        $this->load->view('footer');
    }
    /*-----------------------------------Get User----------------------------------------------------------------*/
    public function getUser($id = '')
    {
        if(empty($id))
        {
             $id     = $this->session->userdata('id');
        }

        $user   = $this->Mdl_user->getById($id);
        return $user;

    }
    /*----------------------------------------Get User Mode---------------------------------------------------------*/
    public function getUserMode()
    {
        $mode = $this->session->userdata('mode');
        return $mode;

    }
    /*------------------------------------------------------------------------------------------------------------------*/

}
