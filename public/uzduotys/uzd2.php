<?php

$letters = 'eatregsmca';

$numbers = [16, 8, 9, 26, 13, 41, 32, 53, 10];
$multiplication = [1, 2, 4, 7, 8];
$addition = [0, 1, 3, 5, 6];

$mult = 1;
foreach ($multiplication as $key) {
    $mult *= $numbers[$key];
}

$sum = 0;
foreach ($addition as $key) {
    $sum += $numbers[$key];
}

$x = $mult + $sum;

$keys = str_split($x);
$word = str_split($letters);

$answer = '';
foreach ($keys as $key) {
    $answer = $answer.''.$word[$key];
}

echo $answer;

/*
Masyve $numbers turime skaičius.

Masyve $multiplication turime masyvo $numbers raktus.
Pvz. skaičius 1, atitinka $numbers narį 8; skaičius 2 atitinka narį, kurio reikšmė yra 9 ir t.t
Sudauginkite tas masyvo $numbers reikšmes, kurių raktai yra masyve $multiplication

Tą patį principą taikykite masyvui $addition, tik šiuo atveju tas reikšmes sudėkite.

Įvykdę šias dvi užduotis turėsite du skaičius - juos sudėkite. Turėsite vieną skaičių X.

Kiekvienas šio skaičiaus skaitmuo atitiks string'o $letters raidę. Raidės pradedamos skaičiuoti nuo 0
t.y 0 - e, 1 - a, 2 - t, 3 - r ir t.t.
Koks žodis užkuoduotas skaičiuoje X?*/
