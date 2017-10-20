<?

$a = $b = 1;
$da = $db = 0;

$x = getValues($_SERVER['DOCUMENT_ROOT'] . '/output/values');

$A1 = A1($b, $x);

/**
 * @param $a
 * @param $b
 * @param $x
 * @param $y
 * @return int
 */
function F1($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += ($a * sin($b * $x) - $y[$i]) * sin($b * $x);

	return $sum;
}

/**
 * @param $a
 * @param $b
 * @param $x
 * @param $y
 * @return int
 */
function F2($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += ($a * sin($b * $x) - $y[$i]) * $a * cos($b * $x) * $x;

	return $sum;
}

/**
 * @param $b
 * @param $x
 * @return int
 */
function A1($b, $x){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += pow(sin($b * $x[$i]), 2);

	return $sum;
}

/**
 * @param $a
 * @param $b
 * @param $x
 * @param $y
 * @return int
 */
function A2($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += 2 * $a * $x[$i] * sin($b * $x[$i]) * cos($b * $x[$i]) - $y[$i] * $x[$i] * cos($b * $x[$i]);

	return $sum;
}

/**
 * @param $a
 * @param $b
 * @param $x
 * @param $y
 * @return int
 */
function B1($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += 2 * $a * $x[$i] * sin($b * $x[$i]) * cos($b * $x[$i]) - $y[$i] * $x[$i] * cos($b * $x[$i]);

	return $sum;
}

/**
 * @param $a
 * @param $b
 * @param $x
 * @param $y
 * @return int
 */
function B2($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += pow($a, 2) * cos($b * $x[$i]) * (-sin($b * $x[$i]) * pow($x[$i], 3) - $y[$i] * $a * pow($x[$i], 2));

	return $sum;
}

/**
 * @param $a
 * @param $b
 * @param $x
 * @param $y
 * @return int
 */
function C1($a, $b, $x, $y){
	return -1 * F1($a, $b, $x, $y);
}

/**
 * @param $a
 * @param $b
 * @param $x
 * @param $y
 * @return int
 */
function C2($a, $b, $x, $y){
	return -1 * F2($a, $b, $x, $y);
}

/**
 * @param $filepath
 * @return array
 */
function getValues($filepath){
	$x = [];

	$handle = fopen($filepath, 'r');
	if ($handle) {
		while (($value = fgets($handle)) !== false)
			$x[] = (int)str_replace(PHP_EOL, '', $value);

		fclose($handle);
	}

	return $x;
}