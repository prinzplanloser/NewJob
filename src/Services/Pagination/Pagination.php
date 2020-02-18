<?php


namespace App\Services\Pagination;

use App\Models\Tasks\Task;

use App\Services\Db\Db;

class Pagination
{
    private $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function pag(int $startPage, int $pageLimit)
    {
        $result = $this->db->simpleQuery('SELECT COUNT(*) FROM tasks');
        $total = intval(($result[0] - 1) / $pageLimit) + 1;
        $page = intval($startPage);
        if (empty($page) or $page < 0) $page = 1;
        if ($page > $total) $page = $total;
        $start = $page * $pageLimit - $pageLimit;
        $pagination = $this->db->limit("SELECT * FROM tasks LIMIT ?,?", [$start, $pageLimit], Task::class);
        return $pagination;
    }

    public function paginate($currentPage, int $pageLimit)
    {
        $page = $currentPage;
        $result = $this->db->simpleQuery('SELECT COUNT(*) FROM tasks');
        $total = intval(($result[0] - 1) / $pageLimit) + 1;
        $page = intval($page);
        if (empty($page) or $page < 0) $page = 1;
        if ($page > $total) $page = $total;
        $start = $page * $pageLimit - $pageLimit;
        $pagination = $this->db->limit("SELECT * FROM tasks LIMIT ?,?", [$start, $pageLimit], Task::class);
        $pagination = $this->db->limit("SELECT * FROM tasks",[],Task::class);
        return ['pagination' => $pagination, 'total' => $total];
    }

}




