<?php

// Constants to determine which function is being used
// and appropriate links
define('PAGES_STUDENTS',1);
define('PAGES_FACULTY',2);
define('PAGES_CLASSES',3);
define('PAGES_COURSES',4);
define('PAGES_ADVISORS',5);
define('PAGES_APPOINTMENTS',6);

class Pagination{
  private $list_type;
  private $input;
  private $limit;
  private $current_page;
  private $total_pages;
  private $total_rows;
  private $id;

  public function __construct($list_type, $input, $id = -1, $limit = 9){
    $this->list_type = $list_type;
    $this->input = $input;
    $this->limit = $limit;
    $this->id = $id;
    $this->set_total_pages();
    $this->set_current_page();
  }
  
  public function get_limit(){
    return $this->limit;
  }

  public function get_offset(){
    return ($this->current_page - 1) * $this->limit;
  }
  
  public function get_total_rows(){
    return $this->total_rows;
  }

  public function get_pagination_query($sql,$types,$params){
    $sql.= "
        LIMIT {$this->get_limit()}
        OFFSET {$this->get_offset()}
    ";
    return query_many($sql, $types, $params);
  }

  public static function get_count_query($sql, $types, $params){
    $f_sql = "
      SELECT COUNT(*) as cnt
      FROM ({$sql}) as count_table
    ";
    $row = query_one($f_sql, $types, $params);
    return isset($row["cnt"])? (int)$row["cnt"] : 0;
  }

  private function get_count($id = null){
    switch($this->list_type){
      case PAGES_STUDENTS:
        return get_all_students($_GET, true);
        break;
      case PAGES_FACULTY:
        return get_all_faculty($_GET, true);
        break;
      case PAGES_CLASSES:
        return get_all_classes($_GET, true);
        break;
      case PAGES_COURSES:
        return get_all_courses($_GET, true);
        break;
      case PAGES_ADVISORS:
        return get_all_advisors($_GET, true);
        break;
      case PAGES_APPOINTMENTS:
        return get_appointments_by_instructor($this->id, $_GET, true);
      default:
        return -1;
    }
    return -1;
  }

  private function set_total_pages(){
    $this->total_rows = $this->get_count();
    $this->total_pages = ceil($this->total_rows / $this->limit);
    if($this->total_pages <= 0)
      $this->total_pages = 1;
  }

  private function set_current_page(){
    $page = isset($this->input["page"])? (int)$this->input["page"] : 1;
    $this->current_page = $page !== 0 && $page <= $this->total_pages? $page : 1;
  }

  private function get_one_link($page){
    if($page === $this->current_page){
      return "<span class='pagination-link'>{$page}</span>";
    }
    $href = "user.php?";
    $params = [];
    foreach($this->input as $key=>$value){
      if($key !== "page")
        $params[] = $key . "=" . $value;
    }
    $params[] = "page={$page}";
    $href .= implode($params,"&");
    $link = "<a class='pagination-link' href={$href}>{$page}</a>";
    return $link;
  }
  public function print_all_links(){
    echo "<div class='pagination'>";
    for($i=1;$i<=$this->total_pages;$i++){
      echo $this->get_one_link($i);
    }
    echo "</div>";
  }
}

?>