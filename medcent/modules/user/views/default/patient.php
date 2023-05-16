<?php
    use app\models\Person;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    
    $this->title = "СТАРОМЕД - Пациент: " . $person->FIRST_NAME . " " . $person->SECOND_NAME;
?>

<div class="user-patient-index">
    <h2 id="talons-header">Пациент: <?= $person->FIRST_NAME . " " . $person->SECOND_NAME ?></h2>
    <h3 style="margin-top: 30px">Адреса</h3>
    <div class="row addresses">
        <?php
            if (count($addresses) !== 0) {
                foreach ($addresses as $address) {
        ?>
            <div class="address" address-id=<?= $address['ID'] ?>>
                <p class="address-info">
                    Aдрес: 
                    <?= $address['REGION'] . ', н.п. '
                            . $address['TOWN'] . ', ул. '
                            . $address['STREET'] . ', д. '
                            . $address['HOUSE_NUMBER']
                            . ($address['FLAT'] ? ', кв. '. $address['FLAT'] : '')?>
                </p>
                <button class="delete-address"><a href="/user/default/delete-address?ID=<?= $address['ID']?>">Удалить адрес</a></button>
            </div>
        <?php
                }
            } else {
        ?>
            <h3>Нет привязанных адресов</h3>
        <?php
            }
        ?>
    </div>
    <button class="personal-data"><a href="/user/update-person/<?= $person->ID ?>">Персональные данные</a></button>
    <button class="add-address"><a href="/user/add-address/<?= $person->ID ?>">Добавить адрес</a></button>
</div>