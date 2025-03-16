<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

/**
 * Service class to handle advanced filtering for Occupations.
 *
 * This service is responsible for parsing filter query strings and
 * dynamically applying them to the Eloquent query builder.
 */
class OccupationFilterService
{
    /**
     * Apply the parsed filter string to the Occupation query.
     *
     * @param  Builder $query  The base Occupation query builder instance
     * @param  string  $filter The raw filter string from query parameters
     * @return Builder         The modified query with applied filters
     */
    public function apply(Builder $query, string $filter): Builder
    {
        // 🔍 Parse and apply filters like:
        // e.g., "job_type=full-time AND status=published"
        return $this->parseExpression($query, $filter);
    }

    /**
     * Parse the raw filter string and apply basic conditions to the query.
     *
     * Supports simple key=value pairs for now (e.g. job_type=full-time).
     *
     * @param  Builder $query  The Eloquent query builder
     * @param  string  $filter The raw filter string
     * @return Builder         The updated query builder
     */
    protected function parseExpression(Builder $query, string $filter): Builder
    {
        /**
         * Basic pattern matching: finds all key=value pairs
         * Example filter: "job_type=full-time status=published"
         * Matches:
         *   - [0] => full string match (e.g. job_type=full-time)
         *   - [1] => key (e.g. job_type)
         *   - [2] => value (e.g. full-time)
         */
        preg_match_all('/(\w+)=([\w\-]+)/', $filter, $matches, PREG_SET_ORDER);

        foreach ($matches as [$_, $key, $value]) {
            match ($key) {
                // Handle enum fields (job_type, status)
                'job_type', 'status' => $query->where($key, $value),

                // Handle boolean fields
                'is_remote' => $query->where('is_remote', filter_var($value, FILTER_VALIDATE_BOOLEAN)),

                // You can add more basic field mappings here (e.g. salary_min, title)
                default => null // Unrecognized keys are skipped (safe fail)
            };
        }

        return $query;
    }
}
