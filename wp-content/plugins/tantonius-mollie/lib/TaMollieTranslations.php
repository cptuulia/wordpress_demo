<?php


class TaMollieTranslations
{

    private static string $locale = 'en_GB';
    public static function trns(string $key, array $placeholders = []): string
    {
        $locale = self::$locale;
        $translations = self::translations();
        $translation = isset($translations[$key][$locale]) ? $translations[$key][$locale] : $key;
        return $translation;
    }

    /**
     * set Locale
     */
    public static function setLocale(string $locale):void {
        self::$locale = $locale;
    }


    private static function translations(): array
    {
        return [
            '__1 MONTH__' =>
            [
                'en_GB' => '1 Month',
                'nl_NL' => '1 Maand',
            ],
            '__2 MONTHS__' =>
            [
                'en_GB' => '2 Months',
                'nl_NL' => '2 Maanden',
            ],
            '__3 MONTHS__' =>
            [
                'en_GB' => '3 Months',
                'nl_NL' => '3 Maanden',
            ],
            '__4 MONTHS__' =>
            [
                'en_GB' => '4 Months',
                'nl_NL' => '4 Maanden',
            ],
            '__6 MONTHS__' =>
            [
                'en_GB' => '6 Months',
                'nl_NL' => '6 Maanden',
            ],
            '__12 MONTHS__' =>
            [
                'en_GB' => '12 Months',
                'nl_NL' => '12 Maanden',
            ],

            '__AMOUNT__' =>
            [
                'en_GB' => 'Amount',
                'nl_NL' => 'Bedrag',
            ],
            '__AMOUNT_EUR__' =>
            [
                'en_GB' => 'Amount (Eur)',
                'nl_NL' => 'Bedrag (Eur)',
            ],
             '__BACK__' =>
            [
                'en_GB' => 'Back',
                'nl_NL' => 'Terug',
            ],
              '__CANCEL__' =>
            [
                'en_GB' => 'Cancel',
                'nl_NL' => 'Annuleren',
            ],
               '__CANCEL_THIS_SUBSCRIPTION__' =>
            [
                'en_GB' => 'Cancel this subscription',
                'nl_NL' => 'Dit abonnement annuleren',
            ],
              '__CANCEL_ERROR__' =>
            [
                'en_GB' => 'An error has occurred. Our technical support has received a message.',
                'nl_NL' => 'Er is een fout opgetreden. Onze technische ondersteuning heeft een bericht ontvangen.',
            ],
             '__CANCEL_SUBSCRIPTION__' =>
            [
                'en_GB' => 'Cancel subscription',
                'nl_NL' => 'Abonnement annuleren',
            ],
             '__CLIENT_NOT_FOUND__' =>
            [
                'en_GB' => 'Client not found',
                'nl_NL' => 'Klant niet gewonden.',
            ],
             '__CONFIRM__' =>
            [
                'en_GB' => 'Please confirm your donation.',
                'nl_NL' => 'Please confirm your donation.',
            ],
            '__CONNECTING__' =>
            [
                'en_GB' => 'Connecting',
                'nl_NL' => 'Verbinden',
            ],
             '__EMAIL__' =>
            [
                'en_GB' => 'Email',
                'nl_NL' => 'E-mail',
            ],
             '__EMAIL_EXISTS__' =>
            [
                'en_GB' => 'This email has already ben registered. Please contact us if you want to change your donation type.',
                'nl_NL' => 'Dit e-mailadres is al geregistreerd. Neem contact met ons op als u uw donatietype wilt wijzigen.',
            ],
             '__FIRST_NAME__' =>
            [
                'en_GB' => 'First Name',
                'nl_NL' => 'Naam',
            ],
              '__FAMILY_NAME__' =>
            [
                'en_GB' => 'Family Name',
                'nl_NL' => 'Achternaam',
            ], 
              '__MANDATE_INFO__' =>
            [
                'en_GB' => 'We need your authorization  to automatically collect recurring payments from their bank account or credit card and as first you need to pay 1 euro cent from your account.',
                'nl_NL' => 'Wij hebben uw toestemming nodig om automatisch terugkerende betalingen van uw bankrekening of creditcard te innen. U moet eerst 1 eurocent van uw rekening afschrijven.',
            ], 
            
               '__PERIOD__' =>
            [
                'en_GB' => 'Period',
                'nl_NL' => 'Periode',
            ],
             '__MOLLIE_ERROR__' =>
            [
                'en_GB' => 'There has been a problem with the payment process. We have your inputed data and will contact you.',
                'nl_NL' => 'Er is een probleem opgetreden tijdens het betaalproces. We hebben uw gegevens ingevuld en nemen contact met u op.',
            ],
             '__NAME__' =>
            [
                'en_GB' => 'Name',
                'nl_NL' => 'Naam',
            ],
             '__ONCE__' =>
             [
                'en_GB' => 'Once',
                'nl_NL' => 'Eenmalig',
            ],
            '__PLEASE_CHECK_THE_FORM_FIELDS__' =>
             [
                'en_GB' => 'Please check the fields.',
                'nl_NL' => 'Verifeer de velden.',
            ],
            '__OTHER_AMOUNT__' =>
             [
                'en_GB' => 'Other amount',
                'nl_NL' => 'Andere bedrag',
            ],
               '__PAYMENT_METHOD__' =>
            [
                'en_GB' => 'Payment method',
                'nl_NL' => 'Betaalmethode',
            ],
              '__REGISTERING__' =>
            [
                'en_GB' => 'Registering...',
                'nl_NL' => 'Bezig met het inschrijven…',
            ],
              '__SUBSCRIPTION__' =>
            [
                'en_GB' => 'Subscription',
                'nl_NL' => 'Abonnement',
            ],
              '__SUBSCRIBING__' =>
            [
                'en_GB' => 'Making a subscription. This lasts some seconds.',
                'nl_NL' => 'Bezig met het abonneren. Dit duurt enkele seconden.',
            ],
             '__SEND__' =>
            [
                'en_GB' => 'Send',
                'nl_NL' => 'Verzenden',
            ],
          
              '__SUBCRIPTION_CANCELLED__' =>
            [
                'en_GB' => 'Your subscription is cancelled.',
                'nl_NL' => 'Uw abonnement is geannuleerd.',
            ],
              '__THANKS_FOR_DONATING__' =>
            [
                'en_GB' => 'Thankyou for donating.',
                'nl_NL' => 'Bedankt voor het doneren.',
            ],
            
        ];
    }
}
