<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;

use helpers\DayHelper;
use model\Entity\SocialMediasEntity;
use View;

class ProviderBranches extends View
{
//
    public $SingularName = 'شعبه ی پذیرنده';
//
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
                                                                    HtmlTags::Th('پذیرنده'),
                                                                    HtmlTags::Th('نام شعبه'),
                                                                    HtmlTags::Th('تلفن'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150'),
                                                                    HtmlTags::Th('.no-sort وضعیت')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show([
                                                                    'provider_branch_name',
                                                                    'provider_id' => new \model\Providers(),
                                                                    'provider_branch_telephone',], true, true, true, function ($item) {
                                                                    return HtmlTags::Button('.btn.btn-outline-warning.m-1.ajax')->Content(
                                                                        HtmlTags::I('.fa.fa-camera')
                                                                    )->Data_('toggle', 'tooltip')->Title('تصاویر شعب پذیرنده ')->Rel((new \controller\Acceptorpictures())->RelPath(['provider_branch_id' => $item->provider_branch_id
                                                                    ]));
                                                                })
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

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('پذیرنده') .
                                        $this->Html()->Select('provider_id', '', \model\Providers::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('نام شعبه') .
                                        $this->Html()->Input('provider_branch_name') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تصویر') .
                                        $this->Html()->ImageInput('provider_branch_image', '2', 2, 2) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مدیر') .
                                        $this->Html()->Select('provider_manager', 'provider_manager', \model\Individuals::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('تلفن') .
                                        $this->Html()->Tel('provider_branch_telephone', 'provider_branch_telephone') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('پروانه ی کسب دارد؟') .
                                        $this->Html()->Input('provider_branch_has_auth_yes_no', 'provider_branch_has_auth_yes_no') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4, '', 'auth') .
                                        $this->Html()->Label('شماره پروانه', '', 'lable') .
                                        $this->Html()->Input('provider_branch_auth_number', 'provider_branch_auth_number', '', false) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('کد پستی') .
                                        $this->Html()->Input('provider_branch_post_code') .
                                        $this->Html()->FormGroupEnd() .

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
                                        $this->Html()->Select('city_id', 'city_id', \model\Cities::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('منطقه') .
                                        $this->Html()->Select('district_id', 'district_id', \model\Districts::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('محدوده') .
                                        $this->Html()->Select('range_id', 'range_id', \model\Ranges::toOption()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(8) .
                                        $this->Html()->Label('مناطق تحت پوشش') .
                                        $this->Html()->Select('district_ids[]', 'district_ids', \model\Districts::toOption(), '', '', '', true) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('خیابان اصلی') .
                                        $this->Html()->Input('provider_branch_main_street') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('خیابان فرعی') .
                                        $this->Html()->Input('provider_branch_secondary_street') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(9) .
                                        $this->Html()->Label('آدرس دقیق') .
                                        $this->Html()->Input('provider_branch_address_full') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(3) .
                                        $this->Html()->Label('پلاک') .
                                        $this->Html()->Input('provider_branch_plaque') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(12) .
                                        $this->Html()->Label('انتخاب محدوده') .
                                        $this->MapMarker('provider_branch_latitude', 'provider_branch_longitude') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(6) .
                                        $this->Html()->Label('طول جغرافیایی') .
                                        $this->Html()->Input('provider_branch_latitude') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(6) .
                                        $this->Html()->Label('عرض جغرافیایی') .
                                        $this->Html()->Input('provider_branch_longitude') .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(12) .
                                        $this->Html()->Label('ساعات کاری') .
                                        $this->WorkingHours(3),
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(12) .
                                        $this->Html()->Label('شبکه های اجتماعی') .
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

    private function WorkingHours(int $int)
    {
        $int = $int > 3 ? 3 : $int <= 0 ? 1 : $int;
        $times = [
            'morning' => 'صبح',
            'noon' => 'عصر',
            'night' => 'شب',
        ];
        $output = [];
        $shifts = [];
        $startAndEnds = [];
        $t = array_values($times);
        for ($i = 0; $i < $int; $i++) {
            $shifts[] = HtmlTags::Th()->Content(
                $t[$i]
            )->Attrs(['colspan' => 3]);
            $startAndEnds[] = HtmlTags::Th()->Content(
                "وضعیت"
            );
            $startAndEnds[] = HtmlTags::Th()->Content(
                "شروع"
            );
            $startAndEnds[] = HtmlTags::Th()->Content(
                "پایان"
            );
        }
        $editShifts = json_decode($this->getData()->shifts, true);
        foreach (DayHelper::toArray() as $dayName => $day) {
            $output[] = HtmlTags::Tr()->Content(
                HtmlTags::Td()->Content(
                    $day
                ),
                function () use ($int, $day, $dayName, $times, $editShifts) {
                    $output = [];
                    $time = array_keys($times);
                    for ($i = 0; $i < $int; $i++) {

                        $output[] = HtmlTags::Td()->Content(
                            HtmlTags::Input('.workHourCheckbox')
                                ->Attrs(['checked' => isset($editShifts[$dayName][$time[$i]])])
                                ->Type('checkbox')->Name("provider_branch_shift[checkbox][$dayName][]")->Value($time[$i])
                        );
                        $output[] = HtmlTags::Td()->Content(
                            $this->Html()->Time("provider_branch_shift[dayInfo][$dayName][$time[$i]][start]")
                                ->Disabled(!isset($editShifts[$dayName][$time[$i]]))->Data_('shift', $time[$i])->Required(false)
                                ->Value(($editShifts) ? "{$editShifts[$dayName][$time[$i]]['start']}" : '')
                        );
                        $output[] = HtmlTags::Td()->Content(
                            $this->Html()->
                            Time("provider_branch_shift[dayInfo][$dayName][$time[$i]][end]")
                                ->Disabled(!isset($editShifts[$dayName][$time[$i]]))
                                ->Data_('shift', $time[$i])->Required(false)
                                ->Value(($editShifts) ? "{$editShifts[$dayName][$time[$i]]['end']}" : '')
                        );
                    }
                    return $output;
                }
            );
        }
        $this->initDataTable = false;
        return HtmlTags::Table('.table.table-striped.table-bordered')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Attrs(['rowspan' => 2])->Content(
                        "#"
                    ),
                    $shifts
                ),
                HtmlTags::Tr()->Content(
//					HtmlTags::Th(),
                    $startAndEnds
                )
            ),
            HtmlTags::Tbody()->Content(
                $output
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
