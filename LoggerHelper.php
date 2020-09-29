<?php 
namespace backend\components\checks\helpers;

use yii;
use backend\models\Orders;

Class LoggerHelper{


	  public function readLogs($id){

			$log = new \common\components\Logger();
			$data = $log->readLog($id);

			$table = "";
			$dryrun = "";

			if($data){
				
				$data = nl2br($data);
				 $dataArray = explode("[[",$data);
				 $datetime = "";

				 foreach ($dataArray as $key => $row) {

				    if(!empty(trim($row))){

				    	//Todo:: not used yet ::START
				        if(false && str_endsWith($row,"] ")){
				            $table .= "<tr><td style='width:17%'>[".$row."</td>";
				          
				        }
				        //Todo:: not used yet ::END
				        else{
				            
				            $table .= "<td>"."[".$row."</td></tr>"; 
				            if(strpos($row,date("Y-m-d"))!==false){
				                  $datetime = str_replace("]","\n",strip_tags($row));
				            }
				            if(!$dryrun){
				                $dryrun = $this->findDryrun($row,$datetime);
				            }
				        }
				    }
				 }

			}else{
				$table = "<tr class='danger'><td><b>No Logs Found</b></td></tr>";
			}


        return  json_encode([
            "success" => true,
            "dryrun" => $dryrun,
            "data"	=> "<table class='table table-bordered table-striped'>".$table."</table>",
        ]);
    }

	 private function findDryrun($log,$datetime){

        if(strpos($log,"NSO Dry run response")!==false){
            $logArr = explode("=>",$log);                            
            if(isset($logArr[1])){
                $model = new Orders();
                $dryrun = str_replace("<br />", "\n", $logArr[1]);
                   $dryrun = trim(str_replace("\n\n", "\n", $dryrun));
                   $dryrun = $dryrun;
                return $datetime.$model->getDryrunHTML($dryrun);
            }
        }
        return "";
    }



}