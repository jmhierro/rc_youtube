<?php
/**
 * Youtube
 *
 * Replace youtube links with embed code
 *
 * @version 0.2
 * @author Juan Martin Hierro <jmhierro@gmail.com>
 */
class youtube extends rcube_plugin {
        public $task = 'mail';

		function init() {
                $this->task = 'mail';
                $this->add_hook('message_part_after',array($this, 'messagebodyyoutube'));
        }

        function messagebodyyoutube($args){

				$this->include_stylesheet('skins/default/youtube.css');
				$this->include_script('youtube.js');

                $video_container = "<div id=\"message-part-youtube\">||CONTENT||</div><div id=\"view-youtube\"></div>";

                $body = $args['body'];

                if (preg_match('/com\/watch\?/', $body)){

                        $search_string='/v=(\S{1,11})/im';

                        preg_match_all($search_string, $body, $output);

                        $t=array_values(array_unique($output[0]));

                        $my_out="";
       
                        for ($you_loop=0; $you_loop < count(array_unique($output[0])); $you_loop++){
                                $youtube = "<div style=\"margin: 8px 8px 12px 8px; float:left;left: 15px; padding:5px; width:120px; height:90px; background: url(https://img.youtube.com/vi/||URL||/1.jpg) no-repeat; \"><img src=\"https://ssl.gstatic.com/apps/gadgets/youtube/play.png\" onClick=\"showVideo('||URL||')\"/></div>";

                                $sal=substr($t[$you_loop], strpos($t[$you_loop], "v=")+2);
                                $my_out = $my_out . str_replace("||URL||", $sal, $youtube);
                        }
                        $my_out = str_replace("||CONTENT||", $my_out, $video_container);
                        return array('body'=> $args['body'].$my_out);
                } else {
                        return array('body'=> $args['body']);
                }
        }
}