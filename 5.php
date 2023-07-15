<?php
declare(strict_types=1);

// Эта штука для русского языка мне не помогла
// setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');

// Ввод
echo 'Введите год в формате <yyyy>: ';
$input_year = intval(trim(fgets(STDIN)));

echo 'Введите месяц в формате <m>: ';
$input_month = intval(trim(fgets(STDIN)));

get_schedule($input_year, $input_month);

function get_schedule(int $year, int $month ) {
    // Создаем тайм-штамп
    $timestamp_date = mktime(0, 0, 0, $month, 1, $year);

    // Для русского языка
    $months = array("январе","феврале","марте","апреле","мае","июне","июле","августе","сентябре","октябре","ноябре","декабре");

    // Кол-во дней в месяце
    $monthlength = cal_days_in_month(CAL_GREGORIAN, intval(date("m", $timestamp_date)), intval(date("Y", $timestamp_date)));

    echo PHP_EOL;
    echo 'В ' . $months[date("n", $timestamp_date)-1] . ' ' . date("Y", $timestamp_date) . ' года всего ' . $monthlength . ' дней.' . PHP_EOL;
    echo 'Рабочее расписание на выбранный месяц:' . PHP_EOL;
    echo PHP_EOL;

    $workday = 2;

    for ($day = 1; $day <= $monthlength; ++$day) {
        
        ++$workday;
        if (date("N", $timestamp_date) < 6 and $workday > 2) {
            //Окраска зеленым
            echo "\033[32m" . $day . "\033[0m" . " (" . date("l", $timestamp_date) .")" . PHP_EOL;
            // Добавляем +день
            $timestamp_date = $timestamp_date + 24*60*60;
            // Сбрасываем счетчик
            $workday = 0;
        } else {
            //Окраска красным
            echo "\033[31m" . $day . "\033[0m" . " (" . date("l", $timestamp_date) .")" . PHP_EOL;
            // Добавляем +день
            $timestamp_date = $timestamp_date + 24*60*60;
        }
    }
}

?>