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

    if (parentSelector == null || parentSelector.charAt(0) != '#') {
      console.error('parentSelector is null or does not start with a #');
      return;
    }

    var row = $(parentSelector + ' .empty-row').clone(true);
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
    $('.repeater-field').each(function (i, repeater) {
      if ($(repeater).find('.row:not(.empty-row)').length == 0) {
        addRow('#' + $(repeater).attr('id'));
      }
    });
    $('.add-row').on('click', function (e) {
      var parentId = $(e.target).attr('data-parent');
      addRow('#' + parentId);
    });
    $('.remove-row').on('click', function (e) {
      $(e.target).parents('.row').remove();
    });
  }
});
/******/ })()
;