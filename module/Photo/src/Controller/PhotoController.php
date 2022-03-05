<?php

namespace Photo\Controller;

use Application\Model\User;
use Application\Tools\MainController;
use Photo\Form\PhotoForm;
use Photo\Model\Photo;

/**
 * Photo controller
 * By default a controller has 4 actions : index, add, edit, delete
 * It's able to mapping alone when we call /index, /add, etc ...
 * Mapping also affect view selections, wich is in /view/controllerName/routeName -> /view/photo/photo.
 * So return new ViewModel and it will select its views by default
 */
class PhotoController extends MainController
{

    public function indexAction()
    {
        return [
            'photos' => $this->getRepository(Photo::class)->findAll()
        ];
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function addAction()
    {
        $form = new PhotoForm();
        $form->get("submit")->setValue("Add");
        $request = $this->getRequest();
        if(!$request->isPost()){
            return ["form" => $form];
        }else{
            $form = $request->getPost();
            $picture = $request->getFiles()->get("picture");
            $photo = new Photo();
            $photo->setTitle($form->get("title"));
            $photo->setDescription($form->get("description"));
            $photo->setPath($picture["name"]);
            $photo->setUser($this->getRepository(User::class)->find(1));
            $this->entityManager->persist($photo);
            $this->entityManager->flush();
            $this->redirect()->toUrl("/photo");
        }
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('photo', ['action' => 'add']);
        }

        // Retrieve the photo with the specified id. Doing so raises
        // an exception if the photo is not found, which should result
        // in redirecting to the landing page.
        try {
            $album = $this->table->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('photo', ['action' => 'index']);
        }

        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return $viewData;
        }

        try {
            $this->table->saveAlbum($album);
        } catch (\Exception $e) {
        }

        // Redirect to photo list
        return $this->redirect()->toRoute('photo', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('photo');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int)$request->getPost('id');
                $photo = $this->getRepository(Photo::class)->find($id);
                $this->entityManager->remove($photo);
                $this->entityManager->flush();
            }

            // Redirect to list of photos
            return $this->redirect()->toRoute('photo');
        }
        $photo = $this->getRepository(Photo::class)->find($id);
        return [
            'id' => $id,
            'photo' => $this->getRepository(Photo::class)->find($id),
        ];
    }
}