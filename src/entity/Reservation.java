/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entity;

import java.util.Date;



/**
 *
 * @author amela
 */
public class Reservation {
    private int id_reservation , nbr_membre, id_utilisateur ,id_terrain;
    private Date date_debut , date_fin;
    
    

    public Reservation() {
    }

    public Reservation(int nbr_membre, int id_utilisateur, int id_terrain, Date date_debut, Date date_fin) {
        this.nbr_membre = nbr_membre;
        this.id_utilisateur = id_utilisateur;
        this.id_terrain = id_terrain;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
    }

    public Reservation(int id_reservation, int nbr_membre, int id_utilisateur, int id_terrain, Date date_debut, Date date_fin) {
        this.id_reservation = id_reservation;
        this.nbr_membre = nbr_membre;
        this.id_utilisateur = id_utilisateur;
        this.id_terrain = id_terrain;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
    }

    public Reservation(String nbrMembre, java.sql.Date dateDebut, java.sql.Date dateFin, String idTerrain, String idUtilisateur) {
    }

    public Reservation(int parseInt, String nbrMembre, java.sql.Date dateDebut, java.sql.Date dateFin, String idTerrain, String idUtilisateur) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

   
    public int getId_reservation() {
        return id_reservation;
    }

    public void setId_reservation(int id_reservation) {
        this.id_reservation = id_reservation;
    }

    public int getNbr_membre() {
        return nbr_membre;
    }

    public void setNbr_membre(int nbr_membre) {
        this.nbr_membre = nbr_membre;
    }

    public int getId_utilisateur() {
        return id_utilisateur;
    }

    public void setId_utilisateur(int id_utilisateur) {
        this.id_utilisateur = id_utilisateur;
    }

    public int getId_terrain() {
        return id_terrain;
    }

    public void setId_terrain(int id_terrain) {
        this.id_terrain = id_terrain;
    }

    public Date getDate_debut() {
        return date_debut;
    }

    public void setDate_debut(Date date_debut) {
        this.date_debut = date_debut;
    }

    public Date getDate_fin() {
        return date_fin;
    }

    public void setDate_fin(Date date_fin) {
        this.date_fin = date_fin;
    }

    @Override
    public String toString() {
        return "Reservation{" + "id_reservation=" + id_reservation + ", nbr_membre=" + nbr_membre + ", id_utilisateur=" + id_utilisateur + ", id_terrain=" + id_terrain + ", date_debut=" + date_debut + ", date_fin=" + date_fin + '}';
    }

  
}
