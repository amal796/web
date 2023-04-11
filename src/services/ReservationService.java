/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package services;

import entity.Reservation;
import interfaces.ReservationInterface;
import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import util.MyConnection;

/**
 *
 * @author amela
 */
public class ReservationService implements ReservationInterface {
    Connection cnx = MyConnection.getInstance().getCnx();

    @Override
    public void ajouterReservation(Reservation reservation) {
      try {
               String sql= "INSERT INTO `reservation` (`nbr_membre`, `date_debut`, `date_fin`, `id_terrain`, `id_utilisateur`) VALUES ( ?, ?, ?, ?,?)";
               PreparedStatement pstmt = cnx.prepareStatement(sql);
               pstmt.setInt(1,reservation.getNbr_membre());
               pstmt.setDate(2, (Date) reservation.getDate_debut());
                pstmt.setDate(3, (Date) reservation.getDate_fin());
                pstmt.setInt(4,reservation.getId_utilisateur());
                pstmt.setInt(5,reservation.getId_terrain());
                pstmt.executeUpdate();
                System.out.println("Reservation ajoutée");
           } catch (SQLException ex) {           
        }    
    }

    @Override
    public Reservation read(int id_reservation) {
        String sql="SELECT * FROM reservation where id_reservation = ?";
        try(PreparedStatement pstmt = cnx.prepareStatement(sql)) {
            pstmt.setInt(1, id_reservation);
            try (ResultSet rs = pstmt.executeQuery()) {
                if(rs.next()) {
                    Reservation reservation =new Reservation();
                    reservation.setId_reservation(rs.getInt("id_reservation"));
                    reservation.setNbr_membre(rs.getInt("nbr_membre"));
                    reservation.setId_utilisateur(rs.getInt("id_utilisateur"));
                    reservation.setId_terrain(rs.getInt("id_terrain"));
                    reservation.setDate_debut(rs.getDate("date_debut"));
                    reservation.setDate_fin(rs.getDate("date_fin"));
                    return reservation;
                } else {    
                    return null;
                }
            }
        }   catch (SQLException ex){System.out.println(ex.getMessage());
    } return null;
    }
    public List<Reservation> readAll() {
            String sql = "SELECT * FROM reservation";
                try (
                     Statement stmt = cnx.createStatement();
                     ResultSet rs = stmt.executeQuery(sql)) {
                    List<Reservation> reservations = new ArrayList<>();
                    while (rs.next()) {
                        Reservation reservation = new Reservation();
                        reservation.setId_reservation(rs.getInt("id_reservation"));
                        reservation.setNbr_membre(rs.getInt("nbr_membre"));
                        reservation.setId_utilisateur(rs.getInt("id_utilisateur"));
                        reservation.setId_terrain(rs.getInt("id_terrain"));
                        reservation.setDate_debut(rs.getDate("date_debut"));
                        reservation.setDate_fin(rs.getDate("date_fin"));
                        reservations.add(reservation);
                    }
                    return reservations;
                } catch (SQLException ex) {    
                System.out.println(ex.getMessage());
            }    
            return null;
        }
    @Override
    public void mettreAJourReservation(Reservation reservation) {
        String sql = "UPDATE reservation SET nbr_membre = ?, date_debut = ?, date_fin = ?, id_terrain = ?, id_utilisateur = ? WHERE id_reservation = ?";  
         try (
                PreparedStatement pstmt = cnx.prepareStatement(sql)) {
                pstmt.setInt(1,reservation.getNbr_membre());
               pstmt.setDate(2, (Date) reservation.getDate_debut());
                pstmt.setDate(3, (Date) reservation.getDate_fin());
                pstmt.setInt(4,reservation.getId_utilisateur());
                pstmt.setInt(5,reservation.getId_terrain());
               pstmt.setInt(6,reservation.getId_reservation());
               pstmt.executeUpdate();    
               System.out.println("Reservation  modifiée");
           }   catch (SQLException ex) {
                   System.out.println(ex.getMessage());
               }
           }
    

    @Override
    public void supprimerReservation(Reservation reservation) {
        String sql ="DELETE FROM reservation where id_reservation=?";
            try (PreparedStatement pstmt = cnx.prepareStatement(sql)){            
                pstmt.setInt(1,reservation.getId_reservation());
                pstmt.executeUpdate();
                System.out.println("reservation supprimée");
            } catch (SQLException ex) {
                System.out.println(ex.getMessage());
            }
        }

  
    
}
