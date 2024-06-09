<?php

if ( ! function_exists('date_custom'))
{
    function date_custom($date) {
        if($date!=""){
            $date = date_create($date);
            $date = date_format($date,"d-m-Y");
        }
        return $date; 
    }
}
if ( ! function_exists('date_time_custom'))
{
    function date_time_custom($date) {
        $date = date_create($date);
        $date = date_format($date,"d-m-Y h:i a");
        return $date;
    }
}
if ( ! function_exists('date_system'))
{
    function date_system($date) {
        $myDateTime = DateTime::createFromFormat('d-m-Y', $date);
        $date = $myDateTime->format('Y-m-d');
        return $date;
    }
}
if ( ! function_exists('does_qurantine_exists'))
{
    function does_qurantine_exists($pro_specs_id) {
        $CI =& get_instance();
        $CI->db->select('pro_specs_id, qurantine_status');
        $CI->db->from('inv_qurantine');
        $CI->db->where('pro_specs_id', $pro_specs_id);
        $CI->db->where("(qurantine_status='Quarantine' OR qurantine_status='Partially Quarantine')");
        $query = $CI->db->get();
        return $query->num_rows();
    }
}

if ( ! function_exists('po_code'))
{
    function po_code() {
        $CI =& get_instance();
        $CI->db->select('(po_code) as next_po_code');
        $CI->db->where('child_po', 0);
        $CI->db->order_by('po_code','desc');
        $CI->db->from('inv_purchase_order');
        $query = $CI->db->get();
        if (!empty($query->row()->next_po_code)) {
            $po_code  = $query->row()->next_po_code;
            $po_code  = substr($po_code, 3);
            $po_code = $po_code + 1;
        } else {
            $po_code = 100001;
        }
        return $po_code;
    }
}
if ( ! function_exists('issuance_code'))
{
    function issuance_code() {
        $CI =& get_instance();
        $CI->db->select('(issuance_code) as next_issuance_code');
        $CI->db->order_by('issuance_code','desc');
        $CI->db->from('inv_add_issuance');
        $query = $CI->db->get();
        if(!empty($query->row()->next_issuance_code)){
        $issuance_code  = $query->row()->next_issuance_code;
        $issuance_code  = substr($issuance_code, 4) + 1;
        }
        else{
            $issuance_code = 100001;
        }
        return $issuance_code;
    }
}

if ( ! function_exists('grn_code'))
{
    function grn_code() {
        $CI =& get_instance();
        $CI->db->select('(grn_code) as next_grn_code');
        $CI->db->where('child_grn', 0);
        $CI->db->order_by('grn_code','desc');
        $CI->db->from('inv_grn');
        $query = $CI->db->get();
        if (!empty($query->row()->next_grn_code)) {
            $grn_code  = $query->row()->next_grn_code;
            $grn_code  = substr($grn_code, 4);
            $grn_code = $grn_code + 1;
        } else {
            $grn_code = 100001;
        }
        return $grn_code;
    }
}
if ( ! function_exists('check_if_exist_grn'))
{
    function check_if_exist_grn($purchase_order_id) {
        $CI =& get_instance();
        $query = $CI->db
        ->where('inv_grn.purchase_order_id',$purchase_order_id)
        ->get("inv_grn");  
        $result = $query->row();
        return $result;
    }
}
if ( ! function_exists('get_po_item_slitting'))
{
    function get_po_item_slitting($id) {
        $CI =& get_instance();
        $query = $CI->db
        ->select('inv_purchase_order_item_slitting.*, inv_purchase_order_item.product_id,inv_product.material_code')
        ->join('inv_purchase_order_item', 'inv_purchase_order_item.po_item_id = inv_purchase_order_item_slitting.po_item_id')
        ->join('inv_product', 'inv_product.product_id = inv_purchase_order_item.product_id')
        ->where('inv_purchase_order_item_slitting.po_item_id',$id)
        ->get("inv_purchase_order_item_slitting");  
        return $query->result();
    }
}
if ( ! function_exists('get_po_item_slitting_new'))
{
    function get_po_item_slitting_new($id) {
        $CI =& get_instance();
        $query = $CI->db
        ->select('inv_purchase_order_item_slitting.*,inv_purchase_order_item.product_id,inv_product.material_code,inv_grn_item_slitting.grn_slitting_id, inv_grn_item_slitting.grn_slitting_quantity_recived,inv_grn_item_slitting.slitting_goods_condition,inv_grn_item_slitting.grn_slitting_product_image')
        ->join('inv_purchase_order_item', 'inv_purchase_order_item.po_item_id = inv_purchase_order_item_slitting.po_item_id')
        ->join('inv_grn_item_slitting', 'inv_grn_item_slitting.slitting_id = inv_purchase_order_item_slitting.slitting_id','left')
        ->join('inv_product', 'inv_product.product_id = inv_purchase_order_item.product_id')
        ->where('inv_purchase_order_item_slitting.po_item_id',$id)
        ->get("inv_purchase_order_item_slitting");  
        return $query->result();
    }
}
if ( ! function_exists('get_po_item_slitting_sku'))
{
    function get_po_item_slitting_sku($pro_specs_id) {
        $CI =& get_instance();
        $query = $CI->db
        ->select('inv_product_specifications.*')
        ->where('inv_product_specifications.pro_specs_id',$pro_specs_id)
        ->get("inv_product_specifications");  
        return $query->row();
    }
}
if ( ! function_exists('get_product_sku_width'))
{
    function get_product_sku_width($product_id) {
        $CI =& get_instance();
        $query = $CI->db
            ->select("inv_product_specifications.pro_specs_id,inv_product_specifications.pro_specs_sku,inv_product_specifications.pro_specs_width")
            ->join('inv_product_specifications', 'inv_product_specifications.product_id = inv_product.product_id')
            ->join('inv_quantity_break_price', 'inv_quantity_break_price.product_id = inv_product.product_id')
            ->where('inv_product.product_id',$product_id)
            ->group_by('inv_product_specifications.pro_specs_id')
            ->get('inv_product');    
        return $query->result();
    }
}

if ( ! function_exists('get_mat_product_details'))
{
    function get_mat_product_details($product_id) {
        $CI =& get_instance();
        $query = $CI->db
                ->join('inv_product_materials_group', 'inv_product_materials_group.product_id = inv_product.product_id')
                ->join('inv_uom', 'inv_uom.uom_id = inv_product.uom_id')
                ->join('inv_store', 'inv_store.store_id = inv_product.store_id')
                ->where('inv_product.product_id',$product_id)
                ->get('inv_product');    
        $mat_details =  $query->row();
        $linear_options = [];
        if($mat_details->ipm_linear_meter_val_a!="" && $mat_details->ipm_linear_meter_val_a!=0 ){
            array_push($linear_options,$mat_details->ipm_linear_meter_val_a);
        }
        if($mat_details->ipm_linear_meter_val_b!="" && $mat_details->ipm_linear_meter_val_b!=0){
            array_push($linear_options,$mat_details->ipm_linear_meter_val_b);
        }
        if($mat_details->ipm_linear_meter_val_c!="" && $mat_details->ipm_linear_meter_val_c!=0){
            array_push($linear_options,$mat_details->ipm_linear_meter_val_c);
        }
        return $linear_options;
    }
}
if ( ! function_exists('get_product_sku_width'))
{
    function get_product_sku_width($product_id) {
        $CI =& get_instance();
        $query = $CI->db
                ->join('inv_product_specifications', 'inv_product_specifications.product_id = inv_product.product_id')
                ->join('inv_quantity_break_price', 'inv_quantity_break_price.pro_specs_id = inv_product_specifications.pro_specs_id')
                ->where('inv_product.product_id',$product_id)
                ->get('inv_product');    
        return $query->result();
    }
}
if ( ! function_exists('get_grn_item_slitting'))
{
    function get_grn_item_slitting($id, $po_item_slitting_master ='', $po_item_slitting_title ='') {
        $CI =& get_instance();
        $CI->db->join('inv_purchase_order_item_slitting', 'inv_purchase_order_item_slitting.slitting_id = inv_grn_item_slitting.slitting_id');
        $CI->db->where('po_item_id',$id);
        if ($po_item_slitting_master != "") {
            $CI->db->where('po_item_slitting_master',$po_item_slitting_master);
        }
        if ($po_item_slitting_title != '') {
            $CI->db->where('po_item_slitting_title', $po_item_slitting_title);
        }
        $query = $CI->db->get("inv_grn_item_slitting");  
        return $query->result();
}
}

if ( ! function_exists('user_permissions'))
{
    function user_permissions() {
        $department = $_SESSION['user_department'];
        $user_id = $_SESSION['user_id'];
        if($department == 'Admin'){
            $permissions = ['home','allocation','inventory_definiton','category','grn','add_grn','edit_grn','issuance','product','add_product','product_list','purchases','add_purchases','qbr','qurantine','stocks','stock_list','stock_allocation','store','suppliers','uom','users','reports','orders', 'qurantine_dispose_action', 'stock_reallocation'];
        }
        elseif($department == 'Purchaser'){//deleted
            $permissions = ['suppliers','product','add_product','product_list','qbr','qurantine','purchases','stocks','stock_allocation'];  
        }
        elseif($department == 'Goods In'){ // Deleted 
            $permissions = ['grn'];  
        }
        elseif($department == 'Stock Intake'){ // Deleted 
            $permissions = ['stocks','stock_list'];  
        }
        elseif($department == 'Multiple Rights Department'){ // Deleted 
            $permissions = ['grn','issuance','qurantine'];  
        }
        elseif($department == 'Mixed Rights Department'){ // Deleted 
            $permissions = ['suppliers','product','add_product','qbr','qurantine','product_list','purchases'];  
        }
        elseif($department == 'Stock+GRN'){
            $permissions = ['stocks','stock_list','grn','add_grn','edit_grn', 'stock_reallocation'];  
        }
        elseif($department == 'Purchasing'){
            $permissions = ['purchases','suppliers','product','product_list','add_product','add_purchases','grn','qbr','qurantine','orders','stocks','stock_list','reports', 'stock_reallocation'];
        }
        elseif($department == 'GRN+Stock+PO+ISS'){
            $permissions = ['grn','add_grn','edit_grn','stocks', 'stock_list', 'purchases', 'issuance','product','qurantine', 'qurantine_dispose_action', 'stock_reallocation'];  
        }
        else{
            $permissions = ['issuance']; 
        }
        return $permissions;
    }
}
if ( ! function_exists('check_permissions'))
{
    function check_permissions($controller_name) {
        if(!(in_array($controller_name, $_SESSION['user_permissions']))){
            redirect(URL.'unauthorized');
        }
    }
}
if ( ! function_exists('check_slitting_completed'))
{
    function check_slitting_completed($id) {
        $CI =& get_instance();
        $query = $CI->db
        ->where('grn_item_id',$id)
        ->where('grn_slitting_title','Production')
        ->get("inv_grn_item_slitting");  
        $result =  $query->result();
        $check = 0;
        $counter = 0;
        foreach ($result as $row) {
            if($row->po_item_slitting_quantity == $row->grn_slitting_quantity_recived){
                $check = $check + 1;
            }
            $counter++;  
        }
        if ($counter == $check){
            $check=0;
        }
        else{
            $check = 1;
        }
        return $check;
    }
}

if ( ! function_exists('product_log'))
{
    function product_log($UserID, $pro_specs_id, $log_event,$pro_specs_sku=null) {
        $CI =& get_instance();
        if(isset($pro_specs_sku)){
            $CI->db->where('pro_specs_sku',$pro_specs_sku);
            $query = $CI->db->get('inv_product_specifications');
            $result = $query->row();
            $pro_specs_id = $result->pro_specs_id;
        }
        $data = array(
            'UserID' => $UserID, 
            'pro_specs_id' => $pro_specs_id, 
            'log_event' => $log_event, 
        );
        $CI->db->insert('inv_product_log', $data);  
        return $CI->db->insert_id(); 
    }
}
if(! function_exists("date_differnce")){
    function date_differnce($start_date , $end_date){
        //Procedural Style
        $start_date = date_create($start_date);
        $end_date = date_create($end_date);
        $interval = date_diff($startDate, $endDate);

        //Object-Oriented Style
        // $start_date = new DateTime($start_date);
        // $end_date = new DateTime($end_date);
        // $interval = $startDate->diff($endDate) ;

        return array('years' => $interval->y, 'months' => $interval->m, 'weeks' => floor($interval->days / 7), 'days' => $interval->days);
    }
}    
if ( ! function_exists('loadLanguageFiles')){ 
    function loadLanguageFiles($site_lang)
    {
        static $count=0;
        $ci=& get_instance();
        $lang=array();
        if($count == 0){
            switch ($site_lang)
            {
                case "fr":
                    foreach (glob("application/language/french/*.php") as $filename)
                    {
                        $filename=basename($filename);
                        $filename=str_replace("_lang","",$filename);
                        $ci->lang->load(basename($filename),"french");

                    }

                    break;
                default:
                    foreach (glob("application/language/english/*.php") as $filename)
                    {
                        $filename=basename($filename);
                        $filename=str_replace("_lang","",$filename);
                        $ci->lang->load(basename($filename),"english");

                    }
                    break;
            }
            $count++;
        }

    }
}
if(! function_exists('site_lang')){

    function site_lang($site_lang){
        static $count = 0;
        if($count == 0) {
            $ci = &get_instance();
            // $site_lang=$ci->uri->segment(1);
            if($site_lang == "fr"){
                $ci->session->set_userdata("site_lang",$site_lang);
            }else{
                $ci->session->set_userdata("site_lang","eng");
            }
            $count++;
        }
    }
}
if(! function_exists("get_site_lang")){
    function get_site_lang(){
        $ci = &get_instance();
        $site_lang = $ci->session->userdata("site_lang");
        return $site_lang;
    }
}

if (!function_exists("ddd")) {
    function ddd($array,  $die = true, $label = '') {
        echo '<pre>';
        if ($label != '') {
            echo  $label .': ';
        }
        print_r($array);
        if ($die) {
            die;
        }
    }
}