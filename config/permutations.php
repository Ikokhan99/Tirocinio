<?php
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
        if($type === 1){
            $_SESSION['p_male'][] = $record;
        } elseif($type===2){
            $_SESSION['p_female'][] = $record;
        } else{
            $_SESSION['p_mix'][] = $record;
        }

    };

    combine($array, $k, $callback,$type);
}