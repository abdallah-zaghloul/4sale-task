<?php

namespace Modules\User\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Modules\Provider\Enums\ProviderEnum;
use Modules\Transaction\Enums\CurrencyEnum;
use Modules\Transaction\Enums\ProviderStatusCodeEnum;
use Modules\User\Models\User;
use Modules\User\Traits\QueryCheck;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RequestCriteria.
 *
 * @package namespace Modules\User\QueryCheck;
 */
class UserTransactionCriteria implements CriteriaInterface
{
    use QueryCheck;

    /**
     * @var Builder
     */
    protected Builder $builder;


    /**
     *
     */
    public function __construct()
    {
        $this->builder = User::query()
            ->leftJoin('transactions','transactions.user_id','=','users.id')
            ->join('providers','transactions.provider_id','=','providers.id');
    }


    /**
     * @return $this
     */
    protected function providerFilter(): self
    {
        $this->builder->when(
            !empty($providers = $this->queryValidEnums('provider',fn($queryParam) => ProviderEnum::get($queryParam))),
            fn(Builder $builder) => match (count($providers)){
                1 => $builder->where('providers.provider', head($providers)),
                default => $builder->whereIn('providers.provider', $providers),
            });
        return $this;
    }


    /**
     * @return $this
     */
    protected function statusCodeFilter(): self
    {
        $this->builder->when(
            !empty($statusCodes = $this->queryValidEnums('statusCode',fn($queryParam) => ProviderStatusCodeEnum::get($queryParam))),
            fn(Builder $builder) => match (count($statusCodes)){
                1 => $builder->where('transactions.status_code', head($statusCodes)),
                default => $builder->whereIn('transactions.status_code', $statusCodes),
            });
        return $this;
    }

    /**
     * @return $this
     */
    protected function balanceFilter(): self
    {
        $this->builder->when(
            ($balanceMin = $this->numberFormat('balanceMin')) && ($balanceMax = $this->numberFormat('balanceMax')),
            fn(Builder $builder) => $builder->whereBetween('transactions.balance', [$balanceMin, $balanceMax])
        );
        return $this;
    }

    /**
     * @return $this
     */
    protected function currencyFilter(): self
    {
        $this->builder->when(
            !empty($currencies = $this->queryValidEnums('currency',fn($queryParam) => CurrencyEnum::get($queryParam))),
            fn(Builder $builder) => match (count($currencies)) {
                1 => $builder->where('transactions.currency', head($currencies)),
                default => $builder->whereIn('transactions.currency', $currencies)
            });
        return $this;
    }


    /**
     * Apply criteria in query repository
     *
     * @param mixed              $model
     * @param RepositoryInterface $repository
     *
     * @return Builder
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $this->providerFilter()
            ->statusCodeFilter()
            ->balanceFilter()
            ->currencyFilter();

        return $this->builder->select(
            'users.*',
            'transactions.id as transaction_id',
            'transactions.balance','transactions.currency','transactions.status_code',
            'transactions.created_at as transaction_created_at','transactions.updated_at as transaction_updated_at',
            'providers.provider','providers.id as provider_id',
        )->latest('transaction_created_at');
    }
}
