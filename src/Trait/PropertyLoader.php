<?php

namespace App\Trait;

trait PropertyLoader
{
    public function setProperty(array $data): void
    {
        foreach ($data as $key => $datum) {
            if (!property_exists($this, $key)) {
                continue;
            }
            $this->$key = $datum;
        }
    }
}
