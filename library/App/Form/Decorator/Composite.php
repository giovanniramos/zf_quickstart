<?php

class App_Form_Decorator_Composite extends Zend_Form_Decorator_Abstract implements Zend_Form_Decorator_Marker_File_Interface
{

    public function buildLabel()
    {
        $element = $this->getElement();
        $noLabel = array(Zend_Form_Element_Submit, Zend_Form_Element_Hidden);

        foreach ($noLabel as $class) {
            if ($element instanceof $class) {
                return false;
            }
        }

        $label = $element->getLabel();
        $translator = $element->getTranslator();

        if ($translator) {
            $label = $translator->translate($label);
        }

        if ($element->isRequired() && !$element->getIgnore()) {
            $label.= ' *';
        }

        return $element->getView()->formLabel($element->getName(), $label);
    }

    public function buildInput()
    {
        $element = $this->getElement();
        $helper = $element->helper;

        if ($element instanceof Zend_Form_Element_Submit) {
            $value = $element->getValue() != '' ? $element->getValue() : $element->getLabel();
        } else {
            $value = $element->getValue();
        }

        return $element->getView()->$helper($element->getFullyQualifiedName(), $value, $element->getAttribs(), $element->options);
    }

    public function buildErrors()
    {
        $element = $this->getElement();
        $messages = $element->getMessages();

        if (empty($messages)) {
            return '';
        }

        list($key, $error) = each($messages);
        $message = '<br /><div class="errors">' . $error . '</div>';

        return $message;
    }

    public function buildDescription()
    {
        $element = $this->getElement();
        $desc = $element->getDescription();

        if (empty($desc)) {
            return '';
        }

        return '<div class="description">' . $desc . '</div>';
    }

    public function render($content)
    {
        $element = $this->getElement();

        if (!$element instanceof Zend_Form_Element) {
            return $content;
        }

        if (null === $element->getView()) {
            return $content;
        }

        if ($element instanceof Zend_Form_Element_Captcha) {
            $label = $element->getLabel();
            $errors = $this->buildErrors();

            $output_format = '<div id="' . $element->getName() . '-element" class="element captcha">';
            $output_format.= '<div id="' . $element->getName() . '-tit" class="element-tit"><label for="' . $element->getName() . '">' . $label . '</label></div>';
            $output_format.= '<div id="' . $element->getName() . '-content" class="element-content">' . $content . ' ' . $errors . '</div>';
            $output_format.= '</div>';

            return $output_format;
        }

        if ($element instanceof Zend_Form_Element_Hidden) {
            $output_format = '%1$s%2$s%3$s%4$s';
        } elseif ($element instanceof Zend_Form_Element_Submit) {
            $output_format = '<div id="' . $element->getName() . '-element" class="element button">%1$s%2$s%3$s%4$s</div>';
        } elseif ($element instanceof Zend_Form_Element_Checkbox) {
            $output_format = '<div id="' . $element->getName() . '-element" class="element checkbox">';
            $output_format.= '<div id="' . $element->getName() . '-content" class="element-content">%1$s%2$s%3$s%4$s</div>';
            $output_format.= '</div>';
        } else {
            $output_format = '<div id="' . $element->getName() . '-element" class="element default">';
            $output_format.= '<div id="' . $element->getName() . '-tit" class="element-tit">%1$s</div>';
            $output_format.= '<div id="' . $element->getName() . '-content" class="element-content">%2$s%3$s%4$s</div>';
            $output_format.= '</div>';
        }

        $placement = $this->getPlacement();
        $separator = $this->getSeparator();
        $label = $this->buildLabel();
        $input = $this->buildInput();
        $errors = $this->buildErrors();
        $desc = $this->buildDescription();

        $output = sprintf($output_format, $label, $input, $errors, $desc);

        switch ($placement) {
            case 'PREPEND':
                $content = $output . $separator . $content;
                break;
            case 'APPEND':
            default:
                $content = $content . $separator . $output;
        }
        return $content;
    }

}

?>
