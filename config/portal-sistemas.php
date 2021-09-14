<?php

if((env('num_cols') > 4 || env('num_cols') < 1) && !empty(env('num_cols'))) {
    dd('num_cols é inválido. Valores possíveis: 1, 2, 3 ou 4. Verifique seu .env');
}

return [

    // numero de colunas da tela principal
    'num_cols' => env('num_cols', 3),
    'col_width' => 12/env('num_cols', 3),
    'base_font_size' => env('base_font_size', 20),
];