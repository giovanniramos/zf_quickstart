<?php

class Application_Form_Books extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Added a hidden field for Id 
        $this->addElement('hidden', 'id');

        // Add an title element
        $this->addElement('text', 'title', array(
            'label' => 'Book title:',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        // Add an author element
        $this->addElement('text', 'author', array(
            'label' => 'Author of the book:',
            'required' => true,
            'filters' => array('StringTrim')
        ));

        // Add the comment element
        $this->addElement('textarea', 'description', array(
            'label' => 'Description:',
            'required' => true,
            'rows' => '7'
        ));


        // Add the cancel button
        $this->addElement('button', 'cancelar', array(
            'label' => 'Cancel',
            'attribs' => array('onclick' => "javascript:location.href = 'index'")
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Save Book',
        ));

        $this->getElement('cancelar')->removeDecorator('DtDdWrapper');
        $this->getElement('submit')->removeDecorator('DtDdWrapper');


        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }

}