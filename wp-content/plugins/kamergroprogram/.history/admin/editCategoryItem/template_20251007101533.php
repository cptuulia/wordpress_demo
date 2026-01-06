<?php

/*************************************************************  
 * 
 * edit category item
 * 
 ************************************************************ */
?>
<div class='slidehowAdminPage'>
    <h1>dsadsad
        <?php
        echo  ucfirst(ProgramTranslations::trns('__DATE__')) . ' : ';
        echo isset($categoryItem["category"]['name']) ? $categoryItem["category"]['name'] . ', ' : '';
        echo isset($categoryItem['name']) ? $categoryItem['name'] : '';
        ?>
    </h1>
    <div class="kamergro_programButtons">
        <a class="kamergro_programButton" href="/wp-admin/admin.php?page=program%2Feditcategory&category=<?php echo $categoryItem['category_id']; ?>">
            <<
                </a>
    </div>
    <hr />
    <?php if (!empty($errors)) : ?>
        <ul class='kamergro_programErrors'>
            <?php foreach ($errors as $error): ?>
                <?php echo $error ?>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
     
    <form name="editMedia" method="post" action="<?php $_SERVER["REQUEST_URI"] ?>" class="kamergro_programForm">
        <input type="hidden" name="category_id" value="<?php echo $categoryItem['category_id'] ?>">
        <input type="hidden" name="category[name]" value="<?php echo $categoryItem["category"]['name'] ?>">
        <?php if (isset($categoryItem['id'])): ?>
            <input type="hidden" name="id" value="<?php echo $categoryItem['id'] ?>">
        <?php endif ?>
        <table>
            <thead></thead>
            <tbody>
                 <?php if (isset($categoryItem['id'])): ?>
                <tr>
                    <td>
                        shortcode:
                    </td>
                    <td>
                         [takamergro_programitem itemid="<?php echo $categoryItem['id'] ?>"] 
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <small> <?php   echo  ProgramTranslations::trns('__CATEGORY_ITEM_SHORT_CODE_HELP__'); ?></small>
                    </td>
                </tr>
                <?php endif ?>
                <tr>
                    <td>
                        <?php echo  ProgramTranslations::trns('__DATE__') ?> *
                    </td>
                    <td>
                        <input 
                            type="text" 
                            name="name" 
                            value="<?php echo isset($categoryItem['name']) ?  $categoryItem['name'] : '' ?>"
                            maxlength="180"
                        >
                    </td>
                </tr>

               <tr>
                    <td>
                        <?php echo  ProgramTranslations::trns('__TICKET_URL__') ?> 
                    </td>
                    <td>
                        <input type="text" name="ticket_url" value="<?php echo isset($category['ticket_url']) ?  $category['ticket_url'] : '' ?>">
                    </td>
                </tr>
            </tbody>
        </table>

        <hr />
        <?php if (isset($categoryItem['id'])) {
            include __DIR__ . '/partials/list.php';
        } else {
            echo  ProgramTranslations::trns('__AFTER_SAVING_A_NEW_ITEM_CATEGORY_YOU_CAN_ADD_MEDIA_ITEMS__') . '<hr>';
        }
        ?>
        <div class="kamergro_programButtons">
            <input type="submit" style="float: left" value="<?php echo  ProgramTranslations::trns('__SAVE__') ?>">
        </div>
    </form>
</div>
