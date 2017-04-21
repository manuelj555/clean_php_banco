<?php
/**
 * User: manuel
 * Date: 21-04-2017
 */

namespace AppBundle\Controller;

use AppBundle\Form\Type\CreateAccountType;
use AppBundle\Form\Type\EditAccountType;
use AppBundle\View\View;
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
     * @Route("/create")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CreateAccountType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $this->get(CreateAccountService::class)->create($form->getData());

            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('account/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}")
     */
    public function editAction(Request $request, Account $account)
    {
        $accountDTO = EditAccountRequest::createFromAccount($account);
        $form = $this->createForm(EditAccountType::class, $accountDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $this->get(EditAccountService::class)->edit(
                $account->getAccountId(), $accountDTO
            );

            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('account/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}