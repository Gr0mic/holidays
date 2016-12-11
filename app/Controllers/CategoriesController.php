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

        if ($request->isPost()) {
            $errors = [];

            Validator::notEmpty()->validate($request->getParam('name')) || $errors['name'] = 'Veuillez entrer un nom';
            Validator::notEmpty()->validate($request->getParam('number_days')) || $errors['number_days'] = 'Veuillez entrer un nombre de jour';
            Validator::notEmpty()->validate($request->getParam('postponed_days')) || $errors['postponed_days'] = 'Veuillez entrer un nombre de jour pouvant être reporter';
            Validator::notEmpty()->validate($request->getParam('validity_days')) || $errors['validity_days'] = 'Veuillez entrer un nombre de jour de validité du congé';
            if (empty($errors)) {
                /*$category = new Category();

                $category->name = $request->getParam('name');
                $category->number_days = $request->getParam('number_days');
                $category->postponed_days = $request->getParam('postponed_days');
                $category->validity_days = $request->getParam('validity_days');
                $category->save();*/
                $this->flash('Information bien enregistrée');
            } else {
                $this->flash('Certains champs n\'ont pas été rempli correctement', 'error');
            }
        }

        $this->render ($response, 'categories/add.twig');
    }

}