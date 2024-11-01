<?php 
/*
 * Plugin Name: Top100 Music Player 
 * Version: 1.0
 * Plugin URI: http://biglazy.net/top100_music_player_for_wordpress
 * Description: 播放巨鲸音乐网的订制音乐列表
 * Author: Biglazy
 * Author URI: http://biglazy.net/
 * Date: 2010-12-24
 */
    class Top100MusicPlayer extends WP_Widget
    {
         /*
         ** 构造函数
         ** 声明一个数组$widget_ops，用来保存类名和描述，以便在控制面板正确显示工具信息
         ** $control_ops 是可选参数，用来定义小工具在控制面板显示的宽度和高度，此参数可忽略
         ** 最后一步是调用WP_Widget来初始化我们的小工具
         */
         function Top100MusicPlayer(){
             $widget_ops = array('classname'=>'top100_music_player','description'=>'播放巨鲸音乐网的订制音乐列表');
             $this->WP_Widget(false,'Music',$widget_ops);
         }
         function form($instance){
             $instance = wp_parse_args((array)$instance,array('title'=>'Music','musicode'=>'在这里输入代码'));
             $title = htmlspecialchars($instance['title']);
             $musicode = htmlspecialchars($instance['musicode']);
             echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:200px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
             echo '<p style="text-align:left;"><label for="'.$this->get_field_name('musicode').'">[下面输入'.'<a href="http://widget.top100.cn/" target="_blank">巨鲸音乐网</a>'.'widget嵌入代码]<textarea cols="24" rows="6" id="'.$this->get_field_id('musicode').'" name="'.$this->get_field_name('musicode').'" >'.$musicode.'</textarea></label></p>';
             echo '<p style="text-align:left;">最下方网站链接栏,如不想保留,可修改上面代码末,使height值减小60即可.<div style="text-align:center;"><strong>支持正版音乐！</strong></div></p>';
         }
         function update($new_instance,$old_instance){
            $instance = $old_instance;
            $instance['title'] = strip_tags(stripslashes($new_instance['title']));
            //如上一行代码中，strip_tags会过滤掉所有输入文本中的html标记，为了安全应该加上，这里因为
            //要嵌入html代码，所以没有过滤，使用前请务必确保嵌入的html代码是“安全”的
            $instance['musicode'] = stripslashes($new_instance['musicode']);
            return $instance;
         }
         function widget($args,$instance){
             extract($args);
             $title = apply_filters('widget_title',$instance['title']);
             echo $before_widget;
             echo $before_title . $title . $after_title;
             //show the top100 music player
             echo $instance['musicode'];
             echo $after_widget;
         }
    } // Top100MusicPlayer 类定义结束
    /*
    ** 注册小工具
    */
    function Top100MusicPlayer(){
     register_widget('Top100MusicPlayer');
    }
    add_action('widgets_init','Top100MusicPlayer');
?>