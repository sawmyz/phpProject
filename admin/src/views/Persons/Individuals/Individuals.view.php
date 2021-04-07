<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;

class Individuals extends View
{

    public $SingularName = 'شخص حقیقی';
    public $PluralName = 'اشخاص حقیقی';

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
                                                                    HtmlTags::Th('نام'),
                                                                    HtmlTags::Th('نام خانوادگی'),
                                                                    HtmlTags::Th('جنسیت'),
                                                                    HtmlTags::Th('موبایل'),

                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show(['individual_first_name',
                                                                    'individual_last_name',
                                                                    'individual_gender' => function ($gender) {
                                                                        return $gender == 1 ? "اقا" : "خانم";
                                                                    },
                                                                    'individual_mobile'], false)
                                                            )
                                                    )
                                            )
                                    )
                            )
                        )
                );
    }

    public function add(Document &$document)
    {
        $document->html = $this->Form();
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
                                        $this->quickAddForm() .
                                        $this->Html()->CardFooter()
                                    )
                            )
                        )
                );
    }

    public function quickAddForm()
    {
        return HtmlTags::Div('.w-100.d-flex.flex-wrap')->Content(

            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('نام') .
            $this->Html()->Input('individual_first_name') .
            $this->Html()->FormGroupEnd() .
            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('نام خانوادگی ') .
            $this->Html()->Input('individual_last_name') .
            $this->Html()->FormGroupEnd() .
            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('جنسیت') .
            $this->Html()->Input('individual_gender') .
            $this->Html()->FormGroupEnd() .
            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('موبایل') .
            $this->Html()->UniqueMobile('individual_mobile', 'individual_mobile') .
            $this->Html()->FormGroupEnd() .
            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('ملیت') .
            $this->Html()->Select('country_id', 'country_id', \model\Countries::toOption()) .
            $this->Html()->FormGroupEnd()
        );
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
