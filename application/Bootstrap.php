<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Init Doctype
     */
    protected function _initDoctype()
    {
        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');
    }

}