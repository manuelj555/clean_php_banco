<?php
/**
 * User: MAGUIRRE
 * Date: 9/10/2017
 */

namespace AppBundle\Controller\Api;

use Manuel\LocalBank\Account\AccountRepository;
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
}