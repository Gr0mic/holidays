<?php

namespace App\Controllers;

use App\Models\Category;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;

class CategoriesController extends Controller {

    public function home ( RequestInterface $request , ResponseInterface $response) {
        $this->render ($response, 'categories/home.twig');
    }

    public function add ( RequestInterface $request , ResponseInterface $response) {
        $old = [];

        if ($request->isPost()) {
            $error = false;
            if ( Validator::notEmpty()->validate($request->getParam('name')) ) {
                $old['name'] = $request->getParam('name');
            } else {
                $error = true;
                $this->flash('Veuillez entrer un nom', 'errors.name');
            }
            if ( Validator::notEmpty()->validate($request->getParam('postponed_days')) ) {
                $old['postponed_days'] = $request->getParam('postponed_days');
            } else {
                $error = true;
                $this->flash('Veuillez entrer un nombre de jour pouvant être reporter', 'errors.postponed_days');
            }
            if (!$error) {
                $category = new Category();

                $category->name = $request->getParam('name');
                $category->postponed_days = $request->getParam('postponed_days');
                if ($category->save()) {
                    $this->flash('Information bien enregistrée');
                    $old = [];
                } else {
                    $this->flash('Erreur lors de la sauvegarde DB', 'error');
                }
            } else {
                $this->flash('Certains champs n\'ont pas été rempli correctement', 'error');
            }
        }

        $this->render ($response, 'categories/add.twig', ['old' => $old]);
    }

}