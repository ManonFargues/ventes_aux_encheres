<?php


namespace App\Controller;


use App\Entity\Car;
use ContainerNuF8QDx\getDoctrine_CacheClearMetadataCommandService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CarController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
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
}