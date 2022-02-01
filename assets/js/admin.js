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
    imageSelectorLogic();
  });
  /**
   * Add metabox repeater-field logic
   */

  function metaboxRepeaterLogic() {
    $('.repeater-field').each(function (i, repeater) {});
    $('.add-row').on('click', function (e) {
      var parentSelector = $(e.target).attr('data-parent');
      var row = $(parentSelector + ' .empty-row').clone(true);
      row.removeClass('empty-row');
      row.addClass('new-row');
      row.appendTo(parentSelector + ' .rows');
    });
    $('.remove-row').on('click', function (e) {
      $(e.target).parents('.row').remove();
    });
  }
  /**
   * Add metabox repeater-field logic
   */


  function imageSelectorLogic() {
    $('.select-image-button').on('click', uploadImage);
    $('.image-preview').on('click', uploadImage);
    $('.remove-image-button').on('click', removeImage);
  }
  /**
   * Upload image
   */


  function uploadImage(e) {
    e.preventDefault();
    var $this = $(e.currentTarget);
    var $select_button = $this.parent().find('.select-image-button');
    var $input_field = $this.parent().find('.image-input');
    var $image = $this.parent().find('.image-preview');
    var custom_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Add Image',
      button: {
        text: 'Add Image'
      },
      multiple: false
    });
    custom_uploader.on('select', function () {
      var attachment = custom_uploader.state().get('selection').first().toJSON();
      $input_field.val(attachment.url);
      $image.attr('src', attachment.url);

      if (attachment.url != '') {
        $image.show();
        $select_button.hide();
      } else {
        $image.hide();
        $select_button.show(); // $remove_button.hide();
      }
    });
    custom_uploader.open();
  }

  function removeImage(e) {
    e.preventDefault();
    var $this = $(e.currentTarget);
    var $input_field = $this.parent().find('.image-input');
    var $select_button = $this.parent().find('.select-image-button');
    var $image = $this.parent().find('.image-preview');
    $input_field.val('');
    $image.attr('src', '');
    $select_button.show();
    $image.hide();
  }
});
/******/ })()
;