<?php
/**
 * User: MAGUIRRE
 * Date: 9/10/2017
 */

namespace AppBundle\Controller\Api;

use Doctrine\Common\Persistence\ObjectManager;
use Manuel\LocalBank\Account\Account;
use Manuel\LocalBank\Account\AccountRepository;
use Manuel\LocalBank\Application\Service\CreateAccount\CreateAccountRequest;
use Manuel\LocalBank\Application\Service\CreateAccount\CreateAccountService;
use Manuel\LocalBank\Application\Service\EditAccount\EditAccountRequest;
use Manuel\LocalBank\Application\Service\EditAccount\EditAccountService;
use Manuel\LocalBank\ValueObject\EntityId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;

/**
 * @author maguirre <maguirre@developerplace.com>
 *
 * @Route("/api/account")
 */
class AccountController extends Controller
{
    /**
     * @Route("/", name="api_account_get_all")
     * @Method("get")
     */
    public function all(AccountRepository $accountRepository)
    {
        $accounts = $accountRepository->findAll();

        return $this->json($accounts);
    }

    /**
     * @Route("/{id}", name="api_account_get_one")
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

    /**
     * @Route("/", name="api_account_create")
     * @Method("post")
     */
    public function create(
        CreateAccountService $accountCreator,
        Serializer $serializer,
        ObjectManager $manager,
        Request $request
    ) {

        $data = $serializer->deserialize($request->getContent(), CreateAccountRequest::class, 'json');

        $id = $accountCreator->create($data);
        $manager->flush();

        return $this->redirectToRoute('api_account_get_one', ['id' => $id]);
    }

    /**
     * @Route("/{id}", name="api_account_get_update")
     * @Method("put")
     */
    public function update(
        AccountRepository $accountRepository,
        EditAccountService $accountUpdater,
        Serializer $serializer,
        ObjectManager $manager,
        Request $request,
        $id
    ) {

        $data = $serializer->deserialize($request->getContent(), EditAccountRequest::class, 'json');

        $id = $accountUpdater->edit(new EntityId($id), $data);
        $manager->flush();

        return $this->json($accountRepository->findById($id));
    }
}