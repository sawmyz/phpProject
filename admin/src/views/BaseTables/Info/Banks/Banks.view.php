<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;

class Banks extends View
{

    public $SingularName = 'بانک';

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
                                                                    HtmlTags::Th('نام بانک'),
                                                                    HtmlTags::Th('لوگو'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
//                                                                    HtmlTags::Th('.no-sort وضعیت')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show(['bank_name','showImage'=>'bank_logo'],false,true)
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
                                        '
                                         <br>  <br>
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="creditBTN" type="button" class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تخصیص اعتبار  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4, 'sss') .
                                        $this->Html()->Label('تخصیص اعتبار', '', 'togglec1') .
                                        '<div class="input-group-append togglec3">' .
                                        $this->Html()->Number('new_credit', 'new_credit', '', false) .
                                        '<span type="button" class="togglec4 btn btn-success">محاسبه</span>' .
                                        '</div>' .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('اعتبار جدید نگا کلاب', 'credit_after', 'togglec2') .
                                        $this->Html()->Number('credit_after', 'credit_after', 0, false) .
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
