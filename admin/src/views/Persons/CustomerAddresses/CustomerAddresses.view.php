<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;

class CustomerAddresses extends View
{

    public $SingularName = 'آدرس مشتری';
    public $PluralName = 'آدرس مشتریان';

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
                                                                    HtmlTags::Th('شهر'),
                                                                    HtmlTags::Th('منطقه'),
                                                                    HtmlTags::Th('خیابان اصلی'),
                                                                    HtmlTags::Th('خیابان فرعی'),
                                                                    HtmlTags::Th('آدرس دقیق'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show([
                                                                    'country_id'=>new \model\Countries() ,
                                                                    'state_name'=>new \model\States() ,
                                                                    'city_name' => new \model\Cities() ,
                                                                    'district_name' => new \model\Districts() ,
                                                                    'customer_main_street',
                                                                     'customer_secondary_street',
                                                                    'customer_address_full',

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
                                        $this->Html()->Label('انتخاب مشتری') .
                                        $this->Html()->Select('customer_id', 'customer_id', \model\Customers::toOption(),'') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('کشور') .
                                        $this->Html()->Select('country_id', 'country_id',\model\Countries::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('انتخاب استان') .
                                        $this->Html()->Select('state_id', 'state_id', \model\States::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('انتخاب شهر') .
                                        $this->Html()->Select('city_id', 'city_id',\model\Cities::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('انتخاب منطقه') .
                                        $this->Html()->Select('district_id', 'district_id', \model\Districts::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('خیابان اصلی') .
                                        $this->Html()->Input('customer_address_main_street') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('خیابان فرعی') .
                                        $this->Html()->Input('customer_address_secondary_street') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(9) .
                                        $this->Html()->Label('آدرس دقیق') .
                                        $this->Html()->Input('customer_address_full') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(3) .
                                        $this->Html()->Label('پلاک') .
                                        $this->Html()->Input('customer_address_plaque') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(12) .
                                        $this->Html()->Label('نقشه') .
                                        $this->MapMarker('customer_address_latitude', 'customer_address_longitude') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(6) .
                                        $this->Html()->Label('عرض جغرافیایی') .
                                        $this->Html()->Input('customer_address_latitude') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(6) .
                                        $this->Html()->Label('طول جغرافیایی') .
                                        $this->Html()->Input('customer_address_longitude') .
                                        $this->Html()->FormGroupEnd().
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
        