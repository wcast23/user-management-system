<?php

namespace App\QueryFilters;

use Illuminate\Http\Request;

/**
 * Class UserFilter to allow filtering by names and emails
 */
class UserFilter
{
    protected $request;
    protected $query;
    protected $filterables = ['name', 'email'];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        $this->query = $query;

        // Global search with ?q=somevalue
        if ($this->request->filled('q')) {
            $this->query->where(function ($subQuery) {
                foreach ($this->filterables as $field) {
                    $subQuery->orWhere($field, 'like', '%' . $this->request->q . '%');
                }
            });
        }

        /**
         * Filter by a Specific field (name or email)
        */
        foreach ($this->filters() as $field => $value) {
            if (in_array($field, $this->filterables)) {
                $this->query->where($field, 'like', '%' . $value . '%');
            }
        }

        return $this->query;
    }

    protected function filters()
    {
        return $this->request->only($this->filterables);
    }
}
