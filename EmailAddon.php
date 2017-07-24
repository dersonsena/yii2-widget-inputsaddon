<?php

namespace backend\widgets\inputsAddon;

use yii\helpers\Html;

class EmailAddon extends AddonAbstract
{
    /**
     * Force the field to be email type
     * @var bool
     */
    public $forceEmailType = false;

    public $icon = 'glyphicon glyphicon-envelope';

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->forceEmailType)
            $this->options['type'] = 'email';

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
    protected function getHTMLInput(): string
    {
        if ($this->hasModel())
            return Html::activeTextInput($this->model, $this->attribute, $this->options);

        return Html::input(($this->forceEmailType ? 'email' : 'text'), $this->name, $this->value, $this->options);
    }
}