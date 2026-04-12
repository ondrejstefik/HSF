<?php
$calendarMonth = isset($_GET['cal_month']) ? (int)$_GET['cal_month'] : (int)date('n');
$calendarYear = isset($_GET['cal_year']) ? (int)$_GET['cal_year'] : (int)date('Y');

if ($calendarMonth < 1 || $calendarMonth > 12) {
    $calendarMonth = (int)date('n');
}

if ($calendarYear < 2020 || $calendarYear > 2100) {
    $calendarYear = (int)date('Y');
}

$monthNames = [
    1 => 'Január',
    2 => 'Február',
    3 => 'Marec',
    4 => 'Apríl',
    5 => 'Máj',
    6 => 'Jún',
    7 => 'Júl',
    8 => 'August',
    9 => 'September',
    10 => 'Október',
    11 => 'November',
    12 => 'December'
];

$dayNames = ['Po', 'Ut', 'St', 'Št', 'Pi', 'So', 'Ne'];

$firstDayTimestamp = mktime(0, 0, 0, $calendarMonth, 1, $calendarYear);
$daysInMonth = (int)date('t', $firstDayTimestamp);
$firstDayOfWeek = (int)date('N', $firstDayTimestamp); // 1 = pondelok, 7 = nedeľa

$todayDay = (int)date('j');
$todayMonth = (int)date('n');
$todayYear = (int)date('Y');

$prevMonth = $calendarMonth - 1;
$prevYear = $calendarYear;

if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $calendarMonth + 1;
$nextYear = $calendarYear;

if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

$queryPrev = $_GET;
$queryPrev['cal_month'] = $prevMonth;
$queryPrev['cal_year'] = $prevYear;

$queryNext = $_GET;
$queryNext['cal_month'] = $nextMonth;
$queryNext['cal_year'] = $nextYear;

if (empty($queryPrev['page']) && !empty($page)) {
    $queryPrev['page'] = $page;
}

if (empty($queryNext['page']) && !empty($page)) {
    $queryNext['page'] = $page;
}

$prevUrl = 'index.php?' . http_build_query($queryPrev);
$nextUrl = 'index.php?' . http_build_query($queryNext);
?>

<div class="mini-calendar">
    <div class="mini-calendar__header">
        <a href="<?= htmlspecialchars($prevUrl) ?>" class="mini-calendar__nav" aria-label="Predchádzajúci mesiac">‹</a>
        <div class="mini-calendar__title"><?= $monthNames[$calendarMonth] ?> <?= $calendarYear ?></div>
        <a href="<?= htmlspecialchars($nextUrl) ?>" class="mini-calendar__nav" aria-label="Nasledujúci mesiac">›</a>
    </div>

    <div class="mini-calendar__weekdays">
        <?php foreach ($dayNames as $dayName): ?>
            <div class="mini-calendar__weekday"><?= htmlspecialchars($dayName) ?></div>
        <?php endforeach; ?>
    </div>

    <div class="mini-calendar__grid">
        <?php for ($i = 1; $i < $firstDayOfWeek; $i++): ?>
            <div class="mini-calendar__day mini-calendar__day--empty"></div>
        <?php endfor; ?>

        <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
            <?php
            $isToday = (
                $day === $todayDay &&
                $calendarMonth === $todayMonth &&
                $calendarYear === $todayYear
            );
            ?>
            <div class="mini-calendar__day <?= $isToday ? 'mini-calendar__day--today' : '' ?>">
                <?= $day ?>
            </div>
        <?php endfor; ?>
    </div>
</div>