<?php
    namespace App\Enums;

    enum Sex:string {
        const female = '1';
        const  male = '0';

        const ALL = [
            self::female,
            self::male
        ];
    }
