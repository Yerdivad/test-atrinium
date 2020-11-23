<?php

namespace App\Controller;

use App\Entity\CurrencyRequest;
use App\Form\CurrencyRequestType;
use App\Repository\CurrencyRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/currency-converter")
 */
class CurrencyRequestController extends AbstractController
{
    /**
     * @Route("/historic", name="currency_request_index", methods={"GET"})
     */
    public function index(CurrencyRequestRepository $currencyRequestRepository): Response
    {
        return $this->render('currency_request/index.html.twig', [
            'currency_requests' => $currencyRequestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="currency_request_new", methods={"GET","POST"})
     */
    public function new(Request $request, CurrencyRequestRepository $currencyRequestRepository): Response
    {
        $currencyRequest = new CurrencyRequest();
        $form = $this->createForm(CurrencyRequestType::class, $currencyRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $origin = $currencyRequest->getOriginCurrency();
            $target = $currencyRequest->getTargetCurrency();
            $amount = $currencyRequest->getAmount();
            $date= $currencyRequest->getRequestDate()->format('Y-m-d');

            $previus_request = $currencyRequestRepository->findOneBy(array('amount' => $amount, 'target_currency' => $target, 'request_date' => $currencyRequest->getRequestDate() ));

            if ($previus_request == null){

                $client = HttpClient::create();
                $response = $client->request('GET', 'http://data.fixer.io/api/'.$date.'?access_key=db7972c6d0f760133bc98f4e003dec10&symbols=USD,AUD,CAD,MXN,GBP');
                $conversion_rate = $response->toArray()["rates"][$target];
            }else {
                $conversion_rate = $previus_request->getValue() / $previus_request->getAmount();
            }

            $value = $amount * $conversion_rate;

            $currencyRequest->setValue($value);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($currencyRequest);
            $entityManager->flush();

            return $this->redirectToRoute('currency_request_index', ['from' => $origin, 'to' => $target,'amount' => $amount ]);
        }

        return $this->render('currency_request/new.html.twig', [
            'currency_request' => $currencyRequest,
            'form' => $form->createView(),
        ]);
    }
}
