<?php

namespace Invezgo\Service;

/**
 * Membership Service - Berlangganan
 */
class MembershipService extends BaseService
{
    /**
     * Get list of memberships
     *
     * @return array
     */
    public function getMemberships(): array
    {
        return $this->client->get('/membership');
    }

    /**
     * Add new membership
     *
     * @param array $data Membership data
     * @return array
     */
    public function addMembership(array $data): array
    {
        return $this->client->post('/membership', $data);
    }

    /**
     * Get membership scope
     *
     * @return array
     */
    public function getScope(): array
    {
        return $this->client->get('/membership/scope');
    }

    /**
     * Get transaction membership list
     *
     * @return array
     */
    public function getTransactionMembership(): array
    {
        return $this->client->get('/membership/list');
    }

    /**
     * Update membership
     *
     * @param string $id Membership ID
     * @param array $data Membership data
     * @return array
     */
    public function changeMembership(string $id, array $data): array
    {
        return $this->client->put("/membership/{$id}", $data);
    }

    /**
     * Delete membership
     *
     * @param string $id Membership ID
     * @return array
     */
    public function deleteMembership(string $id): array
    {
        return $this->client->delete("/membership/{$id}");
    }
}

