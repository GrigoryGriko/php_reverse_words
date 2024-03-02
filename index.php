<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Заголовок</h1>
    <?php 
        function validatePunctMark($string) {   //проверка на знак препинания
            return preg_match('/[^A-Za-zа-яА-Я]+/u', $string) === 0; 
        }

        function mixSymbols($symbolsArr, $lastIndex) {
            for ($i = 0; $i <= $lastIndex; $i++) {
                $indexForPush = $lastIndex - $i;
                $symbol = $symbolsArr[$i];

                if (validatePunctMark($symbol)) {  //если символ является знаком препинания
                    $newWordsArr[$i] = $symbol;   //то оставляем его, сохраняя под тем же индексом
                } else {
                    if (ctype_upper($symbolsArr[$indexForPush])) {      //если буква, которую заменим заглавная
                        strtoupper($symbol);//то перенесенную букву делаем заглавной
                    }   
                    $newWordsArr[$indexForPush] = $symbol;  //добавляем символ в новый массив с конца
                }
                //в любом случае выполняем
            }
        }

        function revertCharacters($words) {
            $wordsArr = explode(' ', $words);   //массив со словами

            $newWordsArr = [];  //итоговый массив слов

            foreach ($wordsArr as $val) {
                $symbolsArr = explode('', $val);    //создаем из слова массив символов
                $lastIndex = count($symbolsArr) - 1;  //узнаем последний индекс массива символов
                
                mixSymbols($symbolsArr, $lastIndex);
            }

            return $newWordsArr;
        }

        
        echo revertCharacters("Привет! Давно не виделись."); //массив слов
         // Тевирп! Онвад ен ьсиледив.
    ?>
</body>
</html>