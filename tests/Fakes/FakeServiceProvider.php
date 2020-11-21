<?php

namespace Tests\Fakes;

use App\Http\RequestInterface;
use App\Providers\AppServiceProvider;

class FakeServiceProvider extends AppServiceProvider
{
    /**
     * Register any application services.
     *
     * @return  void
     */
    public function register(): void
    {
        $this->app->bind('App\Http\RequestInterface', function () {
            return new class implements RequestInterface
            {
                public function getRequest(string $name, string $path)
                {
                    if ($name AND $path) {
                        return $this->responseData();
                    }
                }

                private function responseData()
                {
                    return '{"message":"Lost contact.","map":"## *x ###\n## *  ###","code":410,"path":"lf"}';
                }
            };
        });
    }
}
