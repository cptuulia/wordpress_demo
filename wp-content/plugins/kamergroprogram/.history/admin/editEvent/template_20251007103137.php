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

    <?php if (isset($media['type'])): ?>
        <div class="kamergro_programmMediaEditWrapper">
            <?php switch ($media["type"]) {
                case 'IMAGE':
                    include __DIR__ . '/partials/image.php';
                    break;
                case 'YOUTUBE':
                    include __DIR__ . '/partials/youtube.php';
                    break;
            }

            ?>
        </div>
        <hr>
    <?php endif; ?>

    <form name="editMedia"
        method="post"
        action="<?php $_SERVER["REQUEST_URI"]  ?>"
        enctype="multipart/form-data"
        class="kamergro_programForm">
        <input type="hidden" name="item_id" value="<?php echo $media['item_id'] ?>">
        <?php if (isset($media['id'])): ?>
            <input type="hidden" name="id" value="<?php echo $media['id'] ?>">
        <?php endif ?>

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
                            value="<?php echo isset($media['name']) ?  $media['name'] : '' ?>"
                            maxlength="40">
                    </td>
                </tr>





                <tr>
                    <td>Image url : *</td>
                    <td>
                        <input type="text" name="url" value="<?php echo isset($media['url']) ?  $media['url'] : '' ?>">
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

                  <tr>
                    <td>
                        <?php echo  ProgramTranslations::trns('__EVENT_URL__') ?>
                    </td>
                    <td>
                        <input type="text" name="ticket_url" value="<?php echo isset($category['ticket_url']) ?  $category['ticket_url'] : '' ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo  ProgramTranslations::trns('__TEXT__') ?>
                    </td>
                    <td>
                        <textarea
                            name="text"
                            id="textareaid"
                            rows="14"
                            cols="100"
                            maxlength="450"><?php echo isset($media['text']) ?  $media['text'] : '' ?></textarea>
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