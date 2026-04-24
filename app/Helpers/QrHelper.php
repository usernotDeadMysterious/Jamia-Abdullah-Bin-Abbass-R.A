<?php

namespace App\Helpers;

use BaconQrCode\Writer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;

class QrHelper
{
    public static function generate($text)
    {
        // 🔥 FIX: correct renderer
        $renderer = new ImageRenderer(
            new RendererStyle(100),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);

        return base64_encode($writer->writeString($text));
    }
}