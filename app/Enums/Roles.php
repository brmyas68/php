<?php
    namespace App\Enums;

    enum Roles:string {
        const admin = 'admin';

        const ALL = [
            self::admin,
        ];
    }
