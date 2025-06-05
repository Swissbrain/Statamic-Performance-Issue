<?php

/*
 * Glide Function for returning image URLs resized and cropped
 * @param string $imagePath
 *
 * @param int $width
 *
 * @param int $height
 *
 * @param string $fit
 * about fit: https://glide.thephpleague.com/1.0/api/quick-reference/
 * crop options: 'crop', 'crop_focal', 'max', 'fill', 'stretch', 'contain'
 *
 * @return string
 * @example glide('image.jpg', 800, 500, 'crop_focal')
 */
if (! function_exists('glide')) {
    function glide($imagePath, $width = 800, $height = 500, $fit = 'crop_focal')
    {
        return collect(
            \Statamic\Statamic::tag('glide:generate')
                ->src(
                    Str::startsWith($imagePath, 'http')
                        ? $imagePath
                        : \Statamic\Facades\Asset::find('images::'.$imagePath)
                )
                ->width($width)
                ->height($height)
                ->fit($fit)
        )->first()['url'];
    }
}

if (! function_exists('alt')) {
    function alt($imagePath): string
    {
        return \Statamic\Facades\Asset::find('images::'.$imagePath)->data()->get('alt') ?? '';
    }
}

if (! function_exists('aspect')) {
    function aspect($imagePath, bool $height = false): string
    {
        $image = \Statamic\Facades\Asset::find('images::'.$imagePath);
        if ($height) {
            return $image->height() / $image->width();
        }
        return $image->width() / $image->height();
    }
}

if (! function_exists('statamicView')) {
    function statamicView($view, $data = [])
    {
        return resolve(\Statamic\View\View::class)->template($view)->with($data);
    }
}

if (! function_exists('imagePlaceholder')) {
    function imagePlaceholder(int $width = 200, int $height = 200, string $backgroundColor = 'DDDDDD', string $textColor = '999999', string $format = 'png') {
        if ($width < 10) {
            throw new \ErrorException('Width can not be under 10px');
        }

        if ($height < 10) {
            throw new \ErrorException('Height can not be under 10px');
        }

        if (!ctype_xdigit($backgroundColor)) {
            throw new \ErrorException('Background color is not a valid hex code');
        }

        if (!ctype_xdigit($textColor)) {
            throw new \ErrorException('Text color is not a valid hex code');
        }

        if (!in_array(strtolower($format), ['svg', 'jpg', 'gif', 'png', 'webp'])) {
            throw new \ErrorException('Format is not valid. Supported formats: svg, jpg, gif, webp');
        }

        return 'https://placehold.co/'
            . $width . 'x' . $height
            . '/' . $backgroundColor
            . '/' . $textColor
            . '/' . $format;
    }
}

if (!function_exists('getAspectRatio')) {
    function getAspectRatio($ratio, $width = 1, $height = 1): float {
        return match($ratio) {
            'one_to_one' => 1,
            'two_to_one' => 1/2,
            'three_to_one' => 1/3,
            'four_to_one' => 1/4,
            'custom' => $width / $height,
            default => 1
        };
    }
}

if(!function_exists('currency_format')) {
    function currency_format($value, bool $shortcut = true, $withCurrency = true) {
        $value = round($value, 2);

        if ($shortcut && $value - (int) $value == 0) {
            $value = number_format($value, 0, '.', "'") . '.-';
        } else {
            $value = number_format($value, 2, '.', "'");
        }

        return $value . ($withCurrency ? ' CHF' : '');
    }
}

if (! function_exists('hexColorWithAlpha')) {
    function hexColorWithAlpha(string $hexColor, float $alpha, bool $percentAsAlpha = true): string
    {
        if (\Str::start($hexColor, '#')) {
            $hexColor = str_replace('#', '', $hexColor);
        }

        if (\Str::length($hexColor) != 3 && \Str::length($hexColor) != 6) {
            throw new \ErrorException('Hex color is invalid. Should have 3 or 6 hexadecimal code lengths');
        }

        if (\Str::length($hexColor) == 3) {
            $hexColor = $hexColor[0] . $hexColor[0] . $hexColor[1] . $hexColor[1] . $hexColor[2] . $hexColor[2];
        }

        if ($percentAsAlpha) {
            if ($alpha < 0) {
                $alpha = 0;
            }

            if ($alpha > 100) {
                $alpha = 100;
            }

            $opacity = dechex(round($alpha * 255 / 100));
        } else {
            $alpha = floor($alpha);

            if ($alpha < 0) {
                $alpha = 0;
            }

            if ($alpha > 255) {
                $alpha = 255;
            }

            $opacity = dechex($alpha);
        }

        return '#' . $hexColor . \Str::padleft($opacity, 2, 0);
    }
}