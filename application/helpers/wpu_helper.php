<?php
    function is_logged_in()

    {
       $ci=  get_instance();
        if(!$ci->session->userdata('username')){
            redirect('index.php/auth');
        }else{
            $role_id = $ci->session->userdata('id_role');
            $menu = $ci->uri->segment(1);

            $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

            $menu_id = $queryMenu['menu_id'];

            $userAcces = $ci->db->get_where('user_access_menu',[
                'id_role' => $role_id,
                'menu_id' => $menu_id
            ]);
            if($userAcces->num_rows() < 1) {
               redirect('index.php/auth/blocked');
            }




        }
    }



?>