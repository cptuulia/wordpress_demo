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
                            maxlength="40"
                        >
                    </td>
                </tr>


                <?php if (!isset($media['id'])): ?>
                    <tr>
                        <td>
                            <?php echo  ucfirst(ProgramTranslations::trns('__TYPE__')) ?>:
                        </td>
                        <td>
                            <input name="type" id="categoryItemTypeSelect">
                                <?php echo EditEvent::typeMenu(isset($media['type']) ?  $media['type'] : ''); ?>
                            </select>
                        </td>
                    </tr>
                <?php endif; ?>


                <tr id="categoryItemUrl">
                    <td>Url: *</td>
                    <td>
                        <input type="text" name="url" value="<?php echo isset($media['url']) ?  $media['url'] : '' ?>">
                    </td>
                </tr>
                <?php if (!isset($media['url'])) : ?>
                    <?php 
                            /* 
                                There is a bug in wp-content/plugins/kamergro_program/api_/App/Services/MediaService.php 
                                "public function update"  on tantonius.com, delte crashes, so we don't update.
                                See more in function.
                            */ 
                    ?>
                    <tr id="categoryItemPhoto">
                        <td> <?php echo  ucfirst(ProgramTranslations::trns('__PHOTO__')) ?>:</td>
                        <td>
                            <input type="file" name="categoryItemPhoto" id="categoryItemPhoto" />
                        </td>
                    </tr>
                <?php endif ?>
                <tr>
                    <td>
                        <?php echo  ucfirst(ProgramTranslations::trns('__TEXT__')) ?>:
                    </td>
                    <td>
                        <textarea
                            name="text"
                            rows="4"
                            cols="100"
                            maxlength="450"><?php echo isset($media['text']) ?  $media['text'] : '' ?></textarea>
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