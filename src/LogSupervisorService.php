<?php

namespace carolezountangni\LogSupervisor;

use Composer\InstalledVersions;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class LogSupervisorService
{
    const DEFAULT_MAX_LOG_SIZE_TO_DISPLAY = 131_072;    // 128 KB


    protected string $_cachedTimezone;
    protected mixed $authCallback;
    protected mixed $hostsResolver;
    protected string $layout = 'log-supervisor::index';

    public function timezone(): string
    {
        if (!isset($this->_cachedTimezone)) {
            $this->_cachedTimezone = config('log-supervisor.timezone')
                ?? config('app.timezone')
                ?? 'UTC';
        }

        return $this->_cachedTimezone;
    }



    public function getRouteDomain(): ?string
    {
        return config('log-supervisor.route_domain');
    }

    public function getRoutePrefix(): string
    {
        return config('log-supervisor.route_path', 'log-supervisor');
    }

    public function getRouteMiddleware(): array
    {
        return config('log-supervisor.middleware', []) ?: ['web'];
    }

    public function setViewLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function getViewLayout(): string
    {
        return $this->layout;
    }

    /**
     * Determine if Log Viewer's published assets are up-to-date.
     *
     * @throws \RuntimeException
     */
    public function assetsAreCurrent(): bool
    {
        $publishedPath = public_path('vendor/log-supervisor/mix-manifest.json');

        if (!File::exists($publishedPath)) {
            throw new \RuntimeException('Log Superviosor assets are not published. Please run: php artisan vendor:publish --tag=log-supervisor-assets --force');
        }

        return File::get($publishedPath) === File::get(__DIR__ . '/../public/mix-manifest.json');
    }

    /**
     * Get the current version of the Log Viewer
     */
    public function version(): string
    {
        if (app()->runningUnitTests()) {
            return 'unit-tests';
        }

        if (class_exists(InstalledVersions::class)) {
            return InstalledVersions::getPrettyVersion('carolezountangni/log-supervisor') ?? 'dev-main';
        } else {
            $composerJson = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);

            return is_array($composerJson) && isset($composerJson['version'])
                ? $composerJson['version']
                : 'dev-main';
        }
    }
}
