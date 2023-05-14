<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => '/admin/users',
        'options' => ['class' => 'navbar-dark navbar-fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto navbar-grid'],
        'items' => [
            ['label' => 'Users', 'url' => ['/admin/users']],
            ['label' => 'Addresses', 'url' => ['/admin/addresses']],
            ['label' => 'Passports', 'url' => ['/admin/passports']],
            ['label' => 'Persons', 'url' => ['/admin/persons']],
            ['label' => 'Patients', 'url' => ['/admin/patients']],
            ['label' => 'Roles', 'url' => ['/admin/roles']],
            ['label' => 'Employees', 'url' => ['/admin/employees']],
            ['label' => 'Departments', 'url' => ['/admin/departments']],
            ['label' => 'DepartmentEmployee', 'url' => ['/admin/department-employee']],
            ['label' => 'Branches', 'url' => ['/admin/branches']],
            ['label' => 'Branch Department', 'url' => ['/admin/branch-department']],
            ['label' => 'Suppliers', 'url' => ['/admin/suppliers']],
            ['label' => 'Pharmacy', 'url' => ['/admin/pharmacy']],
            ['label' => 'Talons', 'url' => ['/admin/talons']],
            ['label' => 'Treatments', 'url' => ['/admin/treatments']],
            ['label' => 'Pricelist', 'url' => ['/admin/pricelist']],
            ['label' => 'Person Address', 'url' => ['/admin/person-address']],
            ['label' => 'Positions', 'url' => ['/admin/positions']],
            ['label' => 'Comments', 'url' => ['/admin/comments']],
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; СТАРОМЕД <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end">Admin Panel</div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
