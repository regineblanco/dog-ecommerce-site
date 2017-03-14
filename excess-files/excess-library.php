$items = [
		[
		'Photo' => 'photos/leash.jpg',
		'Item' => 'Leash Me Not',
		'Price' => 'P50,000',
		'Category' => 'Essentials'
		],
		[
		'Photo' => 'photos/bed.png',
		'Item' => 'Luxury Bed',
		'Price' => 'P1,000,000',
		'Category' => 'Cribs'
		],
		[
		'Photo' => 'photos/bowl.jpg',
		'Item' => 'I\'m Hungry Dog Bowl',
		'Price' => 'P400',
		'Category' => 'Essentials'
		],
		[
		'Photo' => 'photos/pedigree.png',
		'Item' => 'Pedigree',
		'Price' => 'P500',
		'Category' => 'Munchies'
		],
		[
		'Photo' => 'photos/haru.jpg',
		'Item' => 'Hire Haru',
		'Price' => 'P500',
		'Category' => 'Dog Yayas'
		],
		[
		'Photo' => 'photos/barkin.png',
		'Item' => 'Barkin\' Blends',
		'Price' => 'P150-P5,000',
		'Category' => 'Interactions'
		],
	];

$users = [
		['username' => 'admin', 'password' => 'admin'],
		['username' => 'simplyme', 'password' => '123'],
		['username' => 'hotnessoverload', 'password' => '456']
	];
	
	$fp = fopen('items.json', 'w');
	fwrite($fp, json_encode($items, JSON_PRETTY_PRINT));
	fclose($fp);

	$fp = fopen('users.json', 'w');
	fwrite($fp, json_encode($users, JSON_PRETTY_PRINT));
	fclose($fp);