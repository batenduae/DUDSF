<?php

namespace App\Contracts;

interface MenuContract
{
    public function listMenus(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc');
    public function findMenuById(int $id);
    public function createMenu(array $params);
    public function updateMenu(array $params);
    public function deleteMenu(int $id);
}
