<?php
    $this->title = 'СТАРОМЕД - Пользователь ' . Yii::$app->user->identity->EMAIL;

    function getEmployeeInfo($id, $array)
    {
        $emp = $array[array_search($id, array_column($array, 'ID'))];
        $result = $emp['SECOND_NAME'] . " "
            . strtoupper(mb_substr($emp['FIRST_NAME'], 0, 1)) . ". "
            . strtoupper(mb_substr($emp['LAST_NAME'], 0, 1)) . ". ("
            . $emp['POSITION_NAME'] . ")";

        return $result;
    }

    function getPatient($talon)
    {
        return $talon['SECOND_NAME'] . " " . $talon['FIRST_NAME'] . " " . $talon['LAST_NAME']; 
    }
?>

<div class="user-default-index">
    <h2 id="talons-header">Забронированные талоны</h2>
    <div class="row talons">
        <?php
            foreach ($talons as $talon) {
                echo "<div class='talon' talon-id=" . $talon['ID'] . ">";
                    echo "<div class='talon-row'>";
                        echo "<p class='talon-title'>Врач</p>";
                        echo "<p class='talon-employee'>" . getEmployeeInfo($talon['EMPLOYEE_ID'], $employees) . "</p>";
                    echo "</div>";
                    echo "<div class='talon-row'>";
                        echo "<p class='talon-title'>Дата</p>";
                        echo "<p class='talon-date'>" . $talon['TALON_DATE'] . "</p>";
                    echo "</div>";
                    echo "<div class='talon-row'>";
                        echo "<p class='talon-title'>Пациент</p>";
                        echo "<p class='talon-patient'>" . getPatient($talon) . "</p>";
                    echo "</div>";
                    echo "<button class='talon-button'><a href='/user/default/delete-talon?ID=" . $talon['ID'] . "'>Удалить бронь</a></button>";
                echo "</div>";
            }  
        ?>
    </div>
</div>
