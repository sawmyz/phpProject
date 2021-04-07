<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwAuthSystem\Main\UserObject;
use model\Entity\IndividualsEntity;
use View;

class Customers extends View
{

    public $SingularName = 'مشتری';
    public $PluralName = 'مشتریان';

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
                                                                    HtmlTags::Th('تصویر'),
                                                                    HtmlTags::Th('نام کاربری'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show([
                                                                    'individual_first_name'=>new \model\Individuals(),
                                                                    'individual_last_name'=>new \model\Individuals(),
                                                                    'showImage'=>'customer_image',
                                                                    'customer_username'])
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
                                        $this->Html()->Label('سطح عضویت') .
                                        $this->Html()->Select('level_id','',\model\Levels::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('کد ملی') .
                                        $this->Html()->Input('customer_national_code') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تاریخ تولد') .
                                        $this->Html()->Input('customer_birthday') .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('نام پدر') .
                                        $this->Html()->Input('customer_father_name') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label(' تلفن') .
                                        $this->Html()->Tel('customer_tell') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('کد پستی') .
                                        $this->Html()->Input('customer_postal_code') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مکان تولد') .
                                        $this->Html()->Input('customer_birthplace') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('وضعیت تاهل') .

                                        $this->Html()->Select('customer_marital_status','customer_marital_status',$married) .

                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تعداد فرزندان') .
                                        $this->Html()->NumberInput('customer_number_children','0','100','1','','0') .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('آدرس ایمیل') .
                                        $this->Html()->Email('customer_email') .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .

                                        $this->Html()->Label('نام کاربری') .
                                        $this->Html()->Input('customer_username') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('کلمه عبور') .
                                        $this->Html()->Password('customer_password') .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تصویر') .
                                        $this->Html()->ImageInput('customer_image') .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('امتیاز') .
                                        $this->Html()->Number('customer_score') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('اعتبار') .
                                        $this->Html()->Price('customer_credit') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(12) .
                                        $this->Html()->Label('توضیحات') .
                                        $this->Html()->TextArea('customer_description') .
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
