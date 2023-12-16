<?php
    namespace App\Enums;

    enum DaysHoursStatus:string {
        const open = '1';
        const  close = '0';

        const ALL = [
            self::open,
            self::close
        ];
    }
