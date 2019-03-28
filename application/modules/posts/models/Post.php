<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Model
{
  //the database table
  public $table_name = 'posts';

  //Primary key field
  public $primary_key = 'id';

  //Filter for primary key
  public $primaryFilter = 'intval';

  //Order by field, Default order for this model
  public $order_by = '';

  public function __construct()
  {
    parent::__construct();
  }
  public function get_my_post($poster_id)
  {
    $querry=$this->db->select('posts.id AS post_id,posts.poster_id,posts.title,
    posts.category_id,posts.created_at,posts.body,categories.category_name,users.firstname,users.lastname,users.profile_pic', false)->from('posts')
    ->join('categories','categories.id=posts.category_id')
    ->join('users','users.id=posts.poster_id')
    ->where(array('posts.poster_id'=>$poster_id))->order_by('posts.id','DESC')->get();

    return $querry->result_array();

  }

  public function get_single_post($post_id)
  {
    $querry=$this->db->select('posts.id AS post_id,posts.poster_id,posts.title,
    posts.category_id,posts.created_at,posts.body,categories.category_name,users.firstname,users.lastname,users.profile_pic', false)->from('posts')
    ->join('categories','categories.id=posts.category_id')
    ->join('users','users.id=posts.poster_id')
    ->where(array('posts.id'=>$post_id))->order_by('posts.id','DESC')->get();

    return $querry->row_array();

  }
}