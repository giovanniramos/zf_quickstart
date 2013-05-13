<?php

class Application_Form_Guestbook extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        $this->addElementPrefixPath('App_Decorator', 'App/Decorator', 'decorator');

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
                array('validator' => 'StringLength', 'options' => array(0, 20))
            )
        ));

        // BaseURL
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();

        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label' => 'Please enter the 5 letters displayed below:',
            'required' => true,
            'captcha' => array(
                'captcha' => 'Image',
                'width' => 130,
                'height' => 60,
                'timeout' => 300,
                'wordLen' => 5,
                'fontSize' => 25,
                'gcFreq'    => 5,
                'dotNoiseLevel' => 3,
                'lineNoiseLevel' => 3,
                'font' => APPLICATION_PATH . '/../public/captcha/font/arial.ttf',
                'imgDir' => APPLICATION_PATH . '/../public/captcha/images/',
                'imgUrl'=>  $baseUrl . '/public/captcha/images/',
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
    }

}