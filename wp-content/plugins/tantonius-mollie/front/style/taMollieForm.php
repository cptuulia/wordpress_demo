<style>
    #taMollieRecurringPaymentForm {
        border: 1px solid #3A4563;
        border-radius: 20px;
        padding: 10px;
        width: 800px;
        display: none;
        position: relative;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        
    }


    #taMollieRecurringPaymentForm   p::first-letter,
    #taMollieRecurringPaymentFormConfirmation p::first-letter {
        color: black !important;
        font-size: 15px !important;
        font-weight: normal !important;
        font-family: NonBreakingSpaceOverride, "Hoefler Text", "Noto Serif", Garamond, "Times New Roman", serif !important;
        letter-spacing: normal !important;
    }

    #taMollieRecurringPaymentForm small {
        font-size: 12px;
    }

    #taMollieRecurringPaymentFormSpinner {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 20px;
        text-align: center;
        display: none;
    }

    #taMollieRecurringPaymentFormSpinner img {
        width: 25%;
        margin: auto;
    }

    #taMollieRecurringPaymentForm .senderData {
        width: 100%;
    }

    #taMollieRecurringPaymentForm .senderData p {
        float: left;
        width: 30%;
        margin: 0px !important;
        padding-right: 20px !important;
        /* padding: 0px !important;*/
        text-align: right;
    }

    #taMollieRecurringPaymentForm .senderData input {
        float: left;
        width: 40%;
        margin-bottom: 15px !important;
        margin-top: 0px !important;
        padding-right: 0px !important;
        padding-bottom: 0px !important;
        padding-top: 0px !important;
        background-color: #E8F0FE;
        border: 0px;
        border-radius: 10px;
        height: 25px;
        color: #676767;
        padding-left: 10px !important;
    }

    #taMollieRecurringPaymentForm .senderData input[type="submit"] {
        float: left;
        background-color: #3A4563;
        margin-top: 130px !important;
        width: 40% !important;
        color: white;
        padding-left: 0px !important;
        margin: auto !important;
    }


    @media only screen and (max-width: 768px) {
        #taMollieRecurringPaymentForm {
            width: 100%;
        }

        #taMollieRecurringPaymentForm .senderData p {
            text-align: left;
        }

        #taMollieRecurringPaymentForm .senderData p,
        #taMollieRecurringPaymentForm .senderData input {
            width: 100%;
        }
    }

    .taMollieInputError {
        background-color: #f2bfcc !important;
        border-radius: 15px;
    }

    #taMollieRecurringPaymentFormEmailExistsError {
        display: none;
    }

    #TaMollieRecurringAmountChoose,
    #TaMollieRecurringPeriodChoose,
    #TaMollieRecurringPaymentMethodChoose,
    #taMollieRecurringPaymentFormErrorMessages {
        margin-top: 10px;
        padding-top: 10px;
        float: left;
        width: 40%;
    }

    #TaMollieRecurringAmountChoose div {
        background-color: #E8F0FE;
        padding: 15px;
        border-radius: 20px;
        width: 45% !important;
        margin-bottom: 10px;
        margin-left: 10px;
        float: left;
        width: 20%;
        text-align: center;
        cursor: pointer;
    }

    #taMollieRecurringPaymentFormAmountDiv {
        display: none;
        width: 100% !important;
    }

    #taMollieRecurringPaymentFormAmountDiv input {
        font-size: 14px;
        width: 100% !important;
        margin: 0px;
    }

    #TaMollieRecurringPeriodChoose div {

        background-color: #E8F0FE;
        padding: 5px;
        border-radius: 10px;
        width: 95% !important;
        margin-bottom: 10px;
        margin-left: 10px;
        float: left;
        width: 20%;
        text-align: center;
        cursor: pointer;
    }

    #TaMollieRecurringPaymentMethodChoose div {

        background-color: #E8F0FE;
        padding: 5px;
        border-radius: 10px;
        width: 45% !important;
        margin-bottom: 10px;
        margin-left: 10px;
        float: left;
        width: 20%;
        text-align: center;
        cursor: pointer;
    }

    #TaMollieRecurringPaymentMethodChoose img {
        height: 80px;
    }

    #TaMollieRecurringPaymentMethodChoose p {
        width: fit-content !important;
        width: 100px !important;
        margin: auto !important;
        background-color: #3A4563;
    }


    #taMollieRecurringPaymentFormErrorMessages {
        display: none;
    }

    #taMollieRecurringPaymentFormErrorMessages div {
        background-color: #f2bfcc !important;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 10px;
        margin-left: 0px;
    }


    #TaMollieRecurringAmountChoose div:hover,
    #TaMollieRecurringPeriodChoose div:hover,
    #TaMollieRecurringPaymentMethodChoose div:hover {
        background-color: #3A4563;
    }

    #TaMollieRecurringAmountChoose div.selected,
    #TaMollieRecurringPeriodChoose div.selected,
    #TaMollieRecurringPaymentMethodChoose .selected {
        background-color: #3A4563;
        color: white;
    }

    @media only screen and (max-width: 768px) {

        #TaMollieRecurringAmountChoose,
        #TaMollieRecurringPeriodChoose,
        #taMollieRecurringPaymentFormErrorMessages {
            width: 100%;
        }

        #TaMollieRecurringAmountChoose div {
            width: 95% !important;
            margin-left: 0px;
        }


        #TaMollieRecurringPaymentMethodChoose {
            width: 95% !important;
          
        }

        #TaMollieRecurringPaymentMethodChoose div {
            width: 95% !important;
            
        }
        #TaMollieRecurringPaymentMethodChoose div img {
            margin: auto;
        }
    }

    #TaMollieRecurringAmountChoose div input {
        float: none;
    }


    #taMollieRecurringPaymentFormRegistering,
    #taMollieRecurringPaymentFormSubscribing,
    #taMollieRecurringPaymentFormSuccess,
    #taMollieRecurringPaymentFormConnecting {
        margin-top: 100px;
        display: none;
        background-color: #E3D499;
        border-radius: 15px;
        width: fit-content;
        text-align: center;
        padding: 20px;
        margin: auto;
    }

    #taMollieRecurringPaymentFormSuccess img {
        width: 100px;
        margin: auto;
    }

    #taMollieRecurringPaymentFormConfirmation {
        display: none;
        margin-top: 100px;
        background-color: #E3D499 !important;
        border-radius: 15px;
        width: 50%;
        text-align: left;
        padding: 20px;
          font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
    }

    #taMollieRecurringPaymentFormConfirmation p {
        float: left;
        margin: 0px;
        padding: 0px;
    }

    @media only screen and (max-width: 768px) {
        #taMollieRecurringPaymentFormConfirmation {

            width: 100%;

        }
    }

    #taMollieRecurringPaymentFormAjaxError {
        background-color: #f2bfcc !important;
        border-radius: 15px;
        padding: 10px;
        display: none;
    }

    #taMollieRecurringPaymentFormAjaxError img {
        width: 20%;
        display: block;
        margin-left: auto;      
        margin-right: auto;
    }
</style>