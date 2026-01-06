<?php

/************************************************************* 
 *  
 * edit category item media
 * 
 ************************************************************ */

?>
<script>
  jQuery(document).ready(function() {
    updateEditCategoryItemFormFields()
    jQuery('#categoryItemTypeSelect').on("change", function() {
      updateEditCategoryItemFormFields()
    });
    jQuery('#categoryItemPhoto').on("change", function() {
      updateEditCategoryItemFormFields()
    });
  });

  /**
   * updateEditCategoryItemFormFields(
   * 
   */
  function updateEditCategoryItemFormFields() {
    let type = jQuery('#categoryItemTypeSelect').find(":selected").val();

    if (type == 'YOUTUBE') {
      jQuery('#categoryItemUrl').show();
      jQuery('#categoryItemPhoto').hide();

    } else {
      jQuery('#categoryItemUrl').hide();
      jQuery('#categoryItemPhoto').show();
    }

    <?php if (!isset($media["id"])) : ?>
      jQuery('#saveEditMedia').show();
      if (type == 'IMAGE') {
        let selectFile = jQuery('[type=file]').val();
        if (selectFile == '' || selectFile == undefined) {
          jQuery('#saveEditMedia').hide();
        }
      }

    <?php endif; ?>

  }
</script>