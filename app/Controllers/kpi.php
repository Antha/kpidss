<?php

namespace App\Controllers;
!defined('BASEPATH') OR exit('No direct script access aloowed');

use CodeIgniter\Controller;
use App\Models\Kpi_model;
use Config\Session;

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
    
    public function index()
    {
        $session = Session();
        
        $user_level = $session->get("user_level");

        $get_table_info_default = $this->kpi_model->default_table_kpi_exists();
        $periode_default = explode("_",$get_table_info_default);
        $qry_latest_update_date = $this->kpi_model->get_lastupdate_date($periode_default[2]);
        $latest_update_date = $qry_latest_update_date[0]['last_update_date'];

        if($user_level == "admin"){
            if($this->request->getPost('btn_submit_periode_kip_admin')){
                $periode = $this->request->getPost('periode_data_kpi_admin');
                $get_table_info = $this->kpi_model->cek_table_kpi_exists($periode);
                
                if($get_table_info == 0){
                    $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_default[2],"");
                    $this->session_user->setFlashdata('table_not_exists','data periode '.$periode.' tidak ditemukan');

                    $data['kpi_lb_dps'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"DENPASAR");
                    $data['kpi_lb_fls'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"FLORES");
                    $data['kpi_lb_kpg'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"KUPANG");
                    $data['kpi_lb_mtr'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"MATARAM");
                    $data['kpi_lb_mgl'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"MAGELANG");
                    $data['kpi_lb_pkl'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"PEKALONGAN");
                    $data['kpi_lb_pwo'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"PURWOKERTO");
                    $data['kpi_lb_smg'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"SEMARANG");
                    $data['kpi_lb_jbr'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"JEMBER");
                    $data['kpi_lb_lmn'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"LAMONGAN");
                    $data['kpi_lb_mdn'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"MADIUN");
                    $data['kpi_lb_mlg'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"MALANG");
                    $data['kpi_lb_sdo'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"SIDOARJO");
                    $data['kpi_lb_sby'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"SURABAYA");
                    $data['kpi_lb_area3'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"AREA 3");
                }else{
                    $regional = $this->request->getPost('kpi_filter_regional_admin');
                    $branch = $this->request->getPost('kpi_filter_branch_admin');
                    $cluster = $this->request->getPost('kpi_filter_cluster_admin');

                    if(!isset($branch) && !isset($cluster) && !isset($regional)){
                        $where_var = "";
                    }else if(isset($regional) && isset($cluster)){
                        $where_var = "WHERE regional = '".$regional."' AND branch = '".$branch."' AND cluster = '".$cluster."'";
                    }else if(isset($branch) && !isset($cluster)){
                        $where_var = "WHERE regional = '".$regional."' AND branch = '".$branch."'";
                    }else{
                        $where_var = "WHERE regional = '".$regional."'";
                    }
                    $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode,$where_var);
                    $data['kpi_lb_dps'] = $this->kpi_model->get_kpi_lb_branch($periode,"DENPASAR");
                    $data['kpi_lb_fls'] = $this->kpi_model->get_kpi_lb_branch($periode,"FLORES");
                    $data['kpi_lb_kpg'] = $this->kpi_model->get_kpi_lb_branch($periode,"KUPANG");
                    $data['kpi_lb_mtr'] = $this->kpi_model->get_kpi_lb_branch($periode,"MATARAM");
                    $data['kpi_lb_mgl'] = $this->kpi_model->get_kpi_lb_branch($periode,"MAGELANG");
                    $data['kpi_lb_pkl'] = $this->kpi_model->get_kpi_lb_branch($periode,"PEKALONGAN");
                    $data['kpi_lb_pwo'] = $this->kpi_model->get_kpi_lb_branch($periode,"PURWOKERTO");
                    $data['kpi_lb_smg'] = $this->kpi_model->get_kpi_lb_branch($periode,"SEMARANG");
                    $data['kpi_lb_jbr'] = $this->kpi_model->get_kpi_lb_branch($periode,"JEMBER");
                    $data['kpi_lb_lmn'] = $this->kpi_model->get_kpi_lb_branch($periode,"LAMONGAN");
                    $data['kpi_lb_mdn'] = $this->kpi_model->get_kpi_lb_branch($periode,"MADIUN");
                    $data['kpi_lb_mlg'] = $this->kpi_model->get_kpi_lb_branch($periode,"MALANG");
                    $data['kpi_lb_sdo'] = $this->kpi_model->get_kpi_lb_branch($periode,"SIDOARJO");
                    $data['kpi_lb_sby'] = $this->kpi_model->get_kpi_lb_branch($periode,"SURABAYA");
                    $data['kpi_lb_area3'] = $this->kpi_model->get_kpi_lb_branch($periode,"AREA 3");
                }
                $data['regional_hidden'] = $regional;
                $data['branch_hidden'] = $branch;
                $data['cluster_hidden'] = $cluster;
                $data['last_update_date'] = $latest_update_date;
                $data['display_periode'] = $periode;
            }else{
                $data['last_update_date'] = $latest_update_date;
                $data['display_periode'] = $periode_default[2];
                
                $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_default[2],"");
                $data['kpi_lb_dps'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"DENPASAR");
                $data['kpi_lb_fls'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"FLORES");
                $data['kpi_lb_kpg'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"KUPANG");
                $data['kpi_lb_mtr'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"MATARAM");
                $data['kpi_lb_mgl'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"MAGELANG");
                $data['kpi_lb_pkl'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"PEKALONGAN");
                $data['kpi_lb_pwo'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"PURWOKERTO");
                $data['kpi_lb_smg'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"SEMARANG");
                $data['kpi_lb_jbr'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"JEMBER");
                $data['kpi_lb_lmn'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"LAMONGAN");
                $data['kpi_lb_mdn'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"MADIUN");
                $data['kpi_lb_mlg'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"MALANG");
                $data['kpi_lb_sdo'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"SIDOARJO");
                $data['kpi_lb_sby'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"SURABAYA");
                $data['kpi_lb_area3'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],"AREA 3");

                $regional="";
                $branch="";
                $cluster="";

                $data['regional_hidden'] = $regional;
                $data['branch_hidden'] = $branch;
                $data['cluster_hidden'] = $cluster;
            }

            return view('kpi_admin_page',$data);
        }else if($user_level == "agent"){
            $agent_id = $session->get("agent_id");
            $agent_branch = $session->get("branch");

            if($this->request->getPost('btn_submit_periode_kpi_agent')){
                $periode = $this->request->getPost('periode_data_kpi_agent');
                $get_table_info = $this->kpi_model->cek_table_kpi_exists($periode);
                
                if($get_table_info == 0){
                    $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_default[2],"");
                    $this->session_user->setFlashdata('table_not_exists','data periode '.$periode.' tidak ditemukan');

                    $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],$agent_branch);
                }else{
                    $branch = $agent_branch;
                    $cluster = $this->request->getPost('kpi_filter_cluster_agent');

                    if(!isset($cluster)){
                        $where_var = "WHERE branch = '".$branch."'";
                    }else{
                        $where_var = "WHERE branch = '".$branch."' AND cluster = '".$cluster."'";
                    }
                    $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode,$where_var);
                    $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode,$agent_branch);
                }
                $data['hidden_cluster'] = $cluster;
                $data['last_update_date'] = $latest_update_date;
                $data['display_periode'] = $periode;
            }else{
                $data['last_update_date'] = $latest_update_date;
                $data['display_periode'] = $periode_default[2];
                $data['hidden_cluster'] = "";
                $where_var = "WHERE branch = '".$agent_branch."'";

                $data['kpi_data'] = $this->kpi_model->get_kpi_data($periode_default[2],$where_var);
                $data['kpi_leaderboard'] = $this->kpi_model->get_kpi_lb_branch($periode_default[2],$agent_branch);
            }

            $data['agent_id'] = $agent_id;
            $data['agent_branch'] = $agent_branch;
            return view('kpi_agent_page',$data);
        }
    }

    function download_data_agent(){
        $session = Session();
        
        if($this->request->getPost('btn_dl_data_agent')){
            $periode = $this->request->getPost('hidden_periode_kpi');
            $branch = $session->get('branch');
            $cluster = $this->request->getPost('hidden_cluster');

            if(!isset($periode)){
                $get_table_info_default = $this->kpi_model->default_table_kpi_exists();
                $periode_default = explode("_",$get_table_info_default);
                if(!isset($cluster)){
                    $data_dl = $this->kpi_model->get_kpi_data($periode_default[2],"WHERE branch = '".$branch."'");
                }else{
                    $data_dl = $this->kpi_model->get_kpi_data($periode_default[2],"WHERE cluster = '".$cluster."'");
                }
            }else{
                $get_table_info = $this->kpi_model->cek_table_kpi_exists($periode);

                if($get_table_info == 0){
                    $this->session_user->setFlashdata('table_not_exists','data periode '.$periode.' tidak ditemukan'); 
                    return redirect()->to(base_url('kpi'));
                }else{
                    if(!isset($cluster)){
                        $data_dl = $this->kpi_model->get_kpi_data($periode,"WHERE branch = '".$branch."'");
                    }else{
                        $data_dl = $this->kpi_model->get_kpi_data($periode,"WHERE cluster = '".$cluster."'");
                    }
                }
            }

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

    function download_data_admin(){
        if($this->request->getPost('btn_dl_data_admin')){
            $periode = $this->request->getPost('periode_data_kpi_admin');
            $regional = $this->request->getPost('regional_hidden');
            $branch = $this->request->getPost('branch_hidden');
            $cluster = $this->request->getPost('cluster_hidden');
            
            if(!isset($periode)){
                $get_table_info_default = $this->kpi_model->default_table_kpi_exists();
                $periode_default = explode("_",$get_table_info_default);
                $periode = $periode_default[2];
            }else{
                $periode = $this->request->getPost('periode_data_kpi_admin');
            }

            if(!isset($branch) && !isset($cluster) && !isset($regional)){
                $where_var = "";
            }else if(isset($regional) && isset($cluster)){
                $where_var = "WHERE regional = '".$regional."' AND branch = '".$branch."' AND cluster = '".$cluster."'";
            }else if(isset($branch) && !isset($cluster)){
                $where_var = "WHERE regional = '".$regional."' AND branch = '".$branch."'";
            }else{
                $where_var = "WHERE regional = '".$regional."'";
            }

          
            $get_table_info = $this->kpi_model->cek_table_kpi_exists($periode);

            if($get_table_info == 0){
                $this->session_user->setFlashdata('table_not_exists','data periode '.$periode.' tidak ditemukan'); 
                return redirect()->to(base_url('kpi'));
            }else{
                $data_dl = $this->kpi_model->get_kpi_data($periode,$where_var);
            }

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
