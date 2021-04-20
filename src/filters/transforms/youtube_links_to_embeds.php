<?php

namespace andyp\cpt\amp\filters\transforms;
/**
 * Filters content for Markdown and converts it to HTML.
 */
class youtube_links_to_embeds {

    public function __construct()
    {
        add_filter('cpt_amp_transforms', [$this, 'callback'], 50, 1 );
    }

    public function callback($text)
    {
        preg_match_all('/<a .* href="https:\/\/www\.youtube\.com\/watch\?v=(.*)">YouTube<\/a>/i',$text, $matches);

        foreach ($matches[1] as $key => $match)
        {
            $embed  = '<lite-youtube class="w-full h-96 block relative bg-repeat-none bg-cover bg-center my-12 fill-youtube cursor-pointer flex" videoid="'.$match.'">';
            $embed .= '<svg class="h-24 w-24 m-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10,15L15.19,12L10,9V15M21.56,7.17C21.69,7.64 21.78,8.27 21.84,9.07C21.91,9.87 21.94,10.56 21.94,11.16L22,12C22,14.19 21.84,15.8 21.56,16.83C21.31,17.73 20.73,18.31 19.83,18.56C19.36,18.69 18.5,18.78 17.18,18.84C15.88,18.91 14.69,18.94 13.59,18.94L12,19C7.81,19 5.2,18.84 4.17,18.56C3.27,18.31 2.69,17.73 2.44,16.83C2.31,16.36 2.22,15.73 2.16,14.93C2.09,14.13 2.06,13.44 2.06,12.84L2,12C2,9.81 2.16,8.2 2.44,7.17C2.69,6.27 3.27,5.69 4.17,5.44C4.64,5.31 5.5,5.22 6.82,5.16C8.12,5.09 9.31,5.06 10.41,5.06L12,5C16.19,5 18.8,5.16 19.83,5.44C20.73,5.69 21.31,6.27 21.56,7.17Z"></path></svg>';
            $embed .= '</lite-youtube>';
            $text = str_replace($matches[0][$key], $embed, $text);
        }

        return $text;
    }

}