<?php
namespace Marton\Textfilter;

//use Michelf\Markdown;

/**
 * Class for textfiltering and formatting.
 */
class Textfilter
{

    /**
     * Take a text and modify it with the given filters.
     *
     * @param string $text The string to format.
     *
     * @param string $filters The filters to apply, commaseparated.
     *
     * @return string The formatted string.
     */
    public function textApplyFilters($text, $filters)
    {
        // Filters and respective function
        $validFilters = [
            'nl2br' => 'nl2br',
            'bbcode' => 'bbcode2html',
            'link' => 'url2link',
            'markdown' => 'markdown2html'
        ];
        $filterArray = explode(',', $filters);
        //echo $filters;
        //print_r($filterArray);

        //if (!$filterArray) {
        //    $filterArray = 'nl2br';
        //}

        foreach ($filterArray as $key) {
            //echo $key;
            //echo $validFilters[$key];
            $text = call_user_func_array([$this, $validFilters[$key]], array($text));
        }
        if (!$text) {
            return 'No such filter!';
        } else {
            return $text;
        }
    }

    /**
     * Take a string and replace the newlines with <br>.
     *
     * @param string $string The string to format
     *
     * @return The formatted string.
     */
    public function nl2br($string)
    {
        $search = '(\r\n|\r|\n)';
        $replace = '<br>';
        return preg_replace($search, $replace, $string);
    }

    /**
     * Take a string and replace the bbcode with html.
     *
     * @param string $string The string to format
     *
     * @return string The formatted string.
     */
    public function bbcode2html($string)
    {
        $search = array(
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        );
        $replace = array(
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        );
        return preg_replace($search, $replace, $string);
    }

    /**
     * Take a string with url's and replace the url's with clickable links.
     *
     * @param string $string The string to format
     *
     * @return string The formatted string.
     */
    public function url2link($string)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            create_function(
                '$matches',
                'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
            ),
            $string
        );
    }

    /**
     * Take a string written in markdown, and replace it with html.
     *
     * @param string $string The string to format
     *
     * @return string The formatted string.
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function markdown2html($string)
    {
        //return $app->markdown->defaultTransform($string);
        return \Michelf\Markdown::defaultTransform($string);
        //return defaultTransform($string);
        //return $string = \Michelf\Markdown::defaultTransform($string);
        //return \Michelf\SmartyPants::defaultTransform($string);
    }
}
