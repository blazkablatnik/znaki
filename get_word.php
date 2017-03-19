<?php

$alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
$words = array("ananas", "balon", "cesta", "dom", "eskim");
$num_words = count($words);
$num_choices = 4;

// Spremeni vse male crke v velike (pri vseh besedah)
for ($i = 0; $i < $num_words; $i++) {
    $words[$i] = strtoupper($words[$i]);
}

// Izberi nakljucno besedo
$word = $words[rand(0, count($words) - 1)];

$letters = str_split($word);

// Prikazi vsako crko posebej
$id = 0;
foreach($letters as $l) {
    // Izberi moznosti, ki se bodo prikazale pri posamezni crki
    $possibilities = return_possibilities($l, $alphabet, $num_choices);
    
    // Izpisi vse moznosti
    echo "<div id='letter_" . $id . "' class='letter-wrap'>";
    echo "<div class='letter'><h3>" . $l . "</h3></div>";
    
    $id_pos = 0;
    foreach($possibilities as $p) {
        echo "<div class='pos_" . $id_pos . "'>";
        echo "<img src='" . get_letter_image_url($p, $alphabet) . "' />";
        echo "</div>"; // pos_($id_pos)
        $id_pos ++;
    }
    echo "</div>"; // letter-wrap
    $id ++;
}

function return_possibilities($letter, $alphabet, $num_choices) {
    $random_letters = array_rand($alphabet, $num_choices);

    foreach($random_letters as $key => $value) {
        $random_letters[$key] = $alphabet[$value];
    }
    if ( !in_array($letter, $random_letters) ) {
        $random_letters[0] = $letter;
        shuffle($random_letters);
    }
    
    return $random_letters;
}

function get_letter_image_url($letter, $alphabet) {
    $image_url = "Znaki/" . strtolower($letter) . ".png";
    if(!file_exists($image_url)) {
        // Zacetnih nekaj crk je hkrati tudi stevilk, zato zgornji link mogoce ni pravi
        $num = array_search($letter, $alphabet) + 1;
        if ($num == 11) { // Posebnost - crka K
            $num = 0;
        }
        $image_url = "Znaki/" . strtolower($letter) . "_" . $num . ".png";
    }
    return $image_url;
}