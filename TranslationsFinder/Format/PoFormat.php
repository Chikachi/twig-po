<?php

namespace TranslationsFinder\Format;

class PoFormat implements FormatInterface {
    const MSGID_REGEX = '/msgid "(.*)"/mu';

    /**
     * @param string $file_contents the file in string
     *
     * @return array the messages (only the keys)
     */
    public function parseMessagesFile($file_contents) {
        preg_match_all(self::MSGID_REGEX, $file_contents, $matches);
        return (isset($matches[1])) ? $matches[1] : [];
    }

    /**
     * @param string $tag the tag as it's found in the template
     *
     * @return string The tag parsed for saving in the messages_file
     */
    public function parseTag($tag) {
        return $tag;
    }

    /**
     * @param string $tag            The tag for saving
     * @param array  $file_names     The appearances in files of the tag
     * @param bool   $is_source_file Should the tag be copied to value
     *
     * @return string The output
     */
    public function outputTag($tag, $file_names = [], $is_source_file = false) {
        $tag = $this->outputString($tag);
        $str = $is_source_file ? $tag : '';
        $output = '';
        foreach ($file_names as $filename) {
            $output .= '
#: '.$filename;
        }

        $output .= '
msgid "'.$tag.'"
msgstr "'.$str.'"

';
        return $output;
    }

    /**
     * Prepares the string of a tag to be stored in the local format. Also for being compared to the current file.
     *
     * @param string $string the Tag string
     *
     * @return string The string outputted
     */
    public function outputString($string) {
        $string = str_replace('\\\'', '\'', $string);
        $string = preg_replace(['/{{ (.*) }}/muU', '/{{(.*)}}/muU'], '%\1%', $string);
        $string = str_replace('"', '\"', $string);
        return $string;
    }
}
