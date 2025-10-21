<?php
/**
 * Mencetak string
 * $teks nilai string
 * $bold adalah argumen opsional
 */
function print_teks($teks, $bold = true){
    echo $bold ? '<b>' .$teks. '</b>' : $teks;
}
print_teks('Indonesiaku');
// Mencetak dengan huruf tebal
echo "<br>";
print_teks('Indonesiaku', false);
// mencetak dengan huruf reguler
?>
