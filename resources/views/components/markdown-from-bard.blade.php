@props(['bardContent' => null, 'replaces' => []])
@php
    $markdown = '';

    foreach ($bardContent as $node) {
        $type = Arr::get($node, 'type');
        $content = Arr::get($node, 'content', []);

        switch ($type) {
            case 'heading':
                $level = Arr::get($node, 'attrs.level', 1);
                $text = collect($content)->pluck('text')->implode('');
                $markdown .= str_repeat('#', $level) . ' ' . $text . "\n\n";
                break;

            case 'paragraph':
                $text = collect($content)->pluck('text')->implode('');
                $markdown .= $text . "\n\n";
                break;

            case 'bullet_list':
                foreach ($content as $item) {
                    $itemText = collect(Arr::get($item, 'content', []))->pluck('text')->implode('');
                    $markdown .= '- ' . $itemText . "\n";
                }
                $markdown .= "\n";
                break;

            case 'ordered_list':
                $i = 1;
                foreach ($content as $item) {
                    $itemText = collect(Arr::get($item, 'content', []))->pluck('text')->implode('');
                    $markdown .= $i++ . '. ' . $itemText . "\n";
                }
                $markdown .= "\n";
                break;

            // Optional: Weitere Typen wie 'blockquote', 'image' etc.
            case 'blockquote':
                $text = collect($content)->pluck('text')->implode('');
                $markdown .= '> ' . $text . "\n\n";
                break;

            default:
                break;
        }
    }

    $markdown = trim($markdown);

    foreach($replaces as $key => $value) {
        $markdown = str_replace($key, $value, $markdown);
    }
@endphp
{{ $markdown }}