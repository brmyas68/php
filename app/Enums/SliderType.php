<?php
    namespace App\Enums;

    enum SliderType:string {
        const image = 'image';
        const  video = 'video';

        const ALL = [
            self::image,
            self::video
        ];
    }
