/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************!*\
  !*** ./src/js/admin.js ***!
  \*************************/
/** 
 * Theme JS
 */
jQuery(function ($) {
  /**
   * Invoke functions when document.body is ready 
   */
  $(document.body).ready(function () {
    metaboxRepeaterLogic();
  });

  function addRow() {
    var parentSelector = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

    if (parentSelector == null || parentSelector[0] != '#') {
      console.error('parentSelector is null or does not start with a #');
      return;
    }

    console.log(parentSelector);
    var row = $(parentSelector + ' .empty-row').clone(true);
    console.log(row);
    row.removeClass('empty-row');
    row.appendTo(parentSelector + ' .rows');
  }

  function removeRow() {
    var withConfirmation = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
  }
  /**
   * Add metabox repeater-field logic
   */


  function metaboxRepeaterLogic() {
    var _this = this;

    $('.repeater-field').each(function (i, repeater) {
      if ($(repeater).find('.row:not(.empty-row)').length == 0) {
        addRow('#' + $(repeater).attr('id'));
      }
    });
    $('.add-row').on('click', function () {
      console.log(_this);
      var parentId = $(_this).attr('data-parent');
      var parentSelector = '#' + parentId;
      var row = $(parentSelector + ' .empty-row').clone(true);
      row.removeClass('empty-row');
      row.appendTo(parentSelector + ' .rows');
    });
    $('.remove-row').on('click', function () {
      if (!withConfirmation || confirm('Deseja realmente remover essa característica?')) {
        $(_this).parents('.row').remove();
      }
    });
  }
});
/******/ })()
;