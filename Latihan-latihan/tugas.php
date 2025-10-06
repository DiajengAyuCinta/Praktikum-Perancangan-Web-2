<?php
// a.
$deret1 = [4, 6, 9, 13, 18];
for ($i = 5; $i < 7; $i++) {
    $deret1[$i] = $deret1[$i-1] + ($i+1);
}

// b.
$deret2 = [2, 2, 3, 3, 4];
$deret2[] = 4; // ulang 4
$deret2[] = 5; // lanjut 5

// c.
$deret3 = [1, 9, 2, 10, 3];
$deret3[] = 11; // genap
$deret3[] = 4;  // ganjil

echo "<h3>Hasil Tes Psikotes:</h3>";
echo "a. " . implode(", ", $deret1) . "<br>";
echo "b. " . implode(", ", $deret2) . "<br>";
echo "c. " . implode(", ", $deret3) . "<br>";
?>

