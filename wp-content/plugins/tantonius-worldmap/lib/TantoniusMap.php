<?php
class TantoniusMap
{
    private static array $countries = [];
    /**
     * Get countries defined in ../front/map/partials/mapCoordinates.php
     * 
     */
    public static function definedCountries(): array
    {
        $out = file_get_contents(__DIR__ .  '/../front/map/partials/mapCoordinates.php');
        $startTag = '<g id="';
        $endTag = '">';
        $pattern = "/" . preg_quote($startTag, '/') . "(.*?)" . preg_quote($endTag, '/') . "/";
        preg_match_all($pattern, $out, $matches);
        $matches = $matches[1];
        sort($matches);
        return $matches;
    }

    /**
     * Active countries
     */
    public static function activeCountries(): array
    {

        if (!empty(self::$countries)) {
            return self::$countries;
        }

     $data= '[

{
"data":
[
{"post_title":"Afghanistan","url":"afghanista","country_code":"afganistan","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/08\/517585569_1149711920532951_4982803261649520416_n.jpg"},
{"post_title":"Bangladesh","url":"bangladesh","country_code":"bangladesh","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/6FD438B9-9647-4714-A566-F2ACFBF578DE-1.jpeg"},
{"post_title":"Bosnia and Herzegovina","url":"bosnia-and-herzegovina","country_code":"bosnia_and_herzegovina","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/05\/Picture-1.png"},
{"post_title":"Burundi","url":"burundi","country_code":"burundi","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/05\/Screenshot-2025-05-19-at-15.48.36.png"},
{"post_title":"Central African Republic","url":"central-african-republic","country_code":"central_african_republic","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/09\/13-Mona-scaled-1.jpg"},
{"post_title":"Colombia","url":"colombia","country_code":"colombia","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/26607028194_462cb29cce_o.jpg"},
{"post_title":"Liberia","url":"liberia","country_code":"liberia","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/DDNW-48.jpg"},
{"post_title":"Libya","url":"libya","country_code":"libya","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/03\/Syrie-Le-cri-etouffe.jpeg"},
{"post_title":"Mali","url":"mali","country_code":"mali","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/06\/Screenshot_Traces_2-Large.png"},
{"post_title":"Ukraine","url":"ukraine","country_code":"ukraine","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/PHOTO-2025-02-26-17-21-25.jpg"},
{"post_title":"Zimbabwe","url":"zimbabwe","country_code":"zimbabwe","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/09\/13-Mona-scaled-1.jpg"}
]
}
]
';
$data = current(json_decode($data))->data;

      
        foreach ($data as $row) {
          
             self::$countries[] =
                [
                    'wm_country' => $row->country_code,
                    'wm_url' => '/country/' . $row->url,
                    'wm_country_title' =>  $row->post_title,
                    'wm_image_url' => $row->country_image,
                ];
        }
        return self::$countries;
    }

    public static function renderLink($country, array $options =[]): string {

        $href = $country['wm_url'];
        $title = $country['wm_country_title'];
         return '<a href="' . $href.'">' . $title.'</a>';
        return '<a href="s">s</a>';
        if (! $country['wm_country_title']) {
            return 's';
        }
        $class = isset($options['class']) ? $options['class'] : ' ';
        $link = '<a href="' . $href. '" >' . $title .'<a>';
        return $link;
    }

}
