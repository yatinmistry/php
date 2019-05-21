<?php 
namespace common\components;

use Yii;
//use yii\helpers\FileHelper;

Class Logger{

	public $transaction_id;//Todo::not used
	public $fileName = "app"; 

	//log_type=error,query,msg
	public function saveLog($logMessage) {
		
        $fileInfo = $this->getFileInfo();
		$logMessage = $this->buildMessage($logMessage,$fileInfo);		
		$this->writeLog($logMessage);		
	} 

	private function writeLog($logMessage){

		$directoryPath = "/var/www/html/sccmlogs/". date('Y-m-d');
		//$mkdirStatus      = FileHelper::createDirectory($directoryPath, $mode = 0777, $recursive = true);
		if (!is_dir($directoryPath)) {
			mkdir($directoryPath, 0777, TRUE);
		}

		/*$tid = $this->getTransactionId();
		if($tid){
			$this->fileName = "transaction_".$tid;
		}*/

		$fileName = $directoryPath."/".$this->fileName .".log";
		file_put_contents($fileName, $logMessage, FILE_APPEND); // Store log
	}

	

	private function buildMessage($logMessage,$fileInfo){

		$msg = "[".date ('Y-m-d H:i:s') . "] ";

		// Add Transaction id in logs
		if($transaction_id = $this->getTransactionId()){
			$msg .= "[transaction_id=".$transaction_id."] ";
		} 	
		$msg .= $fileInfo.PHP_EOL;
		$msg .= $logMessage . PHP_EOL.PHP_EOL; 

		

		return $msg;
	} 	

	// Get File Info :: File,Function,Line No :: start  
	private function getFileInfo(){

		$bt = debug_backtrace();
        foreach ($bt as $key => $btrace) {
            if (!in_array($btrace["function"], ["p"]) && strpos($btrace["file"], "Logger.php") == false) {
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
	
}
