<?php

namespace Botble\Base\Rules;

use Botble\Base\Facades\BaseHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumberRule implements ValidationRule
{
    /**
     * National mobile rules per calling code:
     * - min: minimum national mobile digits
     * - max: maximum national mobile digits
     * - trunks: domestic trunk prefixes that can be automatically stripped
     * - country: primary country / territory label
     */
    protected static array $nationalRules = [
        '1' => ['min' => 10, 'max' => 10, 'trunks' => [], 'country' => 'United States / Canada'],
        '7' => ['min' => 10, 'max' => 10, 'trunks' => ['8'], 'country' => 'Russia / Kazakhstan'],
        '20' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Egypt'],
        '27' => ['min' => 5, 'max' => 9, 'trunks' => ['0'], 'country' => 'South Africa'],
        '30' => ['min' => 10, 'max' => 10, 'trunks' => [], 'country' => 'Greece'],
        '31' => ['min' => 9, 'max' => 11, 'trunks' => ['0'], 'country' => 'Netherlands'],
        '32' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Belgium'],
        '33' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'France'],
        '34' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Spain'],
        '36' => ['min' => 9, 'max' => 9, 'trunks' => ['06'], 'country' => 'Hungary'],
        '39' => ['min' => 9, 'max' => 10, 'trunks' => [], 'country' => 'Italy'],
        '40' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Romania'],
        '41' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Switzerland'],
        '43' => ['min' => 7, 'max' => 13, 'trunks' => ['0'], 'country' => 'Austria'],
        '44' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'United Kingdom'],
        '45' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Denmark'],
        '46' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Sweden'],
        '47' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Norway'],
        '48' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Poland'],
        '49' => ['min' => 10, 'max' => 11, 'trunks' => ['0'], 'country' => 'Germany'],
        '51' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Peru'],
        '52' => ['min' => 10, 'max' => 10, 'trunks' => [], 'country' => 'Mexico'],
        '53' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Cuba'],
        '54' => ['min' => 10, 'max' => 11, 'trunks' => ['0'], 'country' => 'Argentina'],
        '55' => ['min' => 10, 'max' => 11, 'trunks' => [], 'country' => 'Brazil'],
        '56' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Chile'],
        '57' => ['min' => 10, 'max' => 10, 'trunks' => [], 'country' => 'Colombia'],
        '58' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Venezuela'],
        '60' => ['min' => 9, 'max' => 10, 'trunks' => ['0'], 'country' => 'Malaysia'],
        '61' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Australia'],
        '62' => ['min' => 9, 'max' => 12, 'trunks' => ['0'], 'country' => 'Indonesia'],
        '63' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Philippines'],
        '64' => ['min' => 8, 'max' => 10, 'trunks' => ['0'], 'country' => 'New Zealand'],
        '65' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Singapore'],
        '66' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Thailand'],
        '81' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Japan'],
        '82' => ['min' => 9, 'max' => 10, 'trunks' => ['0'], 'country' => 'South Korea'],
        '84' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Vietnam'],
        '86' => ['min' => 11, 'max' => 11, 'trunks' => ['0'], 'country' => 'China'],
        '90' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Turkey'],
        '91' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'India'],
        '92' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Pakistan'],
        '93' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Afghanistan'],
        '94' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Sri Lanka'],
        '95' => ['min' => 7, 'max' => 10, 'trunks' => ['0'], 'country' => 'Myanmar'],
        '98' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Iran'],
        '211' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'South Sudan'],
        '212' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Morocco'],
        '213' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Algeria'],
        '216' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Tunisia'],
        '218' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Libya'],
        '220' => ['min' => 7, 'max' => 9, 'trunks' => [], 'country' => 'Gambia'],
        '221' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Senegal'],
        '222' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Mauritania'],
        '223' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Mali'],
        '224' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Guinea'],
        '225' => ['min' => 10, 'max' => 10, 'trunks' => [], 'country' => 'Ivory Coast'],
        '226' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Burkina Faso'],
        '227' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Niger'],
        '228' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Togo'],
        '229' => ['min' => 10, 'max' => 10, 'trunks' => [], 'country' => 'Benin'],
        '230' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Mauritius'],
        '231' => ['min' => 7, 'max' => 9, 'trunks' => ['0'], 'country' => 'Liberia'],
        '232' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Sierra Leone'],
        '233' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Ghana'],
        '234' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Nigeria'],
        '235' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Chad'],
        '236' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Central African Republic'],
        '237' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Cameroon'],
        '238' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Cape Verde'],
        '239' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'São Tomé and Príncipe'],
        '240' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Equatorial Guinea'],
        '241' => ['min' => 7, 'max' => 8, 'trunks' => [], 'country' => 'Gabon'],
        '242' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Republic of the Congo'],
        '243' => ['min' => 7, 'max' => 9, 'trunks' => ['0'], 'country' => 'Democratic Republic of the Congo'],
        '244' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Angola'],
        '245' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Guinea-Bissau'],
        '246' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Diego Garcia (British Indian Ocean Territory)'],
        '247' => ['min' => 5, 'max' => 5, 'trunks' => [], 'country' => 'Ascension Island'],
        '248' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Seychelles'],
        '249' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Sudan'],
        '250' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Rwanda'],
        '251' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Ethiopia'],
        '252' => ['min' => 7, 'max' => 9, 'trunks' => [], 'country' => 'Somalia'],
        '253' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Djibouti'],
        '254' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Kenya'],
        '255' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Tanzania'],
        '256' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Uganda'],
        '257' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Burundi'],
        '258' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Mozambique'],
        '260' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Zambia'],
        '261' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Madagascar'],
        '262' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Réunion / Mayotte'],
        '263' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Zimbabwe'],
        '264' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Namibia'],
        '265' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Malawi'],
        '266' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Lesotho'],
        '267' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Botswana'],
        '268' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Eswatini'],
        '269' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Comoros'],
        '290' => ['min' => 4, 'max' => 5, 'trunks' => [], 'country' => 'Saint Helena / Tristan da Cunha'],
        '291' => ['min' => 7, 'max' => 7, 'trunks' => ['0'], 'country' => 'Eritrea'],
        '297' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Aruba'],
        '298' => ['min' => 6, 'max' => 6, 'trunks' => [], 'country' => 'Faroe Islands'],
        '299' => ['min' => 6, 'max' => 6, 'trunks' => [], 'country' => 'Greenland'],
        '350' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Gibraltar'],
        '351' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Portugal'],
        '352' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Luxembourg'],
        '353' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Ireland'],
        '354' => ['min' => 7, 'max' => 9, 'trunks' => [], 'country' => 'Iceland'],
        '355' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Albania'],
        '356' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Malta'],
        '357' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Cyprus'],
        '358' => ['min' => 6, 'max' => 10, 'trunks' => ['0'], 'country' => 'Finland'],
        '359' => ['min' => 8, 'max' => 9, 'trunks' => ['0'], 'country' => 'Bulgaria'],
        '370' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Lithuania'],
        '371' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Latvia'],
        '372' => ['min' => 7, 'max' => 8, 'trunks' => [], 'country' => 'Estonia'],
        '373' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Moldova'],
        '374' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Armenia'],
        '375' => ['min' => 9, 'max' => 9, 'trunks' => ['80'], 'country' => 'Belarus'],
        '376' => ['min' => 6, 'max' => 9, 'trunks' => [], 'country' => 'Andorra'],
        '377' => ['min' => 8, 'max' => 9, 'trunks' => ['0'], 'country' => 'Monaco'],
        '378' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'San Marino'],
        '380' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Ukraine'],
        '381' => ['min' => 8, 'max' => 10, 'trunks' => ['0'], 'country' => 'Serbia'],
        '382' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Montenegro'],
        '383' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Kosovo'],
        '385' => ['min' => 8, 'max' => 9, 'trunks' => ['0'], 'country' => 'Croatia'],
        '386' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Slovenia'],
        '387' => ['min' => 8, 'max' => 9, 'trunks' => ['0'], 'country' => 'Bosnia and Herzegovina'],
        '389' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'North Macedonia'],
        '420' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Czech Republic'],
        '421' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Slovakia'],
        '423' => ['min' => 7, 'max' => 9, 'trunks' => [], 'country' => 'Liechtenstein'],
        '500' => ['min' => 5, 'max' => 5, 'trunks' => [], 'country' => 'Falkland Islands'],
        '501' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Belize'],
        '502' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Guatemala'],
        '503' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'El Salvador'],
        '504' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Honduras'],
        '505' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Nicaragua'],
        '506' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Costa Rica'],
        '507' => ['min' => 7, 'max' => 8, 'trunks' => [], 'country' => 'Panama'],
        '508' => ['min' => 6, 'max' => 9, 'trunks' => ['0'], 'country' => 'Saint Pierre and Miquelon'],
        '509' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Haiti'],
        '590' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Guadeloupe / Saint Martin'],
        '591' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Bolivia'],
        '592' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Guyana'],
        '593' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Ecuador'],
        '594' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'French Guiana'],
        '595' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Paraguay'],
        '596' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Martinique'],
        '597' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Suriname'],
        '598' => ['min' => 8, 'max' => 8, 'trunks' => ['0'], 'country' => 'Uruguay'],
        '599' => ['min' => 7, 'max' => 8, 'trunks' => [], 'country' => 'Curaçao / Caribbean Netherlands'],
        '670' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Timor-Leste'],
        '672' => ['min' => 6, 'max' => 6, 'trunks' => [], 'country' => 'Norfolk Island'],
        '673' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Brunei'],
        '674' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Nauru'],
        '675' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Papua New Guinea'],
        '676' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Tonga'],
        '677' => ['min' => 5, 'max' => 7, 'trunks' => [], 'country' => 'Solomon Islands'],
        '678' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Vanuatu'],
        '679' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Fiji'],
        '680' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Palau'],
        '681' => ['min' => 6, 'max' => 6, 'trunks' => [], 'country' => 'Wallis and Futuna'],
        '682' => ['min' => 5, 'max' => 5, 'trunks' => [], 'country' => 'Cook Islands'],
        '683' => ['min' => 4, 'max' => 7, 'trunks' => [], 'country' => 'Niue'],
        '685' => ['min' => 7, 'max' => 10, 'trunks' => [], 'country' => 'Samoa'],
        '686' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Kiribati'],
        '687' => ['min' => 6, 'max' => 6, 'trunks' => [], 'country' => 'New Caledonia'],
        '688' => ['min' => 6, 'max' => 7, 'trunks' => [], 'country' => 'Tuvalu'],
        '689' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'French Polynesia'],
        '690' => ['min' => 4, 'max' => 7, 'trunks' => [], 'country' => 'Tokelau'],
        '691' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Micronesia'],
        '692' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Marshall Islands'],
        '850' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'North Korea'],
        '852' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Hong Kong'],
        '853' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Macao'],
        '855' => ['min' => 8, 'max' => 9, 'trunks' => ['0'], 'country' => 'Cambodia'],
        '856' => ['min' => 9, 'max' => 10, 'trunks' => ['0'], 'country' => 'Laos'],
        '880' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Bangladesh'],
        '886' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Taiwan'],
        '960' => ['min' => 7, 'max' => 7, 'trunks' => [], 'country' => 'Maldives'],
        '961' => ['min' => 7, 'max' => 8, 'trunks' => ['0'], 'country' => 'Lebanon'],
        '962' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Jordan'],
        '963' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Syria'],
        '964' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Iraq'],
        '965' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Kuwait'],
        '966' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Saudi Arabia'],
        '967' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Yemen'],
        '968' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Oman'],
        '970' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Palestine'],
        '971' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'United Arab Emirates'],
        '972' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Israel'],
        '973' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Bahrain'],
        '974' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Qatar'],
        '975' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Bhutan'],
        '976' => ['min' => 8, 'max' => 8, 'trunks' => [], 'country' => 'Mongolia'],
        '977' => ['min' => 10, 'max' => 10, 'trunks' => ['0'], 'country' => 'Nepal'],
        '992' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Tajikistan'],
        '993' => ['min' => 8, 'max' => 8, 'trunks' => ['8'], 'country' => 'Turkmenistan'],
        '994' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Azerbaijan'],
        '995' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Georgia'],
        '996' => ['min' => 9, 'max' => 9, 'trunks' => ['0'], 'country' => 'Kyrgyzstan'],
        '998' => ['min' => 9, 'max' => 9, 'trunks' => [], 'country' => 'Uzbekistan'],
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail(trans('validation.string'));

            return;
        }

        $rules = BaseHelper::getPhoneValidationRule(asArray: false);
        $regex = '/^([0-9\s\-\+\(\)]*)$/';

        if ($regex && ! preg_match($regex, $value)) {
            $fail(trans('validation.regex'));

            return;
        }

        self::validateCountryLength($value, $fail);
    }

    /**
     * Closure rule for backward compatibility:
     * Validates that the national phone number has the right length for the selected country code.
     */
    public static function countryLength(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail): void {
            self::validateCountryLength($value, $fail);
        };
    }

    /**
     * Validate the national mobile number length against the calling code table.
     */
    public static function validateCountryLength(mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            return;
        }

        $trimmed = trim($value);

        if ($trimmed === '') {
            return;
        }

        // Normalize leading 00 to + for international notation
        if (str_starts_with($trimmed, '00')) {
            $trimmed = '+' . substr($trimmed, 2);
        }

        if (str_starts_with($trimmed, '+')) {
            $digits = preg_replace('/\D/', '', $trimmed);

            // Calling codes have length 1, 2, or 3 digits (test longest first)
            foreach ([3, 2, 1] as $len) {
                if (strlen($digits) <= $len) {
                    continue;
                }

                $code = substr($digits, 0, $len);

                if (! isset(self::$nationalRules[$code])) {
                    continue;
                }

                $rule = self::$nationalRules[$code];
                $min = $rule['min'];
                $max = $rule['max'];
                $country = $rule['country'];
                $nationalDigits = substr($digits, $len);

                // Auto-strip recognized domestic trunk prefixes if present
                $stripped = $nationalDigits;
                foreach ($rule['trunks'] as $trunk) {
                    if ($trunk !== '' && str_starts_with($nationalDigits, $trunk)) {
                        $candidate = substr($nationalDigits, strlen($trunk));
                        if (strlen($candidate) >= $min && strlen($candidate) <= $max) {
                            $stripped = $candidate;
                            break;
                        }
                        $stripped = $candidate;
                    }
                }

                $natLen = strlen($nationalDigits);
                $stripLen = strlen($stripped);

                if (($natLen < $min || $natLen > $max) && ($stripLen < $min || $stripLen > $max)) {
                    $lengthLabel = $min === $max ? "{$min}-digit" : "{$min}-{$max} digit";

                    $fail(__('Please enter a valid :length phone number for :country (+:code).', [
                        'length' => $lengthLabel,
                        'country' => $country,
                        'code' => $code,
                    ]));
                }

                return;
            }

            // Unlisted calling code: fallback to configurable system min/max
            $minSetting = (int) setting('phone_number_min_length', 8);
            $maxSetting = (int) setting('phone_number_max_length', 15);
            $totalDigits = strlen($digits);

            if ($totalDigits < $minSetting || $totalDigits > $maxSetting) {
                $fail(__('Please enter a valid phone number.'));
            }

            return;
        }

        // Fallback for numbers submitted without international prefix
        $minSetting = (int) setting('phone_number_min_length', 8);
        $maxSetting = (int) setting('phone_number_max_length', 15);
        $length = mb_strlen($trimmed);

        if ($length < $minSetting) {
            $fail(trans('validation.min.string', ['min' => $minSetting]));

            return;
        }

        if ($length > $maxSetting) {
            $fail(trans('validation.max.string', ['max' => $maxSetting]));
        }
    }
}
