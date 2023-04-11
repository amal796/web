/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package services;

import entity.Terrain;
import interfaces.TerrainInterface;
import java.sql.Connection;
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
public class TerrainService implements TerrainInterface  {
    Connection cnx = MyConnection.getInstance().getCnx();

    @Override
    public void create(Terrain terrain) {
           try {
               String sql = "INSERT INTO `terrain`( `image_terrain`, `description_terrain`, `nom_terrain`, `surface_terrain`, `lieu`) VALUES (?,?,?,?,?)";
               PreparedStatement pstmt = cnx.prepareStatement(sql);
      
               pstmt.setString(1, terrain.getImage_terrain());
               pstmt.setString(2, terrain.getDescription_terrain());
               pstmt.setString(3, terrain.getNom_terrain());
               pstmt.setString(4, terrain.getSurface_terrain());
               pstmt.setString(5, terrain.getLieu());
               pstmt.executeUpdate();
               System.out.println("Terrain Added Successfully!");
           } catch (SQLException ex) {
        }
    }

    @Override
    public Terrain read(int id_terrain) {
 String sql = "SELECT * FROM terrain WHERE id_terrain = ?";
    try ( PreparedStatement pstmt = cnx.prepareStatement(sql)) {
        pstmt.setInt(1, id_terrain);
        try (ResultSet rs = pstmt.executeQuery()) {
            if (rs.next()) {
                Terrain terrain = new Terrain();
                terrain.setId_terrain(rs.getInt("id_terrain"));
                terrain.setImage_terrain(rs.getString("image_terrain"));
                terrain.setDescription_terrain(rs.getString("description_terrain"));
                terrain.setNom_terrain(rs.getString("nom_terrain"));
                terrain.setSurface_terrain(rs.getString("surface_terrain"));
                terrain.setLieu(rs.getString("lieu"));
                return terrain;
            } else {
                return null;
            }
        }
    }   catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }    
        return null;
      
    }
    @Override
    public List<Terrain> readAll() {
        String sql = "SELECT * FROM terrain";
            try (
                 Statement stmt = cnx.createStatement();
                 ResultSet rs = stmt.executeQuery(sql)) {
                List<Terrain> terrains = new ArrayList<>();
                while (rs.next()) {
                    Terrain terrain = new Terrain();
                    terrain.setId_terrain(rs.getInt("id_terrain"));
                    terrain.setImage_terrain(rs.getString("image_terrain"));
                    terrain.setDescription_terrain(rs.getString("description_terrain"));
                    terrain.setNom_terrain(rs.getString("nom_terrain"));
                    terrain.setSurface_terrain(rs.getString("surface_terrain"));
                    terrain.setLieu(rs.getString("lieu"));
                    terrains.add(terrain);
                }
                return terrains;
            } catch (SQLException ex) {    
            System.out.println(ex.getMessage());
        }    
        return null;
    }

    @Override
    public void update(Terrain terrain) {
  String sql = "UPDATE terrain SET image_terrain = ?, description_terrain = ?, nom_terrain = ?, surface_terrain = ?, lieu = ? WHERE id_terrain = ?";  
  try (
         PreparedStatement pstmt = cnx.prepareStatement(sql)) {
        pstmt.setString(1, terrain.getImage_terrain());
        pstmt.setString(2, terrain.getDescription_terrain());
        pstmt.setString(3, terrain.getNom_terrain());
        pstmt.setString(4, terrain.getSurface_terrain());
        pstmt.setString(5, terrain.getLieu());
        pstmt.setInt(6, terrain.getId_terrain());
        pstmt.executeUpdate();    
        System.out.println("Terrain modifiée");
    }   catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }

         @Override
     public void delete(Terrain r)
 {
 try {
            String requete = "DELETE FROM terrain where id_terrain=?";
            PreparedStatement pstmt = cnx.prepareStatement(requete);
            pstmt.setInt(1, r.getId_terrain());
            pstmt.executeUpdate();
            System.out.println("Terrain supprimée");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        } 
 
 }

}