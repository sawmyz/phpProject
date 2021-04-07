<?
namespace view;
use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;
class WorkGroups extends View
{

    public $SingularName = 'گروه کاری';
    public $PluralName = 'گروه های کاری';

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
                                                                    HtmlTags::Th(' گروه کاری'),
                                                                    HtmlTags::Th('تصویر'),
                                                                    HtmlTags::Th('آیکون'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150'),
                                                                    HtmlTags::Th('.no-sort وضعیت')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show(['work_group_name','showImage'=>'work_group_image','showimage'=>'work_group_icon'],false,true,true)
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
                                    $this->Html()->Label('نام گروه کاری') .
                                    $this->Html()->Input('work_group_name') .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('تصویر گروه کاری') .
                                    $this->Html()->ImageInput('work_group_image', 'image/jpeg', 150, 300, 'false', 'work_group_image', false) .
                                    $this->Html()->FormGroupEnd() .

                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('آیکون گروه کاری') .
                                    $this->Html()->ImageInput('work_group_icon', 'image/png', 150, 150, 'false', 'work_group_icon', false) .
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
