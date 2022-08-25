<?php

declare(strict_types=1);

namespace JCode;

use Nette\SmartObject;
use Nette\Utils\Strings;


/**
 * Class Browser
 * @property-read string   $userAgent
 * @property-read string   $name
 * @property-read int|null $version
 * @property-read string   $versionFull
 * @property-read string   $platform
 */
class Browser
{
	use SmartObject;

	private string $userAgent;
	private string $name;
	private ?int $version;
	private string $versionFull;
	private string $platform;


	public function __construct(?string $u_agent = null)
	{
		if ($u_agent === null && isset($_SERVER['HTTP_USER_AGENT'])) {
			$u_agent = $_SERVER['HTTP_USER_AGENT'];
		}

		$name = 'unknown';
		$platform = 'unknown';
		$versionFull = 'unknown';
		$version = null;

		if ($u_agent !== null) {
			if (Strings::match($u_agent, '/android/i') !== null) {
				$platform = 'android';
			} elseif (Strings::match($u_agent, '/linux/i') !== null) {
				$platform = 'linux';
			} elseif (Strings::match($u_agent, '/ipad|iphone/i') !== null) {
				$platform = 'ios';
			} elseif (Strings::match($u_agent, '/macintosh|mac os x/i') !== null) {
				$platform = 'mac';
			} elseif (Strings::match($u_agent, '/windows|win32/i') !== null) {
				$platform = 'windows';
			}

			if (
				(
					Strings::match($u_agent, '/MSIE/i') !== null
					&& Strings::match($u_agent, '/Opera/i') === null
				)
				|| Strings::match($u_agent, '/Trident/i') !== null
			) {
				$name = 'IE';
				$ub = 'MSIE';
			}
			if (Strings::match($u_agent, '/Edge/i') !== null) {
				$name = 'Edge';
				$ub = 'Edge';
			} elseif (Strings::match($u_agent, '/Firefox/i') !== null) {
				$name = 'Firefox';
				$ub = 'Firefox';
			} elseif (Strings::match($u_agent, '/Chrome/i') !== null) {
				$name = 'Chrome';
				$ub = 'Chrome';
			} elseif (Strings::match($u_agent, '/Safari/i') !== null) {
				$name = 'Safari';
				$ub = 'Safari';
			} elseif (Strings::match($u_agent, '/Opera/i') !== null) {
				$name = 'Opera';
				$ub = 'Opera';
			} elseif (Strings::match($u_agent, '/Netscape/i') !== null) {
				$name = 'Netscape';
				$ub = 'Netscape';
			}

			if (isset($ub)) {
				if (Strings::match($u_agent, '/ rv:/i') !== null) {
					$pattern = '#rv:(?<version>[0-9|a-zA-Z.]*)#';
					$matches = Strings::matchAll($u_agent, $pattern);
					if ($matches !== []) {
						$version = $matches[0]['version'];
					}
				} else {
					$known = ['Version', $ub, 'other'];
					$pattern = '#(?<browser>' . implode('|', $known) . ')[/ ]+(?<version>[0-9|a-zA-Z.]*)#';

					$matches = Strings::matchAll($u_agent, $pattern);
					$i = count($matches);
					if ($i === 1) {
						$version = $matches[0]['version'];
					} elseif ($i > 1) {
						if (strripos($u_agent, 'Version') < strripos($u_agent, $ub) && isset($matches[0]['version'])) {
							$version = $matches[0]['version'];
						} elseif (isset($matches[1]['version'])) {
							$version = $matches[1]['version'];
						}
					}
				}
			}

			if ($version === null || $version === '' || $version === 0) {
				$version = null;
			} else {
				$versionFull = $version;
				$version = (int) $version;
			}
		}

		$this->userAgent = $u_agent;
		$this->name = Strings::lower($name);
		$this->version = $version;
		$this->versionFull = $versionFull;
		$this->platform = Strings::lower($platform);
	}


	public function getUserAgent(): string
	{
		return $this->userAgent;
	}


	public function getName(): string
	{
		return $this->name;
	}


	public function getVersion(): ?int
	{
		return $this->version;
	}


	public function getVersionFull(): string
	{
		return $this->versionFull;
	}


	public function getPlatform(): string
	{
		return $this->platform;
	}
}
