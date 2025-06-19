<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stage
 *
 * @author hp
 */
class model_stage extends CI_Model {

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

   function selectAllResult() {
      return $this->db->get('stage')->result();
   }

   function insert($data) {
      return $this->db->insert('stage', $data);
   }

   function update($data, $where) {
      return $this->db->update('stage', $data, $where);
   }

   function delete($where) {
      return $this->db->delete('stage', $where);
   }

}

?>
