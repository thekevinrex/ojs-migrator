<?php


namespace App\Livewire;

use Livewire\Component;

abstract class Migrator extends Component
{

    public $total = null;

    public function cleanStrings($string)
    {
        // Detectar encoding
        $encoding = mb_detect_encoding($string);

        // Convertir a UTF-8
        $string = mb_convert_encoding($string, 'UTF-8', $encoding);

        // Remover caracteres no válidos
        $string = iconv('UTF-8', 'UTF-8//IGNORE', $string);

        // Remover acentos
        $string = $this->removeAccents($string);

        // Reemplazar caracteres especiales
        $string = str_replace(
            array('Ã¡', 'Ã©', 'Ã­', 'Ã³', 'Ãº', 'Ã‚Â¡', 'Ã¢â‚¬â„¢', 'Ã±', 'Â­', 'Â½', 'Ã¼'),
            array('á', 'é', 'í', 'ó', 'ú', 'á', 'é', 'ñ', '', '½', 'ü'),
            $string
        );

        return $string;
    }

    private function removeAccents($string)
    {
        return preg_replace('/[\x{0100}-\x{017F}]/u', '', $string);
    }
}
