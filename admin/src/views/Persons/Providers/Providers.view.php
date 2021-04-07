<?

namespace view;

use DOMWrap\Document;
use FwAuthSystem\Main\UserObject;
use model\Entity\ProvidersEntity;
use model\Entity\SocialMediasEntity;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;

class Providers extends View
{

    public $SingularName = 'پذیرنده';

    public function main(Document &$document)
    {
        $Instance = UserObject::instance();
        $role = str($Instance->getRole());

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
                                                                    HtmlTags::Th('صنف'),
                                                                    HtmlTags::Th('تصویر'),
                                                                    HtmlTags::Th('تعیین وضعیت'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150'),
                                                                    HtmlTags::Th('.no-sort وضعیت')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show([
                                                                    'provider_name',
                                                                    'caste_name' => new \model\Castes(),
                                                                    'showImage' => 'provider_image',
                                                                    'provider_id' => function ($item) {

                                                                        /** @var ProvidersEntity $provider */
                                                                        $status = \model\Providers::get($item)->status;

                                                                        if ($status == 0) {
                                                                            return HtmlTags::Button(".btn.btn-warning.m-1.supervisorConfirm")->Content(
                                                                                HtmlTags::I('.fa.fa-check-square.p-1') .
                                                                                HtmlTags::I('.fa.fa-times-rectangle.p-1') .
                                                                                HtmlTags::P('تعیین وضعیت')
                                                                            )->Data_('toggle', 'tooltip')->Data_('Provider_id', $item)->Id($item)->Data_('status', 0)->Title('تعیین وضعیت');
                                                                        } else if ($status == -1) {
                                                                            return HtmlTags::Button(".btn.btn-danger.m-1.supervisorConfirm")->Content(
                                                                                HtmlTags::I('.fa.fa-check-square.p-1') .
                                                                                HtmlTags::I('.fa.fa-times-rectangle.p-1') .
                                                                                HtmlTags::P('رد توسط سرپرست')
                                                                            )->Data_('toggle', 'tooltip')->Data_('Provider_id', $item)->Id($item)->Data_('status', 0)->Title('تعیین وضعیت');
                                                                        } else if ($status == 1) {
                                                                            return HtmlTags::Button(".btn.btn-primary.m-1.supervisorConfirm")->Content(
                                                                                HtmlTags::I('.fa.fa-check-square.p-1') .
                                                                                HtmlTags::I('.fa.fa-times-rectangle.p-1') .
                                                                                HtmlTags::P('تایید سرپرست')
                                                                            )->Data_('toggle', 'tooltip')->Data_('Provider_id', $item)->Id($item)->Data_('status', 0)->Title('تعیین وضعیت');
                                                                        } else if ($status == 2) {
                                                                            return HtmlTags::Button(".btn.btn-danger.m-1.supervisorConfirm")->Content(
                                                                                HtmlTags::I('.fa.fa-check-square.p-1') .
                                                                                HtmlTags::I('.fa.fa-times-rectangle.p-1') .
                                                                                HtmlTags::P('رد توسط مدیریت')
                                                                            )->Data_('toggle', 'tooltip')->Data_('Provider_id', $item)->Id($item)->Data_('status', 0)->Title('تعیین وضعیت');
                                                                        } else if ($status == 3) {
                                                                            return HtmlTags::Button(".btn.btn-success.m-1.supervisorConfirm")->Content(
                                                                                HtmlTags::I('.fa.fa-check-square.p-1') .
                                                                                HtmlTags::I('.fa.fa-times-rectangle.p-1') .
                                                                                HtmlTags::P('تایید نهایی مدیریت')
                                                                            )->Data_('toggle', 'tooltip')->Data_('Provider_id', $item)->Id($item)->Data_('status', 0)->Title('تعیین وضعیت');
                                                                        }
                                                                    },
                                                                ], true, true, true))

                                                    )
                                            )
                                    )
                            )
                        )
                );

        ?>
        <script>

            $('.supervisorConfirm').on('click', function () {

                let status = $(this).data("status");
                let id = $(this).attr('id');
                let role = '<?= $role ?>';

                $.ajax({
                    url: "controllers/Persons/Providers/Providers",
                    type: "POST",
                    data: {
                        controller_type: 'providerStatusDesc',
                        id: id,
                    },
                    success: res => {
                        console.log(res);
                        $('.swal2-html-container').html(res);
                    }
                });

                if (role === 'SupervisorsRole') {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                        title: 'تعیین وضعیت قرارداد',
                        text: "علت رد قرارداد",
                        input: 'textarea',
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonText: 'تایید قرارداد',
                        cancelButtonText: 'رد قرارداد',
                        cancelButtonColor: "#ff0b0b",
                        confirmButtonColor: "#20a200",
                        preConfirm: res => {
                            $.ajax({
                                url: "controllers/Persons/Providers/Providers",
                                type: "POST",
                                data: {
                                    controller_type: 'providerStatus',
                                    status: 1,
                                    id: id,
                                },
                                success: res => {
                                    $('#' + id).removeClass("btn-warning");
                                    $('#' + id).removeClass("btn-warning");
                                    $('#' + id).removeClass("btn-danger");
                                    $('#' + id).addClass("btn-success");

                                    console.log(res);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'تایید قرارداد با موفقیت انجام شد!',
                                        showConfirmButton: false,
                                    })
                                }
                            });
                        },
                    }).then((result) => {
                        if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            if ($('.swal2-textarea').val() !== '') {

                                $.ajax({
                                    url: "controllers/Persons/Providers/Providers",
                                    type: "POST",
                                    data: {
                                        controller_type: 'providerStatus',
                                        status: -1,
                                        id: id,
                                        desc:'رد قرارداد توسط سرپرست به دلیل : ' + $('.swal2-textarea').val(),
                                    },
                                    success: res => {

                                        $(id).removeClass("btn-warning");
                                        $(id).removeClass("btn-success");
                                        $(id).addClass("btn-danger");

                                        console.log(res);
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'رد قرارداد با موفقیت انجام شد!',
                                            showConfirmButton: false,
                                        })
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'عملیات انجام نشد!',
                                    text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                                    showConfirmButton: false,
                                })
                            }
                        }
                    })
                } else if (role === 'AdminRole') {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                        title: 'تعیین وضعیت قرارداد',
                        text: "علت رد قرارداد",
                        input: 'textarea',
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonText: 'تایید قرارداد',
                        cancelButtonText: 'رد قرارداد',
                        cancelButtonColor: "#ff0b0b",
                        confirmButtonColor: "#20a200",
                        preConfirm: res => {
                            $.ajax({
                                url: "controllers/Persons/Providers/Providers",
                                type: "POST",
                                data: {
                                    controller_type: 'providerStatus',
                                    status: 3,
                                    id: id,
                                },
                                success: res => {
                                    $('#' + id).removeClass("btn-warning");
                                    $('#' + id).removeClass("btn-danger");
                                    $('#' + id).addClass("btn-success");

                                    console.log(res);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'تایید قرارداد با موفقیت انجام شد!',
                                        showConfirmButton: false,
                                    })
                                }
                            });
                        },
                    }).then((result) => {
                        if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            if ($('.swal2-textarea').val() !== '') {

                                $.ajax({
                                    url: "controllers/Persons/Providers/Providers",
                                    type: "POST",
                                    data: {
                                        controller_type: 'providerStatus',
                                        status: 2,
                                        id: id,
                                        desc: 'رد قرارداد توسط مدیریت به دلیل : ' + $('.swal2-textarea').val(),
                                    },
                                    success: res => {

                                        $('#' + id).removeClass("btn-warning");
                                        $('#' + id).removeClass("btn-success");
                                        $('#' + id).addClass("btn-danger");

                                        console.log(res);
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'رد قرارداد با موفقیت انجام شد!',
                                            showConfirmButton: false,
                                        })
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'عملیات انجام نشد!',
                                    text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                                    showConfirmButton: false,
                                })

                            }

                        }
                    })
                }

            });

        </script>
        <?php
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
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('بازاریاب') .
                                        $this->Html()->Select('visitor_id', 'visitor_id', \model\Visitors::toOption(), true, false, 'form-control', true) .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('نام') .
                                        $this->Html()->Input('provider_name') .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('عکس') .
                                        $this->Html()->ImageInput('provider_image') .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مدیر') .
                                        $this->Html()->Select('provider_manager', 'provider_manager', \model\Individuals::toOption()) .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تلفن') .
                                        $this->Html()->Tel('provider_tel') .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('گروه کاری') .
                                        $this->Html()->Select('workgroup_id', 'workgroup_id', \model\WorkGroups::toOption()) .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('اصناف') .
                                        $this->Html()->Select('caste_id', 'caste_id', \model\Castes::toOption()) .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('شماره قرارداد') .
                                        $this->Html()->Number('provider_number') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تاریخ شروع قرارداد') .
                                        $this->Html()->Input('provider_start_date') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تاریخ پایان قرارداد') .
                                        $this->Html()->Input('provider_end_date') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(12) .
                                        $this->Html()->Label('انواع قرارداد') .
                                        $this->Html()->Select('contracttype_id', 'contracttype_id', \model\ContractTypes::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4, '', 'provider_cash_discount_div') .
                                        $this->Html()->Label('درصد تخفیف نقدی') .
                                        $this->Html()->Percent('provider_discount', 'provider_cash_discount', '', false) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4, '', 'provider_credit_discount_div') .
                                        $this->Html()->Label('درصد تخفیف اعتباری', '') .
                                        $this->Html()->Percent('provider_credit_discount', 'provider_credit_discount', '', false) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4, '', 'provider_month_settlement_div') .
                                        $this->Html()->Label('تعداد ماه های تسویه') .
                                        $this->Html()->Number('provider_month_settlement', 'provider_month_settlement', '', false) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(10) .
                                        '<label class="d-block" style="font-size: 150%">محاسبه امتیاز</label>' .
                                        ' هر ' . $this->Html()->SmallInputNumber('provider_each_buy', 'provider_each_buy', '', false) .
                                        ' خرید = ' .
                                        $this->Html()->SmallInputNumber('provider_score_per_buy', 'provider_score_per_buy', '', false) .
                                        ' امتیاز ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12) .
//										$this->Html()->Label('شبکه های اجتماعی') .
                                        '<label class="d-block" style="font-size: 150% ; text-align: center">شبکه های اجتماعی</label>' .
                                        $this->Table() .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->CardFooter()
                                    )
                            )
                        )
                );
    }

    private function Table()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th('.no-sort')->Content("ردیف"),
                    HtmlTags::Th('.no-sort')->Content("#"),
                    HtmlTags::Th()->Content("نام شبکه"),
                    HtmlTags::Th()->Content("آیکون")->Width('100'),
                    HtmlTags::Th('.no-sort')->Content("آدرس")
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    /** @var SocialMediasEntity $socialMedia */
                    foreach (\model\SocialMedias::getAll() as $socialMedia) {
                        $image = $socialMedia->social_media_icon;
                        $row++;
                        $output[] = HtmlTags::Tr()->Content(
                            HtmlTags::Td()->Content("$row"),
                            HtmlTags::Td()->Content(
                                HtmlTags::Input()
                                    ->Attrs(['checked' => isset($data[$socialMedia->social_media_id])])
                                    ->Type('checkbox')->Class('socialMediaCheckBox')
                            ),
                            HtmlTags::Td()->Content(
                                $socialMedia->social_media_name
                            ),
                            HtmlTags::Td()->Content(
                                '<img src="src/images/SocialMedias/' . $image . '"style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $this->Html()->Input("social_media_ids[$socialMedia->social_media_id]")->Disabled(!isset($data[$socialMedia->social_media_id]))->Required(false)
                            )
                        );
                    }
                    return $output;
                }
            )
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

?>

