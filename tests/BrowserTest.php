<?php declare(strict_types=1);

namespace JCode\Tests\Crypt;

use JCode\Browser;
use PHPUnit\Framework\TestCase;

class BrowserTest extends TestCase
{
	static $browsers = [

		// Mac
		[
			'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.116',
			'platform' => 'mac',
		],
		[
			'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Safari/602.1.50',
			'name' => 'safari',
			'version' => 10,
			'version_full' => '10.0',
			'platform' => 'mac',
		],
		[
			'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.143',
			'platform' => 'mac',
		],
		[
			'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Safari/602.1.50',
			'name' => 'safari',
			'version' => 10,
			'version_full' => '10.0',
			'platform' => 'mac',
		],
		[
			'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Safari/602.1.50',
			'name' => 'safari',
			'version' => 10,
			'version_full' => '10.0',
			'platform' => 'mac',
		],
		[
			'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.143',
			'platform' => 'mac',
		],
		[
			'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.116',
			'platform' => 'mac',
		],
		[
			'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.8 (KHTML, like Gecko) Version/9.1.3 Safari/601.7.8',
			'name' => 'safari',
			'version' => 9,
			'version_full' => '9.1.3',
			'platform' => 'mac',
		],


		// iOS
		[
			'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_0_1 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/14A403 Safari/602.1',
			'name' => 'safari',
			'version' => 10,
			'version_full' => '10.0',
			'platform' => 'ios',
		],
		[
			'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_0_2 like Mac OS X) AppleWebKit/601.1 (KHTML, like Gecko) CriOS/53.0.2785.109 Mobile/14A456 Safari/601.1.46',
			'name' => 'safari',
			'version' => 601,
			'version_full' => '601.1.46',
			'platform' => 'ios',
		],
		[
			'ua' => 'Mozilla/5.0 (iPad; CPU OS 9_3_5 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G36 Safari/601.1',
			'name' => 'safari',
			'version' => 9,
			'version_full' => '9.0',
			'platform' => 'ios',
		],
		[
			'ua' => 'Mozilla/5.0 (iPad; CPU OS 10_0_1 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/14A403 Safari/602.1',
			'name' => 'safari',
			'version' => 10,
			'version_full' => '10.0',
			'platform' => 'ios',
		],


		// Android
		[
			'ua' => 'Mozilla/5.0 (Linux; Android 6.0; vivo 1713 Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.124 Mobile Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.124',
			'platform' => 'android',
		],
		[
			'ua' => 'Mozilla/5.0 (Linux; Android 4.3; Nexus 10 Build/JSS15Q) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.72 Safari/537.36 DMBrowser-BV',
			'name' => 'chrome',
			'version' => 29,
			'version_full' => '29.0.1547.72',
			'platform' => 'android',
		],


		// Linux
		[
			'ua' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:49.0) Gecko/20100101 Firefox/49.0',
			'name' => 'firefox',
			'version' => 49,
			'version_full' => '49.0',
			'platform' => 'linux',
		],
		[
			'ua' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.116',
			'platform' => 'linux',
		],


		// Win
		[
			'ua' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.116',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.116',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.143',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.143',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.116',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.143',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0',
			'name' => 'firefox',
			'version' => 49,
			'version_full' => '49.0',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0',
			'name' => 'firefox',
			'version' => 49,
			'version_full' => '49.0',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko',
			'name' => 'ie',
			'version' => 11,
			'version_full' => '11.0',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.116',
			'platform' => 'windows',
		],
		[
			'ua' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36',
			'name' => 'chrome',
			'version' => 53,
			'version_full' => '53.0.2785.116',
			'platform' => 'windows',
		],
	];

	public function testMain()
	{
		foreach(self::$browsers as $browser)
		{
			$bd = new Browser($browser['ua']);

			$this->assertSame($browser['ua'], $bd->userAgent);
			$this->assertSame($browser['name'], $bd->name);
			$this->assertSame($browser['version'], $bd->version);
			$this->assertSame($browser['version_full'], $bd->versionFull);
			$this->assertSame($browser['platform'], $bd->platform);

			$this->assertNotSame('unknown', $bd->userAgent);
			$this->assertNotSame('unknown', $bd->name);
			$this->assertNotSame(null, $bd->version);
			$this->assertNotSame('unknown', $bd->versionFull);
			$this->assertNotSame('unknown', $bd->platform);
		}

		$bd = new Browser('');
		$this->assertSame('', $bd->userAgent);
		$this->assertSame('unknown', $bd->name);
		$this->assertSame(null, $bd->version);
		$this->assertSame('unknown', $bd->versionFull);
		$this->assertSame('unknown', $bd->platform);
	}
}
