<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwAuthSystem\Main\UserObject;
use model\Entity\IndividualsEntity;
use View;

class SendDocuments extends View
{

    public $SingularName = 'ارسال فیزیکی مدارک';
    public $PluralName = 'ارسال فیزیکی مدارک';


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
                                                                    HtmlTags::Th('شماره پرونده'),
                                                                    HtmlTags::Th('مشتری'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show([
                                                                    'credit_file_filenumber',
                                                                    'guarantee_documents_id' => function ($item) {
                                                                        $name = \model\GuaranteeDocuments::get($item)->customer_id;
                                                                        $name = \model\Customers::get($name)->individual_id;
                                                                        $name = \model\Individuals::get($name);
                                                                        return $name->individual_first_name . ' ' . $name->individual_last_name;
                                                                    },
                                                                ])
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
        $uniqe = UniqueOfClass(new \model\CreditFile(), 'credit_file_filenumber', false, 6, true, false);
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
                                        $this->Html()->Label('انتخاب پرونده (شماره پرونده - نام و نام خانوادگی )') .
                                        $this->Html()->Select('guarantee_documents_id', 'guarantee_documents_id', \model\GuaranteeDocuments::toOptionConfirm()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(6) .
                                        $this->Html()->Label('تاریخ ارسال ') .
                                        $this->Html()->Input('send_guarantee_documents_date', 'send_guarantee_documents_date', date('Y')) .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(6) .
                                        $this->Html()->Label('کد رهگیری پستی') .
                                        $this->Html()->Input('send_guarantee_documents_code', 'send_guarantee_documents_code') .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <br>  <br>
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="creditBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  انتخاب مدارک ارسالی  </div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_birth_certificate_id', 'guarantee_birth_certificate_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('شناسنامه') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_national_card_id', 'guarantee_national_card_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('کارت ملی') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_certificate_rights_id', 'guarantee_certificate_rights_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('گواهی کسر از حقوق') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_contract_id', 'guarantee_contract_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('قرارداد مشتری') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_check_id', 'guarantee_check_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('چک تضمین') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_promissory_id', 'guarantee_promissory_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('سفته تضمین') .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_guarantor_check_id', 'guarantee_guarantor_check_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('چک ضامن') .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_Identity_id', 'guarantee_Identity_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('فرم احراز هویت') .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Input('guarantee_guarantor_rights_certificate_id', 'guarantee_guarantor_rights_certificate_id', '0', '', '', 'form-control', 'checkbox') .
                                        $this->Html()->Label('کسر از حقوق ضامن') .
                                        $this->Html()->FormGroupEnd() .


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
