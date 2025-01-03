<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\FpdfLib;
use Zend\Barcode\Barcode;
class Commonmodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db      = \Config\Database::connect();  
        helper('custom_helper');
    }
    //======================================================================
    //START--------------Generic Function For Model-------------------------
    //======================================================================
    
    public function Delete_record($tablename, $columnname, $conditionvalue){
    $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->delete();
    return true; 
    }
    
    public function Delete_double_record($tablename, $columnname, $conditionvalue, $columnname1, $conditionvalue1){
    $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->where($columnname1, $conditionvalue1)
             ->delete();
    }

    public function Delete_all_record(){
    $this->db->table($tablename)->delete(); 
    }

    public function Duplicate_check($condition_cols, $tablename, $not_in_cols = ''){
            // echo print_r($not_in_cols);die;
        $builder = $this->db->table($tablename);

       if (is_array($condition_cols)) {
           foreach ($condition_cols as $key => $val) {
               $builder->where($key, $val);
           }
       }

       if ($not_in_cols != '' && is_array($not_in_cols)) {
           foreach ($not_in_cols as $key => $val) {
               $builder->whereNotIn($key, array($val));
           }
       }

        $rows = $builder->get()->getNumRows(); 
        // print_r($this->db->getLastQuery()->getQuery());die;
        return  $rows;
          
    }

    public function Duplicate_double_check($tablename, $columnname, $conditionvalue, $columnname1, $conditionvalue1){
    $query = $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->where($columnname1, $conditionvalue1)
             ->get()->getNumRows();
             return  $query;
                }

    
    public function Duplicate_triple_check($tablename, $columnname, $conditionvalue, $columnname1, $conditionvalue1, $columnname2, $conditionvalue2){
    $query = $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->where($columnname1, $conditionvalue1)
             ->where($columnname2, $conditionvalue2)
             ->get();
    return  $this->db->getNumRows();
    }
    
    public function rows_number($tablename){
        $query = $this->db->table($tablename)->get()->getNumRows();
        return  $query;
    }


    public function update_record($data, $col, $tablename){ //updated function

        if (!empty($data)) {
            $builder = $this->db->table($tablename);

            if (is_array($col)) {
                foreach ($col as $key => $val) {
                    $builder->where($key, $val);
                }
            } else {
                $builder->where($col, $data[$col]);
            }

            $update = $builder->update($data); 
            return $update ? true : false;
        } 

        return false;  
    }

    public function Update_double_record($tablename, $columnname, $conditionvalue, $columnname1, $conditionvalue1, $data){
        $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->where($columnname1, $conditionvalue1)
             ->update($data); 
    return $this->db->affectedRows();
    }

    public function Update_single_record($tablename, $columnname, $conditionvalue, $data){
        $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->update($data); 
    return $this->db->affectedRows();
    }
    
    
    public function Update_triple_record($tablename, $columnname, $conditionvalue, $columnname1, $conditionvalue1, $columnname2, $conditionvalue2, $data){
        $this->db->table($tablename)
                 ->where($columnname, $conditionvalue)
                 ->where($columnname1, $conditionvalue1)
                 ->where($columnname2, $conditionvalue2)
                 ->update($data); 
        return $this->db->affectedRows();      
    }

    public function insert_record($data, $tablename){ //function name change from Insert_record
        $this->db->table($tablename)->insert($data);  
        return $this->db->insertID();
    }

    public function getAllRecords($tablename){
    $query = $this->db->table($tablename)->get();
    $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;         
    return $result;
    }

    public function Get_record_by_condition($tablename, $columnname, $conditionvalue){
    $query = $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->get()
             ->getResultArray();
    return $query;
    }

    public function Get_record_by_double_condition($tablename, $columnname, $conditionvalue, $columnname1, $conditionvalue1){
    $query = $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->where($columnname1, $conditionvalue1)
             ->get()
             ->getResultArray();
    return $query;
    }

    public function Get_record_by_triple_condition($tablename, $columnname, $conditionvalue, $columnname1, $conditionvalue1,$columnname2, $conditionvalue2){
        $query = $this->db->table($tablename)
                 ->where($columnname, $conditionvalue)
                 ->where($columnname1, $conditionvalue1)
                 ->where($columnname2, $conditionvalue2)
                 ->get()
                 ->getResultArray();
        return $query;
    }

    public function getRows($params = array(), $table) {
        $select = '*';
        if (array_key_exists('returnType', $params) && $params['returnType'] == 'sum') {
            if (!empty($params['col'])) {
                $select = 'SUM(' . $params['col'] . ') as total';
            }
        }

        if (array_key_exists('returnType', $params) && $params['returnType'] == 'min') {
            if (!empty($params['col'])) {
                $select = 'MIN(' . $params['col'] . ') as min';
            }
        }

        if (array_key_exists('returnType', $params) && $params['returnType'] == 'max') {
            if (!empty($params['col'])) {
                $select = 'MAX(' . $params['col'] . ') as max';
            }
        }

        if (array_key_exists('cols', $params)) {
            if (!empty($params['cols'])) {
                $select = $params['cols'];
            }
        }

        $builder = $this->db->table($table);
        $builder->select($select);

        if (array_key_exists('conditions', $params)) {
            foreach ($params['conditions'] as $key => $val) {
                $builder->where($key, $val);
            }
        }


        if (array_key_exists('notLike', $params)) {

            foreach ($params['notLike'] as $key => $val) {
                $builder->notLike($key, $val);
            }
        }

        if (array_key_exists('like', $params)) {
            foreach ($params['like'] as $key => $val) {
                $builder->like($key, $val);
            }
        }

        if (array_key_exists('whereIn', $params)) {
            foreach ($params['whereIn'] as $key => $val) {
                $builder->whereIn($key, $val);
            }
        }

        if (array_key_exists('whereNotIn', $params)) {
            foreach ($params['whereNotIn'] as $key => $val) {
                $builder->whereNotIn($key, $val);
            }
        }

        $order = $direction = "";
        if (array_key_exists('order', $params)) {
            $order = $params['order'];
        }

        if (array_key_exists('direction', $params)) {
            $direction = $params['direction'];
        }

        if ($order != "" && $direction != "") {
            $builder->OrderBy($order, $direction);
        }

        if (array_key_exists('groupBy', $params)) {
            if (!empty($params['groupBy'])) {
                $builder->groupBy($params['groupBy']);
            }
        }

        if (array_key_exists('returnType', $params) && $params['returnType'] == 'count') {
            $result = $builder->countAllResults();
        } else if (array_key_exists('returnType', $params) && in_array($params['returnType'], array('sum', 'min', 'max'))) {
            $query = $builder->get();
            $result = $query->getRow();
        } else {
            if (array_key_exists('id', $params) || isset($params['returnType']) && $params['returnType'] == 'single') {
                if (!empty($params['id'])) {
                    $builder->where('id', $params['id']);
                }
                $query = $builder->get();
                $result = $query->getRow();
            } else {
                if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
                    $builder->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
                    $builder->limit($params['limit']);
                }

                $query = $builder->get();
                //echo '<pre>'; echo $this->db->last_query(); exit;
                $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
            }


        }

        // Return fetched data
        return $result;
    }

    public function Get_record_by_condition_array($tablename, $columnname, $conditionvalue){
    $query = $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->get()
             ->getResultArray();
    return $query;
    }
    
     public function Get_record_by_double_condition_array($tablename, $columnname, $conditionvalue, $columnname1, $conditionvalue1){
        $query = $this->db->table($tablename)
             ->where($columnname, $conditionvalue)
             ->where($columnname1, $conditionvalue1)
             ->get()
             ->getResultArray();
    return $query;
    }
    
    public function Custom_query_wor($query)
    {
        return $this->db->query($query);
    }
    
    public function Get_first_record($tablename)
    {
        $query = $this->db->table($tablename)->get()->getResultArray();
        return $query;
    }
    
    public function Custom_query_array($query)
    {
        return $this->db->query($query)->getResultArray();
    }
    
    
    public function Custom_query_rows($query)
    {
        return $this->db->query($query)->getResult();
    }
    //======================================================================
    //START--------------Generic Function For Model-------------------------
    //======================================================================
    public function transBegin()
    {
        return $this->db->transBegin();
    }
    public function Inert_log()
    {
        //
    }
   
    public function generateProductBarcode($text, $type = 'code128', $unlink = false) {
        if ($unlink) {
            $files = glob('pdf/*'); // get all file names
            foreach($files as $file) { // iterate files
                if (is_file($file)) {
                    // unlink($file); // delete file
                }
            }
        }
        $barcodeOptions = array('text' => $text, 'factor' => 1, 'barHeight' => 30, 'withQuietZones' => false);

        // $barcodeOptions = [ // by setting following configuration achive the max high as static
        //       'text' => $text,
        //       'barHeight' => 40,  // Static bar height to prevent overflow
        //       'barThickWidth' => 2, // Adjust the thickness of bars to control width
        //       'stretchText' => false,
        //       'drawText' => true,
        //       'fontSize' => 10,  // Smaller font size to fit within dimensions
        //       'factor' => 2,  // Scaling factor to control the overall size
        //   ];

        $url = APIURL;
        $params = array('text' => $text, 'type' => $type, 'barcodeOptions' => $barcodeOptions, 'unlink' => $unlink); 

        $response = $this->sendCurl($url, $params);
        return $response;

    }

    // generic functions - start
    public function sendCurl($url, $params = array()) {
        $data = http_build_query($params);
        $getUrl = $url . '?' . $data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            echo 'Request Error:' . curl_error($ch);
            exit;
        }

        curl_close($ch);

        return $response;
    }

    // Function to resize the barcode image
    public function resizeBarcodeImage($filePath, $newWidth, $newHeight) {
        // Load the image
        $image = imagecreatefrompng($filePath);
        $width = imagesx($image);
        $height = imagesy($image);

        // Create a new true color image
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Copy and resize old image into new one
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Save the resized image
        imagepng($newImage, $filePath);

        // Free memory
        imagedestroy($image);
        imagedestroy($newImage);
    }

    public function generateProductNewBarcode() {
        do {
            $barcode = $this->getBarcode(11);
            $num_rows = $this->db->query("select barcode from saimtech_inventory_in where barcode = '".$barcode."'  ")->getNumRows();
        } while ($num_rows > 0 );

        return $barcode;
    }
    public function getBarcode($length) {
        $result = "";
        for($i = 0; $i < $length; $i++) {
                $result .= mt_rand(0, 9);
        }
        return $result ;
    }

    public function generateItemAutoBarcode($itemsId) {

        do {
            $barcode= $this->getBarcode(11);
            $already_barcode_row = $this->getRows(array('returnType' => 'single', 'conditions' => array('barcode' => $barcode)), 'saimtech_items');
        } while ($already_barcode_row);

        $this->update_record(array('barcode' => $barcode),array('itemsId' => $itemsId), 'saimtech_items');

        return $barcode;
    }


}
