<?php

namespace App\Contracts;

interface MemberContract
{
    public function listMembers(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc');
    public function findMemberById(int $id);
    public function createMember(array $params);
    public function updateMember(array $params);
    public function deleteMember(int $id);
}
