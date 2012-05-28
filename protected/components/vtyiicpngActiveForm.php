<?php
/*
 * vtigerCRM vtyiiCPng - web based vtiger CRM Customer Portal
* Copyright (C) 2011 Opencubed shpk: JPL TSolucio, S.L./StudioSynthesis, S.R.L.
*
* This file is part of vtyiiCPng.
*
* The contents of this file are subject to the vtiger CRM Public License Version 1.0 ("License")
* You may not use this file except in compliance with the License
* The Original Code is:  Opencubed Open Source
* The Initial Developer of the Original Code is Opencubed.
* Portions created by Opencubed are Copyright (C) Opencubed.
* All Rights Reserved.
*
* vtyiiCPng is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
* without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*
*/

class vtyiicpngActiveForm extends CActiveForm
{
	/**
	 * Depending on the uitype parameter coming from vtiger CRM, decides what kind of widget to show
	 * @param integer $uitype
	 * @param class $model
	 * @param string $fieldname
	 * @param array $htmlopts
	 */
	public function getVtigerEditField($uitype,$model,$fieldname,$htmlopts=array(),$capturerefersto,$action)
	{
		$widget='';
		switch ($uitype) {
			case 1:
			case 2:
			case 7:
			case 8:
			case 9:
			case 11:
			case 12:
			case 13:
			case 17:
			case 18:
			case 25:
			case 31:
			case 32:
			case 71:
			case 85:
			case 104:
			case 106:
				$widget=$this->textField($model,$fieldname,$htmlopts);
				break;
			case 5:
			case 23:
				// FIXME  get date format from portal user config or setup contact's preferences?
				$dateformat='yy-mm-dd';
				$htmlopts['size']=10;
				$htmlopts['maxlength']=10;
				if (empty($htmlopts['id'])) {
					CHtml::resolveNameID($model,$fieldname,$htmlopts);
				}
				$widget=$this->textField($model,$fieldname,$htmlopts);
				$widget.='<script type="text/javascript">
						$(document).ready(function() {
							$("#' . $htmlopts['id'] . '").datepicker({showOn: "button", dateFormat: "'.$dateformat.'", buttonImage: "' . ICONPATH . '/16/calendar.png' . '", buttonImageOnly: true, buttonText: "' . Yii::t('core', 'showCalendar') . '"});
						});
						</script>';
				break;
			case 6:
			case 70:
				// FIXME  get date format from portal user config or setup contact's preferences?
				$dateformat='Y-m-d';
				$htmlopts['size']=19;
				$htmlopts['maxlength']=19;
				if (empty($htmlopts['id'])) {
					CHtml::resolveNameID($model,$fieldname,$htmlopts);
				}
				$widget=$this->textField($model,$fieldname,$htmlopts);
				$widget.='<script type="text/javascript">
						$(document).ready(function() {
							$("#' . $htmlopts['id'] . '").datepicker({showOn: "button", dateFormat: "'.$dateformat.' " + (new Date()).getHours() + ":" + (new Date()).getMinutes()+ ":" + (new Date()).getSeconds(), buttonImage: "' . ICONPATH . '/16/calendar.png' . '", buttonImageOnly: true, buttonText: "' . Yii::t('core', 'showCalendar') . '"});
						});
						</script>';
				break;
			case 10:
			case 51:
			case 57:
			case 58:
			case 59:
			case 62:
			case 66:
			case 67:
			case 68:
			case 73:
			case 75:
			case 76:
			case 78:
			case 79:
			case 80:
			case 81:
			case 101:
				$widget='';
				$cname=get_class($model);
                                if($action=='edit')
				echo CHtml::hiddenField($cname."[$fieldname]",$model->$fieldname);
                                else
                                echo CHtml::hiddenField($cname."[$fieldname]");
				if (!empty($capturerefersto) and is_array($capturerefersto)) {
					echo CHtml::hiddenField($cname.$fieldname."_type",$capturerefersto[0]);
					if (count($capturerefersto)>1) {
						$translation=false;
						if(($cache=Yii::app()->cache)!==null) {
							if (($modname=$cache->get('yiicpng.sidebar.listmodules'))!==false) {
								$translation=true;
							}
						}
						$pl10values=array();
						foreach ($capturerefersto as $modulename) {
							$pl10values[$modulename]=($translation ? $modname[$modulename] : $modulename);
						}
						echo $this->dropDownList($model,$cname.$fieldname."_select",$pl10values,array(
						  'onchange'=>"jQuery('#".$cname.$fieldname."_display').val('');jQuery('#".$cname.'_'.$fieldname."').val('');jQuery('#".$cname.$fieldname."_type').val(jQuery('#".$cname.'_'.$cname.$fieldname."_select').val());",
						)).'&nbsp;';
					}
				} else { // this has to be an error, but we will setup the type field to avoid JS error
					echo CHtml::hiddenField($cname.$fieldname."_type");
				}
				$htmlopts['onClick']="if (jQuery('#".$cname.$fieldname."_display').val()=='".Yii::t('core', 'search')."') jQuery('#".$cname.$fieldname."_display').val('');";
				if ($action=='edit') {
					$frmvalue=$model->getComplexAttributeValue($model->$fieldname);
					if (is_array($frmvalue) and !empty($frmvalue['reference'])) {
						$frmvalue=$frmvalue['reference'];
					} else {
						$frmvalue=Yii::t('core', 'search');
					}
				} else {
					$frmvalue=Yii::t('core', 'search');
				}
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model'=>$model,
					'name'=>$cname.$fieldname."_display",                                       
					'value'=>$frmvalue,                                  
					'source'=>'js:function(request, response){ // el truco es reescribir source
						     $.getJSON("'.Yii::app()->createUrl($model->modelLinkName).'"+"/"+$("#'.$cname.$fieldname."_type".'").val()+"/AutoCompleteLookup",
						     {
						       term: request.term,
						     }, 
						     response);
						  }',
                                        'cssFile'=>'jquery.ui.autocomplete.css',
					'options'=>array(
						'minLength'=>2,
						'showAnim' => 'fold',
						'delay'=>500, //number of milliseconds before lookup occurs
						'matchCase'=>false, //match case when performing a lookup?
						'select' => 'js:function(event, ui){ jQuery("#'.$cname.'_'.$fieldname.'").val(ui.item["id"]); }'
					),
					'htmlOptions'=>$htmlopts,
				));
				break;
			case 15:
			case 16:
			case 55:
			case 111:
			case 115:
			case 255:                         
				if($fieldname !='firstname' && $fieldname !='lastname')
                                {
                                $plvals=$model->getPicklistValues($fieldname);
                                $values=array_values((is_array($plvals)?$plvals:array()));
                                if($action=='search') array_unshift($values,' ');
				$plvalues=count($values)>0?array_combine($values,$values):array();
				$widget=$this->dropDownList($model,$fieldname,$plvalues,$htmlopts);
                                }
                                else{                                    
                                    $widget=$this->textField($model,$fieldname,$htmlopts);
                                }
				break;
			case 33:
			case 34:				
				$plvalues=array_values($model->getPicklistValues($fieldname));
                                if($action=='search') array_unshift($plvalues,' ');
				$htmlopts['multiple']='true';
				$widget=$this->listBox($model,$fieldname,$plvalues,$htmlopts);
				break;
			case 19:
			case 20:
			case 21:
			case 22:
			case 24:
				unset($htmlopts['size']);
				unset($htmlopts['maxlength']);
				$widget=$this->textArea($model,$fieldname,$htmlopts);
				break;						
			case 28:
			case 29:
			case 61:
			case 69:
//				// Document fields, don't know how to treat these yet
                                if($model->getAttribute('filelocationtype')=='I' || $model->getIsNewResource()){
				echo $this->textField($model,$fieldname.'_E__',array('style'=>'display:none'));
                                echo $this->fileField($model,$fieldname,$htmlopts);
                                }
                                else{
                                echo $this->fileField($model,$fieldname.'_E__',array('style'=>'display:none'));
                                $id=$model->getId();
                                $fl=$model->getDocumentAttachment($id);
                                $model->setAttribute($fieldname,$fl[$id]['filename']);
                                echo $this->textField($model,$fieldname,$htmlopts);
                                }
				break;
                             case 27:                               
                                $values=array(yii::t('core', 'Internal'),yii::t('core', 'External'));
                                $trp=array("I","E");
                                if($action=='search') {
                                    array_unshift($values,' ');
                                    array_unshift($trp,'');
                                }
				$plvalues=count($values)>0?array_combine($trp,$values):array();
                                $htmlopts['onchange']= 'if(this.value=="E") {
                                                                            document.getElementById(\'Vtentity_filename_E__\').style.display="block";
                                                                            document.getElementById(\'Vtentity_filename\').style.display="none";
                                                                            document.getElementById(\'Vtentity_filename\').name="Vtentity[filename]_E__";
                                                                            document.getElementById(\'Vtentity_filename_E__\').name="Vtentity[filename]";
                                                                            }
                                                         else if(this.value=="I") {
                                                                            document.getElementById(\'Vtentity_filename\').style.display="block";
                                                                            document.getElementById(\'Vtentity_filename_E__\').style.display="none";
                                                                            document.getElementById(\'Vtentity_filename_E__\').name="Vtentity[filename]_E__";
                                                                            document.getElementById(\'Vtentity_filename\').name="Vtentity[filename]";
                                                                            }';
				if(empty($model->filelocationtype) || $model->getIsNewResource())
					 $model->setAttribute($fieldname,'I');
				$widget=$this->dropDownList($model,$fieldname,$plvalues,$htmlopts);
                                break;
                            case 26:
                                $values=$model->getPicklistValues($fieldname);                               
                                if($action=='search') array_unshift($values,' ');
				$widget=$this->dropDownList($model,$fieldname,$values,$htmlopts);
                                break;
			case 56:
				$widget=$this->checkBox($model,$fieldname,$htmlopts);
				break;
			case 'file':
				$widget=CHtml::activeFileField($model, $fieldname, $htmlopts);
				break;
			case 53:
				$values=$model->getUsersInSameGroup();
				$plvalues=$values;
                                if($action=='search') array_unshift($plvalues,' ');
				$widget=$this->dropDownList($model,$fieldname,$plvalues,$htmlopts);
				break;

			default:
				$widget=$this->textField($model,$fieldname,$htmlopts);
		}
		return $widget;
	}       
}