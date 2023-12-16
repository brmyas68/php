<?php

    if (!function_exists("convertDateToFarsi")) {
        /*********************************
         *
         * @return
         ********************************/
        function convertDateToFarsi($date)
        {
            return \Morilog\Jalali\Jalalian::forge($date)->format("Y-m-d H:i:s");
        }
    }

    if (!function_exists("DateToFarsi")) {
        /*********************************
         *
         * @return
         ********************************/
        function DateToFarsi($date)
        {
            return \Morilog\Jalali\Jalalian::forge($date)->format("Y-m-d");
        }
    }

    if (!function_exists("randomCode")) {
        /*********************************
         *
         * @return
         ********************************/
        function randomCode($size)
        {
            $alph = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $code = "";

            for($i=0; $i< $size ;$i++){
                $code .= $alph[rand(0, 61)];
            }
            return $code;
        }
    }

    if (!function_exists("UploadFunc")) {
        /*********************************
         *
         * @return
         ********************************/
        function UploadFunc($file,$folderName)
        {
            $basename=explode(".",$file->getClientOriginalName())[0];
            $newName=$basename."_".(time().randomCode(3)).".".$file->getClientOriginalExtension();
            $path=$file->storeAs("upload/".$folderName,$newName,"public");
            return $path;
        }
    }

    if (!function_exists("emailTo")) {
        /*********************************
         *
         * @return
         ********************************/
        function emailTo($toEmail,$contact,$page)
        {
            $newpage=$page == "MessageMail" ? new \App\Mail\MessageMail($contact) : new \App\Mail\CommentMail($contact);
            \Illuminate\Support\Facades\Mail::to($toEmail)->send($newpage);
            return true;
        }
    }

    if (!function_exists("convertObjToArr")) {
        /*********************************
         *
         * @return
         ********************************/
        function convertObjToArr($object,$filed)
        {
            $array=[];
            foreach ($object as $key => $obj){
                $array[]=$obj->$filed;
            }
            return $array;
        }
    }

    if (!function_exists("getFileSizeKB")) {
        /*********************************
         *
         * @return
         ********************************/
        function getFileSizeKB($sizeByte)
        {
            return round($sizeByte/1024,2);
        }
    }

    if (!function_exists("convertShamsiToMiladi")) {
        /*********************************
         *
         * @return
         ********************************/
        function convertShamsiToMiladi(string $date) {
            return \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y-m-d', $date)->format('Y-m-d');
        }
    }
