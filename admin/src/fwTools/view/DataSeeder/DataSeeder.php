<?
use FwHtml\Elements\Tags\Main\HtmlTags;
$View = new View('Data Seeder');

$Trs = '';
foreach ($View->getData() as $table => $data){
    $Trs .= HtmlTags::Tr()->Content(
      HtmlTags::Td(),
      HtmlTags::Td($data->name),
      HtmlTags::Td($data->count),
      HtmlTags::Td()->Content(
          HtmlTags::Button('.btn.btn-success.ajax[data-toggle=tooltip][title=شروع وارد کردن دیتا]')->Attrs([
              'rel' => 'DataSeeder/editDataSeeder.fwTools?table='.$table
          ])
            ->Content(
                HtmlTags::I('.fa.fa-database')
            )
      )
    );
}
echo HtmlTags::Section('.content')
    ->Content(
        HtmlTags::Div('.row')
            ->Content(
                HtmlTags::Div('.col-md-12')->Content(
                    HtmlTags::Div('.card.card-primary.card-outline')
                        ->Content(
                            HtmlTags::Div('.card-header')
                                ->Content(
                                    $View->CardTitle()
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
                                                        HtmlTags::Th('تعداد فیلد ها'),
                                                        HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                    )
                                                ),
                                            HtmlTags::Tbody()
                                                ->Content(
                                                    $Trs
                                                )
                                        )
                                )
                        )
                )
            )
    );
