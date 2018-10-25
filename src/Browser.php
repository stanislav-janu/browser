<?php declare(strict_types=1);

namespace JCode;

use Nette\SmartObject;
use Nette\Utils\Strings;

/**
 * Class Browser
 *
 * @property-read string $userAgent
 * @property-read string $name
 * @property-read int|null $version
 * @property-read string $versionFull
 * @property-read string $platform
 */
class Browser
{
	use SmartObject;

	/** @var string */
	private $userAgent;

	/** @var string */
	private $name;

	/** @var int|null */
	private $version;

	/** @var string */
	private $versionFull;

	/** @var string */
	private $platform;

	/**
	 * Browser constructor.
	 *
	 * @param string|null $u_agent
	 */
	public function __construct(string $u_agent = null)
	{
		if(is_null($u_agent) && isset($_SERVER['HTTP_USER_AGENT']))
			$u_agent = $_SERVER['HTTP_USER_AGENT'];

		$name = 'unknown';
		$platform = 'unknown';
		$version = null;

		if (preg_match('/android/i', $u_agent))
			$platform = 'android';
		elseif (preg_match('/linux/i', $u_agent))
			$platform = 'linux';
		elseif (preg_match('/ipad|iphone/i', $u_agent))
			$platform = 'ios';
		elseif (preg_match('/macintosh|mac os x/i', $u_agent))
			$platform = 'mac';
		elseif (preg_match('/windows|win32/i', $u_agent))
			$platform = 'windows';

		if((preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) || preg_match('/Trident/i',$u_agent))
		{
			$name = 'IE';
			$ub = "MSIE";
		}
		if(preg_match('/Edge/i',$u_agent))
		{
			$name = 'Edge';
			$ub = "Edge";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$name = 'Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$name = 'Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$name = 'Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$name = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$name = 'Netscape';
			$ub = "Netscape";
		}

		if(isset($ub))
		{
			if(preg_match('/ rv:/i',$u_agent))
			{
				$pattern = '#rv:(?<version>[0-9|a-zA-Z.]*)#';
				preg_match_all($pattern, $u_agent, $matches);
				if(isset($matches['version']) && count($matches['version']) > 0)
					$version = $matches['version'][0];
			}
			else
			{
				$known = ['Version', $ub, 'other'];
				$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9|a-zA-Z.]*)#';

				preg_match_all($pattern, $u_agent, $matches);
				$i = count($matches['browser']);
				if ($i == 1)
				{
					$version = $matches['version'][0];
				}
				else if($i > 1)
				{
					if (strripos($u_agent,"Version") < strripos($u_agent,$ub) && isset($matches['version'][0]))
						$version = $matches['version'][0];
					else if(isset($matches['version'][1]))
						$version = $matches['version'][1];
				}
				else if($i < 1)
				{
					$version = $matches['version'][0];
				}
			}
		}

		if(empty($version))
		{
			$versionFull = "unknown";
			$version = null;
		}
		else
		{
			$versionFull = $version;
			$version = intval($version);
		}

		$this->userAgent = $u_agent;
		$this->name = Strings::lower($name);
		$this->version = $version;
		$this->versionFull = $versionFull;
		$this->platform = Strings::lower($platform);
	}

	/**
	 * @return string
	 */
	public function getUserAgent() : string
	{
		return $this->userAgent;
	}

	/**
	 * @return string
	 */
	public function getName() : string
	{
		return $this->name;
	}


	/**
	 * @return int|null
	 */
	public function getVersion() : ?int
	{
		return $this->version;
	}

	/**
	 * @return string
	 */
	public function getVersionFull() : string
	{
		return $this->versionFull;
	}

	/**
	 * @return string
	 */
	public function getPlatform() : string
	{
		return $this->platform;
	}

}
