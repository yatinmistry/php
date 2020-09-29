<?php 
namespace common\components;

use common\components\SccmCommonFunction;

Class CurlClass{
    
    public $errors = [];
    public $transaction_id;
    public $log_details = "";
    public $curlData;

    private function resetVariables(){

        $this->errors = [];
        $this->log_details = "";
        $this->curlData    = [];
    }

    public function call($url, $data, $requestMethod = 'GET', $headers = array(), $xmldata = false) {

        $curl = curl_init();

        switch ($requestMethod) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
                
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMethod);
        
        if ($xmldata === true) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        }

        if (!empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        
       if(strpos($url,"https://")!==false){ 
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, false);
       }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $start_time = date('Y-m-d H:i:s'.substr((string)microtime(), 1, 8));; // Start Time 

        $response = curl_exec($curl);

        $end_time = date('Y-m-d H:i:s'.substr((string)microtime(), 1, 8)); // End Time 

        $curl_error = curl_error($curl);
        if(!$response && $curl_error){
            $this->errors[] = $curl_error;
        }
        $info = curl_getinfo($curl);

       $this->curlData = [
            "curl_error" => $curl_error,
            "curl_info" => $info,
            "curl_response" => $response,
       ];

        curl_close($curl);      

        $log_response = $response;
        if(!$response){
            $log_response = json_encode($this->curlData);
        }
        // Start :: Api Log -----------------------------
        $logsModel  = new SccmCommonFunction();
        $logsModel->createLog($response, [
          'transaction_id'     => $this->transaction_id,  
            'api_url'          => $url, 
            'request_method'   => $requestMethod, 
            'request'          => is_array($data)?json_encode($data):$data,
            'response'         => $log_response, 
            'request_api_name' => "CurlClass",
            "start_time"       => $start_time,
            "end_time"         => $end_time,
            "log_details"          => $this->log_details 
        ]);
        
        // End :: Api Log -----------------------------
         $this->resetVariables();
         
        return $response;
    }
}