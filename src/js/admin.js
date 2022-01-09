

/** 
 * Theme JS
 */


(jQuery)(
    function ($) {
        /**
         * Invoke functions when document.body is ready 
         */
        $(document.body).ready(function () {
            metaboxRepeaterLogic();
        });
        

        function addRow(parentSelector = null) {
            if(parentSelector == null || parentSelector[0] != '#') {
                console.error('parentSelector is null or does not start with a #');
                return;
            } 

            console.log(parentSelector);

            var row = $(parentSelector + ' .empty-row').clone(true);
            console.log(row);
            row.removeClass('empty-row');
            row.appendTo(parentSelector + ' .rows');
        }

        function removeRow(withConfirmation = false) {
            
        }

        /**
         * Add metabox repeater-field logic
         */

        function metaboxRepeaterLogic() {

            $('.repeater-field').each((i, repeater) => {
                if($(repeater).find('.row:not(.empty-row)').length == 0) {
                    addRow('#' + $(repeater).attr('id'));
                }
            });
            
            $('.add-row').on('click', () => {
                console.log(this);
                var parentId = $(this).attr('data-parent');
                var parentSelector = '#' + parentId;
                var row = $(parentSelector + ' .empty-row').clone(true);
                row.removeClass('empty-row');
                row.appendTo(parentSelector + ' .rows');
            });
            
            $('.remove-row').on('click', () => {
                if(!withConfirmation || confirm('Deseja realmente remover essa característica?')) {
                    $(this).parents('.row').remove();
                }
            });
        }
    }
)