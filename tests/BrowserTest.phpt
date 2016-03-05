<?php
use Tester\Assert;

# Load Tester library
require __DIR__ . '/../vendor/autoload.php';       # installation by Composer

# Adjust PHP behaviour and enable some Tester features (described later)
Tester\Environment::setup();

/**
 * @testCase
 */
class BrowserTest extends Tester\TestCase
{
    public function testInit() {
        $browser = new Browser;
        Assert::truthy($browser);
    }

    public function testFirefoxWindows7() {
        $userAgent = 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0';
        $browser = new Browser($userAgent);
        Assert::same(Browser::BROWSER_FIREFOX, $browser->getBrowser());
        Assert::same(Browser::PLATFORM_WINDOWS_7, $browser->getPlatform());
        Assert::same('21.0', $browser->getVersion());
    }

    public function testWindowsPhone81() {
        $userAgent = 'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 520) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537';
        Assert::truthy(preg_match('/windows phone 8\.1/i', $userAgent));

        $browser = new Browser($userAgent);
        Assert::same(Browser::PLATFORM_WINDOWS_PHONE_8_1, $browser->getPlatform());
    }

    public function dataForTestGetPlatform() {
        return array(
            // windows phone masks as android
            // array(self::PLATFORM_WINDOWS_PHONE_7,       ''),
            // array(self::PLATFORM_WINDOWS_PHONE_8,       ''),
            array(Browser::PLATFORM_WINDOWS_PHONE_8_1,  'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 820) like Gecko'),
            array(Browser::PLATFORM_WINDOWS_PHONE_10,   'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; NOKIA; Lumia 830) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Mobile Safari/537.36 Edge/12.10536'),
            // array(self::PLATFORM_WINDOWS_MOBILE,        ''),

            // android
            array(Browser::PLATFORM_ANDROID_6_0,        'Mozilla/5.0 (Linux; Android 6.0; PLK-AL10 Build/HONORPLK-AL10) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.95 Mobile Safari/537.36',),
            array(Browser::PLATFORM_ANDROID_5_1,        'Mozilla/5.0 (Linux; Android 5.1.1; Nexus 7 Build/LMY48G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.93 Safari/537.36',),
            array(Browser::PLATFORM_ANDROID_5_0,        'Mozilla/5.0 (Linux; Android 5.0; SM-G900F Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96 Mobile Safari/537.36',),
            array(Browser::PLATFORM_ANDROID_4_4,        'Mozilla/5.0 (Linux; Android 4.4.2; CUBE1_G503 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36',),
            array(Browser::PLATFORM_ANDROID_4_3,        'Mozilla/5.0 (Linux; U; Android 4.3; cs-cz; SM-N900 Build/JSS15J.N900UBUBMJ2) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',),
            array(Browser::PLATFORM_ANDROID_4_2,        'Mozilla/5.0 (Linux; Android 4.2.2; C2105 Build/15.3.A.1.17) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.59 Mobile Safari/537.36',),
            array(Browser::PLATFORM_ANDROID_4_1,        'Mozilla/5.0 (Linux; Android 4.1.2; GT-P3110 Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.59 Safari/537.36',),
            array(Browser::PLATFORM_ANDROID_4,          'Mozilla/5.0 (Linux; U; Android 4.0.3; cs-cz; EVO3D_X515m Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',),
            // array(Browser::PLATFORM_ANDROID_3,          ''),
            array(Browser::PLATFORM_ANDROID_2_3,        'Mozilla/5.0 (Linux; U; Android 2.3.4; cs-cz; SonyEricssonST15i Build/4.0.2.A.0.84) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',),
            array(Browser::PLATFORM_ANDROID_2_2,        'Mozilla/5.0 (Linux; U; Android 2.2.1; cs-cz; GT-S5570 Build/FROYO) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',),
            // array(Browser::PLATFORM_ANDROID_2,          ''),
            // array(Browser::PLATFORM_ANDROID_1_6,        ''),
            array(Browser::PLATFORM_ANDROID_1_5,        'Mozilla/5.0 (Linux; U; Android 1.5; en-gb; HTC Hero Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1',),
            // array(Browser::PLATFORM_ANDROID_1,          ''),
            // array(Browser::PLATFORM_ANDROID,            ''),

            // consoles
            // array(Browser::PLATFORM_XMB,                ''),
            // array(Browser::PLATFORM_LIVE_AREA,          ''),
            array(Browser::PLATFORM_ORBIS,              'Mozilla/5.0 (PlayStation 4 2.57) AppleWebKit/537.73 (KHTML, like Gecko)',),
            // array(Browser::PLATFORM_NINTENDO_3DS,       ''),
            // array(Browser::PLATFORM_NINTENDO_DS,        ''),
            // array(Browser::PLATFORM_NINTENDO_WIIU,      ''),
            // array(Browser::PLATFORM_NINTENDO_WII,       ''),
            array(Browser::PLATFORM_XBOX,               'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0)'),

            // windows
            // array(Browser::PLATFORM_WINDOWS,            ''),
            array(Browser::PLATFORM_WINDOWS_CE,         'MOT-MPx220/1.400 Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; Smartphone;'),
            array(Browser::PLATFORM_WINDOWS_10,         'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0'),
            array(Browser::PLATFORM_WINDOWS_8_1,        'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36'),
            array(Browser::PLATFORM_WINDOWS_RT,         'Mozilla/5.0 (Windows NT 6.2; ARM; Trident/7.0; Touch; rv:11.0; WPDesktop; Lumia 520) like Gecko'),
            array(Browser::PLATFORM_WINDOWS_8,          'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36'),
            array(Browser::PLATFORM_WINDOWS_7,          'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36',),
            array(Browser::PLATFORM_WINDOWS_VISTA,      'Mozilla/5.0 (Windows; U; Windows NT 6.0; cs; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.16'),
            array(Browser::PLATFORM_WINDOWS_SERVER,     'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322; Screen-Shot Generator 1.3)'),
            array(Browser::PLATFORM_WINDOWS_XP,         'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13'),
            array(Browser::PLATFORM_WINDOWS_2000,       'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'),
            array(Browser::PLATFORM_WINDOWS_ME,         'Mozilla/5.0 (Windows ME; U; en) Opera 8.51'),
            array(Browser::PLATFORM_WINDOWS_98,         'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98)'),
            array(Browser::PLATFORM_WINDOWS_95,         'Mozilla/4.0 (compatible; MSIE 5.5; AOL 6.0; Windows 95)'),
            // array(Browser::PLATFORM_WINDOWS_3,          ''),
            // array(Browser::PLATFORM_WINDOWS_NT,         ''),
            // array(Browser::PLATFORM_WINDOWS_MOBILE,     ''),
            // array(Browser::PLATFORM_WINDOWS_PHONE_7,    ''),
            // array(Browser::PLATFORM_WINDOWS_PHONE_8,    ''),
        );
    }

    /**
     * @dataProvider dataForTestGetPlatform
     */
    public function testGetPlatform($expPlatform, $userAgent) {
        $browser = new Browser($userAgent);
        Assert::same($expPlatform, $browser->getPlatform(), $userAgent);
    }
}

# Testing methods run
$testCase = new BrowserTest;
$testCase->run();
