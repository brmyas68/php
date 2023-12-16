<?php
    namespace App\Enums;

    enum ResumeStatus:string {
        const undefined = '0';
        const rejected = '1';
        const  confirmed = '2';

        const ALL = [
            self::undefined,
            self::rejected,
            self::confirmed
        ];
    }
