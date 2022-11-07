<?php
class changeFormat
{
    protected $durasi;
    public function __construct($durasi)
    {
        $this->durasi = $durasi;
    }
    
    function getTimeCodeFromNum() {
        $seconds = (int)$this->durasi;
        $minutes = (int)($seconds / 60);
        $seconds -= $minutes * 60;
        $hours = (int)($minutes / 60);
        $minutes -= $hours * 60;

        if ($seconds < 10){
            return $minutes . ":0" . $seconds; 
        }

        return $minutes . ":" . $seconds;
    }

    function getTimeCodeFromNumAlbum() {
        $seconds = (int)$this->durasi;
        $minutes = (int)($seconds / 60);
        $seconds -= $minutes * 60;
        $hours = (int)($minutes / 60);
        $minutes -= $hours * 60;

        return $minutes . " min " . $seconds . " sec";
    }
}
?>