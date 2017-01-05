<?php

class Util extends \Twig_Extension
{
    public static function slug($cadena, $separador = '-')
    {
        // Código copiado de http://cubiq.org/the-perfect-php-clean-url-generator
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower(trim($slug, $separador));
        $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);

        return $slug;
    }

    public function getFilters()
    {
        return array(
            "slug" => new \Twig_Filter_Method($this, "slug"),
        );
    }

    public function getName()
    {
        return 'util';
    }
}
