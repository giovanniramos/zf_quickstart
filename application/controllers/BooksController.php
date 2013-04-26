<?php

class BooksController extends Zend_Controller_Action
{
    /**
     * @var Application_Model_BooksMapper
     */
    private $_mapper_guestbook;

    public function init()
    {
        $this->_mapper_guestbook = new Application_Model_BooksMapper();
    }

    public function indexAction()
    {
        $this->view->entries = $this->_mapper_guestbook->fetchAll();
    }

    public function saveAction()
    {
        $request = $this->getRequest();

        $form = new Application_Form_Books();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $values = $form->getValues();
                $data = new Application_Model_Books($values);
                $this->_mapper_guestbook->save($data);

                return $this->_helper->redirector('index');
            }
        }

        $id = $request->getParam('id');
        if ((int) $id > 0) {
            $data = $this->_mapper_guestbook->find($id);
            $form->setDefaults($data);
        }

        $this->view->form = $form;
    }

    public function deleteAction()
    {
        $request = $this->getRequest();

        $id = $request->getParam('id');
        if ((int) $id > 0) {
            $this->_mapper_guestbook->delete($id);
        }
    }

}