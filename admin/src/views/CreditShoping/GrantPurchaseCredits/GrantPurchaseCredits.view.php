<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwAuthSystem\Main\UserObject;
use model\Entity\IndividualsEntity;
use View;

class GrantPurchaseCredits extends View
{

    public $SingularName = 'اعطا خرید اعتباری';
    public $PluralName = 'اعطا خرید اعتباری';


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
                                                                    'credit_file_filenumber' => function ($item) {
                                                                        $customerId = \model\CreditFile::getOneFiltered('credit_file_filenumber', $item)->customer_id;
                                                                        $individualId = \model\Customers::get($customerId)->individual_id;
                                                                        $name = \model\Individuals::get($individualId);
                                                                        return $name->individual_first_name . ' ' . $name->individual_last_name;
                                                                    },
                                                                ], false, false)
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
                                        $this->Html()->Select('guarantee_documents_id', 'guarantee_documents_id', \model\GuaranteeDocuments::toOptionConfirmSend()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('اعتبار درخواستی') .
                                        $this->Html()->Input('credit_file_requested_credit', 'credit_file_requested_credit') .  //x
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('باز پرداخت') .
                                        $this->Html()->Input('credit_file_refund', 'credit_file_refund') .  //y
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('سود ماهیانه') .
                                        $this->Html()->Input('credit_file_monthly_profit', 'credit_file_monthly_profit') .   //z
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مبلغ پرداخت ماهیانه') .
                                        $this->Html()->Input('credit_file_payment_amount', 'credit_file_payment_amount') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مبلغ چک تضمیتی') .
                                        $this->Html()->Input('credit_file_guaranteed_check', 'credit_file_guaranteed_check') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('شماره پرونده') .
                                        $this->Html()->Input('credit_file_filenumber', 'credit_file_filenumber') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <br>  <br>
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="creditBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg"> واریز به حساب بانکی 
                                          <div style="color: red"> در صورت تمایل به واریز مستقیم به اعتبار مشتری نیازی به تکمیل این بخش نمیباشد و با ثبت فرم , مبلغ مورد نظر به اعتبار مشتری افزوده میشود</div></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مبلغ اعتبار واریزی') .
                                        $this->Html()->Input('grant_purchase_credit_price', 'grant_purchase_credit_price') .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('شماره شبا مشتری') .
                                        '<div class="input-group-append toggles3">' .
                                        $this->Html()->Input('customer_credit_account_number', 'customer_credit_account_number', '', false) .
                                        '<span type="button" id="inquiry" class="toggles4 btn btn-success">استعلام شماره شبا</span>' .
                                        '</div>' .
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
