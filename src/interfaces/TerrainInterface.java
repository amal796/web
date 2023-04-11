/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entity.Terrain;
import java.util.List;

/**
 *
 * @author amela
 */
public interface TerrainInterface {
    public void create(Terrain terrain);
    public Terrain read(int id_terrain);
    public List<Terrain> readAll();
    public void update(Terrain terrain);
    public void delete(Terrain r); 
}
