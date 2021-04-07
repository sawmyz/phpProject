<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;

class Supervisors extends View
{

    public $SingularName = 'سرپرست';
    public $PluralName = 'سرپرست ها';

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
                                                                    HtmlTags::Th('نام و نام خانوادگی'),
                                                                    HtmlTags::Th('نام پروفایل'),

                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show(['user_name',
                                                                    'user_profile'], false)
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
            $this->Html()->Label('نام و نام خانوادگی') .
            $this->Html()->Input('user_name') .
            $this->Html()->FormGroupEnd() .

            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('ایمیل') .
            $this->Html()->Input('user_email') .
            $this->Html()->FormGroupEnd() .

            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('نام کاربری') .
            $this->Html()->Input('user_username') .
            $this->Html()->FormGroupEnd() .

          $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('کلمه عبور') .
            $this->Html()->Input('user_password') .
            $this->Html()->FormGroupEnd() .

            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('نام پروفایل') .
            $this->Html()->Input('user_profile') .
            $this->Html()->FormGroupEnd() .

            $this->Html()->FormGroupStart(6) .
            $this->Html()->Label('role') .
            $this->Html()->Input('role_name') .
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
