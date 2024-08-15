<?php

namespace App\PageBuilder\Helpers\Traits;

use App\Helpers\SanitizeInput;
use Mews\Purifier\Facades\Purifier;

trait FieldSanitizationHelper {
    /**
     * Sanitize url to remove script
     * @param String $key
     * @return string
     * */
    public function sanitizedText(string $key) : string
    {
        return SanitizeInput::esc_html($this->setting_item($key));
    }

    /**
     * Sanitize url to remove script
     * @param String $key
     * @return string
     * */
    public function sanitizedUrl(string $key) : string
    {
        return SanitizeInput::esc_html($this->setting_item($key));
    }

    /**
     * Strip HTML and PHP tags from a string. This will allow given html tag with attribute.
     * @param String $key
     * @param array $allowed_tokens
     * @return string
     */
    public function sanitizeWithTags(string $key, array $allowed_tokens) : string
    {
        return SanitizeInput::kses($this->setting_item($key), $allowed_tokens);
    }

    /**
     * This will allow given html tag with attribute
     * @param String $key
     * @return string
     * */
    public function sanitizedHtml(string $key): string
    {
        return Purifier::clean($key);
    }
}
