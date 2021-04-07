<?

namespace FwHtml;

use ReflectionMethod;

if (!class_exists('FwHtml\FontAwesome')) {
    class FontAwesome
    {
        public $icon;

        public function __construct(string $icon)
        {
            $this->icon = $icon;
        }

        public function __toString()
        {
            return "fa fa-{$this->icon}";
        }

        public static function Glass()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Music()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Search()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Envelope_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Heart()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Star()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Star_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function User()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Film()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Th_large()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Th()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Th_list()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Check()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Times()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Search_plus()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Search_minus()
    {
        return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
    }

        public static function Power_off()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Signal()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cog()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Trash_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Home()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Clock_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Road()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Download()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_circle_o_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_circle_o_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Inbox()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Play_circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Repeat()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Refresh()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function List_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Lock()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Flag()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Headphones()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Volume_off()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Volume_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Volume_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Qrcode()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Barcode()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tag()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tags()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Book()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bookmark()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Print()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Camera()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Font()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bold()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Italic()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Text_height()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Text_width()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Align_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Align_center()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Align_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Align_justify()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function List()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Outdent()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Indent()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Video_camera()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Picture_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pencil()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Map_marker()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Adjust()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tint()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pencil_square_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Share_square_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Check_square_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrows()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Step_backward()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Fast_backward()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Backward()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Play()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pause()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Stop()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Forward()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Fast_forward()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Step_forward()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Eject()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chevron_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chevron_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Plus_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Minus_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Times_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Check_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Question_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Info_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Crosshairs()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Times_circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Check_circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ban()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Share()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Expand()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Compress()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Plus()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Minus()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Asterisk()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Exclamation_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Gift()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Leaf()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Fire()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Eye()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Eye_slash()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Exclamation_triangle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Plane()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Calendar()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Random()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Comment()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Magnet()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chevron_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chevron_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Retweet()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Shopping_cart()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Folder()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Folder_open()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrows_v()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrows_h()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bar_chart()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Twitter_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Facebook_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Camera_retro()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Key()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cogs()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Comments()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thumbs_o_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thumbs_o_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Star_half()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Heart_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sign_out()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Linkedin_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thumb_tack()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function External_link()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sign_in()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Trophy()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Github_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Upload()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Lemon_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Phone()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Square_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bookmark_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Phone_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Twitter()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Facebook()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Github()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Unlock()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Credit_card()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Rss()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hdd_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bullhorn()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bell()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Certificate()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_o_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_o_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_o_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_o_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_circle_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_circle_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_circle_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_circle_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Globe()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wrench()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tasks()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Filter()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Briefcase()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrows_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Users()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Link()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cloud()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Flask()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Scissors()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Files_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Paperclip()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Floppy_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bars()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function List_ul()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function List_ol()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Strikethrough()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Underline()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Table()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Magic()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Truck()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pinterest()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pinterest_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Google_plus_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Google_plus()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Money()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Caret_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Caret_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Caret_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Caret_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Columns()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort_desc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort_asc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Envelope()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Linkedin()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Undo()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Gavel()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tachometer()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Comment_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Comments_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bolt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sitemap()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Umbrella()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Clipboard()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Lightbulb_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Exchange()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cloud_download()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cloud_upload()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function User_md()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Stethoscope()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Suitcase()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bell_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Coffee()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cutlery()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_text_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Building_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hospital_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ambulance()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Medkit()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Fighter_jet()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Beer()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function H_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Plus_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angle_double_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angle_double_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angle_double_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angle_double_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angle_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angle_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angle_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angle_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Desktop()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Laptop()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tablet()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mobile()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Quote_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Quote_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Spinner()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Reply()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Github_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Folder_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Folder_open_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Smile_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Frown_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Meh_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Gamepad()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Keyboard_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Flag_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Flag_checkered()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Terminal()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Code()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Reply_all()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Star_half_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Location_arrow()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Crop()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Code_fork()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chain_broken()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Question()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Info()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Exclamation()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Superscript()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Subscript()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Eraser()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Puzzle_piece()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Microphone()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Microphone_slash()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Shield()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Calendar_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Fire_extinguisher()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Rocket()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Maxcdn()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chevron_circle_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chevron_circle_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chevron_circle_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chevron_circle_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Html5()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Css3()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Anchor()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Unlock_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bullseye()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ellipsis_h()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ellipsis_v()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Rss_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Play_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ticket()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Minus_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Minus_square_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Level_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Level_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Check_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pencil_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function External_link_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Share_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Compass()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Caret_square_o_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Caret_square_o_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Caret_square_o_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Eur()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Gbp()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Usd()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Inr()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Jpy()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Rub()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Krw()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Btc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_text()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort_alpha_asc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort_alpha_desc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort_amount_asc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort_amount_desc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort_numeric_asc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sort_numeric_desc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thumbs_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thumbs_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Youtube_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Youtube()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Xing()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Xing_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Youtube_play()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Dropbox()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Stack_overflow()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Instagram()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Flickr()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Adn()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bitbucket()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bitbucket_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tumblr()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tumblr_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Long_arrow_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Long_arrow_up()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Long_arrow_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Long_arrow_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Apple()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Windows()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Android()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Linux()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Dribbble()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Skype()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Foursquare()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Trello()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Female()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Male()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Gratipay()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sun_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Moon_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Archive()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bug()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Vk()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Weibo()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Renren()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pagelines()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Stack_exchange()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_circle_o_right()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Arrow_circle_o_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Caret_square_o_left()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Dot_circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wheelchair()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Vimeo_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Try()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Plus_square_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Space_shuttle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Slack()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Envelope_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wordpress()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Openid()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function University()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Graduation_cap()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Yahoo()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Google()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Reddit()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Reddit_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Stumbleupon_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Stumbleupon()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Delicious()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Digg()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pied_piper_pp()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pied_piper_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Drupal()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Joomla()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Language()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Fax()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Building()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Child()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Paw()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Spoon()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cube()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cubes()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Behance()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Behance_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Steam()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Steam_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Recycle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Car()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Taxi()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tree()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Spotify()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Deviantart()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Soundcloud()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Database()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_pdf_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_word_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_excel_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_powerpoint_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_image_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_archive_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_audio_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_video_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function File_code_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Vine()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Codepen()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Jsfiddle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Life_ring()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Circle_o_notch()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Rebel()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Empire()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Git_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Git()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hacker_news()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tencent_weibo()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Qq()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Weixin()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Paper_plane()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Paper_plane_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function History()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Circle_thin()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Header()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Paragraph()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sliders()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Share_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Share_alt_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bomb()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Futbol_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tty()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Binoculars()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Plug()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Slideshare()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Twitch()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Yelp()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Newspaper_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wifi()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Calculator()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Paypal()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Google_wallet()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc_visa()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc_mastercard()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc_discover()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc_amex()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc_paypal()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc_stripe()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bell_slash()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bell_slash_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Trash()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Copyright()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function At()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Eyedropper()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Paint_brush()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Birthday_cake()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Area_chart()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pie_chart()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Line_chart()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Lastfm()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Lastfm_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Toggle_off()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Toggle_on()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bicycle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bus()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ioxhost()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Angellist()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ils()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Meanpath()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Buysellads()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Connectdevelop()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Dashcube()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Forumbee()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Leanpub()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sellsy()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Shirtsinbulk()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Simplybuilt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Skyatlas()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cart_plus()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cart_arrow_down()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Diamond()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ship()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function User_secret()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Motorcycle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Street_view()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Heartbeat()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Venus()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mars()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mercury()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Transgender()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Transgender_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Venus_double()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mars_double()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Venus_mars()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mars_stroke()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mars_stroke_v()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mars_stroke_h()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Neuter()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Genderless()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Facebook_official()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pinterest_p()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Whatsapp()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Server()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function User_plus()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function User_times()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bed()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Viacoin()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Train()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Subway()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Medium()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Y_combinator()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Optin_monster()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Opencart()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Expeditedssl()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Battery_full()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Battery_three_quarters()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Battery_half()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Battery_quarter()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Battery_empty()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mouse_pointer()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function I_cursor()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Object_group()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Object_ungroup()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sticky_note()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sticky_note_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc_jcb()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Cc_diners_club()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Clone()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Balance_scale()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hourglass_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hourglass_start()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hourglass_half()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hourglass_end()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hourglass()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_rock_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_paper_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_scissors_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_lizard_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_spock_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_pointer_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hand_peace_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Trademark()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Registered()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Creative_commons()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Gg()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Gg_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Tripadvisor()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Odnoklassniki()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Odnoklassniki_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Get_pocket()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wikipedia_w()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Safari()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Chrome()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Firefox()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Opera()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Internet_explorer()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Television()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Contao()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function px_500()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Amazon()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Calendar_plus_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Calendar_minus_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Calendar_times_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Calendar_check_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Industry()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Map_pin()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Map_signs()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Map_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Map()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Commenting()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Commenting_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Houzz()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Vimeo()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Black_tie()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Fonticons()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Reddit_alien()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Edge()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Credit_card_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Codiepie()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Modx()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Fort_awesome()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Usb()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Product_hunt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Mixcloud()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Scribd()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pause_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pause_circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Stop_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Stop_circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Shopping_bag()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Shopping_basket()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Hashtag()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bluetooth()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bluetooth_b()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Percent()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Gitlab()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wpbeginner()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wpforms()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Envira()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Universal_access()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wheelchair_alt()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Question_circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Blind()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Audio_description()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Volume_control_phone()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Braille()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Assistive_listening_systems()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function American_sign_language_interpreting()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Deaf()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Glide()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Glide_g()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Sign_language()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Low_vision()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Viadeo()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Viadeo_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Snapchat()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Snapchat_ghost()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Snapchat_square()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Pied_piper()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function First_order()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Yoast()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Themeisle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Google_plus_official()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Font_awesome()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Handshake_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Envelope_open()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Envelope_open_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Linode()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Address_book()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Address_book_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Address_card()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Address_card_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function User_circle()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function User_circle_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function User_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Id_badge()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Id_card()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Id_card_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Quora()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Free_code_camp()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Telegram()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thermometer_full()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thermometer_three_quarters()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thermometer_half()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thermometer_quarter()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Thermometer_empty()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Shower()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bath()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Podcast()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Window_maximize()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Window_minimize()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Window_restore()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Window_close()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Window_close_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Bandcamp()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Grav()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Etsy()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Imdb()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Ravelry()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Eercast()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Microchip()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Snowflake_o()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Superpowers()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Wpexplorer()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }

        public static function Meetup()
        {
            return new self(str_replace('_', '-', strtolower(((new ReflectionMethod(__METHOD__))->getShortName()))));
        }
        public static function __callStatic($name, $arguments)
        {
            return new self(str_replace('_', '-', strtolower($name)));
        }
    }
}