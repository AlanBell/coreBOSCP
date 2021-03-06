<?php
/**************************************************************************************************
 * Evolutivo vtyiiCPng - web based vtiger CRM Customer Portal
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
 */

//This is the vtiger CRM server path i.e., the url to access the vtiger CRM server in browser
//Ex. if you access your vtiger CRM with http://mickie:90/vtiger/index.php you will use http://mickie:90/vtiger
$evocp_Server_Path = "http://mickie:90/vtiger";

// The next two variables define the portal webservice user to be used to connect to the vtiger CRM server
// This user must be created and configured in your vtiger CRM application
$evocp_Login_User = 'admin';
$evocp_Access_Key = 'U7f44ZhKCZ8ZTkZU';

// name of the folder within which you want any trouble ticket attachments to be uploaded
$evocp_AttachmentFolderName = 'Default';

?>