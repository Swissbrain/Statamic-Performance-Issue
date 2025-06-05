<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DivOrLink extends Component
{
    public function __construct(
        public bool $asLink = false,
        public bool $asDiv = false,
        public ?string $as = null
    ) {}

    public function render(): View
    {
        $isDiv = $this->as == 'div' || $this->asDiv == true;
        $isLink = $this->as == 'link' ||$this->as == 'a' || $this->asLink == true;

        if ($isDiv && $isLink) {
            throw new \ErrorException('You can not render div and link at the same time.');
        }

        return view('components.div-or-link', [
            'renderAs' => $isLink ? 'link': 'div',
        ]);
    }
}
