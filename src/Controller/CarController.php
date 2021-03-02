<?php


namespace App\Controller;


use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
    public function add(EntityManagerInterface $manager)
    {
        $car = new Car();

        $car->setModel('twingo');
        $car->setPrice('2000');

        $manager->persist($car);
        $manager->flush();

        return $this->render('home/add.html.twig');
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
    public function edit(Car $car, EntityManagerInterface $manager)
    {
        $car->setModel("Ferrari");

        $manager->flush($car);

        return $this->render('home/details.html.twig', [
            'car' => $car
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