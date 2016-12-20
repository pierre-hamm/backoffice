<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackOfficeBundle\Form\ProductType;
use BackOfficeBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
	public function lastProductAction()
	{
		$em = $this->getDoctrine()->getManager();
		$productRepository = $em->getRepository('BackOfficeBundle:Product');
		$productList = $productRepository->getMyLastItem();

		return $this->render(
			'BackOfficeBundle:Index:last_product.html.twig',
			array('productList' => $productList)
		);
	}

	public function createProductAction(Request $request)
	{
		$product = new Product();
		$form = $this
		    ->get('form.factory')
		    ->create(ProductType::class, $product);

		if ($request->isMethod('POST')) {
			$form->handleRequest($request);
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($product);
				$em->flush();				
			}
		}

		return $this->render(
			'BackOfficeBundle:Index:create_product.html.twig',
			array('formCreateProduct' => $form->createView())
		);
	}

    public function indexAction()
    {
        return $this->render('BackOfficeBundle:Index:index.html.twig');
    }
}
