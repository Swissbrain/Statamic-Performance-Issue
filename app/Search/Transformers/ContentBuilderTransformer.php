<?php

namespace App\Search\Transformers;

class ContentBuilderTransformer
{
    public function handle($value, $field, $searchable)
    {
        $model = $searchable->toModel();
        $searchableString = [];
        if (is_array($value)) {
            foreach($value as $item) {
                if (!$item['enabled']) continue;

                $value = match($item['type']) {
                    'page_title' => $model->data['title'],
                    'title_subtitle' => $this->getTitleContent($item),
                    'wysiwyg' => isset($item['wysiwyg']) ? \Statamic::modify($item['wysiwyg'])->strip_tags() : '',
                    'columns' => $this->getColumnContent($item),
                    'tabs' => $this->getTabContent($item),
                    'video' => '',
                    'divider' => '',
                    'button' => '',
                    'rental_request' => '',
                    'product_grid' => '',
                    'jura_machine_list' => '',
                    'instagram_feed' => '',
                    'image' => '',
                    'image_grid' => '',
                    'image_slider' => '',
                    default => '',
                };
                if ($value) {
                    $searchableString[] = $value;
                }
            }
        }

        return implode(' ', $searchableString);
    }

    private function getColumnContent($columns): string
    {
        $searchableString = [];

        foreach($columns['columns'] as $column) {
            if(isset($column['sub_content_builder']) && is_array($column['sub_content_builder'])) {
                foreach($column['sub_content_builder'] as $subColumn) {
                    if (!$subColumn['enabled']) continue;

                    if ($subColumn['type'] == 'title_subtitle') {
                         if ($text = \Arr::get($subColumn, 'title', '')) {
                            $searchableString[] = $text;
                        }

                        if ($text = \Arr::get($subColumn, 'subtitle', '')) {
                            $searchableString[] = $text;
                        }
                    }
                    if ($subColumn['type'] == 'wysiwyg') {
                        if ($text = \Statamic::modify($subColumn['wysiwyg'])->strip_tags()) {
                            $searchableString[] = $text;
                        }
                    }
                }
            }
        }

        return implode(' ', $searchableString);
    }

    private function getTabContent($tabs): string
    {
        $searchableString = [];

        foreach($tabs['tabs'] as $tab) {
            if(isset($tab['tab_content_builder']) && is_array($tab['tab_content_builder'])) {
                foreach($tab['tab_content_builder'] as $subTab) {
                    if (!$subTab['enabled']) continue;

                    if ($subTab['type'] == 'title_subtitle') {
                        if ($text = \Arr::get($subTab, 'title', '')) {
                            $searchableString[] = $text;
                        }

                        if ($text = \Arr::get($subTab, 'subtitle', '')) {
                            $searchableString[] = $text;
                        }
                    }
                    if ($subTab['type'] == 'wysiwyg') {
                        if ($text = \Statamic::modify($subTab['wysiwyg'])->strip_tags()) {
                            $searchableString[] = $text;
                        }
                    }
                }
            }
        }

        return implode(' ', $searchableString);
    }

    private function getTitleContent($value): string
    {
        $searchableString = '';

        if (isset($value['title'])) {
            $searchableString .= ' ' . $value['title'];
        }

        if (isset($value['subtitle'])) {
            $searchableString .= ' ' . $value['subtitle'];
        };

        return $searchableString;
    }
}