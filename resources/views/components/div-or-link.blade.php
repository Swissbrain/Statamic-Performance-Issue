@if($renderAs == 'div')
    <div {{ $attributes->except(['target', 'href']) }}>{{ $slot }}</div>
@endif

@if($renderAs == 'link')
    <a {{ $attributes->class('block') }}>{{ $slot }}</a>
@endif