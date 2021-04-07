<?
namespace view;
use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;
class Acceptorpictures extends View
{

    public $SingularName = 'گالری پذیرنده';

    public function main(Document &$document)
    {

        $echo = false;
        if ($_REQUEST['provider_branch_id']){
            $echo = true;
            $branchData = (new \model\ProviderBranches())->get($_REQUEST['provider_branch_id']);
        }


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
                                                $this->Html()->refreshAndAdd('',['provider_branch_id',$_REQUEST['provider_branch_id']]),
                                                ($echo ? ' تصاویر '.$branchData->provider_branch_name : '')
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
                                                                    HtmlTags::Th('شعبه'),
                                                                    HtmlTags::Th('تصویر'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show(['acceptor_photo_name',
                                                                    'provider_branch_name'=>(new \model\ProviderBranches()),
                                                                    'showImage'=>'acceptor_photo_image'

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

        $branchRow='';

        if ($_GET[1]) {
            $branchData =\model\ProviderBranches::get($_GET[1]);
            $branchRow = '<option value="'.$branchData->provider_branch_id.'">'.$branchData->provider_branch_name.'</option>';
            $echo = true;
        }else{
            $branch_all =\model\ProviderBranches::getAll();
            $branchRow .= '<option value="">یک گزینه را انتخاب کنید</option>';
            foreach ($branch_all as $i){
                $branchRow .= '<option value="'.$i->provider_branch_id.'">'.$i->provider_branch_name.'</option>';
            }
        }

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
                                    $this->Html()->refreshAndBack(),
                                    HtmlTags::Br(),
                                    ($echo ? ' افزودن تصویر برای '.$branchData->provider_branch_name : '')
                                ),
                                    $this->Html()->FormStart().
                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('شعبه پذیرنده') .
                                    $this->Html()->Select('provider_branch_id','',$branchRow) .
                                    $this->Html()->FormGroupEnd() .
                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('نام تصویر') .
                                    $this->Html()->Input('acceptor_photo_name') .
                                    $this->Html()->FormGroupEnd() .
                                    $this->Html()->FormGroupStart(4) .
                                    $this->Html()->Label('تصویر') .
                                    $this->Html()->ImageInput('acceptor_photo_image') .
                                    $this->Html()->FormGroupEnd() .
                                    $this->Html()->FormGroupStart(12) .
                                    $this->Html()->Label('توضیحات') .
                                    $this->Html()->TextArea('acceptor_photo_description') .
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
        