<?php
class Convert
{
    public function convertStatus ($status): string
    {
        $strStatus = '';
        if ($status ==1){
            $strStatus = "Đang sử dụng";

        }elseif ($status ==2){
            $strStatus = "Đang thi công";

        }elseif ($status ==3){
            $strStatus = "Đang tu sửa";

        }
        return $strStatus;
    }
}