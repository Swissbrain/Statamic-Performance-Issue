<?php

namespace App\View;

use Illuminate\Support\Arr;
use Stringable;

class CssClassBuilder implements Stringable
{
    protected array $list = [];

    public function add(string|array $classes): self
    {
        $this->list[] = Arr::toCssClasses($classes);

        return $this;
    }

    public function addIf($condition, string $classes): self
    {
        if($condition) {
            $this->list[] = $classes;
        }

        return $this;
    }

    public function __toString()
    {
        return (string) collect($this->list)->join(' ');
    }

    public static function make()
    {
        return new self;
    }
}
