<?

namespace view;

use View;
use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;

class CreditFile extends View {
	
	public $SingularName = 'درخواست تشکیل پرونده';
	
	
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
																])
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
		$uniqe = UniqueOfClass(new \model\CreditFile(), 'credit_file_filenumber', false, 6, true, false);
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
										$this->Html()->Label('نام مشتری ') .
										$this->Html()->Select('customer_id', '', \model\Customers::noCreditFileToOption()) .
										$this->Html()->FormGroupEnd() .
										$this->Html()->FormGroupStart(4) .
										$this->Html()->Label('اعتبار درخواستی') .
										$this->Html()->Price('credit_file_requested_credit') .  //x
										$this->Html()->FormGroupEnd() .
										$this->Html()->FormGroupStart(4) .
										$this->Html()->Label('باز پرداخت') .
										$this->Html()->Number('credit_file_refund') .  //y
										$this->Html()->FormGroupEnd() .
										$this->Html()->FormGroupStart(4) .
										$this->Html()->Label('سود ماهیانه') .
										$this->Html()->Input('credit_file_monthly_profit', 'credit_file_monthly_profit') .   //z
										$this->Html()->FormGroupEnd() .
										$this->Html()->FormGroupStart(4, '', 'po') .
										'<p id="p" style="color: red ; " >پر کردن فیلد های بالا قبل از محاسبه الزامیست </p>' .
										$this->Html()->FormGroupEnd() .
										$this->Html()->FormGroupStart(12) .
										HtmlTags::Div('.creditBox')->Content(
											HtmlTags::Div('.card.text-white')->Content(
												HtmlTags::Button('.btn.btn-primary.col-12.font-weight-bold.btn-lg#button')->Content(
													" محاسبه مبلغ پرداخت ماهیانه و مبلغ چک تضمینی"
												)->Type('button')
											)
										),
										$this->Html()->FormGroupEnd() .
										$this->Html()->FormGroupStart(4, '', 'payment') .
										$this->Html()->Label('مبلغ پرداخت ماهیانه') .
										$this->Html()->Input('credit_file_payment_amount', 'credit_file_payment_amount') .
										$this->Html()->FormGroupEnd() .
										$this->Html()->FormGroupStart(4, '', 'check') .
										$this->Html()->Label('مبلغ چک تضمینی') .
										$this->Html()->Price('credit_file_guaranteed_check', 'credit_file_guaranteed_check') .
										$this->Html()->FormGroupEnd() .
										$this->Html()->FormGroupStart(4, '', 'credit_file_filenumber_div') .
//                                        $this->Html()->Label('شماره پرونده') .
										$this->Html()->Input('credit_file_filenumber', 'credit_file_filenumber', $uniqe, '', '', '', '', '') .
										$this->Html()->FormGroupEnd() .
										$this->Html()->CardFooter()
									)
							)
						)
				);
	}
	
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
	
}
