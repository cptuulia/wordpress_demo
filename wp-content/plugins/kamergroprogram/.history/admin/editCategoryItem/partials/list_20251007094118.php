     <h2><?php echo ucfirst(ProgramTranslations::trns('__EVENTS__')) ?></h2>
     <div class="kamergro_programButtons">
         <a class="kamergro_programButton" href="/wp-admin/admin.php?page=program%2Feditcategoryitemmedia&item=<?php echo $categoryItem['id']; ?>">
             +
         </a>
     </div>
     <table class="kamergro_programIndex">
         <thead>
             <th></th>
             <th colspan="5"><?php echo  ProgramTranslations::trns('__NAME__') ?></th>
         </thead>
         <tbody>
             <?php $rowClass = "oneven" ?>
             <?php
                $index = 0;
                $maxOrdering = 0;
                ?>

             <?php foreach ($medias as $media) : ?>
                 <?php $rowClass = $rowClass == "oneven" ? "" : "oneven"; ?>
                 <tr class="<?php echo $rowClass; ?> mediaRow" rel="<?php echo $media['ordering'] ?>">
                     <td style ="width: 0px;">
                        <input 
                            type="hidden"
                            name="mediaOrdering[<?php echo $index ?>][id]"
                            value="<?php echo $media['id'] ?>"
                        >
                        <input 
                             type="hidden" 
                             name="mediaOrdering[<?php echo $index ?>][ordering]"
                             value="<?php echo $media['ordering'] ?>"
                             class="mediaOrdering"
                         >
                     </td>
                     <td style="width: 20%;">
                         <div class="kamergro_programmMediaThumbnail">
                             <?php switch ($media["type"]) {
                                    case 'IMAGE':
                                        include __DIR__ . '/image.php';
                                        break;
                                    case 'YOUTUBE':
                                        include __DIR__ . '/youtube.php';
                                        break;
                                }

                                ?>
                         </div>

                         <?php echo $media["type"]; ?>
                     </td>
                     <td>
                         <input type="hidden" name="medias[<?php echo $index; ?>][id]" value=" <?php echo $media["id"]; ?>">
                         <input type="hidden" name="medias[<?php echo $index; ?>][name]" value=" <?php echo $media["name"]; ?>">
                         <a href="/wp-admin/admin.php?page=program%2Feditcategoryitemmedia&media=<?php echo $media["id"] ?>">
                             <?php echo $media["name"]; ?>

                         </a>
                     </td>
                     <td style="width: 5%;">
                         <a href="/wp-admin/admin.php?page=program%2Feditcategoryitemmedia&media=<?php echo $media["id"] ?>"
                             class="dashicons dashicons-edit"
                             style="margin: 0px; padding: 0px;">
                         </a>
                     </td>
                     <td style="width: 5%;">
                         <div class="dashicons dashicons-arrow-up orderMatchesUp"
                             rel="<?php echo $media['ordering'] ?>"
                             style="margin: 0px; padding: 0px;">
                         </div>
                         <div
                             class="dashicons dashicons-arrow-down orderMatchesDown"
                             rel="<?php echo $media['ordering'] ?>"
                             style="margin: 0px; padding: 0px;">
                         </div>
                     </td>
                     <td style="width: 5%;">
                         <a
                             class="dashicons dashicons-trash delete"
                             rel="<?php echo $media["id"] ?>__<?php echo $media["name"] ?>"
                             style="margin: 0px; padding: 0px;">
                         </a>
                     </td>
                 </tr>
                 <?php
                    $index++;
                    if ($maxOrdering < $media['ordering']): $maxOrdering = $media['ordering'];
                    endif;
                    ?>
             <?php endforeach; ?>
         </tbody>
     </table>
     <hr />