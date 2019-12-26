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
//Получаем массив примеров и ответов
$arrWithExamples = $_POST;

//Массив где хранятся результаты выполненя примера программой (не пользователем)
$arrCalculationResults = [];

//Массив пользовательских ответов
$arrCustomAnswers = [];

//Массив где хранятся разделенные значения ключа массива $arrWithExamples (то есть сам пример разделенный на ключи)
$arrDivisionKey = [];

//Разбераем основной массив на ключ - значение. Ключ разбиваем на массив по разделителю "_"
foreach ($arrWithExamples as $key => $value){
	if ($key == 'send'){
		continue;
	}
	$arrDivisionKey[] = explode('_', $key);
	$arrCustomAnswers[] = $value;
}

//Решаем переданные примеры. Перед решением выводим валидный арифметический оператор.
for ($i = 0; $i <= count($arrDivisionKey); ++$i){
	if ($arrDivisionKey[$i][1] == '-'){
		$arrCalculationResults[] = $arrDivisionKey[$i][0] - $arrDivisionKey[$i][2];
	}
	if ($arrDivisionKey[$i][1] == '/'){
		$result = $arrDivisionKey[$i][0] / $arrDivisionKey[$i][2];
		$globalResult = number_format($result, 1, '.', '');
		$arrCalculationResults[] = $globalResult;
	}
	if ($arrDivisionKey[$i][1] == '+'){
		$arrCalculationResults[] = $arrDivisionKey[$i][0] + $arrDivisionKey[$i][2];
	}
	if ($arrDivisionKey[$i][1] == '*'){
		$arrCalculationResults[] = $arrDivisionKey[$i][0] * $arrDivisionKey[$i][2];
	}
}

//Сравниваем два массива. Один с решениями генерирумым программой а второй с ответами пользователя.
//В зависимости от результата выводим то или иное сообщение
//Вводим переменную j что бы легче было считать примеры
$j = 1;
$rightAnswers = 0;
$wrongAnswers = 0;
for ($i = 0; $i < count($arrCalculationResults); ++$i ){
	if ($arrCalculationResults[$i] == $arrCustomAnswers[$i]){
		echo "Ответ на пример $j - правильный = $arrCustomAnswers[$i]".'<br>';
		++$rightAnswers;
	}else{
		echo "Ответ на пример $j - не правильный. Правильный ответ = $arrCalculationResults[$i]" .'<br>';
		++$wrongAnswers;
	}
	++$j;
}
echo "<br><strong>Правильные ответы $rightAnswers / Не правильные ответы $wrongAnswers</strong>";
?>
</body>
</html>

