<?php

//Credits and thanks to eddiewould: https://stackoverflow.com/questions/5506888/permutations-all-possible-sets-of-numbers
function permutations($pool, $r = null) {
    $n = count($pool);

    if ($r == null) {
        $r = $n;
    }

    if ($r > $n) {
        return;
    }

    $indices = range(0, $n - 1);
    $cycles = range($n, $n - $r + 1, -1); // count down

    yield array_slice($pool, 0, $r);

    if ($n <= 0) {
        return;
    }

    while (true) {
        $exit_early = false;
        for ($i = $r;$i--;$i >= 0) {
            $cycles[$i]-= 1;
            if ($cycles[$i] == 0) {
                // Push whatever is at index $i to the end, move everything back
                if ($i < count($indices)) {
                    $removed = array_splice($indices, $i, 1);
                    array_push($indices, $removed[0]);
                }
                $cycles[$i] = $n - $i;
            } else {
                $j = $cycles[$i];
                // Swap indices $i & -$j.
                $i_val = $indices[$i];
                $neg_j_val = $indices[count($indices) - $j];
                $indices[$i] = $neg_j_val;
                $indices[count($indices) - $j] = $i_val;
                $result = [];
                $counter = 0;
                foreach ($indices as $indx) {
                    array_push($result, $pool[$indx]);
                    $counter++;
                    if ($counter == $r) break;
                }
                yield $result;
                $exit_early = true;
                break;
            }
        }
        if (!$exit_early) {
            break; // Outer while loop
        }
    }
}

/*  sample, provided by eddiewould in the answer:
$result = iterator_to_array(permutations([1, 2, 3, 4], 3));
foreach ($result as $row) {
    print implode(", ", $row) . "\n";
}

*/

//for unique combinations

//Credits and thanks to Nguyen Van Vinh: https://stackoverflow.com/questions/3742506/php-array-combinations/60268537#60268537
//NB: it's coded for this specific program, unlike the previous one

function combine($array, $k, $callback,int $type)
{
    $total = count($array);
    $init = '
        $i0 = -1;
        $type = '.$type.';';
    $sample = '
        for($i{current} = $i{previous} + 1; $i{current} < $total; $i{current}++ ) {
            {body}
        }
    ';

    $do = '
        $record = array();
        for ($i = 1; $i <= $k; $i++) {
            $t = "i$i";
            $record[] = $array[$$t];
        }
        $callback($record,$type);
    ';
    $for = '';
    for ($i = $k; $i >= 1; $i--) {
        switch ($i) {
            case $k:
                $for = str_replace(['{current}', '{previous}', '{body}'], [$i, $i - 1, $do], $sample);
                break;
            case 1:
                $for = $init . str_replace(['{current}', '{previous}', '{body}'], [$i, $i - 1, $for], $sample);
                break;
            default:
                $for = str_replace(['{current}', '{previous}', '{body}'], [$i, $i - 1, $for], $sample);
                break;
        }
    }

    // execute
    eval($for);
}

function exec_combine(int $k,$array,int $type)
{

    $callback = function ($record,$type) {
        if($type == 1){
            array_push($_SESSION['p_male'], $record);
        } elseif($type==2){
            array_push($_SESSION['p_female'], $record);
        } else{
            array_push($_SESSION['p_mix'], $record);
        }

    };

    combine($array, $k, $callback,$type);
};