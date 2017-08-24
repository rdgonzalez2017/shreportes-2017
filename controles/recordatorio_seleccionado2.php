<?php

//Selección por Checkbox
    if (isset($_POST['enviar'])) {
        if ($_POST['reportes_seleccionados']) {
            //$selected = '';
            //$num_countries = count($_POST['reportes_seleccionados']);
            //$current = 0;
            foreach ($_POST['reportes_seleccionados'] as $key => $value) {
                /*if ($current != $num_countries - 1)
                    $selected .= $value . ', ';
                else
                    $selected .= $value . '.';
                $current++;*/
                echo $value.'<br>';
            }
        }
        
        //echo $selected . '<br>';
    }//Fin de Selección por Checkbox   