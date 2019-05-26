<?php

namespace App\Http;

class ApiRequest
{
    private $allowed_includes;
    
    private $allowed_filters = [];

    private $ignored_filters = [];

    private $default_sort = '';

    private $allowed_sorts = [];

    private $allowed_fields = null;

    public function __construct($arguments = [])
    {
        if (isset($arguments['includes'])) {
            $this->setAllowedIncludes($arguments['includes']);
        }
        if (isset($arguments['filters'])) {
            $this->setAllowedFilters($arguments['filters']);
        }

        if (isset($arguments['sort'])) {
            if (isset($arguments['sort']['default'])) {
                $this->setDefaultSort($arguments['sort']['default']);
            }

            if (isset($arguments['sort']['fields'])) {
                $this->setAllowedSorts($arguments['sort']['fields']);
            }
        }
    }

    public function getAllowedIncludes()
    {
        return $this->allowed_includes;
    }

    public function setAllowedIncludes(...$includes)
    {
        $this->allowed_includes = $includes;

        return $this;
    }

    public function getAllowedFilters()
    {
        return $this->allowed_filters;
    }

    public function setAllowedFilters($filters)
    {
        $this->allowed_filters = $filters;

        return $this;
    }

    public function getIgnoredFilters()
    {
        return $this->ignored_filters;
    }

    public function setIgnoredFilters(array $filters)
    {
        $this->ignored_filters = $filters;

        return $this;
    }

    public function getDefaultsort()
    {
        return $this->default_sort;
    }

    public function setDefaultSort($default)
    {
        $this->default_sort = $default;

        return $this;
    }

    public function hasDefaultSort()
    {
        return !empty($this->default_sort);
    }

    /**
     * Restricts sorts, leaving empty will allow all attributes to be sorted
     */
    public function setAllowedSorts(array $sorts)
    {
        $this->allowed_sorts = $sorts;

        return $this;
    }

    public function getAllowedSorts()
    {
        return $this->allowed_sorts;
    }

    public function hasAllowedSorts()
    {
        return !empty($this->allowed_sorts);
    }

    public function setAllowedFields(...$fields)
    {
        $this->allowed_fields = $fields;

        return $this;
    }

    public function getAllowedFields()
    {
        return $this->allowed_fields;
    }

    public function hasAllowedFields()
    {
        return !empty($this->allowed_fields);
    }
}
