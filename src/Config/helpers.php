<?php

return [



    //configuration Openexchangerates Api Information ******************************************************************************

    "exchange" => [
        "appid" => env('EXCHANGE_APPID', null), //Openexchangerates Appid
        "base_currency" => env('EXCHANGE_BASE_CURRENY', 'USD'), //Set Openexchangerates Api Base Currency
    ],

    //******************************************************************************************************************************
    //==============================================================================================================================



    //configuration DingTalk Robot *************************************************************************************************

    "dingtalk" => env('DINGTALK_ROBOT', null), //Webhooks Access Token

    //******************************************************************************************************************************
    //==============================================================================================================================


    //configuration  Enterprise Wechat Robot  **************************************************************************************

    "wechat" => env('WECHAT_ROBOT', null), //Webhooks Access Token

    //******************************************************************************************************************************
    //==============================================================================================================================


    //configuration  Enterprise Wechat Robot  **************************************************************************************

    "lark" => env('LARK_ROBOT', null), //Webhooks Access Token

    //******************************************************************************************************************************
    //==============================================================================================================================




    //Don't move the following information    **************************************************************************************

    //Return All Country Code and Name
    'country' => [
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
    ],

    //Return All Exchange Code
    'exchangeCode' => [
        "AED",
        "AFN",
        "ALL",
        "AMD",
        "ANG",
        "AOA",
        "ARS",
        "AUD",
        "AWG",
        "AZN",
        "BAM",
        "BBD",
        "BDT",
        "BGN",
        "BHD",
        "BIF",
        "BMD",
        "BND",
        "BOB",
        "BRL",
        "BSD",
        "BTC",
        "BTN",
        "BWP",
        "BYN",
        "BZD",
        "CAD",
        "CDF",
        "CHF",
        "CLF",
        "CLP",
        "CNH",
        "CNY",
        "COP",
        "CRC",
        "CUC",
        "CUP",
        "CVE",
        "CZK",
        "DJF",
        "DKK",
        "DOP",
        "DZD",
        "EGP",
        "ERN",
        "ETB",
        "EUR",
        "FJD",
        "FKP",
        "GBP",
        "GEL",
        "GGP",
        "GHS",
        "GIP",
        "GMD",
        "GNF",
        "GTQ",
        "GYD",
        "HKD",
        "HNL",
        "HRK",
        "HTG",
        "HUF",
        "IDR",
        "ILS",
        "IMP",
        "INR",
        "IQD",
        "IRR",
        "ISK",
        "JEP",
        "JMD",
        "JOD",
        "JPY",
        "KES",
        "KGS",
        "KHR",
        "KMF",
        "KPW",
        "KRW",
        "KWD",
        "KYD",
        "KZT",
        "LAK",
        "LBP",
        "LKR",
        "LRD",
        "LSL",
        "LYD",
        "MAD",
        "MDL",
        "MGA",
        "MKD",
        "MMK",
        "MNT",
        "MOP",
        "MRO",
        "MRU",
        "MUR",
        "MVR",
        "MWK",
        "MXN",
        "MYR",
        "MZN",
        "NAD",
        "NGN",
        "NIO",
        "NOK",
        "NPR",
        "NZD",
        "OMR",
        "PAB",
        "PEN",
        "PGK",
        "PHP",
        "PKR",
        "PLN",
        "PYG",
        "QAR",
        "RON",
        "RSD",
        "RUB",
        "RWF",
        "SAR",
        "SBD",
        "SCR",
        "SDG",
        "SEK",
        "SGD",
        "SHP",
        "SLL",
        "SOS",
        "SRD",
        "SSP",
        "STD",
        "STN",
        "SVC",
        "SYP",
        "SZL",
        "THB",
        "TJS",
        "TMT",
        "TND",
        "TOP",
        "TRY",
        "TTD",
        "TWD",
        "TZS",
        "UAH",
        "UGX",
        "USD",
        "UYU",
        "UZS",
        "VES",
        "VND",
        "VUV",
        "WST",
        "XAF",
        "XAG",
        "XAU",
        "XCD",
        "XDR",
        "XOF",
        "XPD",
        "XPF",
        "XPT",
        "YER",
        "ZAR",
        "ZMW",
        "ZWL",
    ],
    "extend" => [
        "chinese" => [
            "storeRestController" => '创建Rest风格资源控制器',
            "dbBackup" => '备份数据库',
            "choose" => '请选择',
            "exit" => '退出?',
            "dbResult" => '数据库备份成功，可以前往storage/backup文件夹中查看',
            "dbAlert" => '备份期间将临时更改网站为维护模式，备份完成后将恢复',
            "dbResultAlert" => '为您创建了',
            "storeRestControllerAlert" => '请输入创建的控制器名字,请以大写开头，如：',
            "success" => '您的操作已完成',
            "generateDingtalk" => '生成DinktalkNotification',
            "generateWechat" => '生成WechatNotification',
            "generateWechatTemplateMessage" => '生成WechatTemplateMessageNotification',
            "generateLarkRobot" => '生成LarkRobotNotification',
            "generate" => '代码生成器',
        ],
        "english" => [
            "storeRestController" => 'Create rest style resource controller',
            "dbBackup" => 'Backup database',
            "choose" => 'Please select',
            "exit" => 'Exit?',
            "dbResult" => 'If the database backup is successful, you can go to the storage/backup folder to view it',
            "dbAlert" => 'During the backup, the website will be temporarily changed to maintenance mode, and will be restored after the backup is completed',
            "dbResultAlert" => 'Created for you',
            "storeRestControllerAlert" => 'Please enter the name of the created controller, starting with uppercase, such as:',
            "success" => 'SUCCESS',
            "generateDingtalk" => 'Generate DinktalkNotification',
            "generateWechat" => 'Generate WechatNotification',
            "generateWechatTemplateMessage" => 'Generate WechatTemplateMessageNotification',
            "generateLarkRobot" => 'Generate LarkRobotNotification',
            "generate" => 'Generate Code',
        ],
    ],
    'tiktok' => [  //抖音的支付 单位全部为分
        'token' => '', //支付token
        'salt' => '',  //盐值
        'merchant_id' => '',  //商户号
        'app_id' => '',
        'secret' => '',
        'notify_url' => '',  //支付链接  如果在设置回调链接中设置了支付回调链接 则设置的优先 这个配置不生效
        'private_key_url' => storage_path() . '/pay/tt/private_key.pem',
        'platform_public_key_url' => storage_path() . '/pay/tt/platform_public_key.pem',
        'public_key_url' => storage_path() . '/pay/tt/public_key.pem',
        'version' => '',//支付版本号
        'settle_notify_url' =>  '',//分账回调url
        'refund_notify_url' =>  '',//退款回调url
        'agree_refund_notify_url' =>  '',//同意退款回调url
        'create_order_callback' =>  '',//创建订单回调地址
        'pay_callback' =>  '',//支付回调地址
    ],


];
