<?php

    if(!function_exists('p')){
        function p($data){
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            die;
        }
    }

    if(!function_exists('dd')){
        function dd($data){
            dd($data);
            die;

        }
    }