<?php

namespace dersonsena\inputsAddon;

use yii\base\InvalidConfigException;

class ButtonsAddon extends AddonAbstract
{
    /**
     * List of the HTML Buttons for the group
     * @var array
     */
    public $buttons;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->buttons) || is_null($this->buttons))
            throw new InvalidConfigException("Either 'buttons' property must be specified.");
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return '
            <div class="input-group '. $this->size .'">
                '. ($this->side === self::LEFT_SIDE ? $this->getInputGroupButtonTemplate() : '') .'
                '. $this->getHTMLInput() .'
                '. ($this->side === self::RIGHT_SIDE ? $this->getInputGroupButtonTemplate() : '') .'
            </div>
        ';
    }

    /**
     * Method that mounts the portion of HTML to the Buttons Group
     * @return string
     */
    protected function getInputGroupButtonTemplate(): string
    {
        $inputGroupButtonTemplate = "<span class='input-group-btn'>\n";

        foreach ($this->buttons as $button)
            $inputGroupButtonTemplate .= $button . "\n";

        $inputGroupButtonTemplate .= "</span>\n";

        return $inputGroupButtonTemplate;
    }
}