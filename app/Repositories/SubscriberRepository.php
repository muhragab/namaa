<?php

namespace App\Repositories;

use App\Models\Subscriber;
use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class SubscriberRepository
 * @package App\Repositories
 * @version December 25, 2022, 2:30 pm UTC
*/

class SubscriberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'username',
        'password',
        'status',
        'pc_id',
        'type'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
