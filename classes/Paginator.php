<?php
namespace Classes;

class Paginator {
    private int $currentPage;
    private int $recordsPerPage;
    private int $totalRecords;

    public function __construct(int $currentPage = 1, int $recordsPerPage = 10, int $totalRecords = 0) {
        $this->currentPage = (int) $currentPage;
        $this->recordsPerPage = (int) $recordsPerPage;
        $this->totalRecords = (int) $totalRecords;
    }

    public function getOffset() : int {
        return $this->recordsPerPage * ($this->currentPage - 1);
    }

    public function getTotalPages() : int {
        return (int) ceil($this->totalRecords / $this->recordsPerPage);
    }

    public function getPreviousPage() {
        $previousPage = $this->currentPage - 1;
        return $previousPage > 0 ? $previousPage : false; 
    }

    public function getFollowingPage() {
        $followingPage = $this->currentPage + 1;
        return $followingPage <= $this->getTotalPages() ? $followingPage : false;
    }

    public function followingLink() : string {
        $html = '';
        if($this->getFollowingPage()) {
            $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->getFollowingPage()}\" >Siguiente &raquo</a>";
        }
        return $html;
    }

    public function previousLink() : string {
        $html = '';
        if($this->getPreviousPage()) {
            $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->getPreviousPage()}\" >&laquo Anterior</a>";
        }
        return $html;
    }

    public function pageNumbers() {
        $html = '';
        for ($i = 1; $i <= $this->getTotalPages(); $i++) {
            if($i === $this->currentPage) {
                $html .= "<span class=\"pagination__link pagination__link--current\">{$i}</span>";
            } else {
                $html .= "<a class=\"pagination__link pagination__link--number\" href=\"?page={$i}\">{$i}</a>";
            }
        }
        return $html;
    }

    public function pagination() : string {
        $html = '';
        if ($this->totalRecords > 0) {
            $html .= "<div class=\"pagination\">";
            $html .= $this->previousLink();
            $html .= $this->pageNumbers();
            $html .= $this->followingLink();
            $html .= "</div>";
        }

        return $html;
    }
}