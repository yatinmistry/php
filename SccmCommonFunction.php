<?php 
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\helpers\FileHelper;
use backend\models\ApiLog;

class SccmCommonFunction {
    
     /*
        By Jitendra
        Date : 15th January, 2018
        Upgraded by : Satish <Satish.Rane@infinitylabs.in>  
    */
    public static function createLog($message_log, $log_array = array(), $folder = true) {
        if (true || $message_log != "") {
            ## insert in database
            $api_url         = isset($log_array['api_url'])?$log_array['api_url']:'';
            $api_call_name       = isset($log_array['request_api_name'])?$log_array['request_api_name']:'';
            $request_method      = isset($log_array['request_method'])?$log_array['request_method']:''; 
            $request         = isset($log_array['request'])?$log_array['request']:'';
            $response        = isset($log_array['response'])?$log_array['response']:'';
            $service_template_id = isset($log_array['service_template_id'])?$log_array['service_template_id']:'';
            $folder_name         = ($folder)?"api_log":"logs";
            
             $userid          = (isset(Yii::$app->user) && isset(Yii::$app->user->id)?Yii::$app->user->id:"");
            //$username       = self::getUser($userid);
            $ipAddress        = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"";
            $useragent        = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
            $log_str          = "\r\n[" . date('Y-m-d H:i:s') . "] [api_call_name : " . $api_call_name . "] [api_url : " . $api_url . "]";
            $log_str         .= ($request != '[]')?"\r\n[" . date('Y-m-d H:i:s') . "] [request : " . $request . "]\r\n":"\r\n";
            $log_str         .= "[" . date('Y-m-d H:i:s') . "] [ip : " . $ipAddress . "] [uid : " . $userid . "] [" . str_replace("\\n","\r\n",$message_log) . "]" . "[" . $useragent . "]" . "\r\n";
            $directoryPath    = \Yii::$app->basePath . "/runtime/" . $folder_name . "/" . date('Y-m-d');
            $auditLogFilePath = $directoryPath . "/" . $api_call_name . ".txt";
            $mkdirStatus      = FileHelper::createDirectory($directoryPath, $mode = 0777, $recursive = true);

            if(file_put_contents($auditLogFilePath, $log_str, FILE_APPEND | LOCK_EX))
            {
                //echo "<br /> LOG file created successfully";
            }

            $log_details             = $log_str;
            $ApiLog                      = new ApiLog();
            $ApiLog->api_url         = $api_url;
            $ApiLog->request_method      = $request_method;
            $ApiLog->request         = $request;
            $ApiLog->response        = $response;
            // $ApiLog->log_details     = $log_details;
            $ApiLog->log_details     = @$log_array["log_details"];
            $ApiLog->log_file_path   = $auditLogFilePath;
            $ApiLog->service_template_id = $service_template_id;
           // $ApiLog->created_date      = date('Y-m-d H:i:s');
            $ApiLog->created_by      = $userid;
            $ApiLog->start_time = @$log_array["start_time"];
            $ApiLog->end_time = @$log_array["end_time"];
           
            if(isset($log_array["transaction_id"])){
                $ApiLog->transaction_id = $log_array["transaction_id"];
            }else{
                $ApiLog->transaction_id = 0;
            }

            if($ApiLog->save()) {
                // echo "<br /> API LOG record successfully updated";       
                // $data = ApiLog::find()->orderBy(['id'=> SORT_DESC])->limit(2)->all();
                // echo ">>>>><pre>";
                // print_r($data);
            } else {                
                pe($ApiLog->attributes,$ApiLog->getErrors());
               
            }

            ########################### create service inventory #######################
                   #if(count($log_array) > 0) {
                           #$this->createServiceInventory($log_array);
                   #}
            ############################################################################
        } else {
            //echo("No Log Found");
        }
    } // EO createLog()

    /*
        By Jitendra
        Date : 15th January, 2018
        Upgraded by : Satish <Satish.Rane@infinitylabs.in>  
    */
    public static function createApiLog($message_log, $log_array = array()) {
        if ($message_log != "") {
            ## insert in database
            $api_url         = isset($log_array['api_url'])?$log_array['api_url']:'';
            $api_call_name       = isset($log_array['request_api_name'])?$log_array['request_api_name']:'';
            $request_method      = isset($log_array['request_method'])?$log_array['request_method']:''; 
            $request             = isset($log_array['request'])?$log_array['request']:'';
            $response        = isset($log_array['response'])?$log_array['response']:'';
            $service_template_id = isset($log_array['service_template_id'])?$log_array['service_template_id']:'';
            
            $userid              = Yii::$app->user->identity->id;
            //$username       = self::getUser($userid);
            $ipAddress    = $_SERVER['REMOTE_ADDR'];
            $useragent        = $_SERVER ['HTTP_USER_AGENT'];
            $log_str          = "\r\n[" . date('Y-m-d H:i:s') . "] [api_call_name : " . $api_call_name . "] [api_url : " . $api_url . "]"."\r\n";
            $log_str         .= "\r\n[" . date('Y-m-d H:i:s') . "] [request : " . $request . "]"."\r\n";
            $log_str         .= "[" . date('Y-m-d H:i:s') . "] [ip : " . $ipAddress . "] [uid : " . $userid . "] [Request : " . $request . "] [" . $message_log . "]" . "[" . $useragent . "]" . "\r\n";
            $directoryPath    = \Yii::$app->basePath . "/runtime/api_log/" . date('Y-m-d');
            $auditLogFilePath = $directoryPath . "/" . $api_call_name . ".txt";
            $mkdirStatus      = FileHelper::createDirectory($directoryPath, $mode = 0777, $recursive = true);

            if(file_put_contents($auditLogFilePath, $log_str, FILE_APPEND | LOCK_EX))
            {
                //echo "<br /> LOG file created successfully";
            }

            $log_details             = $log_str;
            $ApiLog                      = new ApiLog();
            $ApiLog->api_url         = $api_url;
            $ApiLog->request_method      = $request_method;
            $ApiLog->request         = $request;
            $ApiLog->response        = $response;
            $ApiLog->log_details     = $log_details;
            $ApiLog->log_file_path   = $auditLogFilePath;
            $ApiLog->service_template_id = $service_template_id;
            $ApiLog->created_date    = date('Y-m-d H:i:s');
            $ApiLog->created_by      = $userid;

            if($ApiLog->save()) {
                // echo "<br /> API LOG record successfully updated";       
                // $data = ApiLog::find()->orderBy(['id'=> SORT_DESC])->limit(2)->all();
                // echo ">>>>><pre>";
                // print_r($data);
            } else {
                echo "<pre>";
                print_r($ApiLog->getErrors());
                exit;
            }
            ########################### create service inventory #######################
                   #if(count($log_array) > 0) {
                           #$this->createServiceInventory($log_array);
                   #}
            ############################################################################
        } else {
            echo("No Log Found");
        }
    } // EO createApiLog()
    
    public static function createServiceInventory($log_array) {
        $role_id = $log_array['role_id'];
        $sql = "SELECT sdc.service_template_id, sdc.customer_id, c.first_name, c.last_name, st.template_version, 
                st.user_variable, st.system_variable, sdc.hostname, sc.service_desc
                from service_device_config sdc 
                JOIN service_template st ON sdc.service_template_id = st.id 
                JOIN service_role sr ON sr.id = st.role_id 
                JOIN service_catalog sc ON sc.id = sr.service_id
                JOIN customer c ON c.id = sdc.customer_id
                WHERE sr.id = {$role_id} and nso_config is not null";
        $results = \Yii::$app->db->createCommand($sql)->queryAll();

        $serviceInventory = new ServiceInventory();
        foreach($results as $val) {
            $serviceInventory->service_template_id       = $val['service_template_id'];
            $serviceInventory->customer_id               = $val['customer_id'];
            $serviceInventory->customer_firstname        = $val['first_name'];
            $serviceInventory->customer_lastname         = $val['last_name'];
            $serviceInventory->service_template_version  = $val['template_version'];
            $serviceInventory->user_defined_parameters   = $val['user_variable'];
            $serviceInventory->system_defined_parameters = $val['system_variable'];
            $serviceInventory->device_name               = $val['hostname'];
            $serviceInventory->description               = $val['service_desc'];
            $serviceInventory->created_date              = date('Y-m-d H:i:s');
            $serviceInventory->created_by                = 1;
            $serviceInventory->modified_date             = date('Y-m-d H:i:s');
            $serviceInventory->modified_by               = 1;

            if($serviceInventory->save()) {

            } else {
                echo "<pre>";
                print_r($serviceInventory->getErrors());
                exit;
            }
        }
    } // EO createServiceInventory()

    public function convert_multi_array_to_string($array) {
        $str = implode("&",array_map(function($a) {return implode("~",$a);},$array));
        return $str;
    }
    
    public function curl($url, $requestType = 'GET', $data = '', $headers = array(), $xmldata = FALSE) {

        $ch = curl_init($url);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
       if(strpos($url,"https://")!==false){ 
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
       }
        if ($xmldata == TRUE) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        }
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);

        curl_close($ch);

        return $result;
    }
    
    public function invokeLoginApi($userName,$password){
        $loginRequest = http_build_query(['username' => $userName, 'password' => $password]);
        $sccmCommonFunction = new sccmCommonFunction();
//        echo \yii\helpers\Url::base(true);exit();
//        $loginResponse = $sccmCommonFunction->curl("http://localhost:8080/SCCM/sccm_api/web/api/v1/login", 'POST', $loginRequest);
        $loginResponse = $sccmCommonFunction->curl(Yii::$app->params['SCCM_API_URL']."v1/login", 'POST', $loginRequest);
        return  json_decode($loginResponse, true);
    }
}
?>