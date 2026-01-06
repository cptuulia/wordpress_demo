<?php

/************************************************************* 
 *  
 * edit category item
 * 
 ************************************************************ */
?>

<script>
    jQuery(document).ready(function() {
        jQuery('.delete').on("click", function(event) {
            event.preventDefault();
            const data = (jQuery(this).attr('rel'));
            const parts = data.split("__");
            const message = "<?php echo  ProgramTranslations::trns('__ARE_YOU_SUER_YOUWANT_TO_DELETE__') ?> " + parts[1];
            if (confirm(message)) {
                let url = '/wp-admin/admin.php?page=program%2Feditcategoryitem&item=<?php echo $_GET["item"] ?>&delete=' + parts[0];
                window.location.href = url;
            }
        });

        setOrderMatchesEvents();
    })

    function setOrderMatchesEvents() {

        jQuery('.orderMatchesUp').unbind('click');
        jQuery('.orderMatchesUp').click(function(event) {
            event.preventDefault();
            moveRow(jQuery(this).closest('tr'), -1);
        });

        jQuery('.orderMatchesDown').unbind('click');
        jQuery('.orderMatchesDown').click(function(event) {
            event.preventDefault();
            moveRow(jQuery(this).closest('tr'), 1);
        });
    }

    function moveRow(row, direction, type) {

        OrderingOfRowToReplace = parseInt(row.closest('tr').attr('rel')) + parseInt(direction);
        numberOfOtems = jQuery(".kamergro_programIndex tr").length

        if (OrderingOfRowToReplace < 1 || OrderingOfRowToReplace >= numberOfOtems) {
            return;
        }

        clickedRow = row.closest('tr');
        clickedRow.attr('rel', -99); // put temporarily a non-existing ordering

        rows = [];
        selector = row.closest('table').find('tr');
        selector.each(function() {

            ordering = jQuery(this).attr('rel');

            if (ordering == OrderingOfRowToReplace) {
                newOrdering = parseInt(ordering) - parseInt(direction);
                jQuery(this).attr('rel', newOrdering);

                selector = '.mediaOrdering';
                jQuery(this).find(selector).val(newOrdering);
                rows[newOrdering] = jQuery(this).clone();
            } else {
                rows[ordering] = jQuery(this).clone();
            }
        });

        clickedRow.attr('rel', OrderingOfRowToReplace);
        rows[OrderingOfRowToReplace] = clickedRow;
        selector = selector = '.mediaOrdering';
        clickedRow.find(selector).val(OrderingOfRowToReplace);

        selector = 'table';
        tbody = row.closest('tbody');
        tbody.html('');

        const iterator = rows.keys();
        for (const key of iterator) {
            tbody.append(rows[key]);
        }
        setOrderMatchesEvents();
        setMatchRowColors();
    }

    function setMatchRowColors() {
        color = '';
        jQuery('.mediaRow').each(function() {
            jQuery(this).removeClass('oneven');
            jQuery(this).addClass(color);
            color = color == 'oneven' ? '' : 'oneven';
        });
    }
</script>