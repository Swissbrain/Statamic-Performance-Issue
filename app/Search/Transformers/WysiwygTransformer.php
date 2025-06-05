<?php

namespace App\Search\Transformers;

class WysiwygTransformer
{
    public function handle($value, $field, $searchable)
    {
        if (isset($value['wysiwyg'])) {
            return (string) \Statamic::modify($value['wysiwyg'])->strip_tags();
        }

        if (isset($value[0])) {
            return (string) \Statamic::modify($value[0])->bard_html()->strip_tags();
        }

        return '';
    }
}