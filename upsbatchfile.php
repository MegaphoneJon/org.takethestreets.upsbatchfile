<?php

require_once 'upsbatchfile.civix.php';

function upsbatchfile_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Export_Form_Map') {
    CRM_Core_Error::debug_var('formName', $formName);
    CRM_Core_Resources::singleton()->addScriptFile('org.takethestreets.upsbatchfile', 'js/batchfilesetting.js');
  }
}

/**
 * Add the fields to the export that the UPS Batch File Import expects.
 */
function upsbatchfile_civicrm_export(&$exportTempTable, &$headerRows, &$sqlColumns, &$exportMode) {
  // Is UPS Batch File Export enabled?
  $result = civicrm_api3('Setting', 'getvalue', array(
    'name' => "enableBatchFileExport",
  ));
  if (!$result) {
    return;
  }
  CRM_Core_Error::debug_var('sqlColumns', $sqlColumns);
  $sql = "ALTER TABLE $exportTempTable " .
    "ADD COLUMN contact_name CHAR(255) FIRST" .
    ",ADD COLUMN ups_packaging_type CHAR(2) " .
    ",ADD COLUMN customs_value CHAR(1)" .
    ",ADD COLUMN ups_weight CHAR(5)" .
    ",ADD COLUMN ups_length CHAR(4)" .
    ",ADD COLUMN ups_width CHAR(4)" .
    ",ADD COLUMN ups_height CHAR(4)" .
    ",ADD COLUMN blankT CHAR(1)" .
    ",ADD COLUMN blankU CHAR(1)" .
    ",ADD COLUMN blankV CHAR(1)" .
    ",ADD COLUMN blankW CHAR(1)" .
    ",ADD COLUMN blankX CHAR(1)" .
    ",ADD COLUMN ups_service CHAR(2)" .
    ",ADD COLUMN blankZ CHAR(1)" .
    ",ADD COLUMN blankAA CHAR(1)" .
    ",ADD COLUMN blankAB CHAR(1)" .
    ",ADD COLUMN blankAC CHAR(1)" .
    ",ADD COLUMN blankAD CHAR(1)" .
    ",ADD COLUMN blankAE CHAR(1)" .
    ",ADD COLUMN blankAF CHAR(1)" .
    ",ADD COLUMN blankAG CHAR(1)" .
    ",ADD COLUMN blankAH CHAR(1)" .
    ",ADD COLUMN blankAI CHAR(1)" .
    ",ADD COLUMN email_notification_1_address CHAR(50)" .
    ",ADD COLUMN email_notification_1_ship CHAR(1)" .
    ",ADD COLUMN email_notification_1_exception CHAR(1)" .
    ",ADD COLUMN email_notification_1_delivery CHAR(1)" .
    ",ADD COLUMN email_notification_2_address CHAR(50)" .
    ",ADD COLUMN email_notification_2_ship CHAR(1)" .
    ",ADD COLUMN ups_residential_indicator CHAR(1) AFTER `phone_ext`";

  CRM_Core_DAO::singleValueQuery($sql);

  $sql = "UPDATE $exportTempTable " .
    "SET ups_packaging_type = 2, " .
    "customs_value = '', " .
    "ups_weight = 2, " .
    "ups_length = 8, " .
    "ups_width = 6, " .
    "ups_height = 6, " .
    "ups_residential_indicator = 1, " .
    "contact_name = '', " .
    "blankT = '', " .
    "blankU = '', " .
    "blankV = '', " .
    "blankW = '', " .
    "blankX = '', " .
    "ups_service = 3, " .
    "blankZ = '', " .
    "blankAA = '', " .
    "blankAB = '', " .
    "blankAC = '', " .
    "blankAD = '', " .
    "blankAE = '', " .
    "blankAF = '', " .
    "blankAG = '', " .
    "blankAH = '', " .
    "blankAI = '', " .
    "email_notification_1_address = 'test@example.org', " .
    "email_notification_1_ship = 1, " .
    "email_notification_1_exception = 1, " .
    "email_notification_1_delivery = 1, " .
    "email_notification_2_address = 'donations@calyxinstitute.org', " .
    "email_notification_2_ship = 1, " .
    "country = 'US'";
  CRM_Core_DAO::singleValueQuery($sql);

  // Get the email address again
  $sql = "UPDATE $exportTempTable SET email_notification_1_address = email";
  CRM_Core_DAO::singleValueQuery($sql);

  $headerRows[] = "Packaging Type";
  $headerRows[] = "Customs Value";
  $headerRows[] = "Weight";
  $headerRows[] = "Length";
  $headerRows[] = "Width";
  $headerRows[] = "Height";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "Service";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "";
  $headerRows[] = "Email Notification 1 - Address";
  $headerRows[] = "Email Notification 1 - Ship";
  $headerRows[] = "Email Notification 1 - Exception";
  $headerRows[] = "Email Notification 1 - Delivery";
  $headerRows[] = "Email Notification 2 - Address";
  $headerRows[] = "Email Notification 2 - Ship";

  $sqlColumns['ups_packaging_type'] = 'packaging_type CHAR(2)';
  $sqlColumns['customs_value'] = 'CHAR(1)';
  $sqlColumns['ups_weight'] = 'CHAR(5)';
  $sqlColumns['ups_length'] = 'CHAR(4)';
  $sqlColumns['ups_width'] = 'CHAR(4)';
  $sqlColumns['ups_height'] = 'CHAR(4)';
  $sqlColumns['blankT'] = 'CHAR(1)';
  $sqlColumns['blankU'] = 'CHAR(1)';
  $sqlColumns['blankV'] = 'CHAR(1)';
  $sqlColumns['blankW'] = 'CHAR(1)';
  $sqlColumns['blankX'] = 'CHAR(1)';
  $sqlColumns['ups_service'] = 'CHAR(1)';
  $sqlColumns['blankZ'] = 'CHAR(1)';
  $sqlColumns['blankAA'] = 'CHAR(1)';
  $sqlColumns['blankAB'] = 'CHAR(1)';
  $sqlColumns['blankAC'] = 'CHAR(1)';
  $sqlColumns['blankAD'] = 'CHAR(1)';
  $sqlColumns['blankAE'] = 'CHAR(1)';
  $sqlColumns['blankAF'] = 'CHAR(1)';
  $sqlColumns['blankAG'] = 'CHAR(1)';
  $sqlColumns['blankAH'] = 'CHAR(1)';
  $sqlColumns['blankAI'] = 'CHAR(1)';
  $sqlColumns['email_notification_1_address'] = 'CHAR(50)';
  $sqlColumns['email_notification_1_ship'] = 'CHAR(1)';
  $sqlColumns['email_notification_1_exception'] = 'CHAR(1)';
  $sqlColumns['email_notification_1_delivery'] = 'CHAR(1)';
  $sqlColumns['email_notification_2_address'] = 'CHAR(50)';
  $sqlColumns['email_notification_2_ship'] = 'CHAR(1)';

  // Handle the columns that need splicing into the middle of the export.
  array_splice($headerRows, 10, 0, array("Residential Indicator"));
  array_splice_preserve_keys($sqlColumns, 10, 0, array('ups_residential_indicator' => 'CHAR(1)'));
  array_splice($headerRows, 0, 0, array("Contact Name"));
  array_splice_preserve_keys($sqlColumns, 0, 0, array('contact_name' => 'CHAR(255)'));

}
function array_splice_preserve_keys(&$input, $offset, $length = NULL, $replacement = array()) {
  if (empty($replacement)) {
    return array_splice($input, $offset, $length);
  }

  $part_before  = array_slice($input, 0, $offset, $preserve_keys = TRUE);
  $part_removed = array_slice($input, $offset, $length, $preserve_keys = TRUE);
  $part_after   = array_slice($input, $offset + $length, NULL, $preserve_keys = TRUE);

  $input = $part_before + $replacement + $part_after;

  return $part_removed;
}
/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function upsbatchfile_civicrm_config(&$config) {
  _upsbatchfile_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function upsbatchfile_civicrm_xmlMenu(&$files) {
  _upsbatchfile_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function upsbatchfile_civicrm_install() {
  _upsbatchfile_civix_civicrm_install();
}

/**
* Implements hook_civicrm_postInstall().
*
* @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
*/
function upsbatchfile_civicrm_postInstall() {
  _upsbatchfile_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function upsbatchfile_civicrm_uninstall() {
  _upsbatchfile_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function upsbatchfile_civicrm_enable() {
  _upsbatchfile_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function upsbatchfile_civicrm_disable() {
  _upsbatchfile_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function upsbatchfile_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _upsbatchfile_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function upsbatchfile_civicrm_managed(&$entities) {
  _upsbatchfile_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function upsbatchfile_civicrm_caseTypes(&$caseTypes) {
  _upsbatchfile_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function upsbatchfile_civicrm_angularModules(&$angularModules) {
_upsbatchfile_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function upsbatchfile_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _upsbatchfile_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function upsbatchfile_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function upsbatchfile_civicrm_navigationMenu(&$menu) {
  _upsbatchfile_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'org.takethestreets.upsbatchfile')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _upsbatchfile_civix_navigationMenu($menu);
} // */
