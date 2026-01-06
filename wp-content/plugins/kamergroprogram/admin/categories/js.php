<?php

/************************************************************* 
 *  
 * categories
 * 
 ************************************************************ */
?>
<script>
  jQuery(document).ready(function() {


    /**
     * Delete
     */
    jQuery('.delete').on("click", function(event) {
      event.preventDefault();
      const data = (jQuery(this).attr('rel'));
      const parts = data.split("__");
      const message = "<?php echo  ProgramTranslations::trns('__ARE_YOU_SUER_YOUWANT_TO_DELETE__') ?> " + parts[1];
      if (confirm(message)) {
        let url = '/wp-admin/admin.php?page=program%2Fprogram&delete=' + parts[0];
        window.location.href = url;
      }
    });


  })
</script>