<?php
    $talonsByPositions = [];

    foreach ($talons as $talon) {
        $emp = $talon['POSITION_NAME'] . getDeaprtmentInfo($talon);
        $talonsByPositions[$emp][0] = $emp;
        $talonsByPositions[$emp][1][] = $talon;
    }

    function getDeaprtmentInfo($talon)
    {
        return ' (обл. '
            . $talon['REGION'] . ', '
            . $talon['TOWN'] . ', ул. '
            . $talon['STREET'] . ', д. '
            . $talon['HOUSE_NUMBER'] . ')';
    }

    function getEmployeeInfo($talon)
    {
        return $talon['SECOND_NAME'] . ' '
            . strtoupper(mb_substr($talon['FIRST_NAME'], 0, 1)) . ". "
            . strtoupper(mb_substr($talon['LAST_NAME'], 0, 1)) . ".";
    }

    $this->title = "СТАРОМЕД - Талоны";
?>

<div class="site-talons">
    <h1 id="talons-header" style="margin-bottom: 30px">Заказать талон</h1>
        <?php
            foreach ($talonsByPositions as $position) {
        ?>
            <h3><?= $position[0] ?></h3>
            <div class="row talons book-talons">
                <?php
                    foreach ($position[1] as $talon) {
                ?>
                    <div class="talon">
                        <div class="talon-row">
                            <p class="talon-title">Врач</p>
                            <p class="talon-employee"><?= getEmployeeInfo($talon) ?></p>
                        </div>
                        <div class="talon-row">
                            <p class="talon-title">Дата</p>
                            <p class="talon-date"><?= $talon['TALON_DATE'] ?></p>
                        </div>
                        <button class="talon-button book-talon-button"><a href="/talons/book-talon/<?= $talon['ID'] ?>">Заказать</a></button>
                    </div>
                <?php
                    }
                ?>
            </div>
        <?php
            }
        ?>
    </div>
</div>