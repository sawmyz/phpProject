<?
namespace view;
use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;
class Ranges extends View
{

    public $SingularName = 'محدوده';

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
                                                                    HtmlTags::Th('کشور'),
                                                                    HtmlTags::Th('استان'),
                                                                    HtmlTags::Th(' شهر'),
                                                                    HtmlTags::Th('منطقه'),
                                                                    HtmlTags::Th('محدوده'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150'),
                                                                    HtmlTags::Th('.no-sort وضعیت')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show(['country_name'=>new \model\Countries() ,
                                                                    'state_name'=>new \model\States(),
                                                                    'city_name'=>new \model\Cities(),'district_name'=>new \model\Districts(),'range_name'],false,true,true)
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
                                      $this->Html()->FormGroupStart(4) .
                            $this->Html()->Label('کشور') .
                            $this->Html()->Select('country_id', 'country_id', \model\Countries::toOption()) .
                            $this->Html()->FormGroupEnd() .

                            $this->Html()->FormGroupStart(4) .
                            $this->Html()->Label('استان') .
                            $this->Html()->Select('state_id', 'state_id', \model\States::toOption()) .
                            $this->Html()->FormGroupEnd() .

                            $this->Html()->FormGroupStart(4) .
                            $this->Html()->Label('شهر') .
                            $this->Html()->Select('city_id', 'city_id',\model\Cities::toOption()) .
                            $this->Html()->FormGroupEnd() .

                            $this->Html()->FormGroupStart(4) .
                            $this->Html()->Label('منطقه') .
                            $this->Html()->Select('district_id', 'district_id', \model\Districts::toOption()) .
                            $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('محدوده') .
                                    $this->Html()->Input('range_name') .
                                    $this->Html()->FormGroupEnd()  .

                                    $this->Html()->FormGroupStart(12) .
//                            $this->Html()->Label('انتخاب محدوده') .
                            $this->Polygon('range_polygon') .
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
