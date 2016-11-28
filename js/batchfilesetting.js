CRM.$(function ($) {
  'use strict';
  insertSettingsCheckbox();
  setInitialValue();
  changeSettingListener();
});

function insertSettingsCheckbox() {
  var markup = "<table><tr>";
  markup += "<td>Enable UPS Batch File Export";
  markup += '  <input type="checkbox" id="ups-batch"></td>';
  markup += "</tr></table>";
  CRM.$('#wizard-steps').after(markup);
}

function setInitialValue() {
  CRM.api3('Setting', 'getvalue', {
    "name": "enableBatchFileExport"
  }).done(function(result) {
    console.log(result.result);
    if(result.result) {
      //Set the checkbox to checked.
      CRM.$('#ups-batch').prop('checked', true);
    }
  });
}

function changeSettingListener() {
  CRM.$('#ups-batch').change(
    function(){
      if (CRM.$(this).is(':checked')) {
        settingValue = 1; 
      }
      else {
        settingValue = 0;
      }
      CRM.api3('Setting', 'create', {"enableBatchFileExport": settingValue});
  });
}
