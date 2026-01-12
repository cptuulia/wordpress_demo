<?php
/**
 * Enable this by adding to <body> id = 'google_translate_element'
 */
?>
<style>
    .skiptranslate {
       
    }
    #google_translate_element select {
    }

    #google_translate_element div {
    
    }

    #google_translate_element span {    
    }

    .goog-te-gadget-simple {
        position: absolute;
        top: 0;
        right: -35px;
        z-index: 1000;
        width: 150px;
        border: 0px;
        display: block;
        padding: 0px;
        margin-right: 0px;
    }

    .goog-te-gadget-simple span,
    .goog-te-gadget-simple img {
        display: block;
        float: left;
        border: 0px !important;
    }

      .goog-te-gadget-simple img {
        display: none
        
    }

</style>

<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
            {
                pageLanguage: 'en', includedLanguages : 'en,fi,nl',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            },
            'google_translate_element'
        );
    }
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
