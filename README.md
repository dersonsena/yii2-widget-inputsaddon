# Yii 2 - Widget for the Boostrap Inputs Addon
A Widget for Yii 2 with a simple way to group fields with bootstrap components

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require dersonsena/yii2-widget-inputsaddon "dev-master"
```

or add

```
"dersonsena/yii2-widget-inputsaddon": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Properties

This widget supports all the parameters similar to the `\yii\widgets\InputWidget` widget. The following additional properties are important for the plugin configuration:

### side

`string` the side of the Group Addon. Possibles values: 
- `AddonAbstract::RIGHT_SIDE` (default value);
- `AddonAbstract::LEFT_SIDE`.

### size

`string` the size css class of the Group Addon. See more in: http://getbootstrap.com/components/#input-groups-sizing. Possibles values:
- `AddonAbstract::SIZE_DEFAULT` (default value);
- `AddonAbstract::SIZE_LARGE`;
- `AddonAbstract::SIZE_SMALL`;

### icon

`string` the icon css class or text of the Group Addon;

### useIconText

`boolean` if `true`, the widget will render a text instead of a HTML icon

## Usage Input Addon's

The implementations below can be done by widgets: `AreaAddon`, `EmailAddon`, `MoneyAddon`, `PercentAddon` and `PhoneAddon`:

```php
<?php 
    // the widget usege WITH ActiveForm and model. Minimal configuration
    echo $form->field($model, 'IMO_VAL_ARE')
        ->widget(EmailAddon::className()) ?>

    // the widget usege WITHOUT ActiveForm or model
    echo EmailAddon::widget([
        'name' => 'person_email',
        'value' => 'username@email.com.br'
    ]);

    // the example for costumization
    echo $form->field($model, 'email_field')
        ->widget(EmailAddon::className(), [
            'side' => EmailAddon::RIGHT_SIDE,
            'size' => EmailAddon::SIZE_LARGE,
            'icon' => 'fa fa-envelope' // default is: glyphicon glyphicon-envelope
            'forceEmailType' => true, // Force the input field to be email type. Available only for EmailAddon
            'options' => [
                'placeholder' => 'Type your email...'
            ]
        ]) ?>

    // Text instead icon
    echo $form->field($model, 'email_field')
        ->widget(EmailAddon::className(), [
            'icon' => '@'
            'useIconText' => true
        ]) ?>
```

## Usage Buttons Addon

```php
echo $form->field($model, 'person_id')
    ->widget(ButtonsAddon::className(), [
        'buttons' => [
            Html::button("<i class='glyphicon glyphicon-search'></i>", ['class' => 'btn btn-primary']),
            Html::button("Add", ['class' => 'btn btn-default', 'onclick' => 'alert("Add")']),
            Html::button("Remove", ['class' => 'btn btn-danger'])
        ]
    ]) ?>
```