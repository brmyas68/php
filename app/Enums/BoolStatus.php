<?php
    namespace App\Enums;

    enum BoolStatus:string {
        const yes = '1';
        const  no = '0';

        const ALL = [
            self::yes,
            self::no
        ];
    }
