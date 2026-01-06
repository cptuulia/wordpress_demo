<?php

/*************************************************************  
 * 
 * edit category
 * 
 ************************************************************ */
?>
<div class='slidehowAdminPage'>
    <h1>
        <?php   echo  ucfirst(ProgramTranslations::trns('__YEAR__')) . ' : ';
                echo isset($category['name']) ? $category['name'] :  ProgramTranslations::trns('__NEW_ITEM__');
         ?>
    </h1>

    <div class="kamergro_programButtons">
        <a class="kamergro_programButton" href="/wp-admin/admin.php?page=program%2Fprogram"><<</a>
    </div>

    <hr />
    <form name="editMedia" method="post" action="<?php $_SERVER["REQUEST_URI"] ?>" class="kamergro_programForm"><?php echo $_SERVER["REQUEST_URI"] ?>
        <?php if (isset($category['id'])): ?>
            <input type="hidden" name="id" value="<?php echo $category['id'] ?>">
        <?php endif; ?>
        <table>
            <thead></thead>
            <tbody>
                <tbody>
                 <?php if (isset($category['id'])): ?>
                <tr>
                    <td>
                        shortcode:
                    </td>
                    <td>
                         [takamergro_programindex categoryid="<?php echo $category['id'] ?>"] 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <small> <?php   echo  ProgramTranslations::trns('__CATEGORY_SHORT_CODE_HELP__'); ?></small>
                    </td>
                </tr>
                 <?php endif; ?>
                <tr>
                    <td>
                        <?php echo  ProgramTranslations::trns('__YEAR__') ?> *
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo isset($category['name']) ?  $category['name'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo  ProgramTranslations::trns('__TICKET_URL__') ?> *
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo isset($category['ticket_url']) ?  $category['ticket_url'] : '' ?>">
                    </td>
                </tr>
            </tbody>
        </table>
            <?php if(isset($category['id'])) {
                  include __DIR__ . '/partials/list.php';
            } else {
                echo '<hr>'  . ProgramTranslations::trns('__AFTER_SAVING_A_NEW_CATEGORY_YOU_CAN_ADD_ITEMS__');
            }
            ?>
            <hr />
            <div class="kamergro_programButtons">
                <input type="submit" style="float: left" value="<?php echo  ProgramTranslations::trns('__SAVE__') ?>">
            </div>
    </form>
</div>