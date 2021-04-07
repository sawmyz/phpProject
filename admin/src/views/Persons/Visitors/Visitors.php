<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwAuthSystem\Main\UserObject;
use model\Entity\IndividualsEntity;
use View;

class Visitors extends View
{

    public $SingularName = 'بازاریاب';
    public $PluralName = 'بازاریابان';

    public function main(Document &$document)
    {
        $document->html = $this->Html()->BreadCrumbs() . HtmlTags::Section('.content')
                ->Content(
                    HtmlTags::Div('.row')
                        ->Content(
                            HtmlTags::Div('.col-md-12')->Content(
                                HtmlTags::Div('.card.card-primary.card-outline')
                                    ->Content(
                                        HtmlTags::Div('.card-header')
                                            ->Content(
                                                $this->Html()->CardTitle(),
                                                $this->Html()->refreshAndAdd()
                                            ),
                                        HtmlTags::Div('.card-body.d-flex.flex-wrap')
                                            ->Content(
                                                HtmlTags::Table('.table.table-bordered.table-striped')
                                                    ->Content(
                                                        HtmlTags::Thead('.table-dark')
                                                            ->Content(
                                                                HtmlTags::Tr()->Content(
                                                                    HtmlTags::Th('ردیف')->Width('50'),
                                                                    HtmlTags::Th('نام '),
                                                                    HtmlTags::Th('نام خانوادگی'),
                                                                    HtmlTags::Th('نام کاربری'),
                                                                    HtmlTags::Th('تصویر')->Width('250'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show([
                                                                    'individual_first_name' => new \model\Individuals(),
                                                                    'individual_last_name' => new \model\Individuals(),
                                                                    'visitor_username',
                                                                    'showImage' => 'visitor_image'])
                                                            )
                                                    )
                                            )
                                    )
                            )
                        )
                );
    }

    public function Form()
    {

        $married = HtmlTags::Option()->Selected()->Disabled()->Value("")->Content("لطفا یک گزینه را انتخاب کنید");
        $married .= HtmlTags::Option()->Value("1")->Content("مجرد");
        $married .= HtmlTags::Option()->Value("2")->Content("متاهل");
        return $this->Html()->BreadCrumbs() . HtmlTags::Section('.content')
                ->Content(
                    HtmlTags::Div('.row')
                        ->Content(
                            HtmlTags::Div('.col-md-12')->Content(
                                HtmlTags::Div('.card.card-primary.card-outline')
                                    ->Content(
                                        HtmlTags::Div('.card-header')
                                            ->Content(
                                                $this->Html()->CardTitle(),
                                                $this->Html()->refreshAndBack()
                                            ),
                                        $this->Html()->FormStart() .
                                        $this->Html()->FormGroupStart(12) .
                                        $this->Html()->Label('انتخاب شخص') .
                                        $this->quickAdd(
                                            $this->Html()->Select('individual_id', 'individual_id', \model\Individuals::toOption(UserObject::instance())),
                                            new \controller\Individuals()) .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('سرپرست') .
                                        $this->Html()->Select('user_id', 'user_id', \model\Supervisors::toSupervisorsOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('کد ملی') .
                                        $this->Html()->Input('visitor_national_code') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('سریال شناسنامه') .
                                        $this->Html()->Input('visitor_identity_serial') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تاریخ تولد') .
                                        $this->Html()->Input('visitor_birthday') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('نام پدر') .
                                        $this->Html()->Input('visitor_father_name') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('استان') .
                                        $this->Html()->Select('state_id', 'state_id', \model\States::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('شهر') .
                                        $this->Html()->Select('city_id', 'city_id', \model\Cities::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('آدرس') .
                                        $this->Html()->Input('visitor_address', 'visitor_address') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label(' تلفن') .
                                        $this->Html()->Tel('visitor_tell') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('کد پستی') .
                                        $this->Html()->Input('visitor_postal_code') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مکان تولد') .
                                        $this->Html()->Input('visitor_birthplace') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('وضعیت تاهل') .
                                        $this->Html()->Select('visitor_marital_status', 'visitor_marital_status', $married) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تعداد فرزندان') .
                                        $this->Html()->NumberInput('visitor_number_children', '0', '100', '1', '', '0') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('آدرس ایمیل') .
                                        $this->Html()->Email('visitor_email') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('نام کاربری') .
                                        $this->Html()->Input('visitor_username') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('کلمه عبور') .
                                        $this->Html()->Password('visitor_password') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تصویر') .
                                        $this->Html()->ImageInput('visitor_image') .
                                        $this->Html()->FormGroupEnd() .

//                                        $this->Html()->FormGroupStart(4) .
//                                        $this->Html()->Label('امتیاز') .
//                                        $this->Html()->Number('visitor_score') .
//                                        $this->Html()->FormGroupEnd() .
//
//                                        $this->Html()->FormGroupStart(4) .
//                                        $this->Html()->Label('اعتبار') .
//                                        $this->Html()->Price('visitor_credit') .
//                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(12) .
                                        $this->Html()->Label('توضیحات') .
                                        $this->Html()->TextArea('visitor_description') .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->CardFooter()
                                    )
                            )
                        )
                ).$this->quickAddModals();
    }

    public function add(Document &$document)
    {
        $document->html = $this->Form();
    }

    public function edit(Document &$document)
    {
        $this->doFill();
        $document->html = $this->Form();
    }

    public function delete(Document &$document)
    {
        $this->doFill();
        $this->doDisableAll();
        $document->html = $this->Form();
    }

    public function view(Document &$document)
    {
        $this->doFill();
        $this->doDisableAll();
        $document->html = $this->Form();
    }

}
