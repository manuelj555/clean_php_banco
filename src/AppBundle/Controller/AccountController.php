<?php
/**
 * User: manuel
 * Date: 21-04-2017
 */

namespace AppBundle\Controller;

use AppBundle\Form\Type\CreateAccountType;
use AppBundle\Form\Type\EditAccountType;
use Doctrine\Common\Persistence\ObjectManager;
use Manuel\Http\Response\Redirect;
use Manuel\Http\Response\View;
use Manuel\LocalBank\Account\Account;
use Manuel\LocalBank\Application\Service\CreateAccount\CreateAccountService;
use Manuel\LocalBank\Application\Service\EditAccount\EditAccountRequest;
use Manuel\LocalBank\Application\Service\EditAccount\EditAccountService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author maguirre <maguirre@developerplace.com>
 *
 * @Route("/account")
 */
class AccountController extends Controller
{
    /**
     * @Route("/create", name="account_create")
     */
    public function createAction(
        Request $request,
        FormFactoryInterface $formFactory,
        CreateAccountService $createAccountService,
        ObjectManager $manager
    ) {
        $form = $formFactory->create(CreateAccountType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $id = $createAccountService->create($form->getData());

            $manager->flush();

            return Redirect::to('account_edit', [
                'id' => $id->getId(),
            ]);
        }

        return View::make('account/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="account_edit")
     */
    public function editAction(
        Request $request,
        Account $account,
        FormFactoryInterface $formFactory,
        EditAccountService $editAccountService,
        ObjectManager $manager
    ) {
        $accountDTO = EditAccountRequest::createFromAccount($account);
        $form = $formFactory->createForm(EditAccountType::class, $accountDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $id = $editAccountService->edit(
                $account->getAccountId(), $accountDTO
            );

            $manager->flush();

            return Redirect::to('account_edit', [
                'id' => $id->getId(),
            ]);
        }

        return View::make('account/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}