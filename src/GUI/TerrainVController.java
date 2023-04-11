/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import entity.Terrain;
import interfaces.TerrainInterface;
import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.beans.property.SimpleObjectProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.input.MouseEvent;
import javafx.stage.Stage;
import services.TerrainService;
import util.MyConnection;

/**
 * FXML Controller class
 *
 * @author amela
 */
public class TerrainVController implements Initializable {

    @FXML
    private TextField description_terrain;
    @FXML
    private TextField nom_terrain;
    @FXML
    private TextField surface_terrain;
    @FXML
    private TextField lieu;
    @FXML
    private Button add;
    @FXML
    private Button clear;
    @FXML
    private TableView<Terrain> TableTerrain;
    @FXML
    private TableColumn<Terrain, Integer> idTerrain;
    @FXML
    private TableColumn<Terrain, String> imageTerrain;
    @FXML
    private TableColumn<Terrain, String> descriptionTerrain;
    @FXML
    private TableColumn<Terrain, String> nomTerrain;
    @FXML
    private TableColumn<Terrain, Double> surfaceTerrain;
    @FXML
    private TableColumn<Terrain, String> lieuTerrain;
    @FXML
    private Button drop;
    @FXML
    private Button update;
    @FXML
    private Button backH;
    
    Connection mc;
    PreparedStatement ste;
    ObservableList<Terrain>terrainList;
    @FXML
    private TextField id_terrain;
    @FXML
    private TextField image_terrain;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
        afficherEvenements();
        
        backH.setOnAction(event -> {

            try {
                Parent page1 = FXMLLoader.load(getClass().getResource("Home.fxml"));
                Scene scene = new Scene(page1);
                Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
                stage.setScene(scene);
                stage.show();
            } catch (IOException ex) {
                Logger.getLogger(HomeController.class.getName()).log(Level.SEVERE, null, ex);
            }
        });
    }    
    
    void afficherEvenements(){
            mc=MyConnection.getInstance().getCnx();
            terrainList = FXCollections.observableArrayList();
      
      try {
            String requete = "SELECT * FROM terrain e ";
            Statement st = MyConnection.getInstance().getCnx()
                    .createStatement();
            ResultSet rs =  st.executeQuery(requete); 
            while(rs.next()){
                Terrain e = new Terrain();
                e.setId_terrain(rs.getInt("id_terrain"));
                e.setImage_terrain(rs.getString("image_terrain"));
                e.setDescription_terrain(rs.getString("description_terrain"));
                e.setNom_terrain(rs.getString("nom_terrain"));
                e.setSurface_terrain(rs.getString("surface_terrain"));
                e.setLieu(rs.getString("lieu"));
                
                terrainList.add(e);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
      
  idTerrain.setCellValueFactory(data -> new SimpleObjectProperty(data.getValue().getId_terrain()));
imageTerrain.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getImage_terrain()));
descriptionTerrain.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getDescription_terrain()));
nomTerrain.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getNom_terrain()));
surfaceTerrain.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getSurface_terrain()));
lieuTerrain.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getLieu()));

  
  TableTerrain.setItems(terrainList);
  
  refresh();
  
  }
    public void refresh(){
            terrainList.clear();
            mc=MyConnection.getInstance().getCnx();
            terrainList = FXCollections.observableArrayList();
      
      try {
            String requete = "SELECT * FROM terrain e ";
            Statement st = MyConnection.getInstance().getCnx()
                    .createStatement();
            ResultSet rs =  st.executeQuery(requete); 
            while(rs.next()){
                Terrain e = new Terrain();
                e.setId_terrain(rs.getInt("id_terrain"));
                e.setImage_terrain(rs.getString("image_terrain"));
                e.setDescription_terrain(rs.getString("description_terrain"));
                e.setNom_terrain(rs.getString("nom_terrain"));
                e.setSurface_terrain(rs.getString("surface_terrain"));
                e.setLieu(rs.getString("lieu"));
                System.out.println("the added terrains :" +e.toString());
                
                terrainList.add(e);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        TableTerrain.setItems(terrainList);
        
  }

    @FXML
    private void ajoutTerrain(MouseEvent event) {
   
        String imageTerrain=image_terrain.getText();
        String descriptionTerrain =description_terrain.getText();
        String nomTerrain =nom_terrain.getText();
        String surfaceTerrain = surface_terrain.getText();
        String lieuTerrain =lieu.getText();
        if (descriptionTerrain.isEmpty() || nomTerrain.isEmpty()|| lieuTerrain.isEmpty()){
            Alert alert = new Alert(Alert.AlertType.ERROR);
             alert.setContentText("Il y a un champ vide !!"); // controle de saisie vide
             alert.showAndWait();          
         }
        
         else{
                Terrain e= new Terrain(imageTerrain,descriptionTerrain,nomTerrain,surfaceTerrain,lieuTerrain);
        TerrainService es= new TerrainService();
        es.create(e);
        
     
                image_terrain.setText(null);           //yrodlik les text area vide baad AJOUT
        description_terrain.setText(null);
        nom_terrain.setText(null);     
        surface_terrain.setText(null);
        lieu.setText(null);
            System.out.println("terrain::::::"+e);
        
      
        
       refresh();
    }
    }

    @FXML
    private void clearT(MouseEvent event) {
        id_terrain.setText(null);
        description_terrain.setText(null);
        nom_terrain.setText(null);                               //yrodlik les text area vide baad AJOUT
        surface_terrain.setText(null);
        lieu.setText(null);
        refresh();
    }

    @FXML
    private void dropT(MouseEvent event) {
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
       alert.setHeaderText("Warning");
       alert.setContentText("Es-tu sûre de supprimer!");
        
        String idTerrain =id_terrain.getText();        
        String imageTerrain=image_terrain.getText();
        String descriptionTerrain =description_terrain.getText();
        String nomTerrain =nom_terrain.getText();
        String surfaceTerrain =surface_terrain.getText();
        String lieuTerrain =lieu.getText();
        Optional<ButtonType>result =  alert.showAndWait();
        if(result.get() == ButtonType.OK)
        {
      
         Terrain e= new Terrain(Integer.parseInt(idTerrain),imageTerrain,descriptionTerrain,nomTerrain,surfaceTerrain,lieuTerrain);
        TerrainInterface es= new TerrainService();
        es.delete(e);
        refresh();
      image_terrain.setText(null);
        description_terrain.setText(null);
        nom_terrain.setText(null);
        surface_terrain.setText(null);
                lieu.setText(null);

        }
        
        }
        
        
        
        
    

    @FXML
    private void selected(MouseEvent event) {
        Terrain clicked = TableTerrain.getSelectionModel().getSelectedItem();
        id_terrain.setText(String.valueOf(clicked.getId_terrain()));
        image_terrain.setText(String.valueOf(clicked.getImage_terrain()));
        description_terrain.setText(String.valueOf(clicked.getDescription_terrain()));
        nom_terrain.setText(String.valueOf(clicked.getNom_terrain()));
        surface_terrain.setText(String.valueOf(clicked.getSurface_terrain()));
        lieu.setText(String.valueOf(clicked.getLieu()));

    }

    @FXML
    private void updateT(MouseEvent event) {
          Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
            alert.setHeaderText("Warning");
            alert.setContentText("Es-tu sûre de modifier!");
       int idTerrain =Integer.parseInt(id_terrain.getText());        
        String imageTerrain=image_terrain.getText();
        String descriptionTerrain =description_terrain.getText();
        String nomTerrain =nom_terrain.getText();
        String surfaceTerrain =surface_terrain.getText();
        String lieuTerrain =lieu.getText();
        
if (descriptionTerrain.isEmpty() || nomTerrain.isEmpty()|| lieuTerrain.isEmpty()){
    alert = new Alert(Alert.AlertType.ERROR);
             alert.setContentText("Il y a un champ vide !!"); // controle de saisie
             alert.showAndWait();          
         }
        
         else{
            Optional<ButtonType>result =  alert.showAndWait();
        if(result.get() == ButtonType.OK)
        {
                Terrain e= new Terrain(idTerrain,imageTerrain,descriptionTerrain,nomTerrain,surfaceTerrain,lieuTerrain);
        TerrainInterface es= new TerrainService();
        es.update(e);
        
        
        refresh();
    }
    }
    }
    
    
}

    

