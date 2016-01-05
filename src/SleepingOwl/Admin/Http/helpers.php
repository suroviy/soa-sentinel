<?php

if (!function_exists('soa_icon'))
{
    /**
     * Helper function for icon font generation
     * @param string $icon
     * @param bool $tag
     * @return string
     */
    function soa_icon($icon, $tag = true)
    {
        $icon_html =  sprintf('%s %s', config('admin.icon_prefix'), $icon);

        if ( !$tag ) {
            return $icon_html;
        }

        return sprintf(config('admin.icon_tag'), $icon_html);
    }
}
