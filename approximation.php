<?

$a = $b = 1;
$da = $db = 0;

$x = getX($_SERVER['DOCUMENT_ROOT'] . '/output/x');

$A1 = A1($b, $x);

function F1($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += ($a * sin($b * $x) - $y[$i]) * sin($b * $x);

	return $sum;
}

function F2($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += ($a * sin($b * $x) - $y[$i]) * $a * cos($b * $x) * $x;

	return $sum;
}

function A1($b, $x){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += pow(sin($b * $x[$i]), 2);

	return $sum;
}

function A2($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += 2 * $a * $x[$i] * sin($b * $x[$i]) * cos($b * $x[$i]) - $y[$i] * $x[$i] * cos($b * $x[$i]);

	return $sum;
}

function B1($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += 2 * $a * $x[$i] * sin($b * $x[$i]) * cos($b * $x[$i]) - $y[$i] * $x[$i] * cos($b * $x[$i]);

	return $sum;
}

function B2($a, $b, $x, $y){
	$sum = 0;
	$len = count($x);

	for($i = 0; $i < $len; $i++)
		$sum += pow($a, 2) * cos($b * $x[$i]) * (-sin($b * $x[$i]) * pow($x[$i], 3) - $y[$i] * $a * pow($x[$i], 2));

	return $sum;
}

function C1($a, $b, $x, $y){
	return -1 * F1($a, $b, $x, $y);
}

function C2($a, $b, $x, $y){
	return -1 * F2($a, $b, $x, $y);
}

function getX($filepath){
	$x = [];

	$handle = fopen($filepath, 'r');
	if ($handle) {
		while (($value = fgets($handle)) !== false)
			$x[] = $value;

		fclose($handle);
	}

	return $x;
}