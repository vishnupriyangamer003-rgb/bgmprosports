<link
    rel="stylesheet"
    href="{{ asset('vendor/core/core/base/libraries/intl-tel-input/css/intlTelInput-v2.min.css') }}"
>

<style>
    .iti {
        width: 100%;
        display: block;
    }

    .iti__input {
        width: 100% !important;
    }

    .position-relative .iti {
        width: 100%;
    }

    .auth-input-icon+.iti {
        padding-left: 2.5rem;
    }

    .auth-input-icon+.iti .iti__input {
        padding-left: 3rem;
    }

    .iti__country-list {
        z-index: 1050;
        max-width: 500px;
        list-style: none !important;
        padding: 0 !important;
    }

    @media (max-width: 576px) {
        .iti__country-list {
            max-width: calc(100vw - 30px);
        }
    }

    .iti__country-list .iti__search-container {
        position: sticky;
        top: 0;
        background: #fff;
        padding: 8px !important;
        border-bottom: 1px solid #e0e0e0;
        z-index: 1;
    }

    .iti__country-list .iti__search-input {
        width: 100%;
        padding: 8px 10px !important;
        border: 1px solid #ddd;
        border-radius: 4px;
        outline: none;
        font-size: 14px;
        box-sizing: border-box;
        color: #333;
        background-color: #fff;
    }

    .iti__country-list .iti__search-input:focus {
        border-color: #1e88e5;
    }

    .iti__country.iti__hidden {
        display: none !important;
    }

    .iti__no-results {
        padding: 10px 15px;
        color: #999;
        text-align: center;
        font-size: 14px;
    }

    .iti__country-list li {
        list-style: none !important;
    }

    .iti--separate-dial-code .iti__selected-dial-code {
        padding-left: 6px;
    }

    body[dir="rtl"] .iti {
        direction: ltr;
        text-align: left;
    }

    body[dir="rtl"] .iti__input {
        direction: ltr;
        text-align: left;
    }

    body[dir="rtl"] .auth-input-icon+.iti {
        padding-left: 0;
        padding-right: 2.5rem;
    }

    body[dir="rtl"] .auth-input-icon+.iti .iti__input {
        padding-left: 0;
        padding-right: 3rem;
    }

    body[dir="rtl"] .iti--separate-dial-code .iti__selected-dial-code {
        padding-left: 0;
        padding-right: 6px;
    }

    body[dir="rtl"] .iti__country-list {
        text-align: left;
    }

    body[dir="rtl"] .iti__country {
        padding-left: 15px !important;
    }

    body[dir="rtl"] .iti-mobile .iti--container {
        left: 15px !important;
        right: 15px !important;
        direction: ltr;
    }

    body[dir="rtl"] .iti-mobile .iti__country-list {
        width: 100%;
        max-width: none;
    }

    @media (max-width: 768px) {
        body[dir="rtl"] .iti--container {
            direction: ltr;
            left: 15px !important;
            right: 15px !important;
        }

        body[dir="rtl"] .iti__country-list {
            white-space: normal;
            padding-left: 5px !important;
        }

        body[dir="rtl"] .iti__country {
            padding: 10px 10px 10px 18px !important;
        }
    }

    .iti--container {
        z-index: 9999;
    }

    [data-bs-theme="dark"] .iti__country-list,
    [data-bs-theme="dark"] .iti--container .iti__country-list,
    .dark-mode .iti__country-list,
    .dark-mode .iti--container .iti__country-list {
        background-color: #1e1e2d;
        border-color: rgba(255, 255, 255, 0.1);
    }

    [data-bs-theme="dark"] .iti__country-list .iti__search-container,
    .dark-mode .iti__country-list .iti__search-container {
        background: #1e1e2d;
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    [data-bs-theme="dark"] .iti__country-list .iti__search-input,
    .dark-mode .iti__country-list .iti__search-input {
        background-color: #2a2a3c;
        border-color: rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    [data-bs-theme="dark"] .iti__country-list .iti__search-input::placeholder,
    .dark-mode .iti__country-list .iti__search-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    [data-bs-theme="dark"] .iti__country-list .iti__search-input:focus,
    .dark-mode .iti__country-list .iti__search-input:focus {
        border-color: #3699ff;
    }

    [data-bs-theme="dark"] .iti__country,
    .dark-mode .iti__country {
        background-color: transparent;
    }

    [data-bs-theme="dark"] .iti__country:hover,
    [data-bs-theme="dark"] .iti__country.iti__highlight,
    .dark-mode .iti__country:hover,
    .dark-mode .iti__country.iti__highlight {
        background-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .iti__country-name,
    .dark-mode .iti__country-name {
        color: rgba(255, 255, 255, 0.9);
    }

    [data-bs-theme="dark"] .iti__dial-code,
    .dark-mode .iti__dial-code {
        color: rgba(255, 255, 255, 0.6);
    }

    [data-bs-theme="dark"] .iti__no-results,
    .dark-mode .iti__no-results {
        color: rgba(255, 255, 255, 0.5);
    }

    [data-bs-theme="dark"] .iti__divider,
    .dark-mode .iti__divider {
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }
</style>

<script data-pagespeed-no-defer src="{{ asset('vendor/core/core/base/libraries/intl-tel-input/js/intlTelInput.min.js') }}"></script>

<script>
    (function() {
        if (window.bbPhoneNumberFieldInitialized) {
            return;
        }

        window.bbPhoneNumberFieldInitialized = true;

        const countryPhoneRules = {
    '1': { min: 10, max: 10, trunks: [], country: "United States / Canada" },
    '7': { min: 10, max: 10, trunks: ["8"], country: "Russia / Kazakhstan" },
    '20': { min: 10, max: 10, trunks: ["0"], country: "Egypt" },
    '27': { min: 5, max: 9, trunks: ["0"], country: "South Africa" },
    '30': { min: 10, max: 10, trunks: [], country: "Greece" },
    '31': { min: 9, max: 11, trunks: ["0"], country: "Netherlands" },
    '32': { min: 9, max: 9, trunks: ["0"], country: "Belgium" },
    '33': { min: 9, max: 9, trunks: ["0"], country: "France" },
    '34': { min: 9, max: 9, trunks: [], country: "Spain" },
    '36': { min: 9, max: 9, trunks: ["06"], country: "Hungary" },
    '39': { min: 9, max: 10, trunks: [], country: "Italy" },
    '40': { min: 9, max: 9, trunks: ["0"], country: "Romania" },
    '41': { min: 9, max: 9, trunks: ["0"], country: "Switzerland" },
    '43': { min: 7, max: 13, trunks: ["0"], country: "Austria" },
    '44': { min: 10, max: 10, trunks: ["0"], country: "United Kingdom" },
    '45': { min: 8, max: 8, trunks: [], country: "Denmark" },
    '46': { min: 9, max: 9, trunks: ["0"], country: "Sweden" },
    '47': { min: 8, max: 8, trunks: [], country: "Norway" },
    '48': { min: 9, max: 9, trunks: [], country: "Poland" },
    '49': { min: 10, max: 11, trunks: ["0"], country: "Germany" },
    '51': { min: 9, max: 9, trunks: ["0"], country: "Peru" },
    '52': { min: 10, max: 10, trunks: [], country: "Mexico" },
    '53': { min: 8, max: 8, trunks: ["0"], country: "Cuba" },
    '54': { min: 10, max: 11, trunks: ["0"], country: "Argentina" },
    '55': { min: 10, max: 11, trunks: [], country: "Brazil" },
    '56': { min: 9, max: 9, trunks: [], country: "Chile" },
    '57': { min: 10, max: 10, trunks: [], country: "Colombia" },
    '58': { min: 10, max: 10, trunks: ["0"], country: "Venezuela" },
    '60': { min: 9, max: 10, trunks: ["0"], country: "Malaysia" },
    '61': { min: 9, max: 9, trunks: ["0"], country: "Australia" },
    '62': { min: 9, max: 12, trunks: ["0"], country: "Indonesia" },
    '63': { min: 10, max: 10, trunks: ["0"], country: "Philippines" },
    '64': { min: 8, max: 10, trunks: ["0"], country: "New Zealand" },
    '65': { min: 8, max: 8, trunks: [], country: "Singapore" },
    '66': { min: 9, max: 9, trunks: ["0"], country: "Thailand" },
    '81': { min: 10, max: 10, trunks: ["0"], country: "Japan" },
    '82': { min: 9, max: 10, trunks: ["0"], country: "South Korea" },
    '84': { min: 9, max: 9, trunks: ["0"], country: "Vietnam" },
    '86': { min: 11, max: 11, trunks: ["0"], country: "China" },
    '90': { min: 10, max: 10, trunks: ["0"], country: "Turkey" },
    '91': { min: 10, max: 10, trunks: ["0"], country: "India" },
    '92': { min: 10, max: 10, trunks: ["0"], country: "Pakistan" },
    '93': { min: 9, max: 9, trunks: ["0"], country: "Afghanistan" },
    '94': { min: 9, max: 9, trunks: ["0"], country: "Sri Lanka" },
    '95': { min: 7, max: 10, trunks: ["0"], country: "Myanmar" },
    '98': { min: 10, max: 10, trunks: ["0"], country: "Iran" },
    '211': { min: 9, max: 9, trunks: ["0"], country: "South Sudan" },
    '212': { min: 9, max: 9, trunks: ["0"], country: "Morocco" },
    '213': { min: 9, max: 9, trunks: ["0"], country: "Algeria" },
    '216': { min: 8, max: 8, trunks: [], country: "Tunisia" },
    '218': { min: 9, max: 9, trunks: ["0"], country: "Libya" },
    '220': { min: 7, max: 9, trunks: [], country: "Gambia" },
    '221': { min: 9, max: 9, trunks: [], country: "Senegal" },
    '222': { min: 8, max: 8, trunks: [], country: "Mauritania" },
    '223': { min: 8, max: 8, trunks: [], country: "Mali" },
    '224': { min: 9, max: 9, trunks: [], country: "Guinea" },
    '225': { min: 10, max: 10, trunks: [], country: "Ivory Coast" },
    '226': { min: 8, max: 8, trunks: [], country: "Burkina Faso" },
    '227': { min: 8, max: 8, trunks: [], country: "Niger" },
    '228': { min: 8, max: 8, trunks: [], country: "Togo" },
    '229': { min: 10, max: 10, trunks: [], country: "Benin" },
    '230': { min: 8, max: 8, trunks: [], country: "Mauritius" },
    '231': { min: 7, max: 9, trunks: ["0"], country: "Liberia" },
    '232': { min: 8, max: 8, trunks: ["0"], country: "Sierra Leone" },
    '233': { min: 9, max: 9, trunks: ["0"], country: "Ghana" },
    '234': { min: 10, max: 10, trunks: ["0"], country: "Nigeria" },
    '235': { min: 8, max: 8, trunks: [], country: "Chad" },
    '236': { min: 8, max: 8, trunks: [], country: "Central African Republic" },
    '237': { min: 9, max: 9, trunks: [], country: "Cameroon" },
    '238': { min: 7, max: 7, trunks: [], country: "Cape Verde" },
    '239': { min: 7, max: 7, trunks: [], country: "São Tomé and Príncipe" },
    '240': { min: 9, max: 9, trunks: [], country: "Equatorial Guinea" },
    '241': { min: 7, max: 8, trunks: [], country: "Gabon" },
    '242': { min: 9, max: 9, trunks: [], country: "Republic of the Congo" },
    '243': { min: 7, max: 9, trunks: ["0"], country: "Democratic Republic of the Congo" },
    '244': { min: 9, max: 9, trunks: [], country: "Angola" },
    '245': { min: 9, max: 9, trunks: [], country: "Guinea-Bissau" },
    '246': { min: 7, max: 7, trunks: [], country: "Diego Garcia (British Indian Ocean Territory)" },
    '247': { min: 5, max: 5, trunks: [], country: "Ascension Island" },
    '248': { min: 7, max: 7, trunks: [], country: "Seychelles" },
    '249': { min: 9, max: 9, trunks: ["0"], country: "Sudan" },
    '250': { min: 9, max: 9, trunks: ["0"], country: "Rwanda" },
    '251': { min: 9, max: 9, trunks: ["0"], country: "Ethiopia" },
    '252': { min: 7, max: 9, trunks: [], country: "Somalia" },
    '253': { min: 8, max: 8, trunks: [], country: "Djibouti" },
    '254': { min: 9, max: 9, trunks: ["0"], country: "Kenya" },
    '255': { min: 9, max: 9, trunks: ["0"], country: "Tanzania" },
    '256': { min: 9, max: 9, trunks: ["0"], country: "Uganda" },
    '257': { min: 8, max: 8, trunks: [], country: "Burundi" },
    '258': { min: 9, max: 9, trunks: [], country: "Mozambique" },
    '260': { min: 9, max: 9, trunks: ["0"], country: "Zambia" },
    '261': { min: 9, max: 9, trunks: ["0"], country: "Madagascar" },
    '262': { min: 9, max: 9, trunks: ["0"], country: "Réunion / Mayotte" },
    '263': { min: 9, max: 9, trunks: ["0"], country: "Zimbabwe" },
    '264': { min: 9, max: 9, trunks: ["0"], country: "Namibia" },
    '265': { min: 9, max: 9, trunks: ["0"], country: "Malawi" },
    '266': { min: 8, max: 8, trunks: [], country: "Lesotho" },
    '267': { min: 8, max: 8, trunks: [], country: "Botswana" },
    '268': { min: 8, max: 8, trunks: [], country: "Eswatini" },
    '269': { min: 7, max: 7, trunks: [], country: "Comoros" },
    '290': { min: 4, max: 5, trunks: [], country: "Saint Helena / Tristan da Cunha" },
    '291': { min: 7, max: 7, trunks: ["0"], country: "Eritrea" },
    '297': { min: 7, max: 7, trunks: [], country: "Aruba" },
    '298': { min: 6, max: 6, trunks: [], country: "Faroe Islands" },
    '299': { min: 6, max: 6, trunks: [], country: "Greenland" },
    '350': { min: 8, max: 8, trunks: [], country: "Gibraltar" },
    '351': { min: 9, max: 9, trunks: [], country: "Portugal" },
    '352': { min: 9, max: 9, trunks: [], country: "Luxembourg" },
    '353': { min: 9, max: 9, trunks: ["0"], country: "Ireland" },
    '354': { min: 7, max: 9, trunks: [], country: "Iceland" },
    '355': { min: 9, max: 9, trunks: ["0"], country: "Albania" },
    '356': { min: 8, max: 8, trunks: [], country: "Malta" },
    '357': { min: 8, max: 8, trunks: [], country: "Cyprus" },
    '358': { min: 6, max: 10, trunks: ["0"], country: "Finland" },
    '359': { min: 8, max: 9, trunks: ["0"], country: "Bulgaria" },
    '370': { min: 8, max: 8, trunks: ["0"], country: "Lithuania" },
    '371': { min: 8, max: 8, trunks: [], country: "Latvia" },
    '372': { min: 7, max: 8, trunks: [], country: "Estonia" },
    '373': { min: 8, max: 8, trunks: ["0"], country: "Moldova" },
    '374': { min: 8, max: 8, trunks: ["0"], country: "Armenia" },
    '375': { min: 9, max: 9, trunks: ["80"], country: "Belarus" },
    '376': { min: 6, max: 9, trunks: [], country: "Andorra" },
    '377': { min: 8, max: 9, trunks: ["0"], country: "Monaco" },
    '378': { min: 8, max: 8, trunks: [], country: "San Marino" },
    '380': { min: 9, max: 9, trunks: ["0"], country: "Ukraine" },
    '381': { min: 8, max: 10, trunks: ["0"], country: "Serbia" },
    '382': { min: 8, max: 8, trunks: ["0"], country: "Montenegro" },
    '383': { min: 8, max: 8, trunks: ["0"], country: "Kosovo" },
    '385': { min: 8, max: 9, trunks: ["0"], country: "Croatia" },
    '386': { min: 8, max: 8, trunks: ["0"], country: "Slovenia" },
    '387': { min: 8, max: 9, trunks: ["0"], country: "Bosnia and Herzegovina" },
    '389': { min: 8, max: 8, trunks: ["0"], country: "North Macedonia" },
    '420': { min: 9, max: 9, trunks: [], country: "Czech Republic" },
    '421': { min: 9, max: 9, trunks: ["0"], country: "Slovakia" },
    '423': { min: 7, max: 9, trunks: [], country: "Liechtenstein" },
    '500': { min: 5, max: 5, trunks: [], country: "Falkland Islands" },
    '501': { min: 7, max: 7, trunks: [], country: "Belize" },
    '502': { min: 8, max: 8, trunks: [], country: "Guatemala" },
    '503': { min: 8, max: 8, trunks: [], country: "El Salvador" },
    '504': { min: 8, max: 8, trunks: [], country: "Honduras" },
    '505': { min: 8, max: 8, trunks: [], country: "Nicaragua" },
    '506': { min: 8, max: 8, trunks: [], country: "Costa Rica" },
    '507': { min: 7, max: 8, trunks: [], country: "Panama" },
    '508': { min: 6, max: 9, trunks: ["0"], country: "Saint Pierre and Miquelon" },
    '509': { min: 8, max: 8, trunks: [], country: "Haiti" },
    '590': { min: 9, max: 9, trunks: ["0"], country: "Guadeloupe / Saint Martin" },
    '591': { min: 8, max: 8, trunks: [], country: "Bolivia" },
    '592': { min: 7, max: 7, trunks: [], country: "Guyana" },
    '593': { min: 9, max: 9, trunks: ["0"], country: "Ecuador" },
    '594': { min: 9, max: 9, trunks: ["0"], country: "French Guiana" },
    '595': { min: 9, max: 9, trunks: ["0"], country: "Paraguay" },
    '596': { min: 9, max: 9, trunks: ["0"], country: "Martinique" },
    '597': { min: 7, max: 7, trunks: [], country: "Suriname" },
    '598': { min: 8, max: 8, trunks: ["0"], country: "Uruguay" },
    '599': { min: 7, max: 8, trunks: [], country: "Curaçao / Caribbean Netherlands" },
    '670': { min: 8, max: 8, trunks: [], country: "Timor-Leste" },
    '672': { min: 6, max: 6, trunks: [], country: "Norfolk Island" },
    '673': { min: 7, max: 7, trunks: [], country: "Brunei" },
    '674': { min: 7, max: 7, trunks: [], country: "Nauru" },
    '675': { min: 8, max: 8, trunks: [], country: "Papua New Guinea" },
    '676': { min: 7, max: 7, trunks: [], country: "Tonga" },
    '677': { min: 5, max: 7, trunks: [], country: "Solomon Islands" },
    '678': { min: 7, max: 7, trunks: [], country: "Vanuatu" },
    '679': { min: 7, max: 7, trunks: [], country: "Fiji" },
    '680': { min: 7, max: 7, trunks: [], country: "Palau" },
    '681': { min: 6, max: 6, trunks: [], country: "Wallis and Futuna" },
    '682': { min: 5, max: 5, trunks: [], country: "Cook Islands" },
    '683': { min: 4, max: 7, trunks: [], country: "Niue" },
    '685': { min: 7, max: 10, trunks: [], country: "Samoa" },
    '686': { min: 8, max: 8, trunks: [], country: "Kiribati" },
    '687': { min: 6, max: 6, trunks: [], country: "New Caledonia" },
    '688': { min: 6, max: 7, trunks: [], country: "Tuvalu" },
    '689': { min: 8, max: 8, trunks: [], country: "French Polynesia" },
    '690': { min: 4, max: 7, trunks: [], country: "Tokelau" },
    '691': { min: 7, max: 7, trunks: [], country: "Micronesia" },
    '692': { min: 7, max: 7, trunks: [], country: "Marshall Islands" },
    '850': { min: 10, max: 10, trunks: ["0"], country: "North Korea" },
    '852': { min: 8, max: 8, trunks: [], country: "Hong Kong" },
    '853': { min: 8, max: 8, trunks: [], country: "Macao" },
    '855': { min: 8, max: 9, trunks: ["0"], country: "Cambodia" },
    '856': { min: 9, max: 10, trunks: ["0"], country: "Laos" },
    '880': { min: 10, max: 10, trunks: ["0"], country: "Bangladesh" },
    '886': { min: 9, max: 9, trunks: ["0"], country: "Taiwan" },
    '960': { min: 7, max: 7, trunks: [], country: "Maldives" },
    '961': { min: 7, max: 8, trunks: ["0"], country: "Lebanon" },
    '962': { min: 9, max: 9, trunks: ["0"], country: "Jordan" },
    '963': { min: 9, max: 9, trunks: ["0"], country: "Syria" },
    '964': { min: 10, max: 10, trunks: ["0"], country: "Iraq" },
    '965': { min: 8, max: 8, trunks: [], country: "Kuwait" },
    '966': { min: 9, max: 9, trunks: ["0"], country: "Saudi Arabia" },
    '967': { min: 9, max: 9, trunks: ["0"], country: "Yemen" },
    '968': { min: 8, max: 8, trunks: [], country: "Oman" },
    '970': { min: 9, max: 9, trunks: ["0"], country: "Palestine" },
    '971': { min: 9, max: 9, trunks: ["0"], country: "United Arab Emirates" },
    '972': { min: 9, max: 9, trunks: ["0"], country: "Israel" },
    '973': { min: 8, max: 8, trunks: [], country: "Bahrain" },
    '974': { min: 8, max: 8, trunks: [], country: "Qatar" },
    '975': { min: 8, max: 8, trunks: [], country: "Bhutan" },
    '976': { min: 8, max: 8, trunks: [], country: "Mongolia" },
    '977': { min: 10, max: 10, trunks: ["0"], country: "Nepal" },
    '992': { min: 9, max: 9, trunks: [], country: "Tajikistan" },
    '993': { min: 8, max: 8, trunks: ["8"], country: "Turkmenistan" },
    '994': { min: 9, max: 9, trunks: ["0"], country: "Azerbaijan" },
    '995': { min: 9, max: 9, trunks: ["0"], country: "Georgia" },
    '996': { min: 9, max: 9, trunks: ["0"], country: "Kyrgyzstan" },
    '998': { min: 9, max: 9, trunks: [], country: "Uzbekistan" },
};

        const phoneInvalidLengthTemplate = @json(__('Please enter a valid :length phone number for :country (+:code).'));
        const phoneGenericInvalidMessage = @json(__('Please enter a valid phone number.'));

        function initPhoneNumberFields() {
            document.querySelectorAll('.js-phone-number-mask[data-country-code-selection="true"]').forEach(function(element) {
                if (element.dataset.itiInitialized === 'true') {
                    return;
                }

                const hasCountryCodeSelection = element.dataset.countryCodeSelection === 'true';

                @php
                    $selectedCountries = json_decode(setting('phone_number_available_countries', '[]'), true) ?: [];
                    $availableCountries = array_map('strtolower', $selectedCountries);
                @endphp

                const availableCountries = @json($availableCountries);

                const getDefaultCountry = function() {
                    if (availableCountries.length === 0) {
                        return 'us';
                    }
                    return availableCountries.includes('us') ? 'us' : availableCountries[0];
                };

                const defaultCountry = getDefaultCountry();

                const config = {
                    autoPlaceholder: 'polite',
                    dropdownContainer: document.body,
                    geoIpLookup: function(callback) {
                        const cacheKey = 'ipinfo_country_code';
                        const cacheExpiry = 'ipinfo_country_expiry';
                        const cachedCountry = localStorage.getItem(cacheKey);
                        const cachedExpiry = localStorage.getItem(cacheExpiry);
                        const now = new Date().getTime();

                        if (cachedCountry && cachedExpiry && now < parseInt(cachedExpiry)) {
                            const isCountryAvailable = availableCountries.length === 0 || availableCountries.includes(cachedCountry.toLowerCase());
                            callback(isCountryAvailable ? cachedCountry : defaultCountry);
                            return;
                        }

                        fetch('https://ipinfo.io/json', {
                                credentials: 'omit',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(function(response) {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(function(data) {
                                let countryCode = data && data.country ? data.country.toLowerCase() : defaultCountry;

                                const isCountryAvailable = availableCountries.length === 0 || availableCountries.includes(countryCode);

                                if (!isCountryAvailable) {
                                    countryCode = defaultCountry;
                                }

                                if (countryCode && countryCode !== defaultCountry) {
                                    try {
                                        localStorage.setItem(cacheKey, countryCode);
                                        localStorage.setItem(cacheExpiry, (now + 24 * 60 * 60 *
                                            1000).toString());
                                    } catch (e) {
                                        console.warn('Could not cache country code:', e);
                                    }
                                }

                                callback(countryCode);
                            })
                            .catch(function() {
                                callback(defaultCountry);
                            });
                    },
                    initialCountry: 'auto',
                    utilsScript: '{{ asset('vendor/core/core/base/libraries/intl-tel-input/js/utils.js') }}',
                };

                if (availableCountries && availableCountries.length > 0) {
                    config.onlyCountries = availableCountries;
                }

                // With a single allowed country there is nothing to pick, so keep the
                // flag from opening a one-item dropdown the customer can trip over.
                if (availableCountries && availableCountries.length === 1) {
                    config.allowDropdown = false;
                }

                if (hasCountryCodeSelection) {
                    config.separateDialCode = true;
                    config.nationalMode = false;
                    config.autoHideDialCode = false;
                }

                const iti = window.intlTelInput(element, config);
                element.dataset.itiInitialized = 'true';

                const itiContainer = element.closest('.iti');
                const searchPlaceholder = @json(trans('core/base::forms.search_country'));
                if (itiContainer) {
                    const flagContainer = itiContainer.querySelector('.iti__flag-container');
                    if (flagContainer) {
                        flagContainer.addEventListener('pointerdown', function(e) {
                            if (e.pointerType === 'mouse') {
                                return;
                            }
                            const selectedFlag = itiContainer.querySelector('.iti__selected-flag');
                            if (!selectedFlag) {
                                return;
                            }
                            if (e.cancelable) {
                                e.preventDefault();
                            }
                            e.stopPropagation();
                            setTimeout(function() {
                                if (selectedFlag.getAttribute('aria-expanded') === 'true') {
                                    return;
                                }
                                selectedFlag.click();
                            }, 50);
                        }, { passive: false });

                        flagContainer.addEventListener('click', function() {
                            setTimeout(function() {
                                const countryList = document.querySelector('.iti--container .iti__country-list') ||
                                                   itiContainer.querySelector('.iti__country-list');
                                if (countryList && !countryList.querySelector('.iti__search-container')) {
                                    const searchContainer = document.createElement('li');
                                    searchContainer.className = 'iti__search-container';
                                    const searchInput = document.createElement('input');
                                    searchInput.type = 'text';
                                    searchInput.className = 'iti__search-input';
                                    searchInput.placeholder = searchPlaceholder;
                                    searchInput.autocomplete = 'off';
                                    searchContainer.appendChild(searchInput);
                                    countryList.insertBefore(searchContainer, countryList.firstChild);

                                    searchContainer.addEventListener('click', function(e) {
                                        e.stopPropagation();
                                    });

                                    searchInput.addEventListener('click', function(e) {
                                        e.stopPropagation();
                                    });

                                    searchInput.addEventListener('keydown', function(e) {
                                        e.stopPropagation();
                                    });

                                    searchInput.addEventListener('keyup', function(e) {
                                        e.stopPropagation();
                                    });

                                    let noResultsEl = null;

                                    searchInput.addEventListener('input', function() {
                                        const searchTerm = this.value.toLowerCase().trim();
                                        const countries = countryList.querySelectorAll('.iti__country');
                                        let visibleCount = 0;

                                        countries.forEach(function(country) {
                                            const countryName = country.querySelector('.iti__country-name');
                                            const dialCode = country.querySelector('.iti__dial-code');
                                            const name = countryName ? countryName.textContent.toLowerCase() : '';
                                            const code = dialCode ? dialCode.textContent.toLowerCase() : '';
                                            if (name.includes(searchTerm) || code.includes(searchTerm)) {
                                                country.classList.remove('iti__hidden');
                                                visibleCount++;
                                            } else {
                                                country.classList.add('iti__hidden');
                                            }
                                        });

                                        if (visibleCount === 0) {
                                            if (!noResultsEl) {
                                                noResultsEl = document.createElement('li');
                                                noResultsEl.className = 'iti__no-results';
                                                noResultsEl.textContent = @json(trans('core/base::forms.no_results'));
                                                countryList.appendChild(noResultsEl);
                                            }
                                            noResultsEl.style.display = 'block';
                                        } else if (noResultsEl) {
                                            noResultsEl.style.display = 'none';
                                        }
                                    });

                                    searchInput.focus();
                                }
                            }, 10);
                        });
                    }
                }

                if (hasCountryCodeSelection) {
                    const hiddenFieldId = element.id + '-full';
                    const hiddenField = document.getElementById(hiddenFieldId);

                    if (hiddenField) {
                        const updateHiddenField = function() {
                            const fullNumber = iti.getNumber();
                            const oldValue = hiddenField.value;
                            let newValue = '';

                            if (fullNumber) {
                                newValue = fullNumber;
                            } else if (element.value) {
                                const selectedCountryData = iti.getSelectedCountryData();
                                if (selectedCountryData && selectedCountryData.dialCode) {
                                    newValue = '+' + selectedCountryData.dialCode + element.value
                                        .replace(/\D/g, '');
                                } else {
                                    newValue = element.value;
                                }
                            }

                            hiddenField.value = newValue;

                            if (oldValue !== newValue) {
                                const changeEvent = new Event('change', {
                                    bubbles: true
                                });
                                element.dispatchEvent(changeEvent);
                            }
                        };

                        const initialValue = hiddenField.value || element.value;

                        if (initialValue) {
                            if (initialValue.startsWith('+')) {
                                iti.setNumber(initialValue);
                            } else if (initialValue) {
                                element.value = initialValue;
                            }

                            setTimeout(function() {
                                updateHiddenField();
                            }, 100);
                        }

                        // A value that already carries the dial code (browser autofill,
                        // a paste, or a number typed as +8801...) has to be handed to
                        // setNumber, which re-derives the country and moves the dial
                        // code back into the separate selector instead of dropping it.
                        const applyInternationalValue = function() {
                            const rawValue = (element.value || '').trim();

                            if (! rawValue) {
                                return;
                            }

                            const fullNumber = rawValue.startsWith('00') ? '+' + rawValue.slice(2) : rawValue;

                            if (! fullNumber.startsWith('+')) {
                                return;
                            }

                            iti.setNumber(fullNumber);
                        };

                        // Bulk insertions carry the dial code; a plain keystroke does not.
                        // Re-parsing on every keystroke would fight the caret while typing.
                        const bulkInputTypes = ['insertFromPaste', 'insertFromDrop', 'insertReplacementText'];

                        element.addEventListener('countrychange', updateHiddenField);

                        element.addEventListener('input', function(event) {
                            if (! event.inputType || bulkInputTypes.indexOf(event.inputType) !== -1) {
                                applyInternationalValue();
                            }

                            updateHiddenField();
                        });

                        element.addEventListener('blur', function() {
                            applyInternationalValue();
                            updateHiddenField();
                        });

                        // Per-country mobile digit validation based on international dial code rules.
                        // Empty values are left to the form's required/nullable validation.
                        const clearPhoneError = function() {
                            element.classList.remove('is-invalid');
                            const existing = element.closest('.iti')?.parentElement?.querySelector('.js-phone-error');
                            if (existing) {
                                existing.remove();
                            }
                        };

                        const getPhoneValidationError = function() {
                            const rawValue = (element.value || '').trim();
                            if (! rawValue) {
                                return null;
                            }

                            let digits = rawValue.replace(/\D/g, '');
                            const countryData = iti.getSelectedCountryData();
                            let dialCode = countryData && countryData.dialCode ? String(countryData.dialCode) : null;
                            const countryName = countryData && countryData.name ? countryData.name.replace(/\s*\(.*?\)\s*/g, '') : null;

                            if (! dialCode) {
                                if (rawValue.startsWith('+') || rawValue.startsWith('00')) {
                                    for (const len of [3, 2, 1]) {
                                        const prefix = digits.slice(0, len);
                                        if (countryPhoneRules[prefix]) {
                                            dialCode = prefix;
                                            digits = digits.slice(len);
                                            break;
                                        }
                                    }
                                }
                            } else {
                                if (digits.startsWith(dialCode)) {
                                    digits = digits.slice(dialCode.length);
                                }
                            }

                            if (dialCode && countryPhoneRules[dialCode]) {
                                const rule = countryPhoneRules[dialCode];
                                let stripped = digits;
                                if (rule.trunks && rule.trunks.length > 0) {
                                    for (const trunk of rule.trunks) {
                                        if (trunk && digits.startsWith(trunk)) {
                                            const candidate = digits.slice(trunk.length);
                                            if (candidate.length >= rule.min && candidate.length <= rule.max) {
                                                stripped = candidate;
                                                break;
                                            }
                                            stripped = candidate;
                                        }
                                    }
                                }

                                const natLen = digits.length;
                                const stripLen = stripped.length;

                                if ((natLen < rule.min || natLen > rule.max) && (stripLen < rule.min || stripLen > rule.max)) {
                                    const lengthLabel = rule.min === rule.max ? (rule.min + '-digit') : (rule.min + '-' + rule.max + ' digit');
                                    const name = countryName || rule.country;

                                    return phoneInvalidLengthTemplate
                                        .replace(':length', lengthLabel)
                                        .replace(':country', name)
                                        .replace(':code', dialCode);
                                }

                                return null;
                            }

                            if (digits.length < 8 || digits.length > 15 || iti.isValidNumber() === false) {
                                return phoneGenericInvalidMessage;
                            }

                            return null;
                        };

                        const showPhoneError = function(message) {
                            clearPhoneError();
                            element.classList.add('is-invalid');
                            const wrapper = element.closest('.iti') || element;
                            const error = document.createElement('div');
                            error.className = 'invalid-feedback d-block js-phone-error';
                            error.textContent = message || phoneGenericInvalidMessage;
                            wrapper.insertAdjacentElement('afterend', error);
                        };

                        element.addEventListener('blur', function() {
                            const error = getPhoneValidationError();
                            error ? showPhoneError(error) : clearPhoneError();
                        });

                        element.addEventListener('input', clearPhoneError);
                        element.addEventListener('countrychange', clearPhoneError);

                        const form = element.closest('form');
                        if (form) {
                            form.addEventListener('submit', function(event) {
                                updateHiddenField();

                                const error = getPhoneValidationError();
                                if (error) {
                                    event.preventDefault();
                                    event.stopImmediatePropagation();
                                    showPhoneError(error);
                                    element.focus();
                                }
                            }, true);
                        }
                    }
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initPhoneNumberFields);
        } else {
            initPhoneNumberFields();
        }

        document.addEventListener('payment-form-reloaded', function() {
            initPhoneNumberFields();
        });

        document.addEventListener('phone-number-field:init', function() {
            initPhoneNumberFields();
        });
    })();
</script>
