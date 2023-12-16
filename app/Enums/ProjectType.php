<?php
    namespace App\Enums;

    enum ProjectType:string {
        const doing = 'doing';
        const  done = 'done';

        const ALL = [
            self::doing,
            self::done
        ];
    }
