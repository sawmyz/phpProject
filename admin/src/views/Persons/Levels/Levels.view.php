<?
namespace view;
use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;
class Levels extends View
{

    public $PluralName = ' سطوح عضویت';
    public $SingularName = ' سطح عضویت';

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
                                                                    HtmlTags::Th('عنوان'),
                                                                    HtmlTags::Th('درصد تخفیف برای گروه'),
                                                                    HtmlTags::Th('درصد بازگشت اعتبار برای گروه'),

                                                                    HtmlTags::Th('.no-sort عملیات') ,
                                                                    HtmlTags::Th('.no-sort وضعیت')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show([
                                                                    'level_title',
                                                                    'level_discount_percent',
                                                                    'level_credit_return_percent'
                                                                ],false,'',true)
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
        $card = '<option SELECTED DISABLED value="">لطفا یک گزینه را انتخاب کنید</option>'.'<option value="1">بله</option>'.'<option value="1">خیر</option>';
        return $this->Html()->BreadCrumbs() .HtmlTags::Section('.content')
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
                                    $this->Html()->FormStart().
                                    $this->Html()->FormGroupStart(3) .
                                    $this->Html()->Label('عنوان') .
                                    $this->Html()->Input('level_title') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(3) .
                                    $this->Html()->Label('درصد تخفیف برای گروه') .
                                    $this->Html()->Percent('level_discount_percent','discount_percent') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(3) .
                                    $this->Html()->Label('درصد بازگشت اعتبار برای گروه') .
                                    $this->Html()->Percent('level_credit_return_percent','level_credit_return_percent') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(3) .
                                    $this->Html()->Label('حداقل امتیاز برای پیوستن') .
                                    $this->Html()->Number('level_min_score_join','level_min_score_join') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(3) .
                                    $this->Html()->Label('واحد تبدیل امتیاز به اعتبار') .
                                    $this->Html()->Input('level_unit_score_to_credit') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(3) .
                                    $this->Html()->Label('اعتبار هر واحد (ریال)') .
                                    $this->Html()->Price('level_unit_credit','level_unit_credit') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(3) .
                                    $this->Html()->Label('صدور کارت') .
                                    $this->Html()->Select('level_card_issuance','level_card_issuance',$card) .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(12) .
                                    $this->Html()->Label('توضیحات') .
                                    $this->Html()->Input('level_description') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('ثبت نام در سایت') .
                                    $this->Html()->Number('level_register_site','level_register_site') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('ورود به سایت یکبار در هر روز') .
                                    $this->Html()->Number('level_login_once_day','level_login_once_day') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('تکمیل اطلاعات اولیه پروفایل') .
                                    $this->Html()->Number('level_basic_profile_information','level_basic_profile_information') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('تکمیل اطلاعات تکمیلی') .
                                    $this->Html()->Number('level_additional_information','level_additional_information') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('امتیاز به ازای هر خرید') .
                                    $this->Html()->Number('level_score_buy','level_score_buy') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('امتیاز به ازای هر مبلغ خرید') .
                                    $this->Html()->Number('level_score_buy_amount','level_score_buy_amount') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('امتیاز به ازای معرفی هر کاربر جدید') .
                                    $this->Html()->Number('level_introduce_new_user','level_introduce_new_user') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('امتیاز به ازای ثبت نظر') .
                                    $this->Html()->Number('level_record_comment','level_record_comment') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('امتیاز به ازای ثبت امتیاز در سایت') .
                                    $this->Html()->Number('level_record_score','level_record_score') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('امتیاز به ازای شارژ کیف پول') .
                                    $this->Html()->Input('level_score_wallet') .
                                    $this->Html()->FormGroupEnd()  .
                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('حداقل امتیاز') .
                                    $this->Html()->Input('level_min_score') .
                                    $this->Html()->FormGroupEnd()  .
                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('حداقل اعتبار') .
                                    $this->Html()->Price('level_min_credit') .
                                    $this->Html()->FormGroupEnd()  .
                                    $this->Html()->CardFooter()
                        )
                )
            )
    );
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
        