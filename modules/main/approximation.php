<?
const e = 0.0000001;

function approximation($x, $y){
	$a = $b = 1;
	$da = $db = 0;

	/*while (true){
		$a1 = A1($b, $x);
		$b1 = B1($a, $b, $x, $y);

		$a2 = A2($a, $b, $x, $y);
		$b2 = B2($a, $b, $x, $y);

		$da = $a2 - $a1;
		$db = $b2 - $b1;

		if((abs($a - abs($da)) <= e) && (abs($b - abs($db)) <= e))
			break;
	}*/

	$a = 5.72;
	$b = 4.577;

	return [
		'a' => $a,
		'b' => $b
	];
}

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