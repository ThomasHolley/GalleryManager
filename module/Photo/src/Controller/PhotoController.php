<?php

namespace Photo\Controller;

use Application\Tools\MainController;
use Laminas\Http\Header\CacheControl;
use Laminas\Http\Header\ContentTransferEncoding;
use Laminas\Http\Header\ContentType;
use Laminas\Http\Headers;
use Photo\Form\PhotoForm;
use Photo\Model\Photo;

/**
 * Photo controller
 * By default a controller has 4 actions : index, add, edit, deleteq
 * It's able to mapping alone when we call /index, /add, etc ...
 * Mapping also affect view selections, wich is in /view/controllerName/routeName -> /view/photo/photo.
 * So return new ViewModel and it will select its views by default
 */
class PhotoController extends MainController
{
    public function indexAction()
    {
        if ($this->isAuthenticated()) {
            return [
                'photos' => $this->getRepository(Photo::class)->findBy(["user" => $this->sessionValue("user")])
            ];
        } else {
            return $this->notAuthenticatedPage();
        }
    }

    /**
     * @param $image
     * @return string
     */
    public function saveImage($image)
    {
        $targetDir = "public/uploads";
        if(!file_exists($targetDir)){
            mkdir($targetDir);
        }
        $file = $image["name"];
        $path = pathinfo($file);
        $filename = uniqid();
        $ext = $path["extension"];
        $tmpName = $image["tmp_name"];
        $path_filename_ext = $targetDir . "/" . $filename . "." . $ext;
        while (file_exists("/".$path_filename_ext)) {
            $path_filename_ext = $targetDir . "/" . uniqid() . "." . $ext;
        }

        move_uploaded_file($tmpName, $path_filename_ext);
        $path_filename_ext = str_replace("public/", "", $path_filename_ext);
        return $path_filename_ext;
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
        if (!$request->isPost()) {
            return ["form" => $form];
        } else {
            $photo = new Photo();
            $form->setInputFilter($photo->getInputFilter());
            $form->setData($request->getPost());
            if (!$form->isValid()) {
                return ["form" => $form];
            } else {
                $picture = $request->getFiles()->get("picture");
                $path = $this->saveImage($picture);
                $photo->setTitle($form->get("title")->getValue());
                $photo->setDescription($form->get("description")->getValue());
                $photo->setPath($path);
                $photo->setUser($this->sessionValue("user"));
                $this->entityManager->persist($photo);
                $this->entityManager->flush();
                $this->redirect()->toUrl("/photo");
            }
        }
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('photo', ['action' => 'add']);
        }

        try {
            $photo = $this->getRepository(Photo::class)->find($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('photo', ['action' => 'index']);
        }

        $form = new PhotoForm();
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form, 'photo' => $photo];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($photo->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return $viewData;
        }

        $photo->setTitle($form->get('title')->getValue());
        $photo->setDescription($form->get('description')->getValue());
        if ($request->getFiles()->get('picture')["name"] != "") {
            $photo->setPath($this->saveImage($request->getFiles()->get('picture')));
        }
        $this->entityManager->persist($photo);
        $this->entityManager->flush();

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