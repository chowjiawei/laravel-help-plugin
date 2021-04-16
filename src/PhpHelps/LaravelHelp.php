<?php

namespace Chowjiawei\Helpers\PhpHelps;


class LaravelHelp{

    CONST AllCOUNTRY= [
        "AO" => "Angola",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "BJ" => "Benin",
        "BW" => "Botswana",
        "CD" => "Congo (Kinshasa)",
        "CF" => "Central African Republic",
        "CG" => "Congo (Brazzaville)",
        "CI" => "Ivory Coast",
        "CM" => "Cameroon",
        "CV" => "Cape Verde",
        "DJ" => "Djibouti",
        "DZ" => "Algeria",
        "EG" => "Egypt",
        "EH" => "Western Sahara",
        "ER" => "Eritrea",
        "ET" => "Ethiopia",
        "GA" => "Gabon",
        "GH" => "Ghana",
        "GM" => "Gambia",
        "GN" => "Guinea",
        "GQ" => "Equatorial Guinea",
        "GW" => "Guinea-Bissau",
        "KE" => "Kenya",
        "KM" => "Comoros",
        "LR" => "Liberia",
        "LS" => "Lesotho",
        "LY" => "Libya",
        "MA" => "Morocco",
        "MG" => "Madagascar",
        "ML" => "Mali",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "MW" => "Malawi",
        "MZ" => "Mozambique",
        "NA" => "Namibia",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "RE" => "Reunion",
        "RW" => "Rwanda",
        "SC" => "Seychelles",
        "SD" => "Sudan",
        "SH" => "Saint Helena",
        "SL" => "Sierra Leone",
        "SN" => "Senegal",
        "SO" => "Somalia",
        "SS" => "South Sudan",
        "ST" => "São Tomé and Príncipe",
        "SZ" => "Swaziland",
        "TD" => "Chad",
        "TG" => "Togo",
        "TN" => "Tunisia",
        "TZ" => "Tanzania",
        "UG" => "Uganda",
        "YT" => "Mayotte",
        "ZA" => "South Africa",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe",
        "AQ" => "Antarctica",
        "BV" => "Bouvet Island",
        "GS" => "South Georgia/Sandwich Islands",
        "HM" => "Heard Island and McDonald Islands",
        "TF" => "French Southern Territories",
        "AE" => "United Arab Emirates",
        "AF" => "Afghanistan",
        "AM" => "Armenia",
        "AZ" => "Azerbaijan",
        "BD" => "Bangladesh",
        "BH" => "Bahrain",
        "BN" => "Brunei",
        "BT" => "Bhutan",
        "CC" => "Cocos (Keeling) Islands",
        "CN" => "China",
        "CX" => "Christmas Island",
        "GE" => "Georgia",
        "HK" => "Hong Kong",
        "ID" => "Indonesia",
        "IL" => "Israel",
        "IN" => "India",
        "IO" => "British Indian Ocean Territory",
        "IQ" => "Iraq",
        "IR" => "Iran",
        "JO" => "Jordan",
        "JP" => "Japan",
        "KG" => "Kyrgyzstan",
        "KH" => "Cambodia",
        "KP" => "North Korea",
        "KR" => "South Korea",
        "KW" => "Kuwait",
        "KZ" => "Kazakhstan",
        "LA" => "Laos",
        "LB" => "Lebanon",
        "LK" => "Sri Lanka",
        "MM" => "Myanmar",
        "MN" => "Mongolia",
        "MO" => "Macao",
        "MV" => "Maldives",
        "MY" => "Malaysia",
        "NP" => "Nepal",
        "OM" => "Oman",
        "PH" => "Philippines",
        "PK" => "Pakistan",
        "PS" => "Palestinian Territory",
        "QA" => "Qatar",
        "SA" => "Saudi Arabia",
        "SG" => "Singapore",
        "SY" => "Syria",
        "TH" => "Thailand",
        "TJ" => "Tajikistan",
        "TL" => "Timor-Leste",
        "TM" => "Turkmenistan",
        "TW" => "Taiwan",
        "UZ" => "Uzbekistan",
        "VN" => "Vietnam",
        "YE" => "Yemen",
        "AD" => "Andorra",
        "AL" => "Albania",
        "AT" => "Austria",
        "AX" => "Åland Islands",
        "BA" => "Bosnia and Herzegovina",
        "BE" => "Belgium",
        "BG" => "Bulgaria",
        "BY" => "Belarus",
        "CH" => "Switzerland",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DE" => "Germany",
        "DK" => "Denmark",
        "EE" => "Estonia",
        "ES" => "Spain",
        "FI" => "Finland",
        "FO" => "Faroe Islands",
        "FR" => "France",
        "GB" => "United Kingdom (UK)",
        "GG" => "Guernsey",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "HR" => "Croatia",
        "HU" => "Hungary",
        "IE" => "Ireland",
        "IM" => "Isle of Man",
        "IS" => "Iceland",
        "IT" => "Italy",
        "JE" => "Jersey",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "LV" => "Latvia",
        "MC" => "Monaco",
        "MD" => "Moldova",
        "ME" => "Montenegro",
        "MK" => "North Macedonia",
        "MT" => "Malta",
        "NL" => "Netherlands",
        "NO" => "Norway",
        "PL" => "Poland",
        "PT" => "Portugal",
        "RO" => "Romania",
        "RS" => "Serbia",
        "RU" => "Russia",
        "SE" => "Sweden",
        "SI" => "Slovenia",
        "SJ" => "Svalbard and Jan Mayen",
        "SK" => "Slovakia",
        "SM" => "San Marino",
        "TR" => "Turkey",
        "UA" => "Ukraine",
        "VA" => "Vatican",
        "AG" => "Antigua and Barbuda",
        "AI" => "Anguilla",
        "AW" => "Aruba",
        "BB" => "Barbados",
        "BL" => "Saint Barthélemy",
        "BM" => "Bermuda",
        "BQ" => "Bonaire, Saint Eustatius and Saba",
        "BS" => "Bahamas",
        "BZ" => "Belize",
        "CA" => "Canada",
        "CR" => "Costa Rica",
        "CU" => "Cuba",
        "CW" => "Curaçao",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "GD" => "Grenada",
        "GL" => "Greenland",
        "GP" => "Guadeloupe",
        "GT" => "Guatemala",
        "HN" => "Honduras",
        "HT" => "Haiti",
        "JM" => "Jamaica",
        "KN" => "Saint Kitts and Nevis",
        "KY" => "Cayman Islands",
        "LC" => "Saint Lucia",
        "MF" => "Saint Martin (French part)",
        "MQ" => "Martinique",
        "MS" => "Montserrat",
        "MX" => "Mexico",
        "NI" => "Nicaragua",
        "PA" => "Panama",
        "PM" => "Saint Pierre and Miquelon",
        "PR" => "Puerto Rico",
        "SV" => "El Salvador",
        "SX" => "Saint Martin (Dutch part)",
        "TC" => "Turks and Caicos Islands",
        "TT" => "Trinidad and Tobago",
        "US" => "United States (US)",
        "VC" => "Saint Vincent and the Grenadines",
        "VG" => "Virgin Islands (British)",
        "VI" => "Virgin Islands (US)",
        "AS" => "American Samoa",
        "AU" => "Australia",
        "CK" => "Cook Islands",
        "FJ" => "Fiji",
        "FM" => "Micronesia",
        "GU" => "Guam",
        "KI" => "Kiribati",
        "MH" => "Marshall Islands",
        "MP" => "Northern Mariana Islands",
        "NC" => "New Caledonia",
        "NF" => "Norfolk Island",
        "NR" => "Nauru",
        "NU" => "Niue",
        "NZ" => "New Zealand",
        "PF" => "French Polynesia",
        "PG" => "Papua New Guinea",
        "PN" => "Pitcairn",
        "PW" => "Belau",
        "SB" => "Solomon Islands",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TV" => "Tuvalu",
        "UM" => "United States (US) Minor Outlying Islands",
        "VU" => "Vanuatu",
        "WF" => "Wallis and Futuna",
        "WS" => "Samoa",
        "AR" => "Argentina",
        "BO" => "Bolivia",
        "BR" => "Brazil",
        "CL" => "Chile",
        "CO" => "Colombia",
        "EC" => "Ecuador",
        "FK" => "Falkland Islands",
        "GF" => "French Guiana",
        "GY" => "Guyana",
        "PE" => "Peru",
        "PY" => "Paraguay",
        "SR" => "Suriname",
        "UY" => "Uruguay",
        "VE" => "Venezuela",
    ];

    /**
     * Get Two Number Count.
     *
     * @param   string|integer  $num1
     * @param   string|integer $num2
     * @return  integer
     */
    public function getCountNumber($num1, $num2)
    {
        return $num1+$num2;
    }

    /**
     * Get A Array Count.
     *
     * @param   array  $array
     * @return  integer
     */
    public function getArrayCount($array)
    {
        $sum=0;
        foreach ($array as $num){
            $sum+=$num;
        }
        return $sum;
    }

    /**
     * Get All Country.
     *
     * @return  array
     */
    public function getAllCountry(): array
    {
        return SELF::AllCOUNTRY;
    }
    /**
     * Get Country Name.
     *
     * @return  string
     */
    public function getCountryName($countryCode) :string
    {
        if(isset(SELF::AllCOUNTRY[$countryCode]))
        {
            return SELF::AllCOUNTRY[$countryCode];
        }
    }

    /**
     * Get Country Code.
     *
     * @return  string
     */
    public function getCountryCode($countryName)
    {
        if(array_search($countryName,SELF::AllCOUNTRY)!==false){
            return array_search($countryName,SELF::AllCOUNTRY);
        }
        return null;
    }

    /**
     * Get All Exchange Code.
     *
     * @return  array
     */
    public function getAllExchangeCode() :array
    {
        return config('helpers.exchange_code');
    }


}
