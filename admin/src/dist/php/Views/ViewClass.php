<?php

namespace Views;

use ControllerScheme;
use DATABASE\Model;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwHtml\FontAwesome;
use View;

class Html extends Tags {

	protected $parent = null;

	public function __construct(View $parent) {
		$this->parent = $parent;
	}

	public function refreshAndBack() {
		$btn = '';
		if ($this->View()->State() == 'edit')
			$btn .= $this->topBtn('', 'ثبت نهایی', FontAwesome::Pencil(), 'success', true, 'final_submit_edit', false);
		return $this->backBtn() . $this->refresh() . $btn;
	}

	protected function View(): View {
		return $this->parent;
	}

	public function topBtn(string $link, string $title, FontAwesome $icon = null, string $color = 'primary', bool $outline = true, string $id = '', bool $ajax = true) {
		$ajax = ($ajax ? 'ajax' : '');
		$Object = HtmlTags::A()->Class("btn btn-" . ($outline ? 'outline-' : '') . "$color pull-left m-2 $ajax");
		$Object->Rel($link)->Content(
			HtmlTags::I('.m-1')->Class((!$icon ? FontAwesome::Refresh() : $icon)),
			$title
		);
		if ($id != '')
			$Object->Id($id);
		return $Object;
	}

	public function backBtn(bool $echo = false, string $path = '', $show = true) {
		if ($show) {
			return (($this->View()->referrer() && ($this->View()->referrer() != 'undefined') ? $this->topBtn((strlen($path) > 0 ? $path : $this->View()->referrer()), 'بازگشت', FontAwesome::Arrow_left(), 'warning', true, 'fw_back_btn') : ''));
		} else {
			return '';
		}
	}

	public function refresh(string $arg = '') {
		return $this->topBtn((strlen($arg) > 0 ? $arg : $this->View()->getThis()), 'تازه سازی', FontAwesome::Refresh(), 'primary', true, 'fw_refresh_btn');
	}

	public function CardFooter(string $btnText = '', bool $refresh = false) {
		$res = '';
		if (strpos($this->View()->State(), 'delete') !== false) {
			$btnText = $btnText != "" ? $btnText : "حذف {$this->View()->SingularName()}";

			$res = '<div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-danger mySubmit pull-left ' . ($refresh ? 'refresh' : '') . '"><i
                                    class="fa fa-trash"></i>
                                    ' . $btnText . '
                        </button>
                    </div>';
		} elseif (strpos($this->View()->State(), 'edit') !== false) {
			$btnText = $btnText != "" ? $btnText : "ویرایش {$this->View()->SingularName()}";

			$res = '<div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-success mySubmit pull-left ' . ($refresh ? 'refresh' : '') . '"><i
                                    class="fa fa-edit"></i>
                                    ' . $btnText . '
                        </button>
                    </div>';
		} elseif (strpos($this->View()->State(), 'add') !== false) {
			$btnText = $btnText != "" ? $btnText : "افزودن {$this->View()->SingularName()}";
			$res = '<div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary mySubmit pull-left  ' . ($refresh ? 'refresh' : '') . '"><i
                                    class="fa fa-plus"></i>
                                    ' . $btnText . '
                        </button>
                    </div>';
		}
//        echo nl2br(htmlentities('</div>' . $res . '</form>'));
		return '</div>' . $res . '</form>';
	}

	public function CardFooterAjax() {
		$res = '';
		if (strpos($this->View()->State(), 'delete') !== false) {
			$res = '<div class="card-footer">
                        <div class="btn btn-danger pull-left btnSubmit"><i
                                    class="fa fa-trash"></i>
                            حذف ' . $this->View()->SingularName() . '
                        </div>
                    </div>';
		} elseif (strpos($this->View()->State(), 'edit') !== false) {
			$res = '<div class="card-footer">
                        <div class="btn btn-success pull-left btnSubmit"><i
                                    class="fa fa-edit"></i>
                            ویرایش ' . $this->View()->SingularName() . '
                        </div>
                    </div>';
		} elseif (strpos($this->View()->State(), 'add') !== false) {
			$res = '<div class="card-footer">
                        <div class="btn btn-primary pull-left btnSubmit"><i
                                    class="fa fa-plus"></i>
                            افزودن ' . $this->View()->SingularName() . '
                        </div>
                    </div>';
		}
		return '</div>' . $res . '</form>';
	}

	public function CardTitle() {
		if (strpos($this->View()->State(), 'delete') !== false) {
			return '<h3 class="card-title"> حذف ' . $this->View()->SingularName() . ' - کد ' . "{$this->View()->SingularName()}: " . (en_to_fa($this->View()->getData()->{$this->View()->Controller()->model()->_key})) . '</h3>';
		} elseif (strpos($this->View()->State(), 'edit') !== false) {
			return '<h3 class="card-title"> ویرایش ' . $this->View()->SingularName() . ' - کد ' . "{$this->View()->SingularName()}: " . (en_to_fa($this->View()->getData()->{$this->View()->Controller()->model()->_key})) . '</h3>';
		} elseif (strpos($this->View()->State(), 'add') !== false) {
			return '<h3 class="card-title"> افزودن ' . $this->View()->SingularName() . ' - کد ' . "{$this->View()->SingularName()}: " . (en_to_fa($this->View()->Controller()->model()->LastId() + 1)) . '</h3>';
		} elseif (strpos($this->View()->State(), 'view') !== false) {
			return '<h3 class="card-title"> مشاهده ' . $this->View()->SingularName() . ' - کد ' . "{$this->View()->SingularName()}: " . (en_to_fa($this->View()->Controller()->model()->LastId())) . '</h3>';
		}
		return  '';
	}

	public function refreshAndAdd(string $arg = '', array $args = []) {
		return $this->refresh($arg) . $this->addBtn($args);
	}

	public function addBtn(array $args = []) {
		$link = explode('/', $this->View()->thisView);
		$link[sizeof($link) - 1] = 'add' . end($link);
		$link = implode('/', $link);
		$linkArgs = [];
		foreach ($args as $key => $arg) {
			$linkArgs[] = "$key=$arg";
		}
		$linkArgs = implode('&',$linkArgs);
		if ($linkArgs != ''){
			$link = "$link?$linkArgs";
		}
		return $this->topBtn($link, 'افزودن ' . $this->View()->SingularName(), FontAwesome::Plus());
	}

	public function BreadCrumbs(string $text = '') {
		return HtmlTags::Section('.content-header')
			->Content(
				HtmlTags::Div('.container-fluid')
					->Content(
						HtmlTags::Div('.row.mb-2')
							->Content(
								HtmlTags::Div('.col-sm-6')
									->Content(
										HtmlTags::H1(strlen($text) > 0 ? $text : "مدیریت {$this->View()->PluralName()}")
									),
								HtmlTags::Div('.col-sm-6')
									->Content(
										HtmlTags::Ol('.breadcrumb.float-sm-left')
											->Content(
												HtmlTags::Li('.breadcrumb-item')
													->Content(
														HtmlTags::A('[href=index.php]')
															->Content(
																'خانه'
															)
													),
												HtmlTags::Li('.breadcrumb-item.active')->Content(
													strlen($text) > 0 ? $text : "مدیریت {$this->View()->PluralName()}"
												)
											)
									)
							)
					)
			);
	}

//    public function __call($name, $arguments)
//    {
//        return $this->View()->$name();
//    }


	public function viewBtn($item) {


		$exploded = explode(DIRECTORY_SEPARATOR, $this->View()->thisView);
		$fileName = end($exploded);
		$edit = 'view' . $fileName;
		$exploded[sizeof($exploded) - 1] = $edit;
		$edit = implode('/', $exploded);
		$url = $edit . (strpos($edit, '?') === false ? '?' : '&') . $this->View()->Controller()->Key() . '=' . $item->{$this->View()->Controller()->Key()};
		return $this->actionBtn($url, 'مشاهده', FontAwesome::Eye(), 'btn-outline-primary');
	}

	public function actionBtn($rel, $name = '', FontAwesome $icon = null, $color = 'btn-info', $disabled = false) {
		$Object = HtmlTags::A()->Class("btn $color m-1 ajax $disabled ")->Rel($rel);
		if ($disabled)
			$Object->Disabled(true);
		$Object->Attrs([
			'data-toggle' => 'tooltip',
			'title' => $name,
		])->Content(
			HtmlTags::I('.m-1')->Class((!$icon ? FontAwesome::Eye() : $icon))
		);

		return $Object;
	}

	public function deleteBtn($data, $disabled = false) {
//        $disabled = false;
//        $model = $this->$this->View()->Controller()->model();
//        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'models/')), '/\.php$/') as $phpFile) {
//            $class = "\model\\" . getClassFromFile($phpFile->getRealPath());
//            $class = new $class();
//            if ($class instanceof Model and !($class instanceof $model)) {
//                $table = $class::table;
//                $key = $model->_key;
//                $result = FwConnection::conn()->query("SHOW COLUMNS FROM `$table` LIKE '$key'");
//                $exists = ($result->rowCount() ? TRUE : FALSE);
//                if ($exists and $class->getRow($model->_key, $data->{$model->_key})) {
//                    $disabled = true;
//                }
//            }
//        }
		$exploded = explode(DIRECTORY_SEPARATOR, $this->View()->thisView);
		$fileName = end($exploded);
		$delete = 'delete' . $fileName;
		$exploded[sizeof($exploded) - 1] = $delete;
		$delete = implode('/', $exploded);
		$url = $delete . (strpos($delete, '?') === false ? '?' : '&') . $this->View()->Controller()->Key() . '=' . $data->{$this->View()->Controller()->Key()};
		return $this->actionBtn($url, 'حذف', FontAwesome::Trash(), 'btn-outline-danger', $disabled);
	}

	public function editBtn($data) {
		$exploded = explode(DIRECTORY_SEPARATOR, $this->View()->thisView);
		$fileName = end($exploded);
		$edit = 'edit' . $fileName;
		$exploded[sizeof($exploded) - 1] = $edit;
		$edit = implode('/', $exploded);
		$url = $edit . (strpos($edit, '?') === false ? '?' : '&') . $this->View()->Controller()->Key() . '=' . $data->{$this->View()->Controller()->Key()};
		return $this->actionBtn($url, 'ویرایش', FontAwesome::Edit(), 'btn-outline-success');
	}

	public function InputGroup(string $inputName, string $inputId, string $inputGroupAppend, bool $required = true, string $value = '') {
		if ($this->View()->fill == true) {
			if (isset($this->View()->getData()->$inputName)) $value = $this->View()->getData()->$inputName;
		}
		return '<div class="input-group">
                                <input value="' . $value . '" class="form-control" name="' . $inputName . '" id="' . $inputId . '"
                                       autocomplete="off" ' . ($required ? 'required' : '') . '>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    ' . $inputGroupAppend . '
                                    </span>
                                </div>
                            </div>';
	}

	public function FormGroupStart(int $col = 4, string $addCLasses = '', string $id = '') {
		return '<div class="form-group col-md-' . $col . ' ' . $addCLasses . '" id ="' . $id . '">';
	}

	public function FormGroupEnd() {
		return '</div>';
	}

	public function activeOrDeActive($item) {
		if (isActive($this->View()->Controller(), $item)) {
			return HtmlTags::A('.btn.btn-success.text-white.float-none.status-change[data-toggle=tooltip][title=غیر فعال سازی]')
				->Content(
					HtmlTags::I()->Class(FontAwesome::Check())
				)->Attrs(['action' => 'deactivate', 'item_id' => $item->{$this->View()->Controller()->Key()}, 'table_name' => $this->View()->Controller()->model()->_table]);
		}
		return HtmlTags::A('.btn.btn-danger.text-white.float-none.status-change[data-toggle=tooltip][title=فعال سازی]')
			->Content(
				HtmlTags::I()->Class(FontAwesome::Minus())
			)->Attrs(['action' => 'activate', 'item_id' => $item->{$this->View()->Controller()->Key()}, 'table_name' => $this->View()->Controller()->model()->_table]);
	}

	public function FormStart(string $form_primary_key = 'default') {
		$controller_type = '';
		if (strpos($this->View()->State(), 'delete') !== false) {
			$controller_type = 'delete';

		} elseif (strpos($this->View()->State(), 'edit') !== false) {
			$controller_type = 'edit';

		} elseif (strpos($this->View()->State(), 'add') !== false) {
			$controller_type = 'add';
		} else {
			$controller_type = $form_primary_key;
		}
		if ($controller_type !== 'add') {
			$form_primary_key = $form_primary_key === 'default' ? $this->View()->Controller()->Key() : $form_primary_key;
		}
		return '<form action="' . $this->View()->getControllerPath() . '">' . csrf_field($this->View()->thisView) . ($controller_type === 'add' ? '' : hiddenInput($this->View()->getData()->$form_primary_key, (string)$form_primary_key)) . controllerType($controller_type) . '<div class="card-body d-flex flex-wrap table-responsive">';
	}

	public function Time(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control timeDropper', string $type = 'time', string $attrs = '') {
		if ($id === 'putSameWithName') $id = $name;
		$Object = HtmlTags::Input()->Class($classList)->Name($name)->Id($id);
		if ($required)
			$Object->Required();
		if ($disabled)
			$Object->Disabled();
		if ($value == '' and $this->View()->fill === true)
			$Object->Value("{$this->View()->getData()->$name}");
		return $Object->Type($type);
	}

	public function CheckBox(string $name, string $id = 'putSameWithName', $value = '1', bool $required = true, bool $disabled = false, string $classList = 'form-control CheckBox', string $type = 'checkbox', string $attrs = '') {
		if ($id === 'putSameWithName') $id = $name;
		$Object = HtmlTags::Input()->Class($classList)->Name($name)->Id($id)->Value($value);
		if ($required and !$this->debugState())
			$Object->Required();
		if ($disabled or $this->disableAll)
			$Object->Disabled();
		if ($this->View()->fill === true and $this->View()->getData()->$name == $value)
			$Object->Checked(true);
		return $Object->Type($type);
	}

	public function Url(string $name) {
		return $this->Input($name, $name) . '<script>$("#' . $name . '").checkWebSite()</script>';
	}

	public function ImgInput(string $name = 'image', string $id = 'putSameWithName', bool $required = false, bool $disabled = false, string $classList = 'form-control') {
		if ($id === 'putSameWithName') $id = $name;
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		$res = '';
//            echo "<kbd>https://".$_SERVER['HTTP_HOST']."src/dist/php/Controller_loader.php";
//            exit();
		if ($this->View()->fill == true) {
			$res = showImage($this->View()->getData()->$name);
			$required = false;
		}
		return (strpos($this->View()->State(), 'delete') !== false ? '' : '<input  type="file" name="' . $name . '" id="' . $id . '" ' . ($required ? 'required' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '">') . $res;
	}

	public function Password(string $string) {
		return $this->Input($string) . '<script>$("#' . $string . '").checkPassword()</script>';
	}

	public function UniqueMobile(string $string, string $string1) {
		return $this->Mobile($string, $string1) . '<script>$("#' . $string1 . '").checkUnique({
controller: "' . $this->View()->Controller()->SoftPath('', false) . '",
controller_type: "checkUnique_' . $string . '",
currentState: "' . $this->View()->State() . '"
})</script>';
	}

	public function softDelete(object $row, string $title = "حذف موقت", Model $model = null) {
		$id = (isset($model) ? $row->{$model->_key} : $row->{$this->View()->Controller()->Key()});
		$table_name = (isset($model) ? $model->_table : $row->{$this->View()->Controller()->model()->_table});
		return HtmlTags::Button('.btn.btn-danger.m-2.softDelete')->Content(
			HtmlTags::I()->Class(FontAwesome::Ban())
		)->Data_('toggle', 'tooltip')->Title("$title")
			->Attrs([
				'item_id' => "$id",
				'table_name' => "$table_name",
				'title' => $title,
			]);
	}


}

class Tags {
	protected $disableAll = false;
	private $debug = false;

	public function Option(string $value, string $name, string $data_value = '', string $fw_id = '') {
		return '<option fw_id="' . $fw_id . '" data-value="' . $data_value . '" value="' . $value . '">' . $name . '</option>';
	}

	public function Label(string $data, string $for = '', string $id = '', string $classList = '') {
		$tooltipData = $this->View()->Controller()->model()->GetLabelData($data);
		$this->View()->labels[] = ['data' => $data, 'text' => $tooltipData];
		return '<label class="' . $classList . '" id="' . $id . '" ' . (strlen($for) > 0 ? 'for="' . $for . '"' : '') . '>' . $data . '<i style="font-size: 20px" class="fa fa-question-circle mr-2" data-toggle="tooltip" title="' . $tooltipData . '"></i></label>';
	}

	public function self() {
		return new self();
	}

	public function SvgInput(string $name, bool $required = true) {
		if ($this->View()->fill == true) {
			$res = showSvg($this->View()->getData()->$name);
			$required = false;
		}
		return $this->Input($name)->Type('file')->Attrs(['accept' => 'image/svg+xml'])->Required($required) . ($res ? $res : '');
	}

	public function Input(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', string $type = 'text', string $attrs = '') {
		if (strpos($name, '_yes_no') !== false) {
			return $this->Select($name, $name, '<option value="1">بله</option><option value="2">خیر</option>');
		}
		if (strpos($name, '_gender') !== false) {
			return $this->Select($name, $name, '<option value="1">مرد</option><option value="2">زن</option>');
		}

		$Input = HtmlTags::Input();
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}

		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (!strlen($value) > 0) {
				if (endsWith($name, ']')) {
					$tmp_name = removeAfter($name, '[');
					$tmp_name = str_replace($tmp_name, '', str_replace('[', '', str_replace(']', '', $name)));
					if ($data = is_json($this->View()->getData()->{removeAfter($name, '[')}, true, true)) {
						$value = $data[$tmp_name];
					}
				} elseif (((object)$this->View()->getData()->$name)) {
					$value = $this->View()->getData()->$name;
				}
			} elseif ($type === 'checkbox' || $type == 'radio') {
				$checked = false;
				if (endsWith($name, ']')) {
					$tmp_name = removeAfter($name, '[');
					if ((is_string($this->View()->getData()->$tmp_name) || is_numeric($this->View()->getData()->$tmp_name)) and !is_json($this->View()->getData()->$tmp_name)) {
						if ($value == $this->View()->getData()->$tmp_name) {
							$checked = true;
						}
					} elseif ($data = is_json($this->View()->getData()->$tmp_name, true, true)) {
						if (in_array($value, $data)) {
							$checked = true;
						}
					}
				} else {
					if ($data = is_json($this->View()->getData()->$name, true, true)) {
						if (in_array($value, $data)) {
							$checked = true;
						}
					} elseif ((is_string($this->View()->getData()->$name) || is_numeric($this->View()->getData()->$name))) {
						if ($value == $this->View()->getData()->$name) {
							$checked = true;
						}
					}
				}
			}


		}
		if (strpos($name, 'password') !== false) {
			$res = '';
			if (strpos($this->View()->State(), 'delete') !== false) {
				$required = false;
			} elseif (strpos($this->View()->State(), 'edit') !== false) {
				$required = false;
			}
			$value = '';
		}
		if (strpos($name, 'date') !== false) $value = jdate('Y/m/d-H:i', $value);
		$Input
			->Type($type)
			->Value("$value")
			->Class($classList)
			->Name($name)
			->Id($id)
			->AutoComplete(false);
		if ($required)
			$Input->Required();
		if ($disabled)
			$Input->Disabled();
		return $Input;
		return '<input ' . $attrs . ' type="' . $type . '" ' .
			(strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '')
			. ' class="' . $classList . '" ' . ($required ? 'required' : '') .
			' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">';
	}

	public function Select(string $name, string $id, string $options, bool $required = true, bool $disabled = false, string $classList = 'form-control', bool $multiple = false) {
		if (strpos($name, 'icon_id_bind') !== false) {
			$name = 'icon_id';
		} elseif (strpos($name, 'icon_id') !== false) {
			return $this->View()->Icon();
		}
//        if ($str->includes('icon_id') and $str != 'icon_id_bind'){
//            return $this->View()->Icon();
//        }
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($this->View()->fill == true) {
			if (!$multiple) {
				if (((object)$this->View()->getData())->$name) {
					$options = str_replace('value="' . $this->View()->getData()->$name . '"', 'value="' . $this->View()->getData()->$name . '" selected', $options);
					$options = str_replace("value='{$this->View()->getData()->$name }'", 'value="' . $this->View()->getData()->$name . '" selected', $options);
				}
			} else {
				$tmp_name = removeAfter($name, '[');
				if ($data = is_json($this->View()->getData()->$tmp_name, true, true)) {
					foreach ($data as $datum) {

						$options = str_replace('value="' . $datum . '"', 'value="' . $datum . '" selected', $options);
						$options = str_replace("value='$datum'", 'value="' . $datum . '" selected', $options);
					}
				}
			}
		}
		$script = '';
		if ($multiple) {
			$script = '<script>$("#' . $id . '").find("option:disabled").remove()</script>';
		}
		return '<select ' . ($multiple ? 'multiple="multiple"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' ' . (strlen($name) > 0 ? 'name="' . $name . '"' : '') . ' id="' . $id . '" autocomplete="off">' . $options . '</select>' . $script;
	}

	protected function View(): View {
		return $this->parent;
	}

	/**
	 * @return bool
	 */
	protected function debugState(): bool {
		return $this->debug;
	}

	public function ImageInput(string $name = 'image', string $accept = 'image/*', int $check_width = 150, int $check_height = 150, string $check_required = 'true', string $id = 'putSameWithName', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
		if ($id === 'putSameWithName') $id = $name;
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		$res = '';
//            echo "<kbd>https://".$_SERVER['HTTP_HOST']."src/dist/php/Controller_loader.php";
//            exit();
		if ($this->View()->fill == true) {
			$res = showImage($this->View()->getData()->$name);
			$required = false;
		}
		return (strpos($this->View()->State(), 'delete') !== false ? '' : '<input check-width="' . $check_width . '" check-height="' . $check_height . '" check-required="' . $check_required . '" accept="' . $accept . '"  type="file" name="' . $name . '" id="' . $id . '" ' . ($required ? 'required' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '">' . '<script>$("#' . $id . '").checkImage()</script>') . $res;
	}

	public function SmallInputNumber(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control form-control1', string $type = 'text', string $attrs = '') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}

		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (!strlen($value) > 0) {
				if (endsWith($name, ']')) {
					$tmp_name = removeAfter($name, '[');
					$tmp_name = str_replace($tmp_name, '', str_replace('[', '', str_replace(']', '', $name)));
					if ($data = is_json($this->View()->getData()->{removeAfter($name, '[')}, true, true)) {
						$value = $data[$tmp_name];
					}
				} elseif (((object)$this->View()->getData()->$name)) {
					$value = $this->View()->getData()->$name;
				}
			} elseif ($type === 'checkbox' || $type == 'radio') {
				if (endsWith($name, ']')) {
					$tmp_name = removeAfter($name, '[');
					if ((is_string($this->View()->getData()->$tmp_name) || is_numeric($this->View()->getData()->$tmp_name)) and !is_json($this->View()->getData()->$tmp_name)) {
						if ($value == $this->View()->getData()->$tmp_name) {
							$attrs .= ' checked ';
						}
					} elseif ($data = is_json($this->View()->getData()->$tmp_name, true, true)) {
						if (in_array($value, $data)) {
							$attrs .= ' checked ';
						}
					}
				} else {
					if ($data = is_json($this->View()->getData()->$name, true, true)) {
						if (in_array($value, $data)) {
							$attrs .= ' checked ';
						}
					} elseif ((is_string($this->View()->getData()->$name) || is_numeric($this->View()->getData()->$name))) {
						if ($value == $this->View()->getData()->$name) {
							$attrs .= ' checked ';
						}
					}
				}
			}
		}
		if ($name == 'password') {
			$file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
			$res = '';
			if (strpos($file, 'delete') !== false) {
				$required = false;
			} elseif (strpos($file, 'edit') !== false) {
				$required = false;
			}
			$value = '';
		}
		return '<input ' . $attrs . ' type="' . $type . '" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">' . '<script>$("#' . $id . '").checkNumber()</script>';
	}

	public function Number(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', string $type = 'text', string $attrs = '') {
		if (strpos($name, '_sheba') !== false) {
			return HtmlTags::Div('.input-group')->Content(
					$this->Input($name, $name),
					HtmlTags::Div('.input-group-prepend')->Content(
						HtmlTags::Span('.input-group-text')->Content(
							'IR'
						)
					)
				) . "<script>$('#$name').checkShebaNum()</script>";
		}
		if (strpos($name, '_card') !== false) {
			return $this->Input($name, $name) . "<script>$('#$name').checkCardNumber()</script>";
		}
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (!strlen($value) > 0) {
				if (endsWith($name, ']')) {
					$tmp_name = removeAfter($name, '[');
					$tmp_name = str_replace($tmp_name, '', str_replace('[', '', str_replace(']', '', $name)));
					if ($data = is_json($this->View()->getData()->{removeAfter($name, '[')}, true, true)) {
						$value = $data[$tmp_name];
					}
				} elseif (((object)$this->View()->getData()->$name)) {
					$value = $this->View()->getData()->$name;
				}
			}
		}
		if ($name == 'password') {
			$file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
			$res = '';
			if (strpos($file, 'delete') !== false) {
				$required = false;
			} elseif (strpos($file, 'edit') !== false) {
				$required = false;
			}
			$value = '';
		}
		return '<input ' . $attrs . ' type="' . $type . '" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">' . '<script>$("#' . $id . '").checkNumber()</script>';
	}

	public function English(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', string $type = 'text', string $attrs = '') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (!strlen($value) > 0) {
				if (endsWith($name, ']')) {
					$tmp_name = removeAfter($name, '[');
					$tmp_name = str_replace($tmp_name, '', str_replace('[', '', str_replace(']', '', $name)));
					if ($data = is_json($this->View()->getData()->{removeAfter($name, '[')}, true, true)) {
						$value = $data[$tmp_name];
					}
				} elseif (((object)$this->View()->getData()->$name)) {
					$value = $this->View()->getData()->$name;
				}
			}
		}
		if ($name == 'password') {
			$file = end(explode('/', str_replace(__SOURCE__, '', debug_backtrace()[0]['file'])));
			$res = '';
			if (strpos($file, 'delete') !== false) {
				$required = false;
			} elseif (strpos($file, 'edit') !== false) {
				$required = false;
			}
			$value = '';
		}
		return '<input ' . $attrs . ' type="' . $type . '" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">' . '<script>$("#' . $id . '").checkEnglish()</script>';
	}

	public function NumberInput(string $name, float $min = 0, float $max = 1, float $steps = 0.25, string $id = 'putSameWithName', string $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (((object)$this->View()->getData()->$name)) $value = $this->View()->getData()->$name;
		}
		return '<input ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' type="number" min="' . $min . '" step="' . $steps . '" max="' . $max . '">';
	}

	public function TextArea(string $name, string $id = "putSameWithName", $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', string $attrs = '') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (((object)$this->View()->getData()->$name)) {
				$value = $this->View()->getData()->$name;
			}
		}
		return '<textarea ' . $attrs . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">' . $value . '</textarea>';
	}

	public function Price(string $name, string $id = "putSameWithName", string $price_unit = 'تومان', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', bool $readonly = false) {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (((object)$this->View()->getData()->$name) and strlen($value) <= 0) $value = $this->View()->getData()->$name;
		}
		return '<fw-price ' . (strlen($value) > 0 ? 'value="' . number_format($value) . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' ' . ($readonly ? 'readonly' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off" price-unit=' . $price_unit . '>';
	}

	public function Mobile(string $name, string $id = "putSameWithName", $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (((object)$this->View()->getData()->$name)) $value = MobileFormat($this->View()->getData()->$name);
		}
		return '<fw-mobile dir="ltr" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">';
	}

	public function Email(string $name, string $id = "putSameWithName", $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (((object)$this->View()->getData()->$name)) $value = ($this->View()->getData()->$name);
		}
		return '<fw-email dir="ltr" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">';
	}

	public function Tel(string $name, string $id = 'putSameWithName', string $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (((object)$this->View()->getData()->$name)) $value = TelFormat($this->View()->getData()->$name);
		}
		return '<fw-tell  dir="ltr" ' . (strlen($value) > 0 ? 'value="' . $value . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off">';
	}

	public function Percent(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (((object)$this->View()->getData()->$name)) $value = $this->View()->getData()->$name;
		}
		return '<div class="input-group"><input ' . (strlen($value) > 0 ? 'value="' . ($value) . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off" maxlength="2" max="100" ><div class="input-group-prepend"><div class="input-group-text">%</div></div></div>' . '<script>$("#' . $id . '").checkNumber()</script>';
	}

	public function PercentNoLimit(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control') {
		if ($this->debugState() == true) $required = false;
		if ($this->View()->isDisableAll() == true) {
			$disabled = true;
			$required = false;
		}
		if ($id === 'putSameWithName') $id = $name;
		if ($this->View()->fill == true) {
			if (((object)$this->View()->getData()->$name)) $value = $this->View()->getData()->$name;
		}
		return '<div class="input-group"><input ' . (strlen($value) > 0 ? 'value="' . ($value) . '"' : '') . ' ' . ($disabled ? 'disabled' : '') . ' class="' . $classList . '" ' . ($required ? 'required' : '') . ' name="' . $name . '" id="' . $id . '"
                                    autocomplete="off" maxlength="10" max="250" ><div class="input-group-prepend"><div class="input-group-text">%</div></div></div>' . '<script>$("#' . $id . '").checkNumber()</script>';
	}
    public function Ip(string $name, string $id = 'putSameWithName', $value = '', bool $required = true, bool $disabled = false, string $classList = 'form-control', string $attrs = ''){
        $Input = HtmlTags::Input();
        if ($this->debugState() == true) $required = false;
        if ($this->View()->isDisableAll() == true) {
            $disabled = true;
            $required = false;
        }

        if ($id === 'putSameWithName') $id = $name;
        if ($this->View()->fill == true) {
            if (!strlen($value) > 0) {
                if (endsWith($name, ']')) {
                    $tmp_name = removeAfter($name, '[');
                    $tmp_name = str_replace($tmp_name, '', str_replace('[', '', str_replace(']', '', $name)));
                    if ($data = is_json($this->View()->getData()->{removeAfter($name, '[')}, true, true)) {
                        $value = $data[$tmp_name];
                    }
                } elseif (((object)$this->View()->getData()->$name)) {
                    $value = $this->View()->getData()->$name;
                }
            }
        }
        $Input
            ->Type('text')
            ->Value($value)
            ->Class($classList)
            ->Name($name)
            ->Id($id)
            ->AutoComplete(false)
        ;
        if ($required)
            $Input->Required();
        if ($disabled)
            $Input->Disabled();
        return $Input.'<script>$("#'.$id.'").checkIp()</script>';
    }


	public function isDebug() {
		$this->debug = true;
	}

	/**
	 */
	public function doDisableAll() {
		$this->disableAll = true;
	}

	/**
	 * @return bool
	 */
	private function isDisableAll(): bool {
		return $this->disableAll;
	}
}
