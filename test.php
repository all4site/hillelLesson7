<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<?php
const MINLENGTH = -100;
const MAXLENGTH = 100;
const SYMBOL = ['+' , '-' , '/' , '*' ];

//Проверяется через frontend
$maxCount = $_GET['exercise'];

//Пустой массив для хранения сгенерированных примеров
$arrExercise = [];

//Геренируем примеры
for ($i = 1; $i <= $maxCount; ++$i){
	$operatorArithmetic = SYMBOL[array_rand(SYMBOL, 1)];
	$operatorLeft = random_int(MINLENGTH, MAXLENGTH);
	$operatorRight = random_int(MINLENGTH, MAXLENGTH);

	$arrExercise[] = "$operatorLeft $operatorArithmetic $operatorRight";
}

?>
<p>Примеры с зяпятой надо округлять до десятичного значения</p>
<form action="check.php" method="post">
<!--	Создание счетчика для label. Так как мы не знаем сколько будет примеров то что бы label всегда был уникальным-->
	<?php $i = 0;?>
<!--	Вывод сгенерированых ранее примеров с полем для ответа-->
	<?php	foreach ($arrExercise as $value):?>
		<div style="margin: 10px 0;">
			<label for="result_<?php echo $i ?>"><?php echo $value ?> = </label>
			<input type="number" step="0.01" name="<?php echo $value ?>" id="result_<?php echo $i ?>" required>
		</div>
	<?php ++$i?>
	<?php endforeach;?>
	<input type="submit" value="Send" name="send">
</form>
</body>
</html>

