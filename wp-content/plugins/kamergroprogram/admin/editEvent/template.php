<?php

/*************************************************************  
 * 
 * edit category item media
 * 
 ************************************************************ */
?>
<div class='slidehowAdminPage'>
    <h1>
        <?php
        echo  ucfirst(ProgramTranslations::trns('__EVENT__')) . ' : ';
        echo isset($media["item"]['name']) ?  $media["item"]['name'] . ','  : '';
        echo isset($media['name']) ? $media['name'] : ucfirst(ProgramTranslations::trns('__NEW_ITEM__'));
        ?>
    </h1>
    <div class="kamergro_programButtons">
        <a class="kamergro_programButton" href="/wp-admin/admin.php?page=program%2Feditcategoryitem&item=<?php echo $media['item_id']; ?>">
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


    <form name="editMedia"
        method="post"
        action="<?php $_SERVER["REQUEST_URI"]  ?>"
        enctype="multipart/form-data"
        class="kamergro_programForm">
        <input type="hidden" name="item_id" value="<?php echo $media['item_id'] ?>">
        <?php if (isset($media['id'])): ?>
            <input type="hidden" name="id" value="<?php echo $media['id'] ?>">
        <?php endif ?>
        <input type="hidden" name="url" value="<?php echo isset($media['url']) ?  $media['url'] : '' ?>">
        <input type="hidden" name="type" value="IMAGE">
        <table>
            <thead></thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo  ucfirst(ProgramTranslations::trns('__NAME__')) ?>: *
                    </td>
                    <td>
                        <input
                            type="text"
                            name="name"
                            value='<?php echo isset($media['name']) ?  $media['name'] : '' ?>'
                            maxlength="100">
                    </td>
                </tr>




                <tr>
                    <td>
                        <?php echo ucfirst( ProgramTranslations::trns('__THUMBNAIL__')) ?>
                    </td>
                    <td>


                        <table>
                            <tr>
                                <td>
                                    <?php if ( isset($media['id'])): ?>
                                        <img class="adminCategoryItemThumbnail"
                                            id="categoryItemThumbnail"
                                            src="/wp-content/plugins/kamergroprogram/images/categoryThumbnails/<?php echo $media['id'] ?>.png?random=' . <?php echo uniqid()  ?>">
                                    <?php endif ?>
                                </td>

                                <td class="thumbnailCropCell">
                                    <?php if ( isset($media['id'])) {
                                        include __DIR__ . '/partials/thumbnail.php';
                                    } else {
                                        echo  ProgramTranslations::trns('__AFTER_SAVING_A_NEW_ITEM_CATEGORY_YOU_ADD_A_THUMBNAIL__') . '<hr>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>


                    </td>
                </tr>

                <tr>
                    <td>
                        <?php echo   ucfirst(ProgramTranslations::trns('__TICKET_URL__')) ?>
                    </td>
                    <td>
                        <input type="text" name="ticket_url" value="<?php echo isset($media['ticket_url']) ?  $media['ticket_url'] : '' ?>">
                    </td>
                </tr>

                  <tr>
                    <td>
                        <?php echo  ProgramTranslations::trns('__EVENT_PAGE_URL__') ?>
                    </td>
                    <td>
                        <input type="text" name="event_page_url" value="<?php echo isset($media['event_page_url']) ?  $media['event_page_url'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo   ucfirst(ProgramTranslations::trns('__TEXT__')) ?>
                    </td>
                    <td>
                        <textarea
                            name="text"
                            id="textareaid"
                            rows="14"
                            cols="100"
                            maxlength="50"><?php echo isset($media['text']) ?  $media['text'] : '' ?></textarea>
                        <?php
                        $settings = array(

                            'media_buttons'       => false,
                            'textarea_name' => 'textareaid',
                            'tinymce'             => [
                                'plugins' => 'lists  charmap',
                                'toolbar1' => 'bold,italic,underline,emoticons,bullist,numlist,link,unlink,forecolor,undo,redo'
                            ],
                            'quicktags'           => true
                        );
                        $editor_id = 'textareaid';
                        wp_editor($media['text'], $editor_id, $settings);
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr />
        <div class="kamergro_programButtons">
            <input type="submit" id="saveEditMedia" style="float: left" value="<?php echo  ProgramTranslations::trns('__SAVE__') ?>">
        </div>

    </form>

</div>