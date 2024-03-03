<?php
    header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function validatePunctMark($string) {   //проверка на знак препинания
            return preg_match('/[^A-Za-zа-яА-Я]+/u', $string) === 0; 
        }

        function mixSymbols($symbolsArr, $lastIndex) {
            $newSymbolsArr = [];

            for ($i = 0; $i <= $lastIndex; $i++) {
                $indexForPush = $lastIndex - $i;
                $symbol = $symbolsArr[$i];

                if (validatePunctMark($symbol)) {  //если символ является знаком препинания
                    $newSymbolsArr[$i] = $symbol;   //то оставляем его, сохраняя под тем же индексом
                } else {
                    if (ctype_upper($symbolsArr[$indexForPush])) {      //если буква, которую заменим заглавная
                        strtoupper($symbol);//то перенесенную букву делаем заглавной
                    }   
                    $newSymbolsArr[$indexForPush] = $symbol;  //добавляем символ в новый массив с конца
                }
            }

            sort($newSymbolsArr);
            return implode('', $newSymbolsArr); //соединяем новый массив букв
        }

        function revertCharacters($words) {
            $wordsArr = explode(' ', $words);    //массив со словами

            $newWordsArr = [];  //итоговый массив слов

            foreach ($wordsArr as $val) {
                $symbolsArr = preg_split('//u',$val,-1,PREG_SPLIT_NO_EMPTY);    //создаем из слова массив символов  (для кодировки utf-8)
                $lastIndex = count($symbolsArr) - 1;  //узнаем последний индекс массива символов
                print_r($symbolsArr);
                
                array_push($newWordsArr, mixSymbols($symbolsArr, $lastIndex));  //добавляем слово в новый массив слов
            }
            
            return implode(' ', $newWordsArr);  //соединяем элементы нового массива слов
        }
        
        echo '<h1>Заголовок</h1>';
        echo revertCharacters("Привет! Давно не виделись.");
        
        //echo '<p>'.revertCharacters("Привет! Давно не виделись.").'</p>'; //массив слов
        
         // Тевирп! Онвад ен ьсиледив.*/
    ?>
</body>
</html>