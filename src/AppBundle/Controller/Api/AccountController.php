<?php
/**
 * User: MAGUIRRE
 * Date: 9/10/2017
 */

namespace AppBundle\Controller\Api;

use Manuel\LocalBank\Account\Account;
use Manuel\LocalBank\Account\AccountRepository;
use Manuel\LocalBank\ValueObject\EntityId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author maguirre <maguirre@developerplace.com>
 *
 * @Route("/api/account")
 */
class AccountController extends Controller
{
    /**
     * @Route("/")
     * @Method("get")
     */
    public function all(AccountRepository $accountRepository)
    {
        $accounts = $accountRepository->findAll();

        return $this->json($accounts);
    }

    /**
     * @Route("/{id}")
     * @Method("get")
     */
    public function getOne(AccountRepository $accountRepository, $id)
    {
        $account = $accountRepository->findById(new EntityId($id));

        if (!$account) {
            throw $this->createNotFoundException("No se encontró la cuenta con id '".$id."''");
        }

        return $this->json($account);
    }
}