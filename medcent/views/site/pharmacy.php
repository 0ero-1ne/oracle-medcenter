<?php
    $this->title = 'СТАРОМЕД - Аптека';
?>

<div class="site-index">
    <div class="body-content">
        <div class="row-header">
                <h1 style="font-weigth: 400;">Аптека</h1>
        </div>
        <div class="pharmacy">
            <?php
                foreach ($pharmacy as $drug) {
            ?>
                <div class="drug">
                    <div class="drug-row">
                        <p class="drug-title">Препорат</p>
                        <p class="drug-name"><?= $drug['DRUG'] ?></p>
                    </div>
                    <div class="drug-row">
                        <p class="drug-title">Поставщик</p>
                        <p class="drug-supplier"><?= $drug['SUPPLIER_NAME'] ?></p>
                    </div>
                    <div class="drug-row">
                        <p class="drug-title">Цена</p>
                        <p class="drug-price"><?= $drug['PRICE'] ?></p>
                    </div>
                    <div class="drug-row">
                        <p class="drug-title">Рецепт</p>
                        <p class="drug-price"><?= $drug['NEED_RECIPE'] === '0' ? 'Не нужен' : 'Нужен' ?></p>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>