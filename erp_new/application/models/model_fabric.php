<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fabric
 *
 * @author hp
 */
class model_fabric extends CI_Model {

   //put your code here

   public function __construct() {
      parent::__construct();
   }

   function get($page, $rows, $query) {
      $offset = ($page - 1) * $rows;
      $result = array();
      $result['total'] = $this->db->query($query)->num_rows();
      $row = array();
      $query .= " limit $rows offset $offset";
      $criteria = $this->db->query($query)->result();
      foreach ($criteria as $data) {
         $row[] = array(
             'code' => $data->code,
             'description' => $data->description
         );
      }
      $result = array_merge($result, array('rows' => $row));
      return json_encode($result);
   }
   
   function get_remote_data($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'code' => $data->code,
                'description' => $data->description
            );
        }
        return json_encode($row);
    }

   function selectAllResult() {
      return $this->db->get('fabric')->result();
   }

   function insert($data) {
      return $this->db->insert('fabric', $data);
   }

   function update($data, $where) {
      return $this->db->update('fabric', $data, $where);
   }

   function delete($where) {
      return $this->db->delete('fabric', $where);
   }

}

?>
