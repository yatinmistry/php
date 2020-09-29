<?php 
namespace common\components\yii;

/*
 * Usage : Yii::$app->yiiHelper->getActiveStatusField();
 */
Class YiiHelper{

	public function getActiveStatusField($form,$model){
		return  $form->field($model, 'active_status')->radioList(  [
	         '1'=>'Active',
	         '0'=>'Inactive'
	    ])->label('Active Status');
	}


	public function getIsActiveField($form,$model){
		return  $form->field($model, 'is_active')->radioList(  [
	         '1'=>'Active',
	         '0'=>'Inactive'
	    ])->label('Active Status');
	}
}

