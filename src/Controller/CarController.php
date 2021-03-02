<?php


namespace App\Controller;


use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class CarController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CarRepository $carRepository)
    {
        $cars = $carRepository->findAll();
        return $this->render('home/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(EntityManagerInterface $manager, Request  $request)
    {
        $form = $this->createForm(CarType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $path = $this->getParameter('kernel.project_dir'). '/public/images';
            $car = $form->getData();

            $image = $car->getImage();
            $file = $image->getFile();

            $name = md5(uniqid()). '.' .$file->getExtension();
            $file->move($path, $name);

            $image->setName($name);


            $manager->persist($car);
            $manager->flush();
            $this->addFlash(
                'notice',
                'La voiture a bien été ajoutée'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('home/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(Car $car)
    {
        return $this->render('home/details.html.twig', [
            'car' => $car
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Car $car, EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('home/edit.html.twig', [
            'car' => $car,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Car $car, EntityManagerInterface $manager)
    {
        $manager->remove($car);

        $manager->flush();

        return $this->redirectToRoute('home');
    }
}