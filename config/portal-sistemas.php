<?php

if(env('num_cols') > 4 || env('num_cols') < 1) {
    dd('num_cols é inválido. Verifique seu .env');
}

return [

    // numero de colunas da tela principal
    'num_cols' => env('num_cols', 3),
    'col_width' => 12/env('num_cols', 3),
];