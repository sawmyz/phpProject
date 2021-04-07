<?
namespace view;
use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;
class Jobs extends View
{

    public $SingularName = 'شغل';

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
                                                                    HtmlTags::Th('نام شغل'),
                                                                    HtmlTags::Th('گروه کاری'),
                                                                    HtmlTags::Th('اصناف'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
//                                                                    HtmlTags::Th('.no-sort وضعیت')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show(['job_name','work_group_name'=>new \model\WorkGroups(),'caste_name'=>new \model\Castes()],false,true)
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
                            $this->Html()->FormStart() .

                            $this->Html()->FormGroupStart(6) .
                            $this->Html()->Label('نام شغل') .
                            $this->Html()->Input('job_name') .
                            $this->Html()->FormGroupEnd() .

                            $this->Html()->FormGroupStart(6) .
                            $this->Html()->Label('تحصیلات') .
                            $this->Html()->Select('education_id[]','education_id',\model\Educations::toOption(),false,false,'form-control',true) .
                            $this->Html()->FormGroupEnd() .

                            $this->Html()->FormGroupStart(6) .
                            $this->Html()->Label('گروه کاری') .
                            $this->Html()->Select('workgroup_id','workgroup_id',\model\WorkGroups::toOption()) .
                            $this->Html()->FormGroupEnd() .

                            $this->Html()->FormGroupStart(6) .
                            $this->Html()->Label('اصناف') .
                            $this->Html()->Select('caste_id','caste_id',\model\Castes::toOption(),true,true) .
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
        