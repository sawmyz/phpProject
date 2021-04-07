<? //
namespace view;

use View;
use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;

class GuaranteeDocuments extends View {
	
	public $SingularName = 'اسناد تضمین اعتبار';
	
	
	public function main(Document &$document) {
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
																	HtmlTags::Th('وضعیت')->Width('150'),
																	HtmlTags::Th('.no-sort عملیات')->Width('200')
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
																	'guarantee_documents_status'
																	              => function ($item) {
																		if ($item == 0) {
																			return ' <div class="card bg-primary text-white">
                                                                                     <div class="card-body">پرونده در حال بررسی</div>';
																		} elseif ($item == -1) {
																			return ' <div class="card bg-danger text-white">
                                                                                     <div class="card-body">نقص مدارک پرونده</div>';
																		} elseif ($item == 1) {
																			return ' <div class="card bg-success text-white">
                                                                                     <div class="card-body">پرونده تایید شده</div>';
																		}
																	},
																], false)
															)
													)
											)
									)
							)
						)
				);
	}
	
	public function add(Document &$document) {
		$document->html = $this->Form();
	}
	
	public function Form() {
		
		return
			$this->Html()->BreadCrumbs() . HtmlTags::Section('.content')
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
										HtmlTags::Div('.card.card-info.w-100#tab_1')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات اسناد تضمین اعتبار'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'customer_id', 'customer_id') .
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id') .
													$this->Html()->FormGroupStart(12) .
													$this->Html()->Label(' نام و نام خانوادگی ') .
													$this->Html()->Select('credit_file_id', 'credit_file_id', \model\CreditFile::toOption()) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('اعتبار درخواستی') .
													$this->Html()->Input('credit_file_requested_credit', 'credit_file_requested_credit', '', false, true) .  //x
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('باز پرداخت') .
													$this->Html()->Input('credit_file_refund', 'credit_file_refund', '', false, true) .  //y
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('سود ماهیانه') .
													$this->Html()->Percent('credit_file_monthly_profit', 'credit_file_monthly_profit', '', false, true) .   //z
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('مبلغ پرداخت ماهیانه') .
													$this->Html()->Input('credit_file_payment_amount', 'credit_file_payment_amount', '', false, true) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('مبلغ چک تضمینی') .
													$this->Html()->Input('credit_file_guaranteed_check', 'credit_file_guaranteed_check', '', false, 'true') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4, '', 'credit_file_filenumber_div') .
													$this->Html()->Label('شماره پرونده') .
													$this->Html()->Number('credit_file_filenumber', 'credit_file_filenumber', '', '', false, 'form-control', 'text', 'readonly') .
													$this->Html()->FormGroupEnd()
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
										HtmlTags::Div('.card.card-info.w-100#tab_2')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات شناسنامه'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('شناسنامه') .
													$this->Html()->ImageInput('birth_certificate_image', 'image/jpeg') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('شماره شناسنامه ') .
//													$this->Html()->Number('birth_certificate_number')->Required(true) .
													$this->Html()->Number('birth_certificate_number') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('تاریخ تولد') .
													$this->Html()->Input('birth_certificate_date') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('محل تولد') .
													$this->Html()->Input('birth_certificate_place') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام پدر') .
													$this->Html()->Input('birth_certificate_father_name') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('سریال شناسنامه') .
													$this->Html()->Number('birth_certificate_serial') .
													$this->Html()->FormGroupEnd()
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
//
										HtmlTags::Div('.card.card-info.w-100#tab_3')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات کارت ملی'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('کارت ملی') .
													$this->Html()->ImageInput('national_card_image', 'image/jpeg', 150, 300, 'false', 'guarantee_national_card', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('کد ملی ') .
													$this->Html()->Input('national_card_number') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label(' انقضا') .
													$this->Html()->Input('national_card_expiration') .
													$this->Html()->FormGroupEnd()
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
//
										HtmlTags::Div('.card.card-info.w-100#tab_4')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات گواهی کسر از حقوق'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('گواهی کسر از حقوق') .
													$this->Html()->ImageInput('guarantee_certificate_rights_image', 'image/jpeg') .
													$this->Html()->FormGroupEnd() .
//
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('شروع تاریخ ') .
													$this->Html()->Input('certificate_rights_date_from') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('پایان تاریخ ') .
													$this->Html()->Input('certificate_rights_date_to') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('صادر کننده ') .
													$this->Html()->Input('certificate_rights_exporter') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('مبلغ ') .
													$this->Html()->Price('certificate_rights_price') .
													$this->Html()->FormGroupEnd()
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
										HtmlTags::Div('.card.card-info.w-100#tab_5')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات قرارداد مشتری'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('قرارداد مشتری') .
													$this->Html()->ImageInput('contract_image', 'image/jpeg', 150, 300, 'false', 'guarantee_contract', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('تاریخ ') .
													$this->Html()->Input('contract_date') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('شماره ') .
													$this->Html()->Number('contract_number') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(12) .
													$this->Html()->Label('توضیحات ') .
													$this->Html()->TextArea('contract_desc') .
													$this->Html()->FormGroupEnd()
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
										HtmlTags::Div('.card.card-info.w-100#tab_6')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات چک تضمین'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('چک تضمین') .
													$this->Html()->ImageInput('check_image', 'image/jpeg', 150, 300, 'false', 'guarantee_check', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام بانک ') .
													$this->Html()->Select('bank_id', 'bank_id', \model\Banks::toOption(), false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام شعبه بانک ') .
													$this->Html()->Input('check_branch_name', 'check_branch_name', '', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('مبلغ ') .
													$this->Html()->Price('check_price', 'check_price', 'تومان', '', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('کد بانک ') .
													$this->Html()->Number('check_bank_code', 'check_bank_code', '', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('شماره حساب ') .
													$this->Html()->Number('check_account_number', 'check_account_number', '', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label(' شماره چک ') .
													$this->Html()->Number('check_number', 'check_number', '', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام صاحب حساب ') .
													$this->Html()->Input('check_account_owner', 'check_account_owner', '', false) .
													$this->Html()->FormGroupEnd()
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
										HtmlTags::Div('.card.card-info.w-100#tab_7')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات سفته تضمین'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('سفته تضمین') .
													$this->Html()->ImageInput('promissory_image', 'image/jpeg', 150, 300, 'false', 'guarantee_promissory', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('مبلغ') .
													$this->Html()->Price('promissory_price', 'promissory_price', 'تومان', '', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label(' شماره سفته ') .
													$this->Html()->Number('promissory_number', 'promissory_number', '', false, '') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام صادر کننده ') .
													$this->Html()->Input('promissory_exporter_name', 'promissory_exporter_name', '', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(12) .
													$this->Html()->Label('توضیحات') .
													$this->Html()->TextArea('promissory_desc', 'promissory_desc', '', false) .
													$this->Html()->FormGroupEnd()
//
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
										HtmlTags::Div('.card.card-info.w-100#tab_8')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات چک ضامن'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('چک ضامن') .
													$this->Html()->ImageInput('guarantor_check_bank_image', 'image/jpeg', 150, 300, 'false', 'guarantor_check_bank_image', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام بانک ') .
													$this->Html()->Select('bank_id', 'bank_id', \model\Banks::toOption()) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام شعبه بانک ') .
													$this->Html()->Input('guarantor_check_branch_name') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('مبلغ ') .
													$this->Html()->Price('guarantor_check_price') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('کد بانک ') .
													$this->Html()->Number('guarantor_bank_code') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('شماره حساب ') .
													$this->Html()->Number('guarantor_account_number') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label(' شماره چک ') .
													$this->Html()->Number('guarantor_number') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام صاحب حساب ') .
													$this->Html()->Input('guarantor_account_owner') .
													$this->Html()->FormGroupEnd()
//
//
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
										HtmlTags::Div('.card.card-info.w-100#tab_9')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات فرم احراز هویت'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('فرم احراز هویت') .
													$this->Html()->ImageInput('guarantee_Identity', 'image/jpeg', 150, 300, 'false', 'guarantee_Identity', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('مرجع احراز هویت ') .
													$this->Html()->Select('identification_reference_id', 'identification_reference_id', \model\IdentificationReference::toOption()) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('کد پیگیری') .
													$this->Html()->Input('Identity_code') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupEnd()
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
										HtmlTags::Div('.card.card-info.w-100#tab_10')->Content(
											HtmlTags::Div('.card-header')->Content(
												'اطلاعات کسر از حقوق ضامن'
											) .
											HtmlTags::Div('.card-body.d-flex.flex-wrap.table-responsive')
												->Content(
													hiddenInput('', 'guarantee_documents_id', 'guarantee_documents_id_1') .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('کسر از حقوق ضامن') .
													$this->Html()->ImageInput('guarantee_guarantor_rights_certificate_id', 'image/jpeg', 150, 300, 'false', 'guarantee_guarantor_rights_certificate', false) .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('نام ضامن') .
													$this->Html()->Input('guarantor_rights_certificate_fname') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label(' نام خانوادگی ضامن') .
													$this->Html()->Input('guarantor_rights_certificate_lname') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('  کد ملی ضامن') .
													$this->Html()->Input('guarantor_rights_certificate_national_code') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('  تاریخ شروع ') .
													$this->Html()->Input('guarantor_rights_certificate_date_from') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('تاریخ پایان') .
													$this->Html()->Input('guarantor_rights_certificate_date_to') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('صادر کننده') .
													$this->Html()->Input('guarantor_rights_certificate_exporter') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('شماره فیش') .
													$this->Html()->Input('guarantor_rights_certificate_receipt_number') .
													$this->Html()->FormGroupEnd() .
													$this->Html()->FormGroupStart(4) .
													$this->Html()->Label('مبلغ') .
													$this->Html()->Price('guarantor_rights_certificate_price') .
													$this->Html()->FormGroupEnd()
												),
											HtmlTags::Div('.card-footer.text-center')
												->Content('')
										) .
										'</div><div class="card-footer">
                            <button type="button" id="next" class="btn btn-primary pull-left">
                                <span>مرحله ی بعد</span>
                                <i class="fa fa-arrow-left"></i>
                            </button>
                            <button style="display: none" type="button" id="prev" class="btn btn-secondary float-right"><i
                                        class="fa fa-arrow-right"></i>
                                <span>مرحله ی قبل</span>
                            </button>
                                <button style="display: none" type="button" id="sabt" class="btn btn-success float-left"><i
                                        class="fa fa-check"></i>
                                <span>ثبت نهایی</span>
                            </button>
                        </div>
                    </form>'
									)
							)
						)
				);
	}

//
	public function edit(Document &$document) {
		$this->doFill();
		$document->html = $this->Form();
	}
	
	public function delete(Document &$document) {
		$this->doFill();
		$this->doDisableAll();
		$document->html = $this->Form();
	}
	
	public function view(Document &$document) {
		$this->doFill();
		$this->doDisableAll();
		$document->html = $this->Form();
	}

//
}
