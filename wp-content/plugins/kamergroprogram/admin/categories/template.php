<?php
 /************************************************************* 
  *  
  * categories
  * 
  ************************************************************ */
?>

<div class='slidehowAdminPage'>

    <h1><?php echo ucfirst( ProgramTranslations ::trns('__PROGRAMS__')); ?></h1>

 <div class="kamergro_programButtons">
            <a class="kamergro_programButton" href="/wp-admin/admin.php?page=program%2Feditcategory">
                +
            </a>
        </div>
   
        <table class="kamergro_programIndex">
            <thead>
                <th colspan="3"><?php echo  ProgramTranslations::trns('__YEAR__') ?></th>
            </thead>
        <tbody>
            <?php $rowClass = "oneven" ?>
            <?php foreach ($categories['data'] as $category) : ?>
                <?php $rowClass = $rowClass == "oneven" ? "" : "oneven"; ?>
                <tr class="<?php echo $rowClass; ?>">
                    <td>
                        <a href="/wp-admin/admin.php?page=program%2Feditcategory&category=<?php echo $category["id"] ?>">
                            <?php echo $category["name"]; ?>
                        </a>
                    </td>
                    <td style="width: 5%;">
                        <a href="/wp-admin/admin.php?page=program%2Feditcategory&category=<?php echo $category["id"] ?>"
                            class="dashicons dashicons-edit"
                            style="margin: 0px; padding: 0px;"
                        >
                        </a>
                    </td>
                     <td style="width: 5%;">
                            <a
                                class="dashicons dashicons-trash delete"
                                rel="<?php echo  $category["id"] ?>__<?php echo  $category["name"] ?>"
                                style="margin: 0px; padding: 0px;">
                            </a>
                        </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>