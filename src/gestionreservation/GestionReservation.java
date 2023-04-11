/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gestionreservation;

import entity.Reservation;
import entity.Terrain;
import entity.Utilisateur;
import interfaces.ReservationInterface;
import interfaces.TerrainInterface;
import services.ReservationService;
import services.TerrainService;
import java.sql.Date;

/**
 *
 * @author amela
 */
public class GestionReservation {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        
        TerrainInterface ps = new TerrainService();
        /* Terrain terrain5 =new Terrain();
        Utilisateur utilisateur =new Utilisateur();
        terrain5.setId_terrain(223);
        terrain5.setDescription_terrain("TERRAIN de boo");
        terrain5.setImage_terrain("booo.png");
        terrain5.setNom_terrain("booooooo");
        terrain5.setLieu("gafsaa");
        terrain5.setSurface_terrain("122");*/
        
        Terrain  t=new Terrain("hhhh","hhh","lll","mmm","mmmm");
        
        

        System.out.println("-----------------------------CREATE-----------------------");
      //  ps.create(t);
        
        System.out.println("-----------------------------LIST-----------------------");
        System.out.println(ps.readAll());
     //   ps.delete();
        
        System.out.println("-----------------------------READ-----------------------");
        /*System.out.println(ps.read(16));
        
        
        System.out.println("-----------------------------UPADTE-----------------------");
        ps.update(terrain5);
        
        System.out.println("-----------------------------SUPPRESSION-----------------------");

        ps.supprimerTerrain(terrain5);
        System.out.println(ps.readAll());
        */



            ReservationInterface rs = new ReservationService();
         Reservation reservation4 ;
         /*Date dateDebut = new Date(2023, 10, 2); 
         Date dateFin = new Date(2023, 10, 3); */
        /*Date Datevoy=Date.valueOf("2014-11-11");         
        reservation4 = new Reservation(88,4,18,1, Datevoy , Datevoy );
        System.out.println("-----------------------------AJOUTER-----------------------");
         rs.ajouterReservation(reservation4);
         System.out.println("-----------------------------list-----------------------");
        System.out.println(rs.readAll());
        System.out.println(rs.read(88));
        rs.mettreAJourReservation(reservation4);
        rs.supprimerReservation(reservation4);
*/
    }
    
}
