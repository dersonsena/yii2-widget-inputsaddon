<?php

namespace dersonsena\inputsAddon;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

abstract class AddonAbstract extends InputWidget
{
    const RIGHT_SIDE = 'right';
    const LEFT_SIDE = 'left';

    const SIZE_DEFAULT = '';
    const SIZE_LARGE = 'input-group-lg';
    const SIZE_SMALL = 'input-group-sm';

    /**
     * Side of the Group Addon
     * @var string
     */
    public $side;

    /**
     * Size class of the Group Addon. Please, follow and use the class constants
     * @see http://getbootstrap.com/components/#input-groups-sizing
     * @var
     */
    public $size;

    /**
     * Icon or Text of the Group Addon
     * @var string
     */
    public $icon = '';

    /**
     * if TRUE, the widget will render a text instead of a HTML icon
     * @var bool
     */
    public $useIconText = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this instanceof ButtonsAddon)
            $this->side = (!empty($this->side) && !is_null($this->side) ? $this->side : self::RIGHT_SIDE);
        else
            $this->side = (!empty($this->side) && !is_null($this->side) ? $this->side : self::LEFT_SIDE);

        $this->options = ArrayHelper::merge([
            'class' => 'form-control',
        ], $this->options);

        if (!$this->hasModel())
            $this->options['id'] = $this->name;
    }

    public function run()
    {
        return '
            <div class="input-group '. $this->size .'">
                '. ($this->side === self::LEFT_SIDE ? $this->getInputGroupAddTemplate() : '') .'
                '. $this->getHTMLInput() .'
                '. ($this->side === self::RIGHT_SIDE ? $this->getInputGroupAddTemplate() : '') .'
            </div>
        ';
    }

    /**
     * Method that mounts the portion of HTML to the Group
     * @return string
     */
    protected function getInputGroupAddTemplate(): string
    {
        $inputGroupAddTemplate = '<span class="input-group-addon"><i class="'. $this->icon.'"></i></span>';

        if ($this->useIconText === true)
            $inputGroupAddTemplate = '<span class="input-group-addon">'. $this->icon.'</span>';

        return $inputGroupAddTemplate;
    }

    /**
     * @return string
     */
    protected function getHTMLInput(): string
    {
        if ($this->hasModel())
            return Html::activeTextInput($this->model, $this->attribute, $this->options);

        return Html::input('text', $this->name, $this->value, $this->options);
    }
}