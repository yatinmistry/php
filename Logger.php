<?php 
namespace common\components;

use Yii;
//use yii\helpers\FileHelper;

Class Logger{

	public $transaction_id;
	public $fileName = "mylog"; 
	public $directoryPath =  "/var/www/html/sccmlogs/";

	//log_type=error,query,msg
	public function saveLog($logMessage) {
		
        $fileInfo = $this->getFileInfo();
		$logMessage = $this->buildMessage($logMessage,$fileInfo);		
		$this->writeLog($logMessage);		
	} 

	private function writeLog($logMessage){

		$directoryPath = $this->directoryPath. date('Y-m-d');
		//$mkdirStatus      = FileHelper::createDirectory($directoryPath, $mode = 0777, $recursive = true);
		if (!is_dir($directoryPath)) {
			mkdir($directoryPath, 0777, TRUE);
		}

		$fileName = $directoryPath."/".$this->fileName .".log";
		file_put_contents($fileName, $logMessage, FILE_APPEND); // Store log


		$tid = $this->getTransactionId();
		if($tid){
			$this->fileName = "transaction_".$tid;
			$session  = \Yii::$app->session;
			$existingData = $session->get("transaction_id_".$tid);
			$session["transaction_id_".$tid] = $existingData.$logMessage;
		}


		$fileName = $directoryPath."/".$this->fileName .".log";
		$fileContents = "";
		if(file_exists($fileName)){
			$fileContents = file_get_contents($fileName);
		}
		file_put_contents($fileName, $logMessage . $fileContents);

		//file_put_contents($fileName, $logMessage, FILE_APPEND); // Store log

		
	}

	

	private function buildMessage($logMessage,$fileInfo){

		$msg = "[[".date ('Y-m-d H:i:s') . "] "; //Date Time 

		if($transaction_id = $this->getTransactionId()){
			$msg .= "[[transaction_id=".$transaction_id."] "; // Transaction Id 
		} 	
		//$msg .= $fileInfo.PHP_EOL; // File Info 

		if(is_array($logMessage)){

			$logMessage = ArrayToTable::format($logMessage);
			// $str = "";
			// foreach ($logMessage as $key => $value) {
			// 	if(is_array($value)){
			// 		$value = print_r($value,true);
			// 	}
			// 	$str .= $key.": ".$value."\n";
			// }
			// $logMessage = $str;
		}
		$msg .= $logMessage . PHP_EOL.PHP_EOL;  // Actual Log Message

		return $msg;
	} 	


	// Get File Info :: File,Function,Line No :: start  
	private function getFileInfo(){

		$bt = debug_backtrace();
        foreach ($bt as $key => $btrace) {
            if (!in_array($btrace["function"], ["p","log"]) && strpos($btrace["file"], "Logger.php") == false) {
                $debugArray = $btrace;               
                break;
            }
        }
        $nextKey = $key+1;
        $functionName ="";
        if(isset($bt[$nextKey]) && isset($bt[$nextKey]["function"])){
        	$functionName = $bt[$nextKey]["function"]."()";
        }       	
        $fileInfo = $debugArray['file']."::".$functionName." Line no. ".$debugArray['line'];

        return $fileInfo;
	}


	private function getTransactionId(){
		if($this->transaction_id){
			return $this->transaction_id;
		}else if(isset(Yii::$app->curl->transaction_id)){
			return Yii::$app->curl->transaction_id;
		}
		return false;
	}

	public function readLog($transaction_id){
		
		$directoryPath = $this->directoryPath. date('Y-m-d');
		$tid = $this->getTransactionId();
		$fileName = "transaction_".$transaction_id;
		$filePath = $directoryPath."/".$fileName .".log";
		if(file_exists($filePath)){
			$data =  file_get_contents($filePath);
			return $data;
		}
		return "";
		
	}
	
}