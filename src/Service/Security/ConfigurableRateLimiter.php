<?php

declare(strict_types=1);

namespace Endereco\Shopware6Client\Service\Security;

use Shopware\Core\Framework\RateLimiter\Exception\RateLimitExceededException;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\RateLimiter\Storage\StorageInterface;

/**
 * Sliding-window rate limiting whose limit value is read from System Config on every
 * call, instead of being frozen into the compiled container via Shopware's YAML-based
 * `shopware.api.rate_limiter` mechanism (which only supports runtime-configurable
 * values for the "time_backoff"/"system_config" policies, not "sliding_window").
 *
 * Leaves Symfony's own rate limiter algorithm and storage untouched - only the
 * limit is made flexible.
 */
final class ConfigurableRateLimiter implements ConfigurableRateLimiterInterface
{
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function ensureAccepted(
        string $id,
        string $key,
        int $limit,
        string $interval
    ): void {

        $factory = new RateLimiterFactory(
            ['id' => $id, 'policy' => 'sliding_window', 'limit' => $limit, 'interval' => $interval],
            $this->storage
        );

        $rateLimit = $factory->create($key)->consume();

        if (!$rateLimit->isAccepted()) {
            throw new RateLimitExceededException($rateLimit->getRetryAfter()->getTimestamp());
        }
    }
}
