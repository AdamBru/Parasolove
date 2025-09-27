<?php
	function textTooLong($text, $maxLength) {
		if (mb_strlen($text, 'UTF-8') > $maxLength) {
			return trim(mb_substr($text, 0, $maxLength)) . "...";
		}
		return $text;
	}

					// ID produktu, indeks zdjęcia
	function getProductImage($id, $index = 0, $colorId = null) {
		$imageName = $id . '-' . $index . '.webp';
		$filePath = 'assets/product/' . $imageName;

		$src = file_exists($filePath) ? $filePath : 'assets/site-images/no-image.svg';

		// If no-image then add padding
		if ($src == 'assets/site-images/no-image.svg') {
			// return '<img src="' . $src . '" style="padding: 5em;" loading="lazy">';
			return getImageByColor($colorId);
		} else {
			return '<img src="' . $src . '" loading="lazy" style="object-fit: contain;">';
		}
	}

	function getImageByColor($colorId) {
		$filePath = 'assets/product/color/' . $colorId . '.webp';

		$src = file_exists($filePath) ? $filePath : 'assets/site-images/no-image.svg';

		// If no-image then add padding
		if ($src == 'assets/site-images/no-image.svg') {
			return '<img src="' . $src . '" style="padding: 5em;" loading="lazy">';
		} else {
			return '<img src="' . $src . '" loading="lazy" style="object-fit: contain;">';
		}
	}

	function filters($conn) {
		$where = [];

		// Mapowanie kluczy GET na kolumny SQL i typy
		$filters = [
			'category'	=> fn($v) => $v !== 'wszystkie' ? "category.name = '" . mysqli_real_escape_string($conn, $v) . "'" : null,
			'price-min'	=> fn($v) => is_numeric($v) ? "pro.price >= " . (int)$v : null,
			'price-max'	=> fn($v) => is_numeric($v) ? "pro.price <= " . (int)$v : null,
			'color'		=> fn($v) => is_array($v) ? "color.name IN (" . implode(',', array_map(fn($c) => "'" . mysqli_real_escape_string($conn, $c) . "'", $v)) . ")" : null,
			'size'		=> fn($v) => is_array($v) ? "size.name IN (" . implode(',', array_map(fn($s) => "'" . mysqli_real_escape_string($conn, $s) . "'", $v)) . ")" : null,
		];

		foreach ($filters as $key => $builder) {
			if (isset($_GET[$key]) && ($clause = $builder($_GET[$key]))) {
				$where[] = $clause;
			}
		}

		$whereSQL = $where ? ' ' . implode(' AND ', $where) : '';

		return $whereSQL;
	}

	function getProducts($conn, $sort = 'default', $pagination = false, $limitOne = false) {
		$sortOptions = [
			'default' => 'pro_product_id DESC',
			'price-asc' => 'pro_price ASC',
			'price-desc' => 'pro_price DESC',
			'name-asc' => 'pro_name ASC',
			'name-desc' => 'pro_name DESC',
			'category-asc' => 'cat_name ASC',
			'category-desc' => 'cat_name DESC',
			'id-asc' => 'pro_product_id ASC',
			'id-desc' => 'pro_product_id DESC',
			'color-asc' => 'col_name ASC',
			'color-desc' => 'col_name DESC',
			'size-asc' => 'siz_name ASC',
			'size-desc' => 'siz_name DESC',
			'quantity-asc' => 'pro_quantity ASC',
			'quantity-desc' => 'pro_quantity DESC'
		];

		$sort = $sortOptions[$sort] ?? $sortOptions['default'];

			// Paginacja
			$paginationSql = '';
			$paginationStart = 0;
			$pageNumber = 1;
			$recordsPerPage = 18;
			$numberOfRecords = 0;
			$numberOfPages = 1;
			$whereSql = '';
			

			if ($pagination) {
				$filterString = filters($conn);

				$whereCount = "WHERE pro.is_archived = 0";
				if ($filterString) {
					$whereCount .= " AND" . $filterString;
				}

				$countSql = "SELECT COUNT(*) AS count FROM product pro
							JOIN category ON pro.category_Id = category.category_Id
							JOIN color ON pro.color_Id = color.color_Id
							JOIN size ON pro.size_Id = size.size_Id
							$whereCount";

				$numberOfRecords = mysqli_fetch_assoc(mysqli_query($conn, $countSql))['count'];
				$numberOfPages = ceil($numberOfRecords / $recordsPerPage);

				if (isset($_GET['page']) && is_numeric($_GET['page'])) {
					$pageNumber = max(1, min($_GET['page'], $numberOfPages));
				}

				$paginationStart = ($pageNumber - 1) * $recordsPerPage;
				$paginationSql = " LIMIT $paginationStart, $recordsPerPage";

				$whereSql = $whereCount;
			}

			// Informacje o stronie
			if ($pagination) {
				$startRecord = $paginationStart + 1;
				$endRecord = min($paginationStart + $recordsPerPage, $numberOfRecords);

				echo '<div class="flex-container align-center flex-row nowrap gap-m mobile-page-info" style="justify-content: space-between">';
				echo "<p> Strona $pageNumber z $numberOfPages </p>";
				echo "<p> Wyświetlanie wyników&nbsp; $startRecord - $endRecord &nbsp;z&nbsp; $numberOfRecords </p>";
				echo '</div><hr>';
			}

			// Wybranie konkretnego produktu
			if ($limitOne) {
				$whereSql = 'WHERE pro.is_archived = 0 AND pro.product_id = ' . $_GET['id'];
			}

		$sql = 'SELECT
					pro.product_id 		AS pro_product_id, 
					pro.category_id 	AS pro_category_id, 
					pro.color_id 		AS pro_color_id,
					pro.size_id 		AS pro_size_id,
					pro.name 			AS pro_name,
					pro.description 	AS pro_description,
					pro.price 			AS pro_price,
					pro.quantity 		AS pro_quantity,
					pro.is_archived 	AS pro_is_archived,
					category.name 		AS cat_name,
					color.name 			AS col_name,
					color.hex_code		AS col_hex_code,
					size.name 			AS siz_name
				FROM product pro 
				JOIN category ON pro.category_Id = category.category_Id 
				JOIN color ON pro.color_Id = color.color_Id
				JOIN size ON pro.size_Id = size.size_Id ' . 
				$whereSql . ' 
				ORDER BY ' . $sort . $paginationSql;
				// echo $sql;
		
		$result = mysqli_query($conn, $sql);

		// Treść błędu zwrócona przez SQL
		if (!$result) {
			die("Błąd zapytania: " . mysqli_error($conn));
		}

		// TEMP: show number of returned rows
		// echo '<h1>' . mysqli_num_rows($result) . '</h1>';

		return [
			'products' => mysqli_fetch_all($result, MYSQLI_ASSOC),
			'pagination' => [
				'currentPage' => $pageNumber,
				'totalPages' => $numberOfPages
			], 
			'foundProducts' => mysqli_num_rows($result)
		];

		// Użycie
		// $sort = $_GET['sort'] ?? 'default';
		// $produkty = getProducts($conn, $sort); || foreach (getProducts($conn, $sort) as $product) {}	
	}

?>

<script src="handlers/cartHandler.js"></script>