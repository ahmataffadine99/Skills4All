<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Car;
use App\Form\CarSearchType;
use Knp\Component\Pager\PaginatorInterface;

class CarSearchController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/car/search', name: 'car_search')]
    public function search(Request $request, PaginatorInterface $paginator)
    {
        $form = $this->createForm(CarSearchType::class);
        $form->handleRequest($request);
    
        $queryBuilder = $this->doctrine->getRepository(Car::class)->createQueryBuilder('c');
        $queryBuilder->orderBy('c.name', 'ASC');
    
        $name = $form->get('field_name')->getData();
        $category = $form->get('category')->getData();
    
        if ($name) {
            $queryBuilder->andWhere('c.name LIKE :name');
            $queryBuilder->setParameter('name', '%' . $name . '%');
        }
    
        if ($category) {
            $queryBuilder->join('c.category', 'cat');
            $queryBuilder->andWhere('cat.name = :category');
            $queryBuilder->setParameter('category', $category);
        }
    
        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            20 // Nombre de résultats par page
        );
    
        return $this->render('car/search.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination,
            'name' => $name,
            'category' => $category,
        ]);
    }
    
}
