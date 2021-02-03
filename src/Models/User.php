<?php

namespace Cms\Models;

class User extends \Porteiro\Models\User
{

    public function social()
    {
        return $this->hasMany('Informate\Models\System\Social');
    }
    
    /**
     * Referentes a Business
     * 
     * Retorna 3 Caso seja Deus
     * Retorna 2 Caso seja Admin
     * Retorna 1 Caso seja Inscrito
     * Retorna 0 Caso não seja Inscrito no Business
     */
    public function getLevelForAcessInBusiness()
    {
        if ($this->isRoot()) {
            return 3;
        }

        if ($this->isAdmin()) {
            return 2;
        }

        if ($this->isClient()) {
            return 1;
        }

        return 0;
    }
    public function isRoot()
    {
        return $this->admin == 2;
    }
    public function isAdmin()
    {
        return $this->isRoot() || $this->admin == 1 && app(\Cms\Services\BusinessService::class)->userAsColaborator($this);
    }
    public function isClient()
    {
        return app(\Cms\Services\BusinessService::class)->userAsSubscript($this);
    }

    /**
     * Mostra o tipo de usuário para o cliente
     */
    public function getUserType()
    {
        if ($this->isAdmin()) {
            return 'Admin';
        }
        return 'Business';
    }

}
