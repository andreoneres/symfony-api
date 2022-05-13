<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UsersController extends AbstractController {

  private UsersRepository $repository;

  public function __construct(ManagerRegistry $doctrine) {
    $this->repository = $doctrine->getManager()->getRepository(Users::class);
  }

  public function findOne(Request $request) {

    $id = $request->get("id");
    $user = $this->repository->findOne($id);
    if(empty($user))
      throw new Exception("Nenhum usuário encontrado.", 404);

    return $user;
  }

  public function findAll() {

    $users = $this->repository->findAll();
    if(empty($users)) 
      throw new Exception("Nenhum usuário encontrado.", 404);

    return $users;
  }

  public function create(Request $request) {
    $post = $request->getContent();
    $data = json_decode($post, true);

    try {
      $user = new Users();
      $user->setName($data["name"]);
      $user->setLogin($data["login"]);
      $user->setPassword($data["password"]);
      $user->setAge($data["age"]);
      $user->setIsAdmin($data["is_admin"]);
  
      $this->repository->add($user);
  
      return [
        "Message" => "Usuário criado com sucesso."
      ];
    } catch(Exception $e) {
      throw new Exception("Não foi possível criar o usuário! Contate a equipe responsável.", 500);
    }
  }

  public function update(Request $request) {

    $id = $request->get("id");
    $post = $request->getContent();
    $data = json_decode($post, true);

    try {
      $user = $this->repository->findOne($id);
      if(empty($user)) 
        throw new Exception("O usuário não foi encontrado.", 404);
  
      $user->setName($data["name"]);
      $user->setLogin($data["login"]);
      $user->setPassword($data["password"]);
      $user->setAge($data["age"]);
      $user->setIsAdmin($data["is_admin"]);
  
      $this->repository->update($user);
  
      return [
        "Message" => "Usuário atualizado com sucesso."
      ];
    } catch (\Exception $e) {
      throw new Exception("Não foi possível atualizar o usuário! Contate a equipe responsável.", 500);
    }
  }

  public function delete(Request $request) {

    $id = $request->get("id");

    try {
      $user = $this->repository->findOne($id);
      if(empty($user)) 
        throw new Exception("O usuário não foi encontrado.", 404);
  
      $this->repository->remove($user);
  
      return [
        "Message" => "Usuário deletado com sucesso."
      ];
    } catch (\Exception $e) {
      throw new Exception("Não foi possível deletar o usuário! Contate a equipe responsável.", 500);
    }
  }
}