<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Calendar</title>
    <link rel="stylesheet" href="calendar.css">
</head>

<body>
    <?php
    
    $month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
    $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

    if ($month < 1) {
        $month = 12;
        $year--;
    } elseif ($month > 12) {
        $month = 1;
        $year++;
    }

    // Get current date
    $today = date('Y-m-d');
    $currentDay = date('d');
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Get first day of the month
    $firstDay = mktime(0, 0, 0, $month, 1, $year);
    $dayOfWeek = date('w', $firstDay);

    // Get total days in the month
    $daysInMonth = date('t', $firstDay);
    
    ?>

    <div class="custom-calendar-wrap">
        <div class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <a href="?month=<?=($month - 1)?>&year=<?=($year)?>" class="custom-btn custom-prev"></a>
                    <a href="?month=<?=($month + 1)?>&year=<?=($year)?>" class="custom-btn custom-next"></a>
                </nav>
                <h2 id="custom-month" class="custom-month"><?= date('F', $firstDay) ?></h2>
                <h3 id="custom-year" class="custom-year"><?= date('Y', $firstDay) ?></h3>
            </div>
            <div id="calendar" class="fc-calendar-container">
                <div class="fc-calendar fc-six-rows">
                    <div class="fc-head">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="fc-body">
                        <div class="fc-row">
                            <?php
                            
                            for ($i = 0; $i < $dayOfWeek; $i++) {
                                echo "<div><span class='fc-date'></span></div>";
                            }

                            for ($day = 1; $day <= $daysInMonth; $day++) {
                                $currentDate = sprintf('%04d-%02d-%02d', $year, $month, $day);
                                $class = $currentDate == $today ? 'fc-today' : '';

                                echo "<div class='$class'><span class='fc-date'>$day</span></div>";

                                if (((($i + $day)) % 7) == 0) {
                                    echo "</div>";
                                    echo "<!-- ($i + $day + 1) -->";
                                    echo "<div class='fc-row'>";
                                }
                            }
                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>