<?php

class Application_Form_Guestbook extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Set the App class to the form
        $this->setAttrib('class', 'app');

        // Add an email element
        $this->addElement('text', 'email', array(
            'label' => 'Your email address:',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
        ));

        // Add the comment element
        $this->addElement('textarea', 'comment', array(
            'label' => 'Please Comment:',
            'required' => true,
            'rows' => '7',
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 140))
            )
        ));

        // BaseURL
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();

        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label' => 'Please enter the 5 letters displayed below:',
            'placeholder' => 'Enter code here',
            'required' => true,
            'captcha' => array(
                'captcha' => 'Image',
                'width' => 130,
                'height' => 24,
                'timeout' => 300,
                'gcFreq' => 5,
                'wordLen' => 5,
                'fontSize' => 14,
                'dotNoiseLevel' => 0,
                'lineNoiseLevel' => 2,
                'font' => APPLICATION_PATH . '/../public/captcha/font/arial.ttf',
                'imgDir' => APPLICATION_PATH . '/../public/captcha/images/',
                'imgUrl' => $baseUrl . '/public/captcha/images/',
            )
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Sign Guestbook',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

        // Applying decoration for all elements
        $this->addElementPrefixPath('App_Form_Decorator', 'App/Form/Decorator', 'decorator');
        $this->setElementDecorators(array('Composite'));
    }

}