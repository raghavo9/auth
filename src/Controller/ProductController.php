<?php

namespace App\Controller;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    


    /**
     * @Route("/add_product", name="add_product")
     */
    public function createProduct(): Response
    {
       $entityManager = $this->getDoctrine()->getManager();
       $product = new Product();
       $product->setProductTitle("Wallet");
       $product->setProductQty(10);
       $product->setProductDescription("Itallian leather wallets");
       $entityManager->persist($product);
       $entityManager->flush();
       return new Response('Saved new product with id '.$product->getId());
    }

    
    /**
     * @Route("/show_product", name="show_product")
     */
    public function showProduct(ProductRepository $productRepository)
    {
        $product = $productRepository->findAll();
        return $this->render('product/index.html.twig', ['product' => $product ]);

    }
    

    /**
     * @Route("/add_product_form", name="add_product_form") 
     */

     public function createProductForm(Request $request)
     {
        $product = new Product();
        $form = $this->createForm(ProductType::class , $product,['action'=>$this->generateUrl('add_product_form') ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute("show_product");

        }

        return $this->render('form/index.html.twig' , ['product_form'=>$form->createView()]);

        
     }



}
