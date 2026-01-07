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
{"post_title":"Democratic Republic of the Congo","url":"democratic-republic-of-the-congo","country_code":"democratic_republic_of_the_congo","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/03\/333.jpg"},
{"post_title":"Gambia","url":"gambia","country_code":"gambia","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/SEMA-Little-Bird-1-1.jpeg"},
{"post_title":"Guatemala","url":"guatemala","country_code":"guatemala","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/3434.jpg"},
{"post_title":"Guinea","url":"guinea","country_code":"guinea","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/Picture-31.jpg"},
{"post_title":"Iraq","url":"iraq","country_code":"iraq","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/05\/23232323.png"},
{"post_title":"Ivory Coast","url":"ivory-coast","country_code":"ivory_coast","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/09\/cover-pic-scaled-e1752055640521.jpg"},
{"post_title":"Kenya","url":"kenya","country_code":"kenya","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/SEMA-Little-Bird-8.jpeg"},
{"post_title":"Kosovo","url":"kosovo","country_code":"kosovo","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/05\/ukrien-22.jpeg"},
{"post_title":"Liberia","url":"liberia","country_code":"liberia","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/DDNW-48.jpg"},
{"post_title":"Libya","url":"libya","country_code":"libya","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/03\/Syrie-Le-cri-etouffe.jpeg"},
{"post_title":"Mali","url":"mali","country_code":"mali","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/06\/Screenshot_Traces_2-Large.png"},
{"post_title":"Myanmar","url":"myanmar","country_code":"myanmar","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/08\/518299518_1149711993866277_5597547589751578353_n.jpg"},
{"post_title":"Nepal","url":"nepal","country_code":"nepal","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/02\/thumbnail_Lets-Talk-About-Rape-Angela-1.jpg"},
{"post_title":"Nigeria","url":"nigeria","country_code":"nigeria","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/04\/PHOTO-2025-04-23-14-38-48.jpg"},
{"post_title":"Rwanda","url":"rwanda","country_code":"romania","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/02\/thumbnail_Lets-Talk-About-Rape-Jaqueline-Kenya-1.jpg"},
{"post_title":"South Korea","url":"south-korea","country_code":"south_korea","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/05\/ukraine-44.jpeg"},
{"post_title":"South Sudan","url":"south-sudan","country_code":"south_sudan","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2025\/04\/PHOTO-2025-04-23-14-39-17.jpg"},
{"post_title":"Syria","url":"syria","country_code":"syria","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/07\/Flag_of_Syria_2025-.svg_.png"},
{"post_title":"Timor-Leste","url":"timor-leste","country_code":"timor-leste","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/08\/518297637_1149712000532943_7489504475186636529_n.jpg"},
{"post_title":"Uganda","url":"uganda","country_code":"uganda","country_image":"https:\/\/development.semanetwork.org\/wp-content\/uploads\/2024\/08\/berdenatte.jpg"},
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
