<?php /*************************************************************************************************
 * vtigerCRM vtyiiCPng - web based vtiger CRM Customer Portal
 * Copyright 2012 JPL TSolucio, S.L.  --  This file is a part of vtyiiCPNG.
 * You can copy, adapt and distribute the work under the "Attribution-NonCommercial-ShareAlike"
 * Vizsage Public License (the "License"). You may not use this file except in compliance with the
 * License. Roughly speaking, non-commercial users may share and modify this code, but must give credit
 * and share improvements. However, for proper details please read the full License, available at
 * http://vizsage.com/license/Vizsage-License-BY-NC-SA.html and the handy reference for understanding
 * the full license at http://vizsage.com/license/Vizsage-Deed-BY-NC-SA.html. Unless required by
 * applicable law or agreed to in writing, any software distributed under the License is distributed
 * on an  "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and limitations under the
 * License terms of Creative Commons Attribution-NonCommercial-ShareAlike 3.0 (the License).
 *************************************************************************************************
 *  Author       : JPL TSolucio, S. L.
 *************************************************************************************************/?>
<h1><?php echo $model->getModuleName().' : '.$model->getLookupFieldValue($this->entityLookupField,$model->getAttributes()); ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$model->getDetailViewFieldsID($model->id),
	'cssFile'=>BASEURL.'/themes/'.Yii::app()->getTheme()->getName().'/css/list.css',
));
echo CHtml::hiddenField('entityidValue',$model->__get($this->entityidField), array('id'=>'entityidValue'));
echo CHtml::hiddenField('dvcpage',$_GET[$this->modelName.'_page']-1, array('id'=>'dvcpage'));
?>
<script type="text/javascript">
breadCrumb.add({ icon: 'view', href: 'javascript:chive.goto(\'<?php echo $this->modelLinkName;?>/<?php echo $this->entity;?>/view/<?php echo $model->__get($this->entityidField)?>\')', text: <?php echo CJavaScript::encode($model->getLookupFieldValue($this->entityLookupField,$model->getAttributes())); ?>});
breadCrumb.show();
sideBar.activate(0);
</script>