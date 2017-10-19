<?

namespace Log\Generator;

/**
 * Class UserInfo
 * @package Log\Generator
 */
class UserInfo {
	/**
	 * @var string
	 */
	public
		$ip,
		$agent,
		$timestamp,
		$page;

	/**
	 * @var array
	 */
	static
		$userAgents = [];

	/**
	 * UserInfo constructor.
	 * @param $min_timestamp
	 * @param $max_timestamp
	 */
	public function __construct($min_timestamp, $max_timestamp) {
		$this->ip = $this->randomIPv4();
		$this->agent = $this->randomUserAgent();

		$this->timestamp = rand($min_timestamp, $max_timestamp);
		$this->page = $this->randomUserPage();

		return $this;
	}

	/**
	 * @return string
	 */
	private function randomIPv4(){
		return long2ip(mt_rand());
	}

	/**
	 * @return array
	 */
	private static function getUserAgents(){
		$userAgents = [];
		$handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/assets/agents.list', 'r');
		if ($handle) {
			while (($name = fgets($handle)) !== false)
				$userAgents[] = $name;

			fclose($handle);
		}
		return $userAgents;
	}

	/**
	 * @return mixed|string
	 */
	private function randomUserPage(){
		$staticSitePages = [
			'/contacts',
			'/help',
		];

		$rndSitePage = rand(0, 9); // 4 из 10 главная старница, 1 из 10 статичные страницы, 5 из 10 динамические страницы
		switch ($rndSitePage){
			case 0:
			case 1:
			case 2:
			case 3:
				return '/';
			case 4:
				return $staticSitePages[rand(0, 1)];
			default:
				return $this->randomDynamicPage();
		}
	}

	/**
	 * @return string
	 */
	private function randomDynamicPage(){
		$dynamicSitePages = [
			'/news',
			'/articles',
			'/blog'
		];
		$rndDynamicSitePageSubDir = rand(0, 2);
		if($rndDynamicSitePageSubDir == 0) { // 1 из 3 детальная, остальные списки
			$subDir = '/detail/';
			$param = rand(0, 100);
		} else{
			$subDir = '/list/';
			$param = rand(0, 10);
		}

		return $dynamicSitePages[rand(0, 2)] . $subDir . $param;
	}

	/**
	 *
	 */
	public function reRandomUserAgent(){
		$this->agent = $this->randomUserAgent();
	}

	/**
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public static function sortByTimestamp($a, $b){
		return ($a->timestamp == $b->timestamp) ? 0 : (($a->timestamp < $b->timestamp) ? -1 : 1);
	}

	/**
	 * @return mixed
	 */
	public function randomUserAgent(){
		if(empty(self::$userAgents))
			self::$userAgents = self::getUserAgents();
		return self::$userAgents[rand(0, count(self::$userAgents) - 1)];
	}

	/**
	 * @param $min_timestamp
	 * @param $max_timestamp
	 */
	public function reRandom($min_timestamp, $max_timestamp){
		$this->timestamp = rand($min_timestamp, $max_timestamp);
		$this->page = $this->randomUserPage();

		$rndUserAgent = rand(0, 9);
		if($rndUserAgent == 0) // 1 из 9 меняет user agent с того же ip
			$this->randomUserAgent();
	}
}