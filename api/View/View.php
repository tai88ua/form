<?php

namespace App\View;

class View
{
    private array $data = [];

    public function renderJson(): void
    {
        echo json_encode($this->data);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return View
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }
}
