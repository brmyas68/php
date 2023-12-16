<?php
    namespace App\Enums;

    enum CommentType:string {
        const project = 'project';
        const  weblog = 'weblog';

        const ALL = [
            self::project,
            self::weblog
        ];
    }
