<?php

namespace App\Controllers;
!defined('BASEPATH') OR exit('No direct script access aloowed');

use CodeIgniter\Controller;
use App\Models\Kpi_model;
use Config\Session;
helper(['custom_helper']);

class Kpi extends Controller
{
    protected $kpi_model;
    protected $session_user;
    protected $denpasar_cluster_array;
    protected $kupang_cluster_array;
    protected $flores_cluster_array;
    protected $mataram_cluster_array;

    function __construct()
    {
        $this->kpi_model = new Kpi_model();
        $this->session_user = session();
        
        $this->denpasar_cluster_array = array('BALI BARAT','BALI TENGAH','BALI TIMUR');
        $this->flores_cluster_array = array('ENDE SIKKA','FLORES TIMUR','MANGGARAI');
        $this->kupang_cluster_array = array('KUPANG ROTE','MALAKA TIMTIM BELU','SUMBA');
        $this->mataram_cluster_array = array('LOMBOK','SUMBAWA BARAT','SUMBAWA TIMUR');
    }
    
    /*public function index()
    {
        $session = Session();
        
        $user_level = $session->get("user_level");
        $qry_latest_update_date = $this->kpi_model->get_lastupdate_date();
        $raw_update_date = $qry_latest_update_date[0]['last_update_date'];
        $exp_update_date = explode("-",$raw_update_date);
        $periode_default = "'".$exp_update_date[0]."-".$exp_update_date[1]."-%'";
        $periode_default_display = $exp_update_date[0]."".$exp_update_date[1];

        if($user_level == "admin"){
            if($this->request->getPost('btn_submit_periode_kip_admin')){
                $periode = $this->request->getPost('periode_data_kpi_admin');
                $split_periode = str_split($periode,4);
                $periode_submit = "'".$split_periode[0]."-".$split_periode[1]."-%'";
                $get_table_info = $this->kpi_model->cek_data_kpi_exists($periode_submit);
                
                if($get_table_info == 0){
                    $data['show_fd'] = 1;
                    $this->session_user->setFlashdata('table_not_exists','data periode '.$periode_submit.' tidak ditemukan');
                    $periode_used = $periode_default;
                    $where_var = "";
                }else{
                    $regional = $this->request->getPost('kpi_filter_regional_admin');
                    $branch = $this->request->getPost('kpi_filter_branch_admin');
                    $cluster = $this->request->getPost('kpi_filter_cluster_admin');
                    $data['show_fd'] = 0;

                    if(!isset($branch) && !isset($cluster) && !isset($regional)){
                        $where_var = "";
                    }else if(isset($regional) && isset($cluster)){
                        $where_var = "AND (regional = '".$regional."' AND branch = '".$branch."' AND cluster = '".$cluster."')";
                    }else if(isset($branch) && !isset($cluster)){
                        $where_var = "AND (regional = '".$regional."' AND branch = '".$branch."')";
                    }else{
                        $where_var = "AND regional = '".$regional."'";
                    }

                    $periode_used = $periode_submit;
                }
            }else{
                $periode_used = $periode_default;
                $regional = "";
                $branch = "";
                $cluster = "";
                $where_var = "";

                $data['show_fd'] = 0;
            }

            $data['regional_hidden'] = $regional;
            $data['branch_hidden'] = $branch;
            $data['cluster_hidden'] = $cluster;
            $data['last_update_date'] = $raw_update_date;
            $data['display_periode'] = $periode_default_display;

            $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_used,$where_var);
            $data['kpi_lb_dps'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"DENPASAR");
            $data['kpi_lb_fls'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"FLORES");
            $data['kpi_lb_kpg'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"KUPANG");
            $data['kpi_lb_mtr'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"MATARAM");
            $data['kpi_lb_mgl'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"MAGELANG");
            $data['kpi_lb_pkl'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"PEKALONGAN");
            $data['kpi_lb_pwo'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"PURWOKERTO");
            $data['kpi_lb_smg'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"SEMARANG");
            $data['kpi_lb_jbr'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"JEMBER");
            $data['kpi_lb_lmn'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"LAMONGAN");
            $data['kpi_lb_mdn'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"MADIUN");
            $data['kpi_lb_mlg'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"MALANG");
            $data['kpi_lb_sdo'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"SIDOARJO");
            $data['kpi_lb_sby'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"SURABAYA");
            $data['kpi_lb_area3'] = $this->kpi_model->get_kpi_lb_branch($periode_used,"AREA 3");
            return view('kpi_admin_page',$data);
        }else if($user_level == "agent_branch"){
            $agent_id = $session->get("agent_id");
            $agent_branch = $session->get("branch");

            if($this->request->getPost('btn_submit_periode_kpi_agent')){
                $periode = $this->request->getPost('periode_data_kpi_agent');
                $split_periode = str_split($periode,4);
                $periode_submit = "'".$split_periode[0]."-".$split_periode[1]."-%'";

                $get_table_info = $this->kpi_model->cek_data_kpi_exists($periode_submit);
                
                if($get_table_info == 0){
                    $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_default,"");
                    $data['show_fd'] = 1;
                    $this->session_user->setFlashdata('table_not_exists','data periode '.$periode.' tidak ditemukan');

                    $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode_default,$agent_branch);
                    $periode_used = $periode_default;
                    $periode_display = $periode_default_display;
                }else{
                    $data['show_fd'] = 0;
                    $periode_used = $periode_submit;
                    $periode_display = $periode;
                }

                $branch = $agent_branch;
                $cluster = $this->request->getPost('kpi_filter_cluster_agent');

                if(!isset($cluster)){
                    $where_var = "AND branch = '".$branch."'";
                }else{
                    $where_var = "AND (branch = '".$branch."' AND cluster = '".$cluster."')";
                }

                $data['hidden_cluster'] = $cluster;
                $data['last_update_date'] = $raw_update_date;
                $data['display_periode'] = $periode_display;

                $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_used,$where_var);
                $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode_used,$agent_branch);
            }else{
                $data['show_fd'] = 0;
                $data['last_update_date'] = $raw_update_date;
                $data['display_periode'] = $exp_update_date[0]."".$exp_update_date[1];
                $data['hidden_cluster'] = "";
                $where_var = "AND branch = '".$agent_branch."'";
                
                $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_default,$where_var);
                $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode_default,$agent_branch);
            }

            $data['agent_id'] = $agent_id;
            $data['agent_branch'] = $agent_branch;
            $data['user_level'] = $user_level;
            
            return view('kpi_agent_page',$data);
        }else if($user_level == "agent_cluster"){
            $agent_id = $session->get("agent_id");
            $agent_branch = $session->get("branch");
            $agent_cluster = $session->get("cluster");

            if($this->request->getPost('btn_submit_periode_kpi_agent')){
                $periode = $this->request->getPost('periode_data_kpi_agent');
                $split_periode = str_split($periode,4);
                $periode_submit = "'".$split_periode[0]."-".$split_periode[1]."-%'";

                $get_table_info = $this->kpi_model->cek_data_kpi_exists($periode_submit);
                
                if($get_table_info == 0){
                    $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_default,"");
                    $data['show_fd'] = 1;
                    $this->session_user->setFlashdata('table_not_exists','data periode '.$periode.' tidak ditemukan');

                    $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode_default,$agent_branch);
                    $periode_used = $periode_default;
                    $periode_display = $periode_default_display;
                }else{
                    $data['show_fd'] = 0;
                    $periode_used = $periode_submit;
                    $periode_display = $periode;
                }

                $branch = $agent_branch;
                $where_var = "AND cluster = '".$agent_cluster."'";
               
                $data['hidden_cluster'] = $agent_cluster;
                $data['last_update_date'] = $raw_update_date;
                $data['display_periode'] = $periode_display;

                $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_used,$where_var);
                $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode_used,$agent_branch);
            }else{
                $data['last_update_date'] = $raw_update_date;
                $data['display_periode'] = $exp_update_date[0]."".$exp_update_date[1];
                $data['hidden_cluster'] = $agent_cluster;
                $where_var = "AND cluster = '".$agent_cluster."'";
                $data['show_fd'] = 0;

                $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_default,$where_var);
                $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode_default,$agent_branch);
            }

            $data['agent_id'] = $agent_id;
            $data['agent_branch'] = $agent_branch;
            $data['agent_cluster'] = $agent_cluster;
            $data['user_level'] = $user_level;

            return view('kpi_agent_page',$data);
        }else if($user_level == "admin_cms"){
            return redirect()->to(base_url('/dashboard')); 
        }
    }*/
    
    public function index(){
        $latest_kpi_table = $this->kpi_model->get_latest_table_kpi();
        $exp_table_periode = explode("kpi_data_",$latest_kpi_table);
        $latest_periode = $exp_table_periode[1];
        
        $data['periode'] = $latest_periode;
        $data['result_kpi_data'] = $this->kpi_model->get_kpi_data_v2($latest_periode);

        return view('kpi_admin_page_v2',$data);
    }

    function download_data_agent_branch(){
        $session = Session();
        
        if($this->request->getPost('btn_dl_data_agent')){
            $periode = $this->request->getPost('hidden_periode_kpi');
            $branch = $session->get('branch');
            $cluster = $this->request->getPost('hidden_cluster');
        
            if(!isset($periode)){
                $qry_latest_update_date = $this->kpi_model->get_lastupdate_date();
                $raw_update_date = $qry_latest_update_date[0]['last_update_date'];
                $exp_update_date = explode("-",$raw_update_date);
                $periode_default = "'".$exp_update_date[0]."-".$exp_update_date[1]."-%'";
                if($cluster == ""){
                    $area = $branch;
                    $where_var = "AND branch = '".$branch."'";
                    $data_dl = $this->kpi_model->get_kpi_data($periode_default,$where_var);
                }else{
                    $area = $cluster;
                    $where_var = "AND cluster = '".$cluster."'";
                    $data_dl = $this->kpi_model->get_kpi_data($periode_default,$where_var);
                }
            }else{
                $split_periode = str_split($periode,4);
                $periode_submit = "'".$split_periode[0]."-".$split_periode[1]."-%'";
                if($cluster == ""){
                    $area = $branch;
                    $where_var = "AND branch = '".$branch."'";
                    $data_dl = $this->kpi_model->get_kpi_data($periode_submit,$where_var);
                }else{
                    $area = $cluster;
                    $where_var = "AND cluster = '".$cluster."'";
                    $data_dl = $this->kpi_model->get_kpi_data($periode_submit,$where_var);
                }
            }

            $filename = 'DOWNLOAD KPI DATA '.$area.' '.$periode.'.csv'; 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$filename"); 
            header("Content-Type: application/csv; ");

            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array('regional','branch','cluster','city','agent_id','linkaja','dss_name','digipos_id','active_date','inactive_date','level_competition','city_war_profile','final_ach','runrate','class_may_23','class_jun_23','class','new_sales','so_target','so_actual','so_prepaid','so_byu','so_ach','so_runrate','so_bobot','imei_target','imei_actual','imei_prepaid','imei_byu','imei_ach','imei_runrate','imei_bobot','dt_target','dt_actual','dt_ach','dt_runrate',	'dt_bobot','mni_target','mni_actual','mni_ach','mni_runrate','mni_bobot','pb_sub_bobot','rsc_target','rsc_actual','rsc_ach','rsc_runrate','rsc_bobot','ep_plan','ep_target','ep_actual','ep_ach','ep_runrate','ep_bobot','cs_target','cs_actual','cs_ach','cs_runrate','cs_bobot','ob_sub_bobot');

            fputcsv($file, $header);

            foreach ($data_dl as $key=>$line){ 
                fputcsv($file,$line); 
            }
            fclose($file); 
            exit;
        }
    }

    function download_data_agent_cluster(){
        $session = Session();
        
        if($this->request->getPost('btn_dl_data_agent')){
            $periode = $this->request->getPost('hidden_periode_kpi');
            $cluster = $this->request->getPost('hidden_cluster');
        
            if($periode == ""){
                $qry_latest_update_date = $this->kpi_model->get_lastupdate_date();
                $raw_update_date = $qry_latest_update_date[0]['last_update_date'];
                $exp_update_date = explode("-",$raw_update_date);
                $periode_default = "'".$exp_update_date[0]."-".$exp_update_date[1]."-%'";
                
                $area = $cluster;
                $where_var = "AND cluster = '".$cluster."'";
                $data_dl = $this->kpi_model->get_kpi_data($periode_default,$where_var);
                
            }else{
                $split_periode = str_split($periode,4);
                $periode_submit = "'".$split_periode[0]."-".$split_periode[1]."-%'";
                
                $area = $cluster;
                $where_var = "AND cluster = '".$cluster."'";
                $data_dl = $this->kpi_model->get_kpi_data($periode_submit,$where_var);
            }

            $filename = 'DOWNLOAD KPI DATA '.$area.' '.$periode.'.csv'; 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$filename"); 
            header("Content-Type: application/csv; ");

            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array('regional','branch','cluster','city','agent_id','linkaja','dss_name','digipos_id','active_date','inactive_date','level_competition','city_war_profile','final_ach','runrate','class_may_23','class_jun_23','class','new_sales','so_target','so_actual','so_prepaid','so_byu','so_ach','so_runrate','so_bobot','imei_target','imei_actual','imei_prepaid','imei_byu','imei_ach','imei_runrate','imei_bobot','dt_target','dt_actual','dt_ach','dt_runrate',	'dt_bobot','mni_target','mni_actual','mni_ach','mni_runrate','mni_bobot','pb_sub_bobot','rsc_target','rsc_actual','rsc_ach','rsc_runrate','rsc_bobot','ep_plan','ep_target','ep_actual','ep_ach','ep_runrate','ep_bobot','cs_target','cs_actual','cs_ach','cs_runrate','cs_bobot','ob_sub_bobot');

            fputcsv($file, $header);

            foreach ($data_dl as $key=>$line){ 
                fputcsv($file,$line); 
            }
            fclose($file); 
            exit;
        }
    }

    function download_data_admin(){
        if($this->request->getPost('btn_dl_data_admin')){
            $periode = $this->request->getPost('periode_data_kpi_admin');
            $regional = $this->request->getPost('regional_hidden');
            $branch = $this->request->getPost('branch_hidden');
            $cluster = $this->request->getPost('cluster_hidden');
            
            if(!isset($periode)){
                $qry_latest_update_date = $this->kpi_model->get_lastupdate_date();
                $raw_update_date = $qry_latest_update_date[0]['last_update_date'];
                $exp_update_date = explode("-",$raw_update_date);
                $periode_used = "'".$exp_update_date[0]."-".$exp_update_date[1]."-%'";
            }else{
                $split_periode = str_split($periode,4);
                $periode_used = "'".$split_periode[0]."-".$split_periode[1]."-%'";
            }

            if($branch == "" && $cluster == "" && $regional == ""){
                $where_var = "";
            }else if($branch == "" && $cluster == ""){
                $where_var = "AND regional = '".$regional."'";
            }else if($cluster == ""){
                $where_var = "AND regional = '".$regional."' AND branch = '".$branch."'";
            }else{
                $where_var = "AND regional = '".$regional."' AND branch = '".$branch."' AND cluster = '".$cluster."'";
            }

            $data_dl = $this->kpi_model->get_kpi_data($periode_used,$where_var);
            
            $filename = 'DOWNLOAD KPI DATA '.$periode.'.csv'; 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$filename"); 
            header("Content-Type: application/csv; ");

            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array('regional','branch','cluster','city','agent_id','linkaja','dss_name','digipos_id','active_date','inactive_date','level_competition','city_war_profile','final_ach','runrate','class_may_23','class_jun_23','class','new_sales','so_target','so_actual','so_prepaid','so_byu','so_ach','so_runrate','so_bobot','imei_target','imei_actual','imei_prepaid','imei_byu','imei_ach','imei_runrate','imei_bobot','dt_target','dt_actual','dt_ach','dt_runrate',	'dt_bobot','mni_target','mni_actual','mni_ach','mni_runrate','mni_bobot','pb_sub_bobot','rsc_target','rsc_actual','rsc_ach','rsc_runrate','rsc_bobot','ep_plan','ep_target','ep_actual','ep_ach','ep_runrate','ep_bobot','cs_target','cs_actual','cs_ach','cs_runrate','cs_bobot','ob_sub_bobot');

            fputcsv($file, $header);

            foreach ($data_dl as $key=>$line){ 
                fputcsv($file,$line); 
            }
            fclose($file); 
            exit;
        }
    }
        
}
