<?php

use DATABASE\Model;
use FwAuthSystem\Main\UserObject;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwHtml\FontAwesome;
use model\Icons;

include __SOURCE__ . 'dist/php/Views/ViewClass.php';
include __SOURCE__ . 'dist/php/Views/ViewPagination.php';

abstract class View {
	public $thisView = 'null';
	public $SingularName = '';
	public $PluralName = '';
	public $labels = [];
	public $fill = false;
	public $disableAll = false;
	public $initDataTable = true;
	private $html;
	private $Controller;
	private $Data;
	protected $state;
	private $isSubmitted = false;
	/**
	 * @var string
	 */
	private $controllerPath = 'null';
	private $quick_add_count = 0;
	/**
	 * @var array
	 */
	private $quickAdds = [];

	final public function __construct(Controller &$Controller = null, $Data = null) {

		$this->Data = $Data;
		$this->Controller = $Controller;
		$this->configThis();
		if (!isset($_REQUEST['controller'])) {
			$this->setControllerPath(strtok('controllers/' . str_replace('.view', '', $this->thisView), '?'));
		} else {
			$this->setControllerPath(strtok($_REQUEST['controller'], '?'));
		}

		$this->html = new Views\Html($this);
	}

	private function configThis() {
		$controllerPath = $this->Controller()->RelPath();

//    	echo "<kbd>";
		$arr = explode('/', $controllerPath);
		if ($this->State() and $this->State() != 'main') {
			$arr[sizeof($arr) - 1] = $this->State() . end($arr);
		}
		$this->thisView = implode(DIRECTORY_SEPARATOR, $arr);
	}
	
	protected function wrap(\FwHtml\Elements\Tags\Base\TagsClass $tags_class) {
		return $tags_class;
	}
	public function Controller(): Controller {
		return $this->Controller;
	}

	public function State() {
		return $this->state;
	}

	private function setControllerPath(string $string) {
		$this->controllerPath = $string;
	}

	public function quickAdd(string $Select, \ControllerScheme $controllerToAddTo, ?string $waitFor = '', ?\ControllerScheme $beforeController = null) {
		$this->quick_add_count++;
		$this->quickAdds[] = $this->quickAddModal($controllerToAddTo);
		return HtmlTags::Div('.input-group.w-100')->Content(
			HtmlTags::Div('.input-group-prepend')->Content(
				HtmlTags::Button('.btn.btn-success.quickAddBtn')->Content(
					HtmlTags::I()->Class(FontAwesome::Plus())
				)->Attrs(['type' => 'button'])
					->Data_('modal', "quick_add_{$this->quick_add_count}")->Data_('wait', "$waitFor")
					->Data_('before_name', ($beforeController != null ? $beforeController::name : ''))
			) .
			HtmlTags::Div('.quick-add-div.w-75')->Content(
				$Select
			)
		);
	}

	private function quickAddModal(\ControllerScheme $controller) {
		$name = $controller::name;
		return HtmlTags::Div(".modal.fade#quick_add_{$this->quick_add_count}")->Content(
				HtmlTags::Div('.modal-dialog.modal-lg')->Content(
					HtmlTags::Div('.modal-content')->Content(
						HtmlTags::Div('.modal-header')->Content(
							HtmlTags::H4('.modal-title')->Content(
								"افزودن سریع {$name}"
							),
							HtmlTags::Div('.pull-left')->Content(
								HtmlTags::Button('.close')->Content('&times;')->Data_('dismiss', 'modal')->Type('button')
							)
						),
						HtmlTags::Form()->Content(
							'<form class="quickAddForm" action="' . $controller->SoftPath('', false) . '">' .
							HtmlTags::Div('.modal-body.d-flex.flex-wrap')->Content(
								$controller->quickAdd()
							),
							HtmlTags::Div('.modal-footer')->Content(
								HtmlTags::Button('.btn.btn-danger.float-right.mr-0.ml-auto')->Content(
									HtmlTags::I()->Class(FontAwesome::Times()),
									' انصراف '
								)->Data_('dismiss', 'modal'),
								HtmlTags::Button('.btn.btn-primary.quick-add-submit_button')->Content(
									HtmlTags::I()->Class(FontAwesome::Check()),
									' ثبت '
								)->Attrs(['type' => 'button'])
							)
							. '</form>'
						)
					)
				)
			) . $controller->ViewInstance()->Script('quick');
	}

	public function Script(?string $state = '') {
		$output = [];
		if ($state == '') {
			$state = $this->State();
		}
		$prod = FwConfig::PROD();
		foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'views/' . $this->currentDir())), '/\.js/') as $phpFile) {
			$fileName = $phpFile->getFileName();
			$fileName = str_replace('.js', '', $fileName);
			$arr = explode('/', $this->thisView);
			$view = end($arr);
			$view = str_replace($state, '', $view);
			$fileName = str_replace("$view.view.", '', $fileName);
			$fileName = str_replace('OR', '|', $fileName);

			if (preg_match('/' . $fileName . '/', $state) == true) {
				$time = time();
				if ($prod){
					$time = 1;
				}
				$output[] = '<script type="module" src="js/' . $this->currentDir() . '/' . $phpFile->getFileName() . '?t='.$time.'"></script>';
			}
		}
		return implode('', $output);
	}

	public function currentDir() {
		$data = explode(DIRECTORY_SEPARATOR, $this->Controller()->Path());
		array_pop($data);
		return end(explode('/controllers/', implode(DIRECTORY_SEPARATOR, $data)));
	}

	final public function Path() {
		return (new ReflectionClass($this))->getFileName();
	}

	public function doFill() {
		$this->fill = true;
	}

	/**
	 */
	public function doDisableAll() {
		$this->disableAll = true;
	}

	/**
	 * @return bool
	 */
	public function isDisableAll(): bool {
		return $this->disableAll;
	}

	public function labels() {
		$Document = new \DOMWrap\Document();
		$this->add($Document);
		echo optOfArray((object)$this->labels, 'data', 'data', false, ['value' => 'text'], false);
		die();
	}

	public function Process($state) {
		$this->state = $state;
		$Document = new \DOMWrap\Document();
		if (method_exists($this, $state)) {
			$this->configThis();
			$this->$state($Document);
			$Document->script .= $this->Script();
			if ((new Str($state))->includes('add') || (new Str($state))->includes('edit') or (new Str($state))->includes('delete')) {
				$script = '<script src="src/dist/js/selectIcon.js"></script>';
				$script .= '<script src="src/dist/js/final_submit.js"></script>';
			} else
				$script = '<script src="src/dist/js/activation.js"></script>';

			$this->submit();
			$className = end(explode('\\', $this->Controller()->class()));
			return hiddenInput($this->State() . $className, '', 'fw_current_page_url_new') . $Document->saveHTML() . $Document->script . hiddenInput($this->thisView, '', 'fw_lastAjaxCallView') . hiddenInput($this->thisView, '', 'fw_lastAjaxCallView') . hiddenInput($this->PluralName(), '', 'fw_current_page_title') . $script;
		} else {
			return $this->NotFoundError(get_class($this), $state);
		}
	}

	protected function submit() {
		if ($this->isSubmitted === false) {
			echo '<script>$.submit("' . $this->getControllerPath() . '")</script>';
			$this->isSubmitted = true;
		}
	}

	/**
	 * @return mixed
	 */
	public function getControllerPath() {
		return $this->controllerPath;
	}

	public function PluralName(): string {
		return ($this->PluralName ? $this->PluralName : $this->SingularName() . ' ها');
	}

	public function SingularName(): string {
		return $this->SingularName;
	}

	private function NotFoundError(string $get_class, $state) {
		return HtmlTags::Section('.content')->Content(HtmlTags::Div('.row')->Content(HtmlTags::Div('.col-md-12')->Content(HtmlTags::Div('.card.card-warning.mt-5')->Content(HtmlTags::Div('.card-header')->Content(HtmlTags::H4('خطایی رخ داد!'), HtmlTags::Div('.card-tools')->Content($this->Html()->backBtn())), HtmlTags::Div('.card-body')->Content(HtmlTags::H3("متود $state در کلاس $get_class یافت نشد!"), HtmlTags::Br(), HtmlTags::H5()->Content("کنترلر: {$this->Controller()->class()}"), HtmlTags::H5()->Content("آدرس کنترلر: {$this->Controller()->SoftPath('.php')}"), HtmlTags::Br(), HtmlTags::H5()->Content("مدل: {$this->Controller()->model()->class()}"))))));
	}

	protected function Html(): \Views\Html {
		return $this->html;
	}

	public function Polygon(string $name, string $listen = '') {

		$res = '<div class="form-group col-md-12">
                                <label>لطفا محدوده ' . $this->SingularName() . ' را مشخص کنید</label>
                                <div class="map" id="map">
                                </div>
                                <div>
                                    <input type="hidden" name="' . $name . '" id="map-coords">
                                </div>
                            </div>';
		$listen = ($listen !== '' ? "listen: '$listen'" : '');
		if ($this->fill === true) {
			$coordsArr = explode(")", str_replace("(", "", $this->getData()->$name));
			$firstPos = explode(",", $coordsArr[0]);
			$polygon = '[';
			foreach ($coordsArr as $coords) {
				if ($coords != "") {
					$point = explode(',', $coords);
					$polygon .= "[" . $point[0] . ',' . $point[1] . '],';
				}
			}
			$polygon .= ']';
			$res .= '<script>
$.initMap({
    view: [' . $firstPos[0] . ',' . $firstPos[1] . '],
    polygon: ' . $polygon . ',
    disable: ' . (strpos($this->thisView, "delete") !== false ? "true" : "false") . ',
    ' . $listen . '
})';
		} else {
			$res .= '<script>
    $.initMap({
    disable: ' . (strpos($this->thisView, "delete") !== false ? "true" : "false") . ',
    ' . $listen . '
    });</script>';
		}
		return $res;

	}

	public function getData() {
		return $this->Data;
	}

	public function MapMarker(string $lat, string $long) {
		$firstValue = '35.69299463209881';
		$secondValue = '51.33911132812501';
		if ($this->fill and $this->getData()->$lat and $this->getData()->$long) {
			$firstValue = $this->getData()->$lat;
			$secondValue = $this->getData()->$long;
		}
		return HtmlTags::Div('#map.map') . "<script>$(function () {
        let map = L.map('map').setView([$firstValue, $secondValue], 8);
        
        let internal = setInterval(() => {
            if ($('#map').is(':visible')){
			   window.dispatchEvent(new Event('resize'));
			   clearInterval(internal);
           }
        },500);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmFyaGFkamFmYXJpMzg1IiwiYSI6ImNqanF5dmpvNjhmZXgzdm82cHljbDdhb2UifQ.VGrzePHsYotiYRCe9cDr4A', {
            maxZoom: 18,
            minZoom: 5,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmFyaGFkamFmYXJpMzg1IiwiYSI6ImNqanF5dmpvNjhmZXgzdm82cHljbDdhb2UifQ.VGrzePHsYotiYRCe9cDr4A'
        }).addTo(map);
        let marker = L.marker([$firstValue, $secondValue]).addTo(map);

        function onMapClick(e) {
            map.removeLayer(marker);
            marker = L.marker(e.latlng).addTo(map);
            $(\"#$lat\").val(e.latlng.lat);
            $(\"#$long\").val(e.latlng.lng);
        }

        map.on('click', onMapClick);
    });</script>";
	}

	public function __call($name, $arguments) {
		return $this->Html()->$name();
	}

	public function show(array $arrayOfIndexed, bool $showDelete = true, bool $showEdit = true, bool $showActive = false, ...$actionBtn) {

		$result = '';
		$canEdit = UserObject::canEdit($this->Controller());
		$canDelete = UserObject::canDelete($this->Controller());
		$canActivate = UserObject::canActivate($this->Controller());
		$userObject = UserObject::instance();
		foreach (@$this->getData() as $item) {
			if (UserObject::canSee($this->Controller(), $item, $userObject)) {
				$result .= '<tr><td></td>';
				foreach ($arrayOfIndexed as $index => $value) {

					if (is_string($index) and is_callable($value)) {
						$reflect = new ReflectionFunction($value);
						switch (sizeof($reflect->getParameters())) {
							case 0:
								$result .= "<td>{$value()}</td>";
								break;
							case 1:
								$result .= "<td>{$value($item->{$index})}</td>";
								break;
							case 2:
								$result .= "<td>{$value($item->{$index},$item)}</td>";
								break;
						}

					}
					if (is_string($index) and is_string($value)) {
						if (class_exists($value)) {
							$value = new $value();
							if ($value instanceof Controller) {
								$value = $value->model();
							}
							if ($value instanceof Model) {
								$val = join_class($value, $item->{$value->_key}, $index);
								$result .= "<td>{$val}</td>";
							}
						} elseif (function_exists($index)) {
							$result .= "<td>{$index($item->$value)}</td>";
						} else {
							$result .= $index($value);
						}
					} elseif (is_numeric($index) and is_string($value)) {
						if (filter_var($item->$value, FILTER_VALIDATE_URL)) {
							$result .= "<td><a target='_blank' href='{$item->$value}'>{$item->$value}</a></td>";
						} else {
							$item->$value = ($item->$value == '' ? '<a class="badge badge-danger p-2 text-white">ثبت نشده</a>' : $item->$value);
							$result .= "<td>{$item->$value}</td>";
						}

					} elseif (is_numeric($index) and is_callable($value)) {
						$Reflected = new ReflectionFunction($value);
						if (sizeof($Reflected->getParameters()) > 0) $result .= "<td>{$value($item)}</td>"; else
							$result .= "<td>{$value()}</td>";
					} elseif (is_string($index) and is_object($value)) {
						if ($value instanceof Controller) {
							$value = $value->model();
						}
						if ($value instanceof Model) {
							$val = join_class($value, $item->{$value->_key}, $index);
							$result .= "<td>{$val}</td>";
						}

					}
				}
				if ($canEdit && $showEdit) {
					$edit = $this->Html()->editBtn($item);
				}
				if ($canDelete && $showDelete) {
					$delete = $this->Html()->deleteBtn($item);
				}
				if ($canActivate && $showActive) {
					$activeOrDeActive = $this->Html()->activeOrDeActive($item);
				}
				$view = $this->Html()->viewBtn($item)->Class('viewButton');
				$actionBtns = '';
				foreach ($actionBtn as $action) {
					$actionBtns .= $action($item);
				}
				if ($delete != '' or $edit != '' or $view != '') {
					$result .= "<td>$edit $view  $delete $actionBtns</td>";
				}
				if ($activeOrDeActive) $result .= HtmlTags::Td()->Content("$activeOrDeActive");

				$result .= '</tr>';
			}
		}
		return $result;
	}

	public function getThis() {
		return $this->thisView;
	}

	public function referrer() {
		return $_REQUEST['fw_referrer'];
	}

	public function __destruct() {

	}

	public function quickAddModals() {
		$output = '';
		foreach ($this->quickAdds as $quickAdd) {
			$output .= $quickAdd;
		}
		return $output;
	}


}
