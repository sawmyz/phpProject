<?php

namespace FwHtml\Elements\Tags\Main;

use FwHtml\Elements\Tags\A;
use FwHtml\Elements\Tags\Body;
use FwHtml\Elements\Tags\Br;
use FwHtml\Elements\Tags\Button;
use FwHtml\Elements\Tags\Div;
use FwHtml\Elements\Tags\Form;
use FwHtml\Elements\Tags\H1;
use FwHtml\Elements\Tags\H2;
use FwHtml\Elements\Tags\H3;
use FwHtml\Elements\Tags\H4;
use FwHtml\Elements\Tags\H5;
use FwHtml\Elements\Tags\H6;
use FwHtml\Elements\Tags\Head;
use FwHtml\Elements\Tags\Header;
use FwHtml\Elements\Tags\Hr;
use FwHtml\Elements\Tags\Html;
use FwHtml\Elements\Tags\I;
use FwHtml\Elements\Tags\Iframe;
use FwHtml\Elements\Tags\Img;
use FwHtml\Elements\Tags\Input;
use FwHtml\Elements\Tags\Label;
use FwHtml\Elements\Tags\Li;
use FwHtml\Elements\Tags\Link;
use FwHtml\Elements\Tags\Ol;
use FwHtml\Elements\Tags\Option;
use FwHtml\Elements\Tags\P;
use FwHtml\Elements\Tags\PageTag;
use FwHtml\Elements\Tags\Parsa;
use FwHtml\Elements\Tags\Pre;
use FwHtml\Elements\Tags\Section;
use FwHtml\Elements\Tags\Select;
use FwHtml\Elements\Tags\Span;
use FwHtml\Elements\Tags\Table;
use FwHtml\Elements\Tags\Tbody;
use FwHtml\Elements\Tags\Td;
use FwHtml\Elements\Tags\TextArea;
use FwHtml\Elements\Tags\Tfoot;
use FwHtml\Elements\Tags\Th;
use FwHtml\Elements\Tags\Thead;
use FwHtml\Elements\Tags\Title;
use FwHtml\Elements\Tags\Tr;
use FwHtml\Elements\Tags\Ul;
use FwMigrationSystem\Resources\Helpers\Types;
if (!class_exists('FwHtml\Elements\Tags\Main\HtmlTags')) {
    final class HtmlTags {
        final public static function P(string $data = '') {
            return new P($data);
        }

        final public static function Table(string $data = '') {
            return new Table($data);
        }
        final public static function Button(string $data = '') {
            return new Button($data);
        }

        final public static function Title(string $data = '') {
            return new Title($data);
        }
        final public static function Ol(string $data = '') {
            return new Ol($data);
        }

        final public static function Html(string $data = '') {
            return new Html($data);
        }

        final public static function H2(string $data = '') {
            return new H2($data);
        }

        final public static function Thead(string $data = '') {
            return new Thead($data);
        }

        final public static function Ul(string $data = '') {
            return new Ul($data);
        }

        final public static function Select(string $data = '') {
            return new Select($data);
        }

        final public static function H4(string $data = '') {
            return new H4($data);
        }

        final public static function Tr(string $data = '') {
            return new Tr($data);
        }

        final public static function Span(string $data = '') {
            return new Span($data);
        }

        final public static function Td(string $data = '') {
            return new Td($data);
        }

        final public static function H6(string $data = '') {
            return new H6($data);
        }

        final public static function Tbody(string $data = '') {
            return new Tbody($data);
        }

        final public static function Br(string $data = '') {
            return new Br($data);
        }

        final public static function A(string $data = '') {
            return new A($data);
        }

        final public static function Div(string $data = '') {
            return new Div($data);
        }

        final public static function Header(string $data = '') {
            return new Header($data);
        }

        final public static function H1(string $data = '') {
            return new H1($data);
        }

        final public static function Hr(string $data = '') {
            return new Hr($data);
        }

        final public static function I(string $data = '') {
            return new I($data);
        }

        final public static function Label(string $data = '') {
            return new Label($data);
        }

        final public static function Iframe(string $data = '') {
            return new Iframe($data);
        }

        final public static function Input(string $data = '') {
            return new Input($data);
        }

        final public static function Tfoot(string $data = '') {
            return new Tfoot($data);
        }

        final public static function Img(string $data = '') {
            return new Img($data);
        }

        final public static function Option(string $data = '') {
            return new Option($data);
        }

        final public static function TextArea(string $data = '') {
            return new TextArea($data);
        }

        final public static function Li(string $data = '') {
            return new Li($data);
        }

        final public static function Pre(string $data = '') {
            return new Pre($data);
        }

        final public static function Body(string $data = '') {
            return new Body($data);
        }

        final public static function Form(string $data = '') {
            return new Form($data);
        }

        final public static function Th(string $data = '') {
            return new Th($data);
        }

        final public static function H3(string $data = '') {
            return new H3($data);
        }

        final public static function Head(string $data = '') {
            return new Head($data);
        }

        final public static function Link(string $data = '') {
            return new Link($data);
        }

        final public static function H5(string $data = '') {
            return new H5($data);
        }

        final public static function Section(string $data = '') {
            return new Section($data);
        }

		public static function Page(string $data = '') {
			return new PageTag($data);
		}
	}
}
