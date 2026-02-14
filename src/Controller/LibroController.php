<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Form\LibroType;
use App\Repository\LibroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlador CRUD completo para la entidad Libro.
 * Todas las rutas están protegidas para usuarios autenticados.
 */
#[Route('/libro')]
class LibroController extends AbstractController
{
    /** Lista todos los libros guardados en BD. */
    #[Route('/', name: 'app_libro_index', methods: ['GET'])]
    public function index(LibroRepository $libroRepository): Response
    {
        return $this->render('libro/index.html.twig', [
            'libros' => $libroRepository->findBy([], ['id' => 'DESC']),
        ]);
    }

    /** Crea un nuevo libro usando formulario Symfony. */
    #[Route('/nuevo', name: 'app_libro_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $libro = new Libro();
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $libro->setUsuario($this->getUser());
            $entityManager->persist($libro);
            $entityManager->flush();
            $this->addFlash('success', 'Libro creado correctamente.');

            return $this->redirectToRoute('app_libro_index');
        }

        return $this->render('libro/new.html.twig', ['form' => $form]);
    }

    /** Muestra un libro en detalle. */
    #[Route('/{id}', name: 'app_libro_show', methods: ['GET'])]
    public function show(Libro $libro): Response
    {
        return $this->render('libro/show.html.twig', ['libro' => $libro]);
    }

    /** Edita un libro existente. */
    #[Route('/{id}/editar', name: 'app_libro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Libro $libro, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Libro actualizado correctamente.');

            return $this->redirectToRoute('app_libro_index');
        }

        return $this->render('libro/edit.html.twig', ['libro' => $libro, 'form' => $form]);
    }

    /** Borra un libro con protección CSRF. */
    #[Route('/{id}/borrar', name: 'app_libro_delete', methods: ['POST'])]
    public function delete(Request $request, Libro $libro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete_libro_'.$libro->getId(), (string) $request->request->get('_token'))) {
            $entityManager->remove($libro);
            $entityManager->flush();
            $this->addFlash('success', 'Libro eliminado correctamente.');
        }

        return $this->redirectToRoute('app_libro_index');
    }
}
