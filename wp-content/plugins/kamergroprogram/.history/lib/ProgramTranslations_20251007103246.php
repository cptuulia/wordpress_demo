<?php


class ProgramTranslations
{

    public static function trns(string $key, array $placeholders = []): string
    {
        $locale = 'en_GB';
        $translations = self::translations();
        $translation = isset($translations[$key][$locale]) ? $translations[$key][$locale] : $key;
        return $translation;
    }


    private static function translations(): array
    {
        return [
             '__AFTER_SAVING_A_NEW_CATEGORY_YOU_CAN_ADD_ITEMS__' =>
            [
                'en_GB' => 'After saving a new category you can add items.',
                'nl_NL' => 'Na het opslaan van een nieuwe categorie kunt u items toevoegen.',
            ],
            '__AFTER_SAVING_A_NEW_ITEM_CATEGORY_YOU_CAN_ADD_MEDIA_ITEMS__' =>
            [
                'en_GB' => 'After saving a new item you can add media items.',
                'nl_NL' => 'Na het opslaan van een nieuwe item kunt u media items toevoegen.',
            ],
            '__AFTER_SAVING_A_NEW_ITEM_CATEGORY_YOU_ADD_A_THUMBNAIL__' =>
            [
                'en_GB' => 'After saving a new category you can add a thumbnail.',
                'nl_NL' => 'Nadat u een nieuwe categorie hebt opgeslagen, kunt u een thumbnail toevoegen.',
            ],
            '__ARE_YOU_SUER_YOUWANT_TO_DELETE__' =>
            [
                'en_GB' => 'Are you sure you want to delete ;',
                'nl_NL' => 'Bent u zeker dat u wilt verwijderen :',
            ],
            '__CATEGORIES__' =>
            [
                'en_GB' => 'categories_',
                'nl_NL' => 'categorieën',
            ],
            '__CATEGORY__' =>
            [
                'en_GB' => 'category_',
                'nl_NL' => 'categorie',
            ],
            '__CATEGORY_SHORT_CODE_HELP__' =>
            [
                'en_GB' => 'With this code you can render on page the index of this category.',
                'nl_NL' => 'Met deze code kan men de lijst van de items van deze categorie op een pagina weergeven.',
            ],
             '__CATEGORY_ITEM_SHORT_CODE_HELP__' =>
            [
                'en_GB' => 'With this code you can render on page the photos and vidoes of this item.',
                'nl_NL' => "Met deze code kan men de foto's en video's van dit item op een pagina renderen.",
            ],
               '__EVENT__'  =>
            [
                'en_GB' => 'event',
                'nl_NL' => 'evenemnt',
            ],
            '__EVENTS__'  =>
            [
                'en_GB' => 'Events',
                'nl_NL' => "Evenementen",
            ],
            '__EVENTS__'  =>
            [
                'en_GB' => 'Events',
                'nl_NL' => "Evenementen",
            ],
             '__DATE__'  =>
            [
                'en_GB' => 'date',
                'nl_NL' => "datum",
            ],
            '__DATES__'  =>
            [
                'en_GB' => 'dates',
                'nl_NL' => "datums",
            ],
             '__EXAMPLE__' =>
            [
                'en_GB' => 'example',
                'nl_NL' => 'voorbeeld',
            ],
            '__ITEM__' =>
            [
                'en_GB' => 'item',
                'nl_NL' => 'item',
            ],
            '__ITEMS__' =>
            [
                'en_GB' => 'items',
                'nl_NL' => 'items',
            ],
            '__MEDIA__' =>
            [
                'en_GB' => 'media item',
                'nl_NL' => 'media item',
            ],
            '__MEDIAS__' =>
            [
                'en_GB' => 'media items',
                'nl_NL' => 'media item',
            ],
            '__NAME__' =>
            [
                'en_GB' => 'name',
                'nl_NL' => 'naam',
            ],
            '__NEW_ITEM__' =>
            [
                'en_GB' => 'new item',
                'nl_NL' => 'nieuw item',
            ],
            '__SAVE__' =>
            [
                'en_GB' => 'save',
                'nl_NL' => 'opslaan',
            ], 
              '__SLOGAN__' =>
            [
                'en_GB' => 'slogan',
                'nl_NL' => 'slogan',
            ], 
             '__SLOGANS__' =>
            [
                'en_GB' => 'slogans',
                'nl_NL' => 'slogans',
            ], 
            '__PAGE__' =>
            [
                'en_GB' => 'page',
                'nl_NL' => 'pagina',
            ],
            '__PROGRAMS__'=>
            [
                'en_GB' => 'programs',
                'nl_NL' => 'programmas',
            ],
            '__PHOTO__' =>
            [
                'en_GB' => 'photo',
                'nl_NL' => 'foto',
            ],
             '__TEXT__' =>
            [
                'en_GB' => 'text',
                'nl_NL' => 'tekst',
            ],
            '__THUMBNAIL__' =>
            [
                'en_GB' => 'thumbnail',
                'nl_NL' => 'thumbnail',
            ],
            '__TICKET_URL__' =>
            [
                'en_GB' => 'ticket url',
                'nl_NL' => 'ticket url',
            ],
             '__TYPE__' =>
            [
                'en_GB' => 'type',
                'nl_NL' => 'type',
            ],
            '__YEAR__' =>
            [
                'en_GB' => 'year',
                'nl_NL' => 'jaar',
            ],
        ];
    }
}
