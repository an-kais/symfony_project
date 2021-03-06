<?php
namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentsRepository;
use App\Repository\LecturerRepository;
use App\Repository\SubjLectRepository;
use App\Repository\ExamsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function query(){
        

        $query = $this->getDoctrine()->getManager();
        $query = $query->createQueryBuilder();
        $query->select('node')
            ->from('App\Entity\Students', 'node')
            ->where('node.univ_id < 10')
            ->andWhere('node.kurs <> 2');

        $stud = $query->getQuery()->getResult();

        $query1 = $this->getDoctrine()->getManager();
        $query1 = $query1->createQueryBuilder();
        $query1->select('node1')
            ->from('App\Entity\Lecturer', 'node1')
            ->where('node1.id > 1');

        $lect = $query1->getQuery()->getResult();

       // dump($_ENV['APP_SECRET']);//вывод переменной окружения
         //dump($_SERVER['APP_ENV']);//аналогично
        //делаем проверку
        //if ($_ENV['APP_ENV'] == 'prod'){
            //dump('Отладка');
        //}


        return $this->render('home/index.html.twig', [
            'stud' => $stud,
            'lect' => $lect,
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(){
        return new JsonResponse('Hello world');
    }



}
