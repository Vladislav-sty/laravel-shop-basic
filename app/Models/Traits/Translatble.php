<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\App;

trait Translatble
{
    protected $defaultLocale = 'ua';

    public function __($originFieldName){
        $locale = App::getLocale() ?? $this->defaultLocale;

        if ($locale === 'en'){
            $fieldName = $originFieldName . '_en';
        } else {
            $fieldName = $originFieldName;
        }

        if ($locale === 'en' && (is_null($this->$fieldName) || empty($this->$fieldName))){
            return $this->$originFieldName;
        }

        return $this->$fieldName;
    }
}
