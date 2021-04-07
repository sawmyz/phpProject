<?

namespace view;

use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwAuthSystem\Main\UserObject;
use model\Customers;
use model\Entity\GuaranteeBirthCertificateEntity;
use model\Entity\GuaranteeCertificateRightsEntity;
use model\Entity\GuaranteeChecksEntity;
use model\Entity\GuaranteeContractsEntity;
use model\Entity\GuaranteeGuarantorChecksEntity;
use model\Entity\GuaranteeGuarantorRightsCertificatesEntity;
use model\Entity\GuaranteeIdentitysEntity;
use model\Entity\GuaranteeNationalCardEntity;
use model\Entity\GuaranteePromissoryEntity;
use model\Entity\IndividualsEntity;
use model\Entity\SocialMediasEntity;
use model\IdentificationReference;
use model\Individuals;
use View;

class GuaranteeDocumentsConfirm extends View
{

    public $SingularName = 'تایید خرید اعتباری';
    public $PluralName = 'تایید خرید اعتباری';


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
                                                                    HtmlTags::Th('شماره پرونده'),
                                                                    HtmlTags::Th('مشتری'),
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                $this->show([
                                                                    'credit_file_filenumber',
                                                                    'customer_id' => function ($item) {
                                                                        $name = \model\Customers::get($item)->individual_id;
                                                                        $name = \model\Individuals::get($name);
                                                                        return $name->individual_first_name . ' ' . $name->individual_last_name;
                                                                    },
                                                                ], false, false,false
                                                                    , function ($item) {
                                                                    return HtmlTags::Button('.btn.btn-warning.m-1.ajax')->Content(
                                                                        HtmlTags::I('.fa.fa-check-square.m-1')
                                                                    )->Data_('toggle', 'tooltip')->Title('تعیین وضعیت پرونده')->Rel((new \controller\GuaranteeDocumentsConfirm())->RelPath(['documents_id' => $item->guarantee_documents_id
                                                                    ]));
                                                                }
                                                                )
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


        $documentRow = '';
        if ($_GET['documents_id']) {
            $documentRow = '<option value="" disabled selected >یک گزینه را انتخاب کنید</option>';
            $documentData = \model\GuaranteeDocuments::get($_GET['documents_id']);
            $name = Individuals::get(Customers::get($documentData->customer_id)->individual_id);
            $documentRow .= '<option value="' . $documentData->guarantee_documents_id . '">' . $documentData->credit_file_filenumber .' - '.$name->individual_first_name.' '.$name->individual_last_name .'</option>';
        }
        else {
            $documentRow =   \model\GuaranteeDocuments::toOptionNotComplete();
        }


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
                                        $this->Html()->Label('انتخاب پرونده (شماره پرونده - نام و نام خانوادگی )') .
                                        $this->Html()->Select('guarantee_documents_id', 'guarantee_documents_id', $documentRow ) .
//                                        $this->Html()->Select('guarantee_documents_id', 'guarantee_documents_id', \model\GuaranteeDocuments::toOptionNotComplete()) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('اعتبار درخواستی') .
                                        $this->Html()->Input('credit_file_requested_credit', 'credit_file_requested_credit', '', false) .  //x
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('باز پرداخت') .
                                        $this->Html()->Input('credit_file_refund', 'credit_file_refund', '', false) .  //y
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('سود ماهیانه') .
                                        $this->Html()->Input('credit_file_monthly_profit', 'credit_file_monthly_profit', '', false) .   //z
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مبلغ پرداخت ماهیانه') .
                                        $this->Html()->Input('credit_file_payment_amount', 'credit_file_payment_amount', '', false) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('مبلغ چک تضمیتی') .
                                        $this->Html()->Input('credit_file_guaranteed_check', 'credit_file_guaranteed_check', '', false) .
                                        $this->Html()->FormGroupEnd() .

                                        $this->Html()->FormGroupStart(4) .
                                        $this->Html()->Label('شماره پرونده') .
                                        $this->Html()->Input('credit_file_filenumber', 'credit_file_filenumber', '', false) .
                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <br> 
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="birthBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات شناسنامه <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'birthArea') .
                                        $this->TableBirthCertificate() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'birthArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('birth_certificate_desc', 'birth_certificate_desc') .
//                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="nationalCardBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات کارت ملی  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'nationalCardArea') .
                                        $this->TableNationalCard() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'nationalCardArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('national_card_desc', 'national_card_desc') .
//                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="certificateRightBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات گواهی کسر از حقوق  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'certificateRightArea') .
                                        $this->TableCertificateRights() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'certificateRightArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('certificate_rights_desc', 'certificate_rights_desc') .
//                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="contractBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات قرارداد مشتری  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'contractArea') .
                                        $this->TableContract() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'contractArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('contract_desc', 'contract_desc') .
//                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="checkBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات چک تضمین  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'checkArea') .
                                        $this->TableCheck() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'checkArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('check_desc', 'check_desc') .
//                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="promissoryBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات سفته تضمین  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'promissoryArea') .
                                        $this->TablePromissory() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'promissoryArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('promissory_desc', 'promissory_desc') .
//                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="guarantorCheckBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات چک ضامن  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'guarantorCheckArea') .
                                        $this->TableGuarantorCheck() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'guarantorCheckArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('guarantor_check_desc', 'guarantor_check_desc') .
//                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="IdentityBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات فرم احراز هویت  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'IdentityArea') .
                                        $this->TableIdentity() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'IdentityArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('Identity_dsec', 'Identity_dsec') .
//                                        $this->Html()->FormGroupEnd() .


                                        $this->Html()->FormGroupStart(12) .
                                        '
                                         <div class="creditBox">
                                          <div class="card text-white" style="background-color: #41b8cc">
                                          <div id="guarantorRightBTN"  class="btn btn-outline-dark col-12 font-weight-bold btn-lg">  تصویر و اطلاعات کسر از حقوق ضامن  <span class="badge badge-warning">کلیک کنید</span></div>
                                        
                                           </div>
                                           </div>
                                         ' .
                                        $this->Html()->FormGroupEnd() .
                                        $this->Html()->FormGroupStart(12, 'guarantorRightsArea') .
                                        $this->TableGuarantorRightsCertificate() .
                                        $this->Html()->FormGroupEnd() .
//                                        $this->Html()->FormGroupStart(12, '', 'guarantorRightsArea') .
//                                        $this->Html()->Label('دلایل رد مدرک') .
//                                        $this->Html()->TextArea('guarantor_rights_certificate_desc', 'guarantor_rights_certificate_desc') .
//                                        $this->Html()->FormGroupEnd() .

                                        hiddenInput('', 'birth_certificate_desc', 'birth_certificate_desc') .
                                        hiddenInput('0', 'birth_certificate_status', 'birth_certificate_status') .
                                        hiddenInput('', 'certificate_rights_desc', 'certificate_rights_desc') .
                                        hiddenInput('0', 'certificate_rights_status', 'certificate_rights_status') .
                                        hiddenInput('', 'national_card_desc', 'national_card_desc') .
                                        hiddenInput('0', 'national_card_status', 'national_card_status') .
                                        hiddenInput('', 'contract_desc', 'contract_desc') .
                                        hiddenInput('0', 'contract_status', 'contract_status') .
                                        hiddenInput('', 'check_desc', 'check_desc') .
                                        hiddenInput('0', 'check_status', 'check_status') .
                                        hiddenInput('', 'promissory_desc', 'promissory_desc') .
                                        hiddenInput('0', 'promissory_status', 'promissory_status') .
                                        hiddenInput('', 'guarantor_check_desc', 'guarantor_check_desc') .
                                        hiddenInput('0', 'guarantor_check_status', 'guarantor_check_status') .
                                        hiddenInput('', 'Identity_desc', 'Identity_desc') .
                                        hiddenInput('0', 'Identity_status', 'Identity_status') .
                                        hiddenInput('', 'guarantor_rights_certificate_desc', 'guarantor_rights_certificate_desc') .
                                        hiddenInput('0', 'guarantor_rights_certificate_status', 'guarantor_rights_certificate_status') .

                                        $this->Html()->CardFooter()
//                                        '<button type="submit" id="mySubmit" name="submit" class="btn btn-primary pull-left  "><i class="fa fa-plus"></i>
//                                          ابتدا وضعیت مدارک را تایید کنید
//                                         </button>'
                                        .
                                        '<div id="myModal" class="modal" style="
                                          display: none; 
                                          position: fixed; 
                                          padding-top: 100px; 
                                          left: 0;
                                          top: 0;
                                          width: 100%; 
                                          height: 100%; 
                                          overflow: auto; 
                                          background-color: rgb(0,0,0); 
                                          background-color: rgba(0,0,0,0.9); ">
                                          <span id="closeModel" class="close" style="position: absolute;
                                          top: 15px;
                                          right: 35px;
                                          color: #f1f1f1;
                                          font-size: 40px;
                                          font-weight: bold;
                                          transition: 0.3s;">&times;</span>
                                          <img class="modal-content" id="img01"style="width: 80%;margin: auto">
                                          <div id="caption" style=" margin: auto;
                                          display: block;
                                          width: 80%;
                                          max-width: 700px;
                                          text-align: center;
                                          color: #ccc;
                                          padding: 10px 0;
                                          height: 150px;
                                          -webkit-animation-name: zoom;
                                          -webkit-animation-duration: 0.6s;
                                          animation-name: zoom;
                                          animation-duration: 0.6s;"></div>
                                         </div>'

                                    )
                            )
                        )
                );
    }

    private function TableBirthCertificate()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر شناسنامه")->Width('200'),
                    HtmlTags::Th()->Content("شماره شناسنامه"),
                    HtmlTags::Th()->Content("تاریخ تولد"),
                    HtmlTags::Th()->Content("محل تولد"),
                    HtmlTags::Th()->Content("نام پدر"),
                    HtmlTags::Th()->Content("سریال شناسنامه"),
                    HtmlTags::Th()->Content("رد مدرک")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteeBirthCertificateEntity $BirthCertificate */
                    foreach (\model\GuaranteeBirthCertificate::getAll() as $BirthCertificate) {
                        if ($BirthCertificate->birth_certificate_status == 0 ){
                            $status = 'warning';
                        }else if ($BirthCertificate->birth_certificate_status == 1){
                            $status = 'success';
                        }else if ($BirthCertificate->birth_certificate_status == 2){
                            $status = 'danger';
                        }

                        $image = $BirthCertificate->birth_certificate_image;
                        $row++;
                        $output[] = HtmlTags::Tr('.filterBirth')->Data_('birthId', $BirthCertificate->guarantee_birth_certificate_id)->Data_('documentId', $BirthCertificate->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="birthImg" class="birthImg" src="src/images/GuaranteeBirthCertificate/' . $image . '" style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $BirthCertificate->birth_certificate_number
                            ),
                            HtmlTags::Td()->Content(
                                $BirthCertificate->birth_certificate_date
                            ),
                            HtmlTags::Td()->Content(
                                $BirthCertificate->birth_certificate_place
                            ),
                            HtmlTags::Td()->Content(
                                $BirthCertificate->birth_certificate_father_name
                            ),
                            HtmlTags::Td()->Content(
                                $BirthCertificate->birth_certificate_serial
                            ),
                            HtmlTags::Td()->Content(

                                '<button type="button"  class="birth_certificate_check btn btn-'.$status.' m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'


//                                HtmlTags::Input()
//                                    ->Attrs(['checked' => isset($data[$BirthCertificate->birth_certificate_status])])
//                                    ->Type('checkbox')->Name('birth_certificate_status')->Class('BirthCertificateCheckBox')
                            )
                        );
                    }
                    return $output;
                }
            )
        );

    }

    private function TableNationalCard()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر کارت ملی")->Width('200'),
                    HtmlTags::Th()->Content("کد ملی"),
                    HtmlTags::Th()->Content("تاریخ انقضا کارت ملی"),
                    HtmlTags::Th()->Content("تعیین وضعیت")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteeNationalCardEntity $NationalCard */
                    foreach (\model\GuaranteeNationalCard::getAll() as $NationalCard) {
                        if ($NationalCard->national_card_status == 0 ){
                            $status = 'warning';
                        }else if ($NationalCard->national_card_status == 1){
                            $status = 'success';
                        }else if ($NationalCard->national_card_status == 2){
                            $status = 'danger';
                        }

                        $image = $NationalCard->national_card_image;
                        $row++;
                        $output[] = HtmlTags::Tr('.filterNationalCard')->Data_('documentId', $NationalCard->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="nationalImg" class="nationalImg" src="src/images/GuaranteeNationalCard/' . $image . '" style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $NationalCard->national_card_number
                            ),
                            HtmlTags::Td()->Content(
                                $NationalCard->national_card_expiration
                            ),
                            HtmlTags::Td()->Content(
                                '<button type="button" class="national_card_check btn btn-'.$status.' m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'

                            )
                        );
                    }
                    return $output;
                }
            )
        );
    }

    private function TableCertificateRights()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر گواهی کسر از حقوق")->Width('200'),
                    HtmlTags::Th()->Content("تاریخ اشتغال به کار"),
                    HtmlTags::Th()->Content("تاریخ صدور گواهی"),
                    HtmlTags::Th()->Content("صادر کننده گواهی"),
                    HtmlTags::Th()->Content("میزان حقوق"),
                    HtmlTags::Th()->Content("رد مدرک")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteeCertificateRightsEntity $socialMedia */
                    foreach (\model\GuaranteeCertificateRights::getAll() as $CertificateRights) {
                        if ($CertificateRights->guarantee_certificate_rights_status == 0 ){
                            $status = 'warning';
                        }else if ($CertificateRights->guarantee_certificate_rights_status == 1){
                            $status = 'success';
                        }else if ($CertificateRights->guarantee_certificate_rights_status == 2){
                            $status = 'danger';
                        }

                        $image = $CertificateRights->guarantee_certificate_rights_image;
                        $row++;
                        $output[] = HtmlTags::Tr('.filterCertificateRights')->Data_('documentId', $CertificateRights->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="RightsImg" class="RightsImg" src="src/images/GuaranteeCertificateRights/' . $image . '"style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $CertificateRights->certificate_rights_date_from
                            ),
                            HtmlTags::Td()->Content(
                                $CertificateRights->certificate_rights_date_to
                            ),
                            HtmlTags::Td()->Content(
                                $CertificateRights->certificate_rights_exporter
                            ),
                            HtmlTags::Td()->Content(
                                $CertificateRights->certificate_rights_price
                            ),
                            HtmlTags::Td()->Content(
                                '<button type="button" class="certificate_rights_check btn btn-'.$status.' m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'

                            )
                        );
                    }
                    return $output;
                }
            )
        );
    }

    private function TableContract()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر قرارداد مشتری")->Width('200'),
                    HtmlTags::Th()->Content("تاریخ تنظیم قرارداد"),
                    HtmlTags::Th()->Content("شماره قرارداد"),
                    HtmlTags::Th()->Content("رد مدرک")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteeContractsEntity $Contract */
                    foreach (\model\GuaranteeContracts::getAll() as $Contract) {
                        if ($Contract->contract_status == 0 ){
                            $status = 'warning';
                        }else if ($Contract->contract_status == 1){
                            $status = 'success';
                        }else if ($Contract->contract_status == 2){
                            $status = 'danger';
                        }


                        $image = $Contract->contract_image;
                        $row++;
                        $output[] = HtmlTags::Tr('.filterContract')->Data_('documentId', $Contract->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="contractImg" class="contractImg" src="src/images/GuaranteeContracts/' . $image . '"style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $Contract->contract_date
                            ),
                            HtmlTags::Td()->Content(
                                $Contract->contract_number
                            ),
                            HtmlTags::Td()->Content(
                                '<button type="button" class="contract_check btn btn-'.$status.' m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'
                            )
                        );
                    }
                    return $output;
                }
            )
        );
    }

    private function TableCheck()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر چک تضمین")->Width('200'),
                    HtmlTags::Th()->Content("نام صاحب حساب"),
                    HtmlTags::Th()->Content("نام بانک صادر کننده چک"),
                    HtmlTags::Th()->Content("شعبه بانک"),
                    HtmlTags::Th()->Content("کد بانک"),
                    HtmlTags::Th()->Content("مبلغ چک"),
                    HtmlTags::Th()->Content("شماره چک"),
//                    HtmlTags::Th()->Content("تاریخ سر رسید چک"),
                    HtmlTags::Th()->Content("رد مدرک")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteeChecksEntity $Check */
                    foreach (\model\GuaranteeChecks::getAll() as $Check) {
                        if ($Check->check_status == 0 ){
                            $status = 'warning';
                        }else if ($Check->check_status == 1){
                            $status = 'success';
                        }else if ($Check->check_status == 2){
                            $status = 'danger';
                        }


                        $image = $Check->check_image;
                        $row++;
                        $output[] = HtmlTags::Tr('.filterCheck')->Data_('documentId', $Check->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="checksImg" class="checksImg" src="src/images/GuaranteeChecks/' . $image . '"style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $Check->check_account_owner
                            ),
                            HtmlTags::Td()->Content(
                                $Check->check_bank_name
                            ),
                            HtmlTags::Td()->Content(
                                $Check->check_branch_name
                            ),
                            HtmlTags::Td()->Content(
                                $Check->check_bank_code
                            ),
                            HtmlTags::Td()->Content(
                                $Check->check_price
                            ),
                            HtmlTags::Td()->Content(
                                $Check->check_number
                            ),
                            HtmlTags::Td()->Content(
                                '<button type="button" class="check_check btn btn-'.$status.' m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'
                            )
                        );
                    }
                    return $output;
                }
            )
        );
    }

    private function TablePromissory()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر سفته")->Width('200'),
                    HtmlTags::Th()->Content("مبلغ سفته"),
                    HtmlTags::Th()->Content("شماره سفته"),
                    HtmlTags::Th()->Content("نام صادر کننده سفته"),
                    HtmlTags::Th()->Content("رد مدرک")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteePromissoryEntity $Promissory */
                    foreach (\model\GuaranteePromissory::getAll() as $Promissory) {
                        if ($Promissory->promissory_status == 0 ){
                            $status = 'warning';
                        }else if ($Promissory->promissory_status == 1){
                            $status = 'success';
                        }else if ($Promissory->promissory_status == 2){
                            $status = 'danger';
                        }


                        $image = $Promissory->promissory_image;

                        $row++;
                        $output[] = HtmlTags::Tr('.filterPromissory')->Data_('documentId', $Promissory->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="promissoryImg" class="promissoryImg" src="src/images/GuaranteePromissory/' . $image . '" style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $Promissory->promissory_price
                            ),
                            HtmlTags::Td()->Content(
                                $Promissory->promissory_number
                            ),
                            HtmlTags::Td()->Content(
                                $Promissory->promissory_exporter_name
                            ),
                            HtmlTags::Td()->Content(
                                '<button type="button" class="promissory_check btn btn-'.$status.' m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'
                            )
                        );
                    }
                    return $output;
                }
            )
        );
    }

    private function TableGuarantorCheck()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر چک ضامن")->Width('200'),
                    HtmlTags::Th()->Content("نام ضامن"),
                    HtmlTags::Th()->Content("نام بانک صادر کننده چک"),
                    HtmlTags::Th()->Content("شعبه بانک"),
                    HtmlTags::Th()->Content("کد بانک"),
                    HtmlTags::Th()->Content("مبلغ چک ضامن"),
                    HtmlTags::Th()->Content("شماره چک ضامن"),
                    HtmlTags::Th()->Content("رد مدرک")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteeGuarantorChecksEntity $GuarantorChecks */
                    foreach (\model\GuaranteeGuarantorChecks::getAll() as $GuarantorChecks) {
                        if ($GuarantorChecks->guarantor_check_status == 0 ){
                            $status = 'warning';
                        }else if ($GuarantorChecks->guarantor_check_status == 1){
                            $status = 'success';
                        }else if ($GuarantorChecks->guarantor_check_status == 2){
                            $status = 'danger';
                        }


                        $image = $GuarantorChecks->guarantor_check_image;
                        $row++;
                        $output[] = HtmlTags::Tr('.filterGuarantorChecks')->Data_('documentId', $GuarantorChecks->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="guarantorCheckImg" class="guarantorCheckImg" src="src/images/GuaranteeGuarantorChecks/' . $image . '"style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorChecks->guarantor_check_bank_name
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorChecks->guarantor_account_owner
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorChecks->guarantor_check_branch_name
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorChecks->guarantor_bank_code
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorChecks->guarantor_check_price
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorChecks->guarantor_number
                            ),
                            HtmlTags::Td()->Content(
                                '<button type="button" class="guarantor_check_check btn btn-warning m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'
                            )
                        );
                    }
                    return $output;
                }
            )
        );
    }

    private function TableIdentity()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر فرم احراز هویت")->Width('200'),
                    HtmlTags::Th()->Content("کد پیگیری"),
                    HtmlTags::Th()->Content("مرجع احراز هویت"),
                    HtmlTags::Th()->Content("رد مدرک")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteeIdentitysEntity $Identitys */
                    foreach (\model\GuaranteeIdentitys::getAll() as $Identitys) {
                        if ($Identitys->Identity_status == 0 ){
                            $status = 'warning';
                        }else if ($Identitys->Identity_status == 1){
                            $status = 'success';
                        }else if ($Identitys->Identity_status == 2){
                            $status = 'danger';
                        }


                        $image = $Identitys->Identity_image;
                        $row++;
                        $output[] = HtmlTags::Tr('.filterIdentitys')->Data_('documentId', $Identitys->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="identityImg" class="identityImg" src="src/images/GuaranteeIdentitys/' . $image . '"style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $Identitys->Identity_code
                            ),
                            HtmlTags::Td()->Content(
                                IdentificationReference::get($Identitys->identification_reference_id)->identification_reference_name
                            ),
                            HtmlTags::Td()->Content(
                                '<button type="button" class="Identity_check btn btn-'.$status.' m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'
                            )
                        );
                    }
                    return $output;
                }
            )
        );
    }

    private function TableGuarantorRightsCertificate()
    {
        $data = json_decode($this->getData()->social_media_ids, true);
        $this->initDataTable = false;

        return HtmlTags::Table('.table.table-bordered.table-striped')->Content(
            HtmlTags::Thead()->Content(
                HtmlTags::Tr()->Content(
                    HtmlTags::Th()->Content("تصویر گواهی کسر از حقوق ضامن"),
                    HtmlTags::Th()->Content("نام ضامن"),
                    HtmlTags::Th()->Content("نام خانوادگی ضامن"),
                    HtmlTags::Th()->Content("کد ملی ضامن"),
                    HtmlTags::Th()->Content("تاریخ اشتغال ضامن"),
                    HtmlTags::Th()->Content("تاریخ صدور"),
                    HtmlTags::Th()->Content("صادر کننده"),
                    HtmlTags::Th()->Content("حقوق دریافتی ضامن"),
                    HtmlTags::Th()->Content("شماره فیش حقوقی ضامن"),
                    HtmlTags::Th()->Content("رد مدرک")->Width('100')
                )
            ),
            HtmlTags::Tbody()->Content(

                function () use ($data) {
                    $row = '0';
                    $output = [];
                    $status = '';
                    /** @var GuaranteeGuarantorRightsCertificatesEntity $GuarantorRightsCertificate */
                    foreach (\model\GuaranteeGuarantorRightsCertificates::getAll() as $GuarantorRightsCertificate) {
                        if ($GuarantorRightsCertificate->guarantor_rights_certificate_status == 0 ){
                            $status = 'warning';
                        }else if ($GuarantorRightsCertificate->guarantor_rights_certificate_status == 1){
                            $status = 'success';
                        }else if ($GuarantorRightsCertificate->guarantor_rights_certificate_status == 2){
                            $status = 'danger';
                        }


                        $image = $GuarantorRightsCertificate->guarantor_rights_certificate_image;
                        $row++;
                        $output[] = HtmlTags::Tr('.filterGuarantorRightsCertificate')->Data_('documentId', $GuarantorRightsCertificate->guarantee_documents_id)->Content(

                            HtmlTags::Td()->Content(
                                '<span class="badge badge-success">برای مشاهده روی عکس کلیک کنید</span><br>' .
                                '<img id="guarantorRightImg"  class="guarantorRightImg" src="src/images/GuaranteeGuarantorRightsCertificates/' . $image . '"style="width: 100px;height=100px">'
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorRightsCertificate->guarantor_rights_certificate_fname
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorRightsCertificate->guarantor_rights_certificate_lname
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorRightsCertificate->guarantor_rights_certificate_national_code
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorRightsCertificate->guarantor_rights_certificate_date_from
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorRightsCertificate->guarantor_rights_certificate_date_to
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorRightsCertificate->guarantor_rights_certificate_exporter
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorRightsCertificate->guarantor_rights_certificate_price
                            ),
                            HtmlTags::Td()->Content(
                                $GuarantorRightsCertificate->guarantor_rights_certificate_receipt_number
                            ),
                            HtmlTags::Td()->Content(
                                '<button type="button" class="guarantor_rights_certificate_check btn btn-'.$status.' m-auto">
                                 <i class="fa fa-check-square p-1" ></i>
                                 <i class="fa fa-times-rectangle p-1" ></i><br> تعیین وضعیت</button>'
                            )
                        );
                    }
                    return $output;
                }
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
