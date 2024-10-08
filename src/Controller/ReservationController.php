<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Enum\ReservationStatusEnum;
use App\Form\ReservationType;
use App\Trait\GuestOrAdminTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    use GuestOrAdminTrait;

    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {

        $this->checkAccessGuestOrAdmin();

        $user = $this->getUser();
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You must be logged in to access this page.');
        }

        $rooms = $entityManagerInterface->getRepository(Room::class)->findBy(['status' => 'Available'], ['name' => 'ASC']);
        $message = null;
        if (!$rooms) {
            $message = 'No rooms available for the moment !';
        }

        return $this->render('reservation/index.html.twig', [
            'reservations' => $user->getReservations(),
            'rooms' => $rooms,
            'message' => $message
        ]);
    }

    #[Route('/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->checkAccessGuestOrAdmin();

        $user = $this->getUser();

        // verify if $user is an instance of entity User
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('You must be logged in to access this page.');
        }

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $user) {
            $room = $reservation->getRooms();
            // if a room exist
            if ($room !== null) {
                // if room status is strictly different of available add an error to the form & render the same form
                if ($room->getStatus() !== ReservationStatusEnum::Available->value) {
                    $form->get('rooms')->addError(new FormError('This room is not available for reservation.'));

                    return $this->render('reservation/new.html.twig', [
                        'reservation' => $reservation,
                        'form' => $form,
                    ]);
                }
                // if all is ok add to db and return to index page
                $reservation->setUsers($user);
                $entityManager->persist($reservation);
                $entityManager->flush();

                return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        $this->checkAccessGuestOrAdmin();

        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $this->checkAccessGuestOrAdmin();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $this->checkAccessGuestOrAdmin();

        if ($this->isCsrfTokenValid('delete' . $reservation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/room/{id}', name: 'app_reservation_room_show', methods: ['GET'])]
    public function showRoom(int $id, EntityManagerInterface $entityManager): Response
    {
        $this->checkAccessGuestOrAdmin();

        $room = $entityManager->getRepository(Room::class)->find($id);
        return $this->render('reservation/room_show.html.twig', [
            'room' => $room,
        ]);
    }
}
