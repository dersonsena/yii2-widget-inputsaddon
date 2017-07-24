<?php

namespace dersonsena\inputsAddon;

use yii\helpers\Html;
use yii\widgets\MaskedInput;

class PhoneAddon extends AddonAbstract
{
    /**
     * Force the field to be tel type
     * @var bool
     */
    public $forceTelType = false;

    /**
     * @var array|string
     */
    public $mask = ['(99) 99999-9999', '(99) 9999-9999'];

    public $icon = 'glyphicon glyphicon-phone-alt';

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->forceTelType)
            $this->options['type'] = 'tel';

        return '
            <div class="input-group">
                '. ($this->side === self::LEFT_SIDE ? $this->getInputGroupAddTemplate() : '') .'
                '. $this->getHTMLInput() .'
                '. ($this->side === self::RIGHT_SIDE ? $this->getInputGroupAddTemplate() : '') .'
            </div>
        ';
    }

    /**
     * @inheritdoc
     */
    protected function getHTMLInput():string
    {
        if ($this->hasModel()) {
            $input = Html::activeTextInput($this->model, $this->attribute, $this->options);

            if (!empty($this->mask) && !is_null($this->mask)) {
                $input = MaskedInput::widget([
                    'model' => $this->model,
                    'attribute' => $this->attribute,
                    'mask' => $this->mask
                ]);
            }

            return $input;
        }

        if (!empty($this->mask) && !is_null($this->mask)) {
            return MaskedInput::widget([
                'name' => $this->name,
                'mask' => $this->mask,
                'value' => $this->value,
                'options' => $this->options
            ]);
        }

        return Html::input(($this->forceTelType ? 'tel' : 'text'), $this->name, $this->value, $this->options);
    }
}