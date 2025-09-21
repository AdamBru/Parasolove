<?php
	function textTooLong($text, $maxLength) {
		if (mb_strlen($text, 'UTF-8') > $maxLength) {
			return trim(mb_substr($text, 0, $maxLength)) . "...";
		}
		return $text;
	}

					// ID produktu, indeks zdjęcia
	function getProductImage($id, $index = 0) {
		$imageName = $id . '-' . $index . '.webp';
		$filePath = 'assets/product/' . $imageName;

		$src = file_exists($filePath) ? $filePath : 'assets/site-images/no-image.svg';

		// If no-image then add padding
		if ($src == 'assets/site-images/no-image.svg') {
			return '<img src="' . $src . '" style="padding: 5em;" loading="lazy">';
		} else {
			return '<img src="' . $src . '" loading="lazy">';
		}
	}
	

	function getProducts($conn, $sort = 'default', $pagination = false) {
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
			$hideArchived = '';
			
			if ($pagination) {
				$numberOfRecords = mysqli_fetch_assoc( mysqli_query( $conn, 'SELECT COUNT(*) AS count FROM product WHERE is_archived = 0' ) )['count'];
				$numberOfPages = ceil($numberOfRecords / $recordsPerPage);

				if (isset($_GET['page']) && is_numeric($_GET['page'])) {
					$pageNumber = max(1, min($_GET['page'], $numberOfPages));
				}

				$paginationStart = ($pageNumber - 1) * $recordsPerPage;
				$paginationSql = " LIMIT $paginationStart, $recordsPerPage";

				// Ukrycie produktów archiwalnych
				$hideArchived = "WHERE pro.is_archived = 0";
			}

			// Informacje o stronie
			if ($pagination) {
				$startRecord = $paginationStart + 1;
				$endRecord = min($paginationStart + $recordsPerPage, $numberOfRecords);

				echo '<div class="flex-container align-center flex-row nowrap gap-m" style="justify-content: space-between">';
					echo "<p> Strona $pageNumber z $numberOfPages </p>";
					echo "<p> Wyświetlanie wyników&nbsp; $startRecord - $endRecord &nbsp;z&nbsp; $numberOfRecords </p>";
				echo '</div><hr>';
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
					pro.is_archived 	AS p_is_archived,
					category.name 		AS cat_name,
					color.name 			AS col_name,
					color.hex_code		AS col_hex_code,
					size.name 			AS siz_name
				FROM product pro 
				JOIN category ON pro.category_Id = category.category_Id 
				JOIN color ON pro.color_Id = color.color_Id
				JOIN size ON pro.size_Id = size.size_Id ' . 
				$hideArchived . ' 
			    ORDER BY ' . $sort . $paginationSql;
		
		$result = mysqli_query($conn, $sql);

		return [
			'products' => mysqli_fetch_all($result, MYSQLI_ASSOC),
			'pagination' => [
				'currentPage' => $pageNumber,
				'totalPages' => $numberOfPages
			]
		];

		// Użycie
		// $sort = $_GET['sort'] ?? 'default';
		// $produkty = getProducts($conn, $sort); || foreach (getProducts($conn, $sort) as $product) {}	
	}

?>