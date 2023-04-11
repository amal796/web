/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entity.Reservation;
import java.util.List;

/**
 *
 * @author amela
 */
public interface ReservationInterface {
    public void ajouterReservation(Reservation reservation);
    public Reservation read(int id_reservation);
    public List<Reservation> readAll() ;
    public void mettreAJourReservation(Reservation reservation);
    public void supprimerReservation(Reservation reservation);
    
}
