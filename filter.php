<?php

defined('MOODLE_INTERNAL') || die();

/**
 * The filter_gitquotes class.
 * 
 * This class extends the moodle_text_filter class and is used to filter the text and replace the custom quotes with the git-style quotes.
 */
class filter_gitquotes extends moodle_text_filter
{
    public const PATTERN_HTML = '/<blockquote>\s*?<p>\s*\[\!(NOTE|WARNING|TIP|IMPORTANT)\](.*?)<\/p>\s*<\/blockquote>/is';
    
    /**
     * Filter function. 
     * 
     * Filters the text and replaces the custom quotes with the git-style quotes.  
     *
     * @param string $text The text to be filtered.
     * @param array $options The options for the filter.
     */   
    public function filter($text, array $options = array())
    {
        if (empty($text)) {
            return $text;
        }

        // Get the format of the text.
        $format = "";
        if (isset($options['context']) && method_exists($options['context'], 'get_format')) {
            $format = $options['context']->get_format();
        } else {
            $format = FORMAT_MARKDOWN;
        }

        // If the format is not markdown, return the text as it is.
        if (!in_array($format, array(FORMAT_MARKDOWN))) {
            return $text;
        }

        // Replace the custom quotes with the git-style quotes.
        $replacement_html = '<blockquote class="gitquote $1"><div class="gitquote_name"><strong class="quote-type $1">$1</strong></div><span class="quote-content">$2</span></blockquote>';
        
        $text = preg_replace(self::PATTERN_HTML, $replacement_html, $text);

        return $text;
    }
}
