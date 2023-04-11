/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import entity.Reservation;
import entity.Terrain;
import interfaces.ReservationInterface;
import interfaces.TerrainInterface;
import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.beans.property.SimpleObjectProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Spinner;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.input.MouseEvent;
import javafx.stage.Stage;
import services.ReservationService;
import services.TerrainService;
import util.MyConnection;

/**
 * FXML Controller class
 *
 * @author amela
 */
public class ReservationVController implements Initializable {

    @FXML
    private TextField id_utilisateur;
    @FXML
    private TextField nbr_membre;
    @FXML
    private DatePicker date_debut;
    @FXML
    private DatePicker date_fin;
    @FXML
    private Button addR;
    @FXML
    private Button clearR;
    @FXML
    private TableView<Reservation> listeReservation;
    @FXML
    private TableColumn<Reservation , Integer> idReservation;
    @FXML
    private TableColumn<Reservation , Integer> nbrMembre;
    @FXML
    private TableColumn<Reservation , Integer> idUtilisateur;
    @FXML
    private TableColumn<Reservation , Integer> idTerrain;
    @FXML
    private TableColumn<Reservation , Date> dateDebut;
    @FXML
    private TableColumn<Reservation , Date> dateFin;
    @FXML
    private Button dropR;
    @FXML
    private Button updateR;
    @FXML
    private Button backH;
    Connection mc;
    PreparedStatement ste;
    ObservableList<Reservation>reservationList;
    @FXML
    private TextField id_terrain;
    @FXML
    private TextField id_reservation;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
        afficherReservations();
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

void afficherReservations(){
            mc=MyConnection.getInstance().getCnx();
            reservationList = FXCollections.observableArrayList();
      
      try {
            String requete = "SELECT * FROM reservation e ";
            Statement st = MyConnection.getInstance().getCnx()
                    .createStatement();
            ResultSet rs =  st.executeQuery(requete); 
            while(rs.next()){
                Reservation e = new Reservation();
                e.setId_reservation(rs.getInt("id_reservation"));
                e.setNbr_membre(rs.getInt("nbr_membre"));
                e.setDate_debut(rs.getDate("date_debut"));
                e.setDate_fin(rs.getDate("date_fin"));
                e.setId_terrain(rs.getInt("id_terrain"));
                e.setId_utilisateur(rs.getInt("id_utilisateur"));
                
                reservationList.add(e);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
      
  idReservation.setCellValueFactory(data -> new SimpleObjectProperty(data.getValue().getId_reservation()));
nbrMembre.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getNbr_membre()));
dateDebut.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getDate_debut()));
dateFin.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getDate_fin()));
idTerrain.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getId_terrain()));
idUtilisateur.setCellValueFactory(data ->new SimpleObjectProperty(data.getValue().getId_utilisateur()));

  
  listeReservation.setItems(reservationList);
  
  refresh();
  
  }
    public void refresh(){
            reservationList.clear();
            mc=MyConnection.getInstance().getCnx();
            reservationList = FXCollections.observableArrayList();
      
      try {
            String requete = "SELECT * FROM reservation e ";
            Statement st = MyConnection.getInstance().getCnx()
                    .createStatement();
            ResultSet rs =  st.executeQuery(requete); 
            while(rs.next()){
                Reservation e = new Reservation();
                e.setId_reservation(rs.getInt("id_reservation"));
                e.setNbr_membre(rs.getInt("nbr_membre"));
                e.setDate_debut(rs.getDate("date_debut"));
                e.setDate_fin(rs.getDate("date_fin"));
                e.setId_terrain(rs.getInt("id_terrain"));
                e.setId_utilisateur(rs.getInt("id_utilisateur"));
                System.out.println("the added reservations :" +e.toString());
                
                reservationList.add(e);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        listeReservation.setItems(reservationList);
        
  }    

    @FXML
    private void ajoutReservation(MouseEvent event) {
        
         String nbrMembre=nbr_membre.getText();
        Date dateDebut= Date.valueOf(date_debut.getValue());
        Date dateFin= Date.valueOf(date_fin.getValue());
        String idTerrain = id_terrain.getText();
        String idUtilisateur = id_utilisateur.getText();
        if (nbrMembre.isEmpty() || idTerrain.isEmpty()|| idUtilisateur.isEmpty() || idTerrain.isEmpty()|| idUtilisateur.isEmpty()){
            Alert alert = new Alert(Alert.AlertType.ERROR);
             alert.setContentText("Il y a un champ vide !!"); // controle de saisie vide
             alert.showAndWait();          
         }
        
         else{
                Reservation e= new Reservation(nbrMembre,dateDebut,dateFin,idTerrain,idUtilisateur);
        ReservationService es= new ReservationService();
        es.ajouterReservation(e);
        
     
                nbr_membre.setText(null);           //yrodlik les text area vide baad AJOUT
        date_debut.setValue(null);
        date_fin.setValue(null);   
        id_terrain.setText(null);
        id_utilisateur.setText(null);
            System.out.println("reservation::::::"+e);
        
      
        
       refresh();
    }
    }

    @FXML
    private void clearR(MouseEvent event) {
        nbr_membre.setText(null);           //yrodlik les text area vide baad AJOUT
        date_debut.setValue(null);
        date_fin.setValue(null);   
        id_terrain.setText(null);
        id_utilisateur.setText(null);
        
      
        
       refresh();
    }

    @FXML
    private void dropR(MouseEvent event) {
          Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
       alert.setHeaderText("Warning");
       alert.setContentText("Es-tu sûre de supprimer!");
       String idReservation = id_reservation.getText();
        String nbrMembre=nbr_membre.getText();
        Date dateDebut= Date.valueOf(date_debut.getValue());
        Date dateFin= Date.valueOf(date_fin.getValue());
        String idTerrain = id_terrain.getText();
        String idUtilisateur = id_utilisateur.getText();
        Optional<ButtonType>result =  alert.showAndWait();
        if(result.get() == ButtonType.OK)
        {
      
         Reservation e= new Reservation(Integer.parseInt(idReservation),nbrMembre,dateDebut,dateFin,idTerrain,idUtilisateur);
        ReservationInterface es= new ReservationService();
        es.supprimerReservation(e);
        refresh();
      nbr_membre.setText(null);           //yrodlik les text area vide baad AJOUT
        date_debut.setValue(null);
        date_fin.setValue(null);   
        id_terrain.setText(null);
        id_utilisateur.setText(null);

        }
    }

    @FXML
    private void selectedR(MouseEvent event) {
    Reservation clicked = listeReservation.getSelectionModel().getSelectedItem();
        id_reservation.setText(String.valueOf(clicked.getId_reservation()));
        nbr_membre.setText(String.valueOf(clicked.getNbr_membre()));
        date_debut.setText(Date.valueOf(clicked.getDate_debut()));
        date_fin.setText(String.valueOf(clicked.getDate_fin()));
       id_terrain.setText(String.valueOf(clicked.getId_terrain()));
        id_utilisateur.setText(String.valueOf(clicked.getId_utilisateur()));
    }
    
}
