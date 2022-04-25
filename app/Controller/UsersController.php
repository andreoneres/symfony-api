<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController {

  private UsersRepository $repository;

  public function __construct(ManagerRegistry $doctrine) {
    $this->repository = $doctrine->getManager()->getRepository(Users::class);
  }

  public function findOne(Request $request) {

    $id = $request->get('id');
    $user = $this->repository->findOne($id);
    if(empty($user)) return new Response("Nenhum usuário encontrado.");

    $response = new Response();
    $response->setContent(json_encode([
      'Status' => 200,
      'Dados' => $user
    ]));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  public function findAll() {

    $users = $this->repository->findAll();
    if(empty($users)) return new Response("Nenhum usuário encontrado.");

    $response = new Response();
    $response->setContent(json_encode([
      'Status' => 200,
      'Dados' => $users
    ]));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  public function create(Request $request) {
    $post = $request->getContent();
    $data = json_decode($post, true);

    $user = new Users();
    $user->setName($data['name']);
    $user->setLogin($data['login']);
    $user->setPassword($data['password']);
    $user->setAge($data['age']);
    $user->setIsAdmin($data['is_admin']);

    $this->repository->add($user);

    $response = new Response();
    $response->setContent(json_encode([
      'Status' => 200,
      'Dados' => 'Usuário criado com sucesso.'
    ]));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  public function update(Request $request) {

    $id = $request->get('id');
    $post = $request->getContent();
    $data = json_decode($post, true);

    $user = $this->repository->findOne($id);
    if(empty($user)) return new Response("Nenhum usuário encontrado.");

    $user->setName($data['name']);
    $user->setLogin($data['login']);
    $user->setPassword($data['password']);
    $user->setAge($data['age']);
    $user->setIsAdmin($data['is_admin']);

    $this->repository->update($user);

    $response = new Response();
    $response->setContent(json_encode([
      'Status' => 200,
      'Dados' => 'Usuário atualizado com sucesso.'
    ]));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  public function delete(Request $request) {

    $id = $request->get('id');

    $user = $this->repository->findOne($id);
    if(empty($user)) return new Response("Nenhum usuário encontrado.");

    $this->repository->remove($user);

    $response = new Response();
    $response->setContent(json_encode([
      'Status' => 200,
      'Dados' => 'Usuário deletado com sucesso.'
    ]));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }
}