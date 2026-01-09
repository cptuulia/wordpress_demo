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
{"post_title":"Afghanistan","url":"Afghanistan","country_code":"afganistan","country_image":"afganistan.png"},
{"post_title":"Bangladesh","url":"Bangladesh","country_code":"bangladesh","country_image":"bangladesh.png"},
{"post_title":"Bosnia and Herzegovina","url":"Bosnia-and-Herzegovina","country_code":"bosnia_and_herzegovina","country_image":"bosnia-and-herzegovina.png"},
{"post_title":"Burundi","url":"Burundi","country_code":"burundi","country_image":"burundi.png"},
{"post_title":"Central African Republic","url":"Central-African-Republic","country_code":"central_african_republic","country_image":"central-african-republic.png"},
{"post_title":"Colombia","url":"Colombia","country_code":"colombia","country_image":"colombia.png"},
{"post_title":"Liberia","url":"Liberia","country_code":"liberia","country_image":"liberia.png"},
{"post_title":"Libya","url":"libya","country_code":"libya","country_image":"libya.png"},
{"post_title":"Mali","url":"Mali","country_code":"mali","country_image":"mali.png"},
{"post_title":"Ukraine","url":"Ukraine","country_code":"ukraine","country_image":"ukraine.png"},
{"post_title":"Zimbabwe","url":"Zimbabwe","country_code":"zimbabwe","country_image":"zimbabve.png"}
]
}
]
';
$data = current(json_decode($data))->data;

      
        foreach ($data as $row) {
          
             self::$countries[] =
                [
                    'wm_country' => $row->country_code,
                    'wm_url' => 'https://www.britannica.com/place/' . $row->url,
                    'wm_country_title' =>  $row->post_title,
                    'wm_image_url' => '/wp-content/plugins/tantonius-worldmap/images/countryImages/' . $row->country_image,
                ];
        }
        return self::$countries;
    }

    public static function renderLink($country, array $options =[]): string {

        $href = $country['wm_url'];
        $title = $country['wm_country_title'];
        return '<a href="' . $href.'" target="_blank">' . $title.'</a>';

    }

}
