 <hr>

 <h2><?php echo ucfirst(ProgramTranslations::trns('__DATES__')) ?></h2>
 <div class="kamergro_programButtons">
     <a class="kamergro_programButton" href="/wp-admin/admin.php?page=program%2Feditcategoryitem&category=<?php echo $category['id']; ?>">
         +
     </a>
 </div>
 <table class="kamergro_programIndex">
     <thead>
         <th colspan="6"><?php echo  ProgramTranslations::trns('__DATE__') ?></th>

     </thead>
     <tbody>
         <?php $rowClass = "oneven" ?>
         <?php $index = 0; ?>
         <?php foreach ($items as $item) : ?>
             <?php $rowClass = $rowClass == "oneven" ? "" : "oneven"; ?>
             <tr class="<?php echo $rowClass; ?> itemRow" rel="<?php echo $item['ordering'] ?>">
                <td style ="width: 0px;">
                        <input 
                            type="hidden"
                            name="itemOrdering[<?php echo $index ?>][id]"
                            value="<?php echo $item['id'] ?>"
                        >
                        <input 
                             type="hidden" 
                             name="itemOrdering[<?php echo $index ?>][ordering]"
                             value="<?php echo $item['ordering'] ?>"
                             class="itemOrdering"
                         >
                     </td>
                 <td>
                     <input type="hidden" name="items[<?php echo $index; ?>][id]" value=" <?php echo $item["id"]; ?>">
                     <input type="hidden" name="items[<?php echo $index; ?>][name]" value=" <?php echo $item["name"]; ?>">
                     <?php if (isset($item['thumbnail'])): ?>
                         <img
                             style="width: 5em;"
                             src="<?php echo isset($item['thumbnail']) ?  $item['thumbnail'] . '?random=' . uniqid()  : '' ?>"><br>
                     <?php endif ?>
                 </td>
                 <td>

                     <a href="/wp-admin/admin.php?page=program%2Feditcategoryitem&item=<?php echo $item["id"] ?>">
                         <?php echo $item["name"]; ?>
                     </a>
                 </td>
                 <td style="width: 5%;">
                     <a href="/wp-admin/admin.php?page=program%2Feditcategoryitem&item=<?php echo $item["id"] ?>"
                         class="dashicons dashicons-edit"
                         style="margin: 0px; padding: 0px;">
                     </a>
                 </td>

                     <td>
                         <div class="dashicons dashicons-arrow-up orderMatchesUp"
                             rel="<?php echo $item['ordering'] ?>"
                             style="margin: 0px; padding: 0px;">
                         </div>
                         <div
                             class="dashicons dashicons-arrow-down orderMatchesDown"
                             rel="<?php echo $item['ordering'] ?>"
                             style="margin: 0px; padding: 0px;">
                         </div>
                     </td>
                 <td style="width: 5%;">
                     <a
                         class="dashicons dashicons-trash delete"
                         rel="<?php echo $item["id"] ?>__<?php echo $item["name"] ?>"
                         style="margin: 0px; padding: 0px;">
                     </a>
                 </td>
             </tr>
             <?php $index++; ?>
         <?php endforeach; ?>
     </tbody>
 </table>