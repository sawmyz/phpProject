<?php

namespace FwBase\Reports;

use ControllerScheme;
use FwHtml\Elements\Attrs\Style;
use FwHtml\Elements\Tags\Main\HtmlTags;
use helpers\PaymentStatus;
use model\Entity\ProductGroupsEntity;
use model\Entity\ProductNamesEntity;
use model\Entity\ProductsEntity;
use model\Entity\ProvidersEntity;
use model\ProductNames;
use model\Products;
use model\Providers;

abstract class ReportScheme extends ControllerScheme {
	final static public function timeToQuery($field, $startValue, $endValue) {
		$query = [];
		if ($startValue) {
			$query[] = "$field >= $startValue";
		}
		if ($endValue) {
			$query[] = "$field <= $endValue";
		}
		return implode(' and ', $query);
	}

	abstract public function getReport();

	public function start() {
		return $this->main();
	}

	public function main() {
		return $this->view($this->viewName(), 'start', [

		]);
	}

	final protected function isSet(string $field_name, callable $function = null) {
		$output = ((isset($this->requestArray()['filters'][$field_name]) and $this->requestArray()['filters'][$field_name] != '') ? $this->requestArray()['filters'][$field_name] : null);
		if ($function)
			return $function($output);
		return $output;
	}
}

abstract class OrderReportScheme extends ReportScheme {
	public function output($html, $initialData) {
		if (sizeof($initialData) > 0) {
			$data = HtmlTags::Div('.card-header.d-flex.flex-wrap.text-center.w-100')->Content(
				PaymentStatus::toHtml($initialData)
			);
		} else {
			$data = null;
		}
		return HtmlTags::Div('.card')->Content(
			$data,
			$html
		);
	}

	protected function products($initialData, bool $excludeNoProviders = false) {
		$order_products = [];
		foreach ($initialData as $initial_datum) {
			$order_products[] = json_decode($initial_datum->order_products, true);
		}
		$productByProviderId = [];
		foreach ($order_products as $order_product) {
			if ($order_product) {
				foreach ($order_product as $productId => $productData) {
					if (!isset($productByProviderId[$productData['provider_id']])) {
						$productByProviderId[$productData['provider_id']] = [];
					}
					/** @var ProductsEntity $productEntity */
					$productEntity = Products::get($productId);

					/** @var ProductNamesEntity $productName */
					$productName = ProductNames::get($productEntity->name_id);
					if ($excludeNoProviders) {
						if ($productData['provider_id'] > 0) {
							$productByProviderId[$productData['provider_id']][] = [
								'id' => $productId,
								'name' => $productName->name,
								'unit' => $productData['unit'],
								'count' => $productData['count'],
								'price' => $productData['price'],
							];
						}
					} else {
						$productByProviderId[$productData['provider_id']][] = [
							'id' => $productId,
							'name' => $productName->name,
							'unit' => $productData['unit'],
							'count' => $productData['count'],
							'price' => $productData['price'],
						];
					}
				}
			}

		}
		$products = [];
		foreach ($productByProviderId as $provider_id => $productDataAll) {
			$products[$provider_id] = [];
			foreach ($productDataAll as $productData) {
				if (!isset($products[$provider_id][$productData['id']])) {
					$products[$provider_id][$productData['id']] = [
						'name' => $productData['name'],
						'unit' => $productData['unit'],
						'count' => 0,
						'price' => $productData['price'],
					];
				}
				$products[$provider_id][$productData['id']]['count'] += $productData['count'];
			}
		}


		$output = [];
		$buyAllPrice = 0;
		$sellAllPrice = 0;
		foreach ($products as $provider_id => $productsData) {
			/** @var ProvidersEntity $provider */
			$provider = Providers::get($provider_id);
			$providerProducts = json_decode($provider->products, true);
			foreach ($productsData as $product_id => $productData) {
				/** @var ProductsEntity $product */
				$product = Products::get($product_id);
				$output[] = HtmlTags::Tr()->Content(
					HtmlTags::Td()->Content(),
					HtmlTags::Td()->Content($productData['name']),
					HtmlTags::Td()->Content($productData['count'] . ' ' . $productData['unit']),
					HtmlTags::Td()->Content($provider->name),
					HtmlTags::Td()->Content(price_format($providerProducts[$product_id])),
					HtmlTags::Td()->Content(price_format($providerProducts[$product_id] * ($productData['count'] / $product->factor))),
					HtmlTags::Td()->Content(price_format($productData['price'])),
					HtmlTags::Td()->Content(price_format($productData['price'] * ($productData['count'] / $product->factor))),
					HtmlTags::Td()->Content(price_format($productData['price'] * ($productData['count'] / $product->factor) - $providerProducts[$product_id] * ($productData['count'] / $product->factor)))
				);
				$buyAllPrice += $providerProducts[$product_id] * ($productData['count'] / $product->factor);
				$sellAllPrice += $productData['price'] * ($productData['count'] / $product->factor);
			}

		}
		return HtmlTags::Table('.table.table-bordered.table-hover')->Content(
			HtmlTags::Thead()->Attrs(['style' => "background-color: #b5b5b52e"])->Content(
				HtmlTags::Tr()->Content(
					HtmlTags::Th()->Content("ردیف")->Width(50),
					HtmlTags::Th()->Content("محصول"),
					HtmlTags::Th()->Content("تعداد*واحد"),
					HtmlTags::Th()->Content("تامین کننده"),
					HtmlTags::Th()->Content("قیمت خرید واحد"),
					HtmlTags::Th()->Content("هزینه خرید کل"),
					HtmlTags::Th()->Content("قیمت فروش واحد"),
					HtmlTags::Th()->Content("قیمت فروش کل"),
					HtmlTags::Th()->Content("تفاضل خرید و فروش کل")
				)
			),
			HtmlTags::Tbody()->Content(
				implode('', $output)
			),
			HtmlTags::Tfoot()->Attrs(['style' => "background-color: #b5b5b52e"])->Content(
				HtmlTags::Tr()->Content(
					HtmlTags::Tr()->Content(
						HtmlTags::Td()->Attrs(['colspan' => 4])->Content(),
						HtmlTags::Td()->Attrs([])->Content(),
						HtmlTags::Td()->Attrs([])->Content(price_format($buyAllPrice)),
						HtmlTags::Td()->Attrs([])->Content(),
						HtmlTags::Td()->Attrs([])->Content(price_format($sellAllPrice)),
						HtmlTags::Td()->Attrs([])->Content(price_format($sellAllPrice - $buyAllPrice))
					)
				)
			)
		);
	}
}
