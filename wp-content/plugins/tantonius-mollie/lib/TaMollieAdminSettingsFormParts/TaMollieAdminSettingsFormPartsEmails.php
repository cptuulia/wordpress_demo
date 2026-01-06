<?php

use App\Email;


require_once __DIR__  . '/../../api/App/Email.php';
/**
 * @property string $wpOptionName
 * @property string $pluginSectionName
 */
trait TaMollieAdminSettingsFormPartsEmails
{


    /**
     * Register API section in the form
     */
    public static function registerMollieClientEmailsSection()
    {
        $apiSettingSectionKey = 'email_settings';
        add_settings_section(
            $apiSettingSectionKey,
            'Email content',
            [self::class, 'emailsSectionText'],
            self::$pluginSectionName
        );

        add_settings_field(
            self::$pluginSectionName . 'from_email',
            'From email',
            [self::class, 'fromEmail'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );

        add_settings_field(
            self::$pluginSectionName . 'reply_email',
            'Reply email',
            [self::class, 'replyEmail'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );

        add_settings_field(
            self::$pluginSectionName . 'welcome_mail',
            'Welcome mail',
            [self::class, 'welcomeMail'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );

        add_settings_field(
            self::$pluginSectionName . 'payment_mail',
            'Payment mail',
            [self::class, 'paymentMail'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );

        add_settings_field(
            self::$pluginSectionName . 'cancel_mail',
            'Cancel mail',
            [self::class, 'cancelMail'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );

        add_settings_field(
            self::$pluginSectionName . 'footer',
            'Footer',
            [self::class, 'footer'],
            self::$pluginSectionName,
            $apiSettingSectionKey
        );
    }
    /**
     * Text to API section
     */
    public static function emailsSectionText()
    {
        echo '<p>Here you can define the e-mail content with the optional placeholders as in the example below.</p>';
        echo '<p style ="border:solid 1px grey;  border-radius: 15px; width:500px; padding:10px">';
        echo 'Dear [NAME]<br>';
        echo 'Your email is  [EMAIL] and your client id is  [CLIENT_ID].<br>';
        echo 'We have charged you  [AMOUNT] by your  [SUBSCRIPTION_TYPE] subscription. <br>';
        echo 'Your can cancel your subscription by clicking the link  [CANCELLATION_LINK] .';
        echo '</p>';
    }

    /**
     * From email fields
     */
    public static function fromEmail()
    {
        self::emailFromAndReplyFields('from', 'This mail and name are shown "from" email and name in the mailbox.');
    }

    /**
     * Reply email fields
     */
    public static function replyEmail()
    {
        self::emailFromAndReplyFields('reply', 'This mail and name are shown "reply" email and name.');
    }

    /**
     * From and Reply email fields
     */
    public static function emailFromAndReplyFields(string $type, string $description)
    {
        $options = get_option(self::$wpOptionName);

        echo '<span style ="font-size: small;">' . $description . '</span><br><br>';
        echo '<span style ="font-size: small;">Email</span><br>';
        echo '<input 
            id="mollie_' . $type . '_email" 
            name = "' . self::$wpOptionName . '[' . $type . '_email]" 
            type = "text" 
            value="' . esc_attr($options[$type . '_email']) . '" 
        ><br>';
        echo '<span style ="font-size: small;">Name</span><br>';
        echo '<input 
            id="mollie_' . $type . '_email" 
            name = "' . self::$wpOptionName . '[' . $type . '_name]" 
            type = "text" 
            value="' . esc_attr($options[$type . '_name']) . '" 
        ><br>';
    }



    /**
     *  welcomeMail
     */
    public static  function welcomeMail()
    {
        self::mailFields('welcome', 'Mail after a subscription is done.');
    }


    /**
     *  paymentMail
     */
    public static  function paymentMail()
    {
        self::mailFields('payment', 'Mail after a each periodic payement.');
    }
    public static  function cancelMail()
    {
        self::mailFields('cancel', 'Mail after a subscription is cancelled.');
    }

    /**
     *  mailFields
     */
    private static function mailFields(string $type, string $description): void
    {
        $options = get_option(self::$wpOptionName);
        echo '<span style ="font-size: small;">' . $description . '</span><br><br>';
        echo '<span style ="font-size: small;">Subject</span><br>';
        echo '<input 
            id="mollie_' . $type . '_email_subject" 
            name = "' . self::$wpOptionName . '[' . $type . '_mail_subject]" 
            type = "text" 
            value="' . esc_attr($options[$type . '_mail_subject']) . '" 
        ><br>';

        echo '<span style ="font-size: small;">Content</span><br>';
        echo '<textarea 
         rows="10" 
         cols="50"
        id="mollie_' . $type . '_email_body" 
         name="' . self::$wpOptionName . '[' . $type . '_mail]"  
        />';
        echo esc_attr($options[$type . '_mail']);
        echo "</textarea>";
    }

    /**
     * footer
     */
    public static function footer()
    {

        $options = get_option(self::$wpOptionName);

        echo '<span style ="font-size: small;">Logo and footer</span><br><br>';

        echo Email::footer($options['footer_logo'], $options['footer_text']);


        echo '<span style ="font-size: small;"><br> Logo url </span><br>';
        echo '<input 
            id="mollie_footer_logo" 
            name = "' . self::$wpOptionName . '[footer_logo]" 
            type = "text" 
            value="' . esc_attr($options['footer_logo']) . '" 
        ><br>';
        echo '<span style ="font-size: small;">Text</span><br>';

        echo '<textarea 
         rows="4" 
         cols="50"
        id="mollie_footer_text" 
         name="' . self::$wpOptionName . '[footer_text]"  
        />';
        echo esc_attr($options['footer_text']);
        echo "</textarea>";
    }
}
