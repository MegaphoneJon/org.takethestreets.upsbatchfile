<?php

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2013
 * $Id$
 *
 */
/*
 * Settings metadata file.
 */

return array(
  'enableBatchFileExport' => array(
    'group_name' => 'UPS Batch File',
    'group' => 'upsbatchfile',
    'name' => 'enableBatchFileExport',
    'type' => 'Boolean',
    'default' => 0,
    'add' => '4.5',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Enable UPS Batch File Export',
    'help_text' => 'When enabled, UPS Batch File fields will be added during an export',
  ),
);
