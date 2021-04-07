<?php

namespace FwBase\Reports;

use DOMWrap\Document;
use FwHtml\Elements\Attrs\Style;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwHtml\FontAwesome;
use View;

abstract class ReportView extends View {
    public function start(Document &$document){
        $document->html  = HtmlTags::Div()->Content(
                    HtmlTags::Form('#report_form')->Content(
            HtmlTags::Div('.card.card-info.card-outline.m-2')->Content(
                HtmlTags::Div('.card-header')->Content(
                    HtmlTags::H4()->Content(
                        "تهیه گزارش {$this->PluralName()}"
                    ),
                    HtmlTags::Div('.card-tools')->Content(
                        HtmlTags::Button('.btn.btn-outline-secondary.m-2.disabled')
                            ->Content(
                                HtmlTags::I('.m-1')->Class(FontAwesome::Print()),
                                "پرینت"
                            )->Attrs(['type' => 'button'])->Id("print_report"),
                        HtmlTags::Button('.btn.btn-danger.m-2')
                            ->Content(
                                HtmlTags::I('.m-1')->Class(FontAwesome::Times()),
                                "حذف فیلتر ها"
                            )->Attrs(['type' => 'reset']),
                        $this->Html()->refresh()
                    ),
                        HtmlTags::Div('#formDiv')->Content(
                            HtmlTags::Div('.card-body.d-flex.flex-wrap#formDiv')->Content(
                                $this->MakeReports()
                            )
                        )
                        ,
                        HtmlTags::Div('.card-footer')->Content(
                            HtmlTags::Button('.btn.btn-success.w-100')->Content(
                                HtmlTags::I('.m-2')->Class(FontAwesome::Download()),
                                HtmlTags::Span('دریافت گزارش')
                            )->Id('submit_btn')->Type('button')
                        )
                    )
                )
            ),
            HtmlTags::Div('#res')
        );
    }

    final private function MakeReports() {
        return implode('',$this->ReportFields());
    }

    abstract function ReportFields(): array;

    final protected function SimpleSearch(string $name,string $label,int $size = 6){
        $name = "fw_report_$name";
        return HtmlTags::Div('.form-group.col-md-'.$size)->Content(
            HtmlTags::Label($label),
            HtmlTags::Input('.form-control')->Name($name)->Id($name)->PlaceHolder($label)
        );
    }
    final protected function Percent(string $name,string $label,int $size = 6){
        $name = "fw_report_$name";
        return HtmlTags::Div('.form-group.col-md-'.$size)->Content(
            HtmlTags::Label($label),
            HtmlTags::Div('.input-group')->Content(
                HtmlTags::Input('.form-control')->Name($name)->Id($name)->PlaceHolder($label),

                HtmlTags::Div('.input-group-append')->Content(
                    HtmlTags::Span('.input-group-text')->Content(
                        '٪'
                    )
                )
            )
        );
    }
    final protected function SimpleSelect(string $name,string $label, $options,int $size = 6,bool $all = true){
        $name = "fw_report_$name";
        return HtmlTags::Div('.form-group.col-md-'.$size)->Content(
            HtmlTags::Label()->Content($label),
            HtmlTags::Select('.form-control')->Name($name)->Id($name)->Content(
                $all ? HtmlTags::Option()->Value('all')->Selected()->Content("همه") : '',
                $options
            )
        );
    }
    final protected function CreateRadioButtons(array $array,string $name, string $label,int $size = 6,$default = null){
        $name = "fw_report_$name";
        $radios = [];
        foreach ($array as $key => $value){

            $radios[] = HtmlTags::Div('.m-2')->Content(

                HtmlTags::Input('.form-control')
                    ->Name($name)
                    ->Id("$name"."_$key")
                    ->Value($key)->Checked($key === $default)
                    ->Type('radio'),
                HtmlTags::Label($value)->Class('mr-2')
            );
        }
        return HtmlTags::Div('.form-group.col-md-'.$size)->Content(
            HtmlTags::Label($label)->Style(new Style([Style\Props\Display::Block()])),
            HtmlTags::Div('.d-flex.flex-wrap')->Content(
                implode('',$radios)
            )
        );
    }

    public function Script(?string $state = '') {
        $view = str_replace($this->State(),'',$this->thisView);
        if (file_exists(__SOURCE__ . 'views/' . $view . '.view.js')) {
            return '<script src="src/views/' . $view . '.view.js"></script>';
        }
        return '';
    }

    final public function CheckBox(array $checkboxes,string $label,int $size = 6) {
        $checks = [];
        foreach ($checkboxes as $key => $value){
            $key = "fw_report_$key";
            $checks[] = HtmlTags::Div('.m-2')->Content(
                HtmlTags::Input('.form-control')
                    ->Name($key)
                    ->Id($key)
                    ->Value($value['value'])
                    ->Type('checkbox'),
                HtmlTags::Label($value['label'])->Class('mr-2')
            );
        }
        return HtmlTags::Div('.form-group.col-md-'.$size)->Content(
            HtmlTags::Label($label)->Style(new Style([Style\Props\Display::Block()])),
            implode('',$checks)
        );
    }
    final protected function DateFromTo(string $name,string $label,int $size = 12) {
        $divided = $size / 2;
        $name = "fw_report_$name";
        return HtmlTags::Div(".form-group.col-md-$size")->Content(
            HtmlTags::Label($label),
            HtmlTags::Div('.d-flex.flex-wrap')->Content(
                HtmlTags::Div(".form-group.col-md-{$divided}")->Content(
                    HtmlTags::Label('از'),
                    HtmlTags::Input('.form-control')->Name("$name"."_from")->Id("$name"."_from")
                ),
                HtmlTags::Div(".form-group.col-md-{$divided}")->Content(
                    HtmlTags::Label('تا'),
                    HtmlTags::Input('.form-control')->Name("$name"."_to")->Id("$name"."_to")
                )
            )
        );
    }
	protected function SimpleDate(string $name, string $label,int $size = 12) {
		$name = "fw_report_$name";

		return    HtmlTags::Div(".form-group.col-md-$size")->Content(
			HtmlTags::Label("$label"),
			$this->Html()->Input("$name","simple_date_$name")
		);
	}
}
