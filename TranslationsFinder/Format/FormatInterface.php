<?php

namespace TranslationsFinder\Format;

interface FormatInterface {
    /**
     * @param string $file_contents the file in string
     *
     * @return array the messages (just the keys)
     */
    public function parseMessagesFile($file_contents);

    /**
     * @param string $tag the tag as it's found in the template
     *
     * @return string The tag parsed for saving in the messages_file
     */
    public function parseTag($tag);

    /**
     * @param string $tag        The tag for saving
     * @param array  $file_names The appearances in files of the tag
     * @param bool   $is_source_file
     *
     * @return string The output
     */
    public function outputTag($tag, $file_names = [], $is_source_file = false);

    /**
     * Prepares the string of a tag to be stored in the local format. Also for being compared to the current file.
     *
     * @param string $string the Tag string
     *
     * @return string The string outputted
     */
    public function outputString($string);
}
