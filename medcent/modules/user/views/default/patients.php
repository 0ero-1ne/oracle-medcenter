<?php

    $this->title = 'СТАРОМЕД - Пациенты ' . Yii::$app->user->identity->EMAIL;
?>

<div class="user-patients-index">
    <h2 id="talons-header">Список пациентов</h2>
    <div class="row patients">
        <?php
            foreach($patients as $patient) {
        ?>
            <div class="patient" id="<?= $patient['ID']?>">
                <div class="patient-row">
                    <p class="patient-title">Имя</p>
                    <p class="patient-first_name"><?=  $patient['FIRST_NAME']?></p>
                </div>
                <div class="patient-row">
                    <p class="patient-title">Фамилия</p>
                    <p class="patient-second_name"><?=  $patient['SECOND_NAME']?></p>
                </div>
                <div class="patient-row">
                    <p class="patient-title">Отчество</p>
                    <p class="patient-last_name"><?=  $patient['LAST_NAME']?></p>
                </div>
                <div class="patient-row">
                    <p class="patient-title">Дата рождения</p>
                    <p class="patient-birth_date"><?=  substr($patient['BIRTH_DATE'], 0, 10)?></p>
                </div>
                <button class="patient-button"><a href="/user/patient/<?= $patient['ID']?>">Подробнее</a></button>
            </div>
        <?php 
            }
        ?>
    </div>
    <button class="add-patient"><a href="/user/add-patient">Добавить пациента</a></button>
</div>
