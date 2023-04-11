/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entity;

/**
 *
 * @author amela
 */
public class Terrain {
    private int id_terrain;
    private String image_terrain;
    private String description_terrain;
    private String nom_terrain;
    private  String surface_terrain;
    private String lieu;

    public Terrain() {
    }

    public Terrain(String image_terrain, String description_terrain, String nom_terrain, String surface_terrain, String lieu) {
        this.image_terrain = image_terrain;
        this.description_terrain = description_terrain;
        this.nom_terrain = nom_terrain;
        this.surface_terrain = surface_terrain;
        this.lieu = lieu;
    }

    public Terrain(int id_terrain, String image_terrain, String description_terrain, String nom_terrain, String surface_terrain, String lieu) {
        this.id_terrain = id_terrain;
        this.image_terrain = image_terrain;
        this.description_terrain = description_terrain;
        this.nom_terrain = nom_terrain;
        this.surface_terrain = surface_terrain;
        this.lieu = lieu;
    }

    public Terrain(int parseInt) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    public Terrain(String descriptionTerrain, String nomTerrain, String surfaceTerrain, String lieuTerrain) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }


   

    public int getId_terrain() {
        return id_terrain;
    }

    public void setId_terrain(int id_terrain) {
        this.id_terrain = id_terrain;
    }

    public String getImage_terrain() {
        return image_terrain;
    }

    public void setImage_terrain(String image_terrain) {
        this.image_terrain = image_terrain;
    }

    public String getDescription_terrain() {
        return description_terrain;
    }

    public void setDescription_terrain(String description_terrain) {
        this.description_terrain = description_terrain;
    }

    public String getNom_terrain() {
        return nom_terrain;
    }

    public void setNom_terrain(String nom_terrain) {
        this.nom_terrain = nom_terrain;
    }

    public String getSurface_terrain() {
        return surface_terrain;
    }

    public void setSurface_terrain(String surface_terrain) {
        this.surface_terrain = surface_terrain;
    }

 


    public String getLieu() {
        return lieu;
    }

    public void setLieu(String lieu) {
        this.lieu = lieu;
    }

    @Override
    public String toString() {
        return "Terrain{" + "id_terrain=" + id_terrain + ", image_terrain=" + image_terrain + ", description_terrain=" + description_terrain + ", nom_terrain=" + nom_terrain + ", surface_terrain=" + surface_terrain + ", lieu=" + lieu + '}';
    }
    
    
}
